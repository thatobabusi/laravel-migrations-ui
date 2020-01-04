<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use App;
use Carbon\CarbonImmutable;
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

        return view('migrations-ui::home', compact('migrations'));
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
            $date = null;

            if (preg_match('/^(\d{4}_\d{2}_\d{2}_\d{2}\d{2}\d{2})_(.+)$/', $name, $matches)) {
                $date = CarbonImmutable::createFromFormat('Y_m_d_His', $matches[1]);
                $name = $matches[2];
            }

            return (object)[
                'date' => $date,
                'name' => str_replace('_', ' ', $name),
                'file' => $file,
                'batch' => null, // Will be overwritten later
            ];
        });

        // Check which migrations have been run, and check for any missing files
        // TODO
        // if ($this->migrator->repositoryExists()) {
        //
        //     $runMigrations = $this->migrator->getRepository()->getMigrationBatches();
        //     var_dump($runMigrations);exit;
        //
        // }

        return $migrations->reverse();
    }
}
