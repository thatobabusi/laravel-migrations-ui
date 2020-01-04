<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI\Controllers;

use Carbon\CarbonImmutable;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Controller;
use stdClass;

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
            return (object)[
                'file' => $file,
                'batch' => null, // Will be overwritten later
            ];
        });

        // Check which migrations have been run, and check for any missing files
        if ($this->migrator->repositoryExists()) {
            foreach ($this->migrator->getRepository()->getMigrationBatches() as $name => $batch) {
                if (isset($migrations[$name])) {
                    $migrations[$name]->batch = $batch;
                } else {
                    $migrations[$name] = (object)[
                        'file' => null,
                        'batch' => $batch,
                    ];
                }
            }
        }

        // Split name into date and human-readable title
        $migrations->each(static function (stdClass $migration, string $name) {
            $migration->name = $name;

            if (preg_match('/^(\d{4}_\d{2}_\d{2}_\d{2}\d{2}\d{2})_(.+)$/', $migration->name, $matches)) {
                $migration->date = CarbonImmutable::createFromFormat('Y_m_d_His', $matches[1]);
                $migration->title = $matches[2];
            } else {
                $migration->date = null;
                $migration->title = $migration->name;
            }

            $migration->title = str_replace('_', ' ', $migration->title);
        });

        // Sort migrations
        return $migrations->sort(static function (stdClass $m1, stdClass $m2) {
            return ($m2->batch ?? INF) <=> ($m1->batch ?? INF)
                ?: $m2->name <=> $m1->name;
        });
    }
}
