<?php

namespace MigrationsUITests;

use DaveJamesMiller\MigrationsUI\MigrationsUIServiceProvider;
use DaveJamesMiller\MigrationsUI\Migrator;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    protected $enablePackage = true;

    protected static function assertTableExists(string $table)
    {
        static::assertTrue(Schema::hasTable($table), "Expected '$table' table to exist");
    }

    protected static function assertTableDoesntExist(string $table)
    {
        static::assertFalse(Schema::hasTable($table), "Expected '$table' table not to exist");
    }

    protected function resolveApplicationConfiguration($app)
    {
        // Load .env file
        $app->useEnvironmentPath(__DIR__ . '/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        // Load configuration files
        parent::resolveApplicationConfiguration($app);

        // Enable the package, except in the EnabledOrDisabledTest where we want
        // the default settings
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

    protected function createTable(string $table): void
    {
        Schema::create($table, static function (Blueprint $table) {
            $table->bigIncrements('id');
        });
    }
}
