<?php

namespace MigrationsUITests;

use DaveJamesMiller\MigrationsUI\MigrationsUIServiceProvider;
use DaveJamesMiller\MigrationsUI\Migrator;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    protected $enablePackage = true;

    protected function getEnvironmentSetUp($app)
    {
        // Load .env file
        $app->useEnvironmentPath(__DIR__ . '/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        if ($this->enablePackage) {
            config(['migrations-ui.enabled' => true]);
        }
    }

    protected function getPackageProviders($app)
    {
        return [
            MigrationsUIServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    protected function setMigrationPath(string $path)
    {
        app(Migrator::class)->path($path);
    }

    protected function markAsRun(string $migration, int $batch = 1): void
    {
        DB::table('migrations')->insert(compact('migration', 'batch'));
    }
}
