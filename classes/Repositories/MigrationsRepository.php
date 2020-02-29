<?php

namespace DaveJamesMiller\MigrationsUI\Repositories;

use DaveJamesMiller\MigrationsUI\Migrator;
use DaveJamesMiller\MigrationsUI\Models\Migration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class MigrationsRepository
{
    /** @var \DaveJamesMiller\MigrationsUI\Migrator */
    private $migrator;

    public function __construct(Migrator $migrator)
    {
        $this->migrator = $migrator;
    }

    public function allPaths()
    {
        // Unfortunately some packages (e.g. Telescope) don't register their
        // migrations when running via the web. Artisan::call() doesn't help
        // either because it doesn't re-run the service providers, and
        // manually creating a new application instance caused it to crash.
        // Maybe at some point I can fix that, but for now we shell out to a
        // separate Artisan console process to get the paths.

        if (App::runningInConsole()) {
            /** @see \Illuminate\Database\Console\Migrations\BaseCommand::getMigrationPaths() */
            $paths = array_merge(
                app('migrator')->paths(),
                [app()->databasePath('migrations')]
            );
        } else {
            // I can't think of a way to unit test this - even if we put a copy
            // of the artisan binary somewhere, it won't have the right environment
            /** Based on {@see \Illuminate\Queue\Listener} */
            $php = (new PhpExecutableFinder)->find(false);
            $artisan = defined('ARTISAN_BINARY') ? ARTISAN_BINARY : base_path('artisan');
            $process = new Process([$php, $artisan, 'migrations-ui:list-paths']);
            $paths = json_decode($process->mustRun()->getOutput(), true);
        }

        return $paths;
    }

    private function load()
    {
        // Find all the migration files
        /** @see \Illuminate\Database\Console\Migrations\StatusCommand::getAllMigrationFiles() */
        $migrations = collect($this->migrator->getMigrationFiles($this->allPaths()))
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
        return $this->load()->where('batch', '!==', null)->sortByDesc('name');
    }

    public function batch(int $batch): Collection
    {
        return $this->load()->where('batch', '===', $batch)->sortByDesc('name');
    }

    public function pending(): Collection
    {
        return $this->load()->where('batch', '===', null)->sortBy('name');
    }

    public function get($name): ?Migration
    {
        return $this->load()->get($name);
    }
}
