<?php

namespace MigrationsUITests;

use DaveJamesMiller\MigrationsUI\MigrationsUIServiceProvider;
use DaveJamesMiller\MigrationsUI\Migrator;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Arr;
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

    /**
     * Register migrations path and run the migrations.
     *
     * @param string $path The path to register
     * @param boolean|string|array $run Optional migrations to run (default is all migrations)
     */
    protected function migrate(string $path, $run = true): void
    {
        // Register path
        app(Migrator::class)->path($path);

        // Run migrations
        if ($run === false) {
            return;
        }

        if ($run === true) {
            $paths = [$path];
        } else {
            $paths = [];
            foreach (Arr::wrap($run) as $file) {
                $paths[] = "$path/$file.php";
            }
        }

        $this->loadMigrationsFrom(['--path' => $paths]);
    }
}
