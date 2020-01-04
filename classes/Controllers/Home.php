<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Migration;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Controller;

class Home extends Controller
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    private $app;

    /**
     * @var \Illuminate\Database\Migrations\Migrator
     */
    private $migrator;

    public function __construct(Application $app)
    {
        $this->app = $app;

        /** @see \Illuminate\Database\MigrationServiceProvider::registerMigrator() */
        $this->migrator = $app->make('migrator');
    }

    public function __invoke()
    {
        // TODO: Support for other database connections?
        //$this->migrator->setConnection($connection);

        $migrations = $this->migrations();

        $connection = config('database.default');
        $database = DB::getDatabaseName();
        $tables = DB::getDoctrineSchemaManager()->listTableNames();

        return view('migrations-ui::home', compact('migrations', 'connection', 'database', 'tables'));
    }

    private function migrations()
    {
        // Get list of migration files
        /** @see \Illuminate\Database\Console\Migrations\BaseCommand::getMigrationPaths() */
        $paths = array_merge($this->migrator->paths(), [$this->app->databasePath('migrations')]);

        /** @see \Illuminate\Database\Console\Migrations\StatusCommand::getAllMigrationFiles() */
        $migrations = collect($this->migrator->getMigrationFiles($paths));

        // Convert each one to an object
        $migrations->transform(static function (string $file, string $name) {
            return new Migration($name, $file);
        });

        // Check which migrations have been run, and check for any missing files
        if ($this->migrator->repositoryExists()) {
            foreach ($this->migrator->getRepository()->getMigrationBatches() as $name => $batch) {
                if (!isset($migrations[$name])) {
                    $migrations[$name] = new Migration($name);
                }

                $migrations[$name]->batch = $batch;
            }
        }

        // Sort migrations
        return $migrations->sort(static function (Migration $m1, Migration $m2) {
            return ($m2->batch ?? INF) <=> ($m1->batch ?? INF)
                ?: $m2->name <=> $m1->name;
        });
    }
}
