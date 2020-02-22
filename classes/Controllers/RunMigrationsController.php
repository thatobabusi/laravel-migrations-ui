<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Exceptions\SeederException;
use DaveJamesMiller\MigrationsUI\Migrator;
use DaveJamesMiller\MigrationsUI\Models\Migration;
use DaveJamesMiller\MigrationsUI\Repositories\MigrationsRepository;
use DaveJamesMiller\MigrationsUI\Responses\OverviewResponse;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use LogicException;

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

    public function __construct(MigrationsRepository $migrations, Migrator $migrator)
    {
        $this->migrations = $migrations;
        $this->migrator = $migrator;
        $this->response = OverviewResponse::make();
        $this->startTime = microtime(true);
    }

    private function load(Collection $migrations): void
    {
        $files = $migrations->pluck('file')->all();

        $this->migrator->requireFiles($files);
    }

    private function apply(Collection $migrations): Collection
    {
        $this->load($migrations);

        $this->migrator->runPending($migrations->pluck('name')->all());

        return $migrations;
    }

    private function applyAndRespond(Collection $migrations)
    {
        $this->apply($migrations);

        $count = count($migrations);

        if ($migrations->count() === 1) {
            $migration = $migrations->first();

            return $this->response->withSuccess('Applied Migration', $migration->name, $this->runtime());
        }

        return $this->response->withSuccess('Applied Migrations', "Ran $count migrations.", $this->runtime());
    }

    public function applySingle(Migration $migration)
    {
        return $this->applyAndRespond(collect([$migration]));
    }

    public function applyAll()
    {
        $migrations = $this->migrations->pending();

        if ($migrations->isEmpty()) {
            return OverviewResponse::make()->withError('Cannot Apply Migrations', 'No migrations are pending.');
        }

        return $this->applyAndRespond($migrations);
    }

    private function rollback(Collection $migrations): Collection
    {
        $this->load($migrations);

        $this->migrator->rollbackMigrations(
            $migrations->map(static function (Migration $migration) {
                return ['migration' => $migration->name];
            })->all(),
            $this->migrator->allPaths(),
            []
        );

        return $migrations;
    }

    private function rollbackAndRespond(Collection $migrations)
    {
        $this->rollback($migrations);

        $count = $migrations->count();

        if ($count === 1) {
            $migration = $migrations->first();

            return $this->response->withSuccess('Rolled Back Migration', $migration->name, $this->runtime());
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

        if (config('migrations-ui.fresh.views')) {
            try {
                $builder->dropAllViews();
                $types[] = 'views';
            } catch (LogicException $e) {
                Session::flash('migrations-ui::warning-title', 'Cannot Drop Views');
                Session::flash('migrations-ui::warning', $e->getMessage());
            }
        }

        $builder->dropAllTables();

        if (config('migrations-ui.fresh.types')) {
            try {
                $builder->dropAllTypes();
                $types[] = 'types';
            } catch (LogicException $e) {
                Session::flash('migrations-ui::warning-title', 'Cannot Drop Types');
                Session::flash('migrations-ui::warning', $e->getMessage());
            }
        }

        $this->migrator->getRepository()->createRepository();

        $message = 'Dropped all ' . collect($types)->join(', ', ' & ') . '.';
        return $this->finishRefresh('Fresh', $message);
    }

    public function refresh()
    {
        $count = $this->rollback($this->migrations->applied())->count();

        $message = $count === 1 ? 'Rolled back 1 migration.' : "Rolled back $count migrations.";
        return $this->finishRefresh('Refresh', $message);
    }

    private function finishRefresh($type, $message)
    {
        $messages = [$message];

        $count = $this->apply($this->migrations->pending())->count();
        $messages[] = $count === 1 ? 'Ran 1 migration.' : "Ran $count migrations.";

        if (Request::get('seed', false) && $this->runSeeder()) {
            $messages[] = 'Seeded the database.';
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
        if ($this->runSeeder()) {
            $this->response->withSuccess('Seed', 'Database seeded', $this->runtime());
        }

        return $this->response;
    }

    private function runtime()
    {
        return round(microtime(true) - $this->startTime, 2);
    }
}
