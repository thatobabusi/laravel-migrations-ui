<?php

namespace DaveJamesMiller\MigrationsUI;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;

class MigrationsRepository
{
    /** @var \DaveJamesMiller\MigrationsUI\Migrator */
    private $migrator;

    /** @var \Illuminate\Support\Collection */
    private $migrations;

    public function __construct(Migrator $migrator)
    {
        // TODO: Support for other database connections?
        //$migrator->setConnection($connection);

        $this->migrator = $migrator;

        $this->refresh();
    }

    public function refresh()
    {
        // Find all the migration files
        /** @see \Illuminate\Database\Console\Migrations\StatusCommand::getAllMigrationFiles() */
        $migrations = collect($this->migrator->getMigrationFiles($this->migrator->allPaths()))
            ->map(static function (string $file, string $name) {
                return new Migration($name, $file);
            });

        // Check which migrations have been run, and check for any with missing files
        if ($this->migrator->repositoryExists()) {
            foreach ($this->migrator->getRepository()->getMigrationBatches() as $name => $batch) {
                if (!isset($migrations[$name])) {
                    $migrations[$name] = new Migration($name);
                }

                $migrations[$name]->batch = $batch;
            }
        }

        $this->migrations = $migrations;
    }

    public function all(): Collection
    {
        return $this->migrations->sortByDesc('name');
    }

    public function get($name): ?Migration
    {
        return $this->migrations->get($name);
    }

    public function pending(): Collection
    {
        return $this->all()->where('batch', '===', null);
    }

    public function applied(): Collection
    {
        return $this->all()->where('batch', '!==', null);
    }

    public function batch(int $batch): Collection
    {
        return $this->all()->where('batch', '===', $batch);
    }
}
