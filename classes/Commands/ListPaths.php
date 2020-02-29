<?php

namespace DaveJamesMiller\MigrationsUI\Commands;

use DaveJamesMiller\MigrationsUI\Migrator;
use Illuminate\Console\Command;

class ListPaths extends Command
{
    protected $signature = 'migrations-ui:list-paths';

    protected $hidden = true;

    public function handle(Migrator $migrator)
    {
        /** @see \Illuminate\Database\Console\Migrations\BaseCommand::getMigrationPaths() */
        $paths = array_merge(
            $migrator->paths(),
            [app()->databasePath('migrations')]
        );

        $this->output->writeln(json_encode($paths, JSON_UNESCAPED_SLASHES));
    }
}
