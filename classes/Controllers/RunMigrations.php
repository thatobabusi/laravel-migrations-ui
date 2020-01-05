<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Migration;
use DaveJamesMiller\MigrationsUI\MigrationsRepository;
use DaveJamesMiller\MigrationsUI\Migrator;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class RunMigrations
{
    /** @var \DaveJamesMiller\MigrationsUI\MigrationsRepository */
    private $migrationsRepository;

    /** @var \DaveJamesMiller\MigrationsUI\Migrator */
    private $migrator;

    public function __construct(MigrationsRepository $migrationsRepository, Migrator $migrator)
    {
        $this->migrationsRepository = $migrationsRepository;
        $this->migrator = $migrator;
    }

    private function load(Collection $migrations): void
    {
        $files = $migrations->pluck('file')->all();

        $this->migrator->requireFiles($files);
    }

    private function apply(Collection $migrations)
    {
        $this->load($migrations);

        $startTime = microtime(true);
        $this->migrator->runPending($migrations->pluck('name')->all());
        $runTime = round(microtime(true) - $startTime, 2);
        $count = count($migrations);

        if (!$migrations) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::warning', 'No pending migrations found');
        }

        if ($migrations->count() === 1) {
            $migration = $migrations->first();

            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::success', new HtmlString(
                    '<strong>Migrated:</strong> ' . e($migration->name) . " ($runTime seconds)"
                ));
        }

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success', "Ran $count migrations ($runTime seconds)");
    }

    public function applySingle(Migration $migration)
    {
        return $this->apply(collect([$migration]));
    }

    public function applyAll()
    {
        $migrations = $this->migrationsRepository->pending();

        return $this->apply($migrations);
    }

    private function rollback(Collection $migrations)
    {
        $this->load($migrations);

        $startTime = microtime(true);

        $this->migrator->rollbackMigrations(
            $migrations->map(static function (Migration $migration) {
                return ['migration' => $migration->name];
            })->all(),
            $this->migrator->allPaths(),
            []
        );

        $runTime = round(microtime(true) - $startTime, 2);
        $count = $migrations->count();

        if ($count === 1) {
            $migration = $migrations->first();

            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::success', new HtmlString(
                    '<strong>Rolled back:</strong> ' . e($migration->name) . " ($runTime seconds)"
                ));
        }

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success', "Rolled back $count migrations ($runTime seconds)");
    }

    public function rollbackSingle(Migration $migration)
    {
        return $this->rollback(collect([$migration]));
    }

    public function rollbackBatch(int $batch)
    {
        $migrations = $this->migrationsRepository->batch($batch);

        if ($migrations->isEmpty()) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::warning', "No migrations found in batch $batch");
        }

        return $this->rollback($migrations);
    }

    public function rollbackAll()
    {
        $migrations = $this->migrationsRepository->applied();

        if ($migrations->isEmpty()) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::warning', 'No applied migrations found');
        }

        return $this->rollback($migrations);
    }
}
