<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Migration;
use DaveJamesMiller\MigrationsUI\MigrationsRepository;
use DaveJamesMiller\MigrationsUI\Migrator;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use LogicException;
use Symfony\Component\HttpFoundation\Response;

class RunMigrations
{
    /** @var \DaveJamesMiller\MigrationsUI\MigrationsRepository */
    private $migrations;

    /** @var \DaveJamesMiller\MigrationsUI\Migrator */
    private $migrator;

    /** @var float */
    private $startTime;

    public function __construct(MigrationsRepository $migrations, Migrator $migrator)
    {
        $this->migrations = $migrations;
        $this->migrator = $migrator;
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

    private function applyAndRedirect(Collection $migrations): Response
    {
        $this->apply($migrations);

        $count = count($migrations);

        if ($migrations->count() === 1) {
            $migration = $migrations->first();

            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::success-title', 'Applied Migration')
                ->with('migrations-ui::success', new HtmlString(e($migration->name) . $this->runtime()));
        }

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success-title', 'Applied Migrations')
            ->with('migrations-ui::success', new HtmlString("Ran $count migrations." . $this->runtime()));
    }

    public function applySingle(Migration $migration)
    {
        return $this->applyAndRedirect(collect([$migration]));
    }

    public function applyAll()
    {
        $migrations = $this->migrations->pending();

        if ($migrations->isEmpty()) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::danger-title', 'Cannot Apply Migrations')
                ->with('migrations-ui::danger', 'No migrations are pending.');
        }

        return $this->applyAndRedirect($migrations);
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

    private function rollbackAndRedirect(Collection $migrations): Response
    {
        $this->rollback($migrations);

        $count = $migrations->count();

        if ($count === 1) {
            $migration = $migrations->first();

            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::success-title', 'Rolled Back')
                ->with('migrations-ui::success', new HtmlString(e($migration->name) . $this->runtime()));
        }

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success-title', 'Rolled Back')
            ->with('migrations-ui::success', new HtmlString("Rolled back $count migrations." . $this->runtime()));
    }

    public function rollbackSingle(Migration $migration)
    {
        return $this->rollbackAndRedirect(collect([$migration]));
    }

    public function rollbackBatch(int $batch)
    {
        $migrations = $this->migrations->batch($batch);

        if ($migrations->isEmpty()) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::danger-title', 'Cannot Roll Back')
                ->with('migrations-ui::danger', "No migrations found in batch $batch.");
        }

        return $this->rollbackAndRedirect($migrations);
    }

    public function rollbackAll()
    {
        $migrations = $this->migrations->applied();

        if ($migrations->isEmpty()) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::danger-title', 'Cannot Roll Back')
                ->with('migrations-ui::danger', 'No applied migrations found.');
        }

        return $this->rollbackAndRedirect($migrations);
    }

    public function fresh()
    {
        $builder = DB::getSchemaBuilder();

        /** @see \Illuminate\Database\Console\WipeCommand::handle() */
        $builder->dropAllTables();
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
        return $this->finishRefresh($message);
    }

    public function refresh()
    {
        $count = $this->rollback($this->migrations->applied())->count();

        $message = $count === 1 ? 'Rolled back 1 migration.' : "Rolled back $count migrations.";
        return $this->finishRefresh($message);
    }

    private function finishRefresh($message)
    {
        $messages = [$message];

        $this->migrations->refresh();

        $count = $this->apply($this->migrations->pending())->count();
        $messages[] = $count === 1 ? 'Ran 1 migration.' : "Ran $count migrations.";

        $seeded = $this->runSeeder(Request::get('seed', false));
        if ($seeded) {
            $messages[] = 'Seeded the database.';
        }

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success', new HtmlString(collect($messages)->join('<br>') . $this->runtime()));
    }

    private function runSeeder(bool $enabled = true): bool
    {
        if (!$enabled) {
            return false;
        }

        /** @see \DatabaseSeeder */
        $class = config('migrations-ui.seeder');

        if (!class_exists($class)) {
            Session::flash('migrations-ui::danger-title', 'Cannot Seed Database');
            Session::flash('migrations-ui::danger', "Unable to find $class class.");
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
            Session::flash('migrations-ui::success', new HtmlString('Database Seeded' . $this->runtime()));
        }

        return redirect()->route('migrations-ui.home');
    }

    private function runtime()
    {
        $runTime = round(microtime(true) - $this->startTime, 2);

        return "<br><small class='text-muted'>in $runTime seconds</small>";
    }
}
