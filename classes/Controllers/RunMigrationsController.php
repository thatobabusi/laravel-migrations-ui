<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Migrator;
use DaveJamesMiller\MigrationsUI\Models\Migration;
use DaveJamesMiller\MigrationsUI\Repositories\MigrationsRepository;
use DaveJamesMiller\MigrationsUI\Responses\OverviewResponse;
use Exception;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use LogicException;
use RuntimeException;

class RunMigrationsController
{
    /** @var \DaveJamesMiller\MigrationsUI\Repositories\MigrationsRepository */
    private $migrations;

    /** @var \DaveJamesMiller\MigrationsUI\Migrator */
    private $migrator;

    /** @var \DaveJamesMiller\MigrationsUI\Responses\OverviewResponse */
    private $response;

    /** @var float */
    private $startTime;

    /** @var string|null */
    private $currentAction;

    public function __construct(MigrationsRepository $migrations, Migrator $migrator)
    {
        $this->migrations = $migrations;
        $this->migrator = $migrator;
        $this->response = OverviewResponse::make();
        $this->startTime = microtime(true);
    }

    private function load(Collection $migrations): void
    {
        if ($migration = $migrations->firstWhere('file', null)) {
            throw new RuntimeException("Cannot load migration '{$migration->name}' as it was not found on disk.");
        }

        $files = $migrations->pluck('file')->all();

        $this->migrator->requireFiles($files);
    }

    private function migrate(Collection $migrations): int
    {
        $this->load($migrations);

        $batch = $this->migrator->getRepository()->getNextBatchNumber();

        /** @var Migration $migration */
        foreach ($migrations as $migration) {
            $this->currentAction = "{$migration->name} (up method)";
            $this->migrator->runUp($migration->file, $batch, false);
        }

        $this->currentAction = null;

        return count($migrations);
    }

    private function migrateAndRespond(Collection $migrations)
    {
        try {
            $count = $this->migrate($migrations);
        } catch (Exception $e) {
            return $this->response->withException('Error in ' . $this->currentAction, $e);
        }

        if ($migrations->count() === 1) {
            $migration = $migrations->first();

            return $this->response->withSuccess('Migrated', $migration->name, $this->runtime());
        }

        return $this->response->withSuccess('Migrated', "Ran $count migrations.", $this->runtime());
    }

    public function migrateSingle(Migration $migration)
    {
        return $this->migrateAndRespond(collect([$migration]));
    }

    public function migrateAll()
    {
        $migrations = $this->migrations->pending();

        if ($migrations->isEmpty()) {
            return OverviewResponse::make()->withError('Cannot Run Migrations', 'No migrations are pending.');
        }

        return $this->migrateAndRespond($migrations);
    }

    private function rollback(Collection $migrations): int
    {
        $this->load($migrations);

        /** @var Migration $migration */
        foreach ($migrations as $migration) {
            $this->currentAction = "{$migration->name} (down method)";

            $this->migrator->runDown(
                $migration->file,
                (object)['migration' => $migration->name],
                false
            );
        }

        $this->currentAction = null;

        return count($migrations);
    }

    private function rollbackAndRespond(Collection $migrations)
    {
        try {
            $count = $this->rollback($migrations);
        } catch (Exception $e) {
            return $this->response->withException('Error in ' . $this->currentAction, $e);
        }

        if ($count === 1) {
            $migration = $migrations->first();

            return $this->response->withSuccess('Rolled Back', $migration->name, $this->runtime());
        }

        return $this->response->withSuccess('Rolled Back', "Rolled back $count migrations.", $this->runtime());
    }

    public function rollbackSingle(Migration $migration)
    {
        return $this->rollbackAndRespond(collect([$migration]));
    }

    public function rollbackBatch(int $batch)
    {
        $migrations = $this->migrations->batch($batch);

        if ($migrations->isEmpty()) {
            return OverviewResponse::make()->withError('Cannot Roll Back', "No migrations found in batch $batch.");
        }

        return $this->rollbackAndRespond($migrations);
    }

    public function rollbackAll()
    {
        $migrations = $this->migrations->applied();

        if ($migrations->isEmpty()) {
            return OverviewResponse::make()->withError('Cannot Roll Back', "No applied migrations found.");
        }

        return $this->rollbackAndRespond($migrations);
    }

    public function fresh(DatabaseManager $db)
    {
        $builder = $db->getSchemaBuilder();

        /** @see \Illuminate\Database\Console\WipeCommand::handle() */
        $types = ['tables'];

        // Drop views
        if (config('migrations-ui.fresh.views')) {
            try {
                $builder->dropAllViews();
                $types[] = 'views';
            } catch (LogicException $e) {
                $this->response->withWarning('Cannot Drop Views', $e->getMessage());
            }
        }

        // Drop tables
        $builder->dropAllTables();

        // Drop types (Postgres only)
        if (config('migrations-ui.fresh.types')) {
            try {
                $builder->dropAllTypes();
                $types[] = 'types';
            } catch (LogicException $e) {
                $this->response->withWarning('Cannot Drop Types', $e->getMessage());
            }
        }

        // Re-create the migrations table
        $this->migrator->getRepository()->createRepository();

        // Run migrations & seeders (if requested)
        // Can't use this until Laravel 5.8:
        // $message = 'Dropped all ' . collect($types)->join(', ', ' & ') . '.';
        $lastType = array_pop($types);
        $message = 'Dropped all ' . ($types ? implode(', ', $types) . ' & ' . $lastType : $lastType) . '.';
        return $this->finishRefresh('Fresh', $message);
    }

    public function refresh()
    {
        // Rollback all migrations
        $count = $this->rollback($this->migrations->applied());

        // Run migrations & seeders (if requested)
        $message = $count === 1 ? 'Rolled back 1 migration.' : "Rolled back $count migrations.";
        return $this->finishRefresh('Refresh', $message);
    }

    private function finishRefresh($type, $message)
    {
        $messages = [$message];

        try {
            // Run all migrations
            $count = $this->migrate($this->migrations->pending());
            $messages[] = $count === 1 ? 'Ran 1 migration.' : "Ran $count migrations.";

            // Seed the database (if requested)
            if (Request::get('seed', false)) {
                $this->currentAction = 'Database Seeder';
                if ($this->runSeeder()) {
                    $messages[] = 'Seeded the database.';
                }
                $this->currentAction = null;
            }
        } catch (Exception $e) {
            return $this->response->withException('Error in ' . $this->currentAction, $e);
        }

        return $this->response->withSuccess($type, implode("\n", $messages), $this->runtime());
    }

    private function runSeeder()
    {
        /** @see \DatabaseSeeder */
        $class = config('migrations-ui.seeder');

        if (!class_exists($class)) {
            $this->response->withError('Cannot Seed Database', "Unable to find $class class.");
            return false;
        }

        /** @see \Illuminate\Database\Console\Seeds\SeedCommand::getSeeder() */
        /** @var \Illuminate\Database\Seeder $seeder */
        $seeder = app($class);

        /** @see \Illuminate\Database\Console\Seeds\SeedCommand::handle() */
        $seeder->setContainer(app())->__invoke();

        return true;
    }

    public function seed()
    {
        try {
            if ($this->runSeeder()) {
                $this->response->withSuccess('Seed', 'Database seeded', $this->runtime());
            }
        } catch (Exception $e) {
            return $this->response->withException('Error in Database Seeder', $e);
        }

        return $this->response;
    }

    private function runtime()
    {
        return round(microtime(true) - $this->startTime, 2);
    }
}
