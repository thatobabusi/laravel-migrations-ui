<?php

namespace DaveJamesMiller\MigrationsUI;

use Illuminate\Database\Migrations\Migrator as BaseMigrator;

class Migrator extends BaseMigrator
{
    // Several methods in the base class are protected so they can't be called
    // any other way, and they're complicated enough that I don't want to
    // recreate them.

    public function allPaths()
    {
        /** @see \Illuminate\Database\Console\Migrations\BaseCommand::getMigrationPaths() */
        return array_merge($this->paths(), [app()->databasePath('migrations')]);
    }

    public function rollbackMigrations(array $migrations, $paths, array $options)
    {
        return parent::rollbackMigrations($migrations, $paths, $options);
    }
}
