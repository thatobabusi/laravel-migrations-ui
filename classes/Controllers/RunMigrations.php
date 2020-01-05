<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Migration;
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
}
