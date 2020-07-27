<?php

namespace ThatoBabusi\MigrationsUI;

use Illuminate\Database\Migrations\Migrator as BaseMigrator;

class Migrator extends BaseMigrator
{
    // These methods in the base class are protected, but they're complicated
    // enough that I don't want to recreate them, and the higher-level public
    // methods (runPending(), rollback()) are not flexible enough.
    public function runUp($file, $batch, $pretend)
    {
        parent::runUp($file, $batch, $pretend);
    }

    public function runDown($file, $migration, $pretend)
    {
        parent::runDown($file, $migration, $pretend);
    }
}
