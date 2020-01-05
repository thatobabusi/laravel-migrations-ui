<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Migration;
use DaveJamesMiller\MigrationsUI\MigrationsRepository;
use DaveJamesMiller\MigrationsUI\Migrator;
use Illuminate\Support\HtmlString;

class RunMigrations
{
    public function apply(Migration $migration, Migrator $migrator)
    {
        $migrator->requireFiles([$migration->file]);

        $startTime = microtime(true);
        $migrator->runPending([$migration->name]);
        $runTime = round(microtime(true) - $startTime, 2);

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success', new HtmlString(
                '<strong>Migrated:</strong> ' . e($migration->name) . " ($runTime seconds)"
            ));
    }

    public function applyAll(Migrator $migrator)
    {
        $startTime = microtime(true);
        $migrations = $migrator->run($migrator->allPaths());
        $runTime = round(microtime(true) - $startTime, 2);
        $count = count($migrations);

        if (!$migrations) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::warning', 'No pending migrations found');
        }

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success', "Ran $count migrations ($runTime seconds)");
    }

    public function rollback(Migration $migration, Migrator $migrator)
    {
        $migrator->requireFiles([$migration->file]);

        $startTime = microtime(true);
        $migrator->rollbackMigrations([['migration' => $migration->name]], $migrator->allPaths(), []);
        $runTime = round(microtime(true) - $startTime, 2);

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success', new HtmlString(
                '<strong>Rolled back:</strong> ' . e($migration->name) . " ($runTime seconds)"
            ));
    }

    public function rollbackAll(MigrationsRepository $migrationsRepository, Migrator $migrator)
    {
        $migrations = $migrationsRepository->applied();

        if ($migrations->isEmpty()) {
            return redirect()->route('migrations-ui.home')
                ->with('migrations-ui::warning', 'No applied migrations found');
        }

        $migrator->requireFiles($migrations->pluck('file')->all());

        $startTime = microtime(true);

        $migrator->rollbackMigrations(
            $migrations->map(static function (Migration $migration) {
                return ['migration' => $migration->name];
            })->all(),
            $migrator->allPaths(),
            []
        );

        $runTime = round(microtime(true) - $startTime, 2);
        $count = $migrations->count();

        return redirect()->route('migrations-ui.home')
            ->with('migrations-ui::success', "Rolled back $count migrations ($runTime seconds)");
    }
}
