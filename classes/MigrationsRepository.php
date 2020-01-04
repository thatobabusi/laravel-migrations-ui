<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI;

use Illuminate\Contracts\Foundation\Application;

class MigrationsRepository
{
    /** @var \Illuminate\Support\Collection */
    private $migrations;

    public function __construct(Application $app)
    {
        /** @see \Illuminate\Database\MigrationServiceProvider::registerMigrator() */
        /** @var \Illuminate\Database\Migrations\Migrator $migrator */
        $migrator = $app->make('migrator');

        // TODO: Support for other database connections?
        //$migrator->setConnection($connection);

        // Get list of migration files
        /** @see \Illuminate\Database\Console\Migrations\BaseCommand::getMigrationPaths() */
        $paths = array_merge($migrator->paths(), [$app->databasePath('migrations')]);

        /** @see \Illuminate\Database\Console\Migrations\StatusCommand::getAllMigrationFiles() */
        $migrations = collect($migrator->getMigrationFiles($paths))
            ->map(static function (string $file, string $name) {
                return new Migration($name, $file);
            });;

        // Check which migrations have been run, and check for any missing files
        if ($migrator->repositoryExists()) {
            foreach ($migrator->getRepository()->getMigrationBatches() as $name => $batch) {
                if (!isset($migrations[$name])) {
                    $migrations[$name] = new Migration($name);
                }

                $migrations[$name]->batch = $batch;
            }
        }

        $this->migrations = $migrations;
    }

    public function all()
    {
        return $this->migrations->sort(static function (Migration $m1, Migration $m2) {
            return ($m2->batch ?? INF) <=> ($m1->batch ?? INF)
                ?: $m2->name <=> $m1->name;
        });
    }
}
