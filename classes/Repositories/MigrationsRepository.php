<?php

namespace DaveJamesMiller\MigrationsUI\Repositories;

use DaveJamesMiller\MigrationsUI\Migrator;
use DaveJamesMiller\MigrationsUI\Models\Migration;
use Illuminate\Support\Collection;

class MigrationsRepository
{
    /** @var \DaveJamesMiller\MigrationsUI\Migrator */
    private $migrator;

    public function __construct(Migrator $migrator)
    {
        $this->migrator = $migrator;
    }

    private function load()
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

        return $migrations;
    }

    public function all(): Collection
    {
        return $this->load()->sortByDesc('name');
    }

    public function applied(): Collection
    {
        return $this->all()->where('batch', '!==', null);
    }

    public function batch(int $batch): Collection
    {
        return $this->all()->where('batch', '===', $batch);
    }

    public function pending(): Collection
    {
        return $this->all()->where('batch', '===', null);
    }

    public function get($name): ?Migration
    {
        return $this->load()->get($name);
    }
}