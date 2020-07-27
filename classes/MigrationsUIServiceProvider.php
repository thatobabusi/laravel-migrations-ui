<?php

namespace ThatoBabusi\MigrationsUI;

use ThatoBabusi\MigrationsUI\Commands\ListPaths;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * The Laravel service provider, which registers, configures and bootstraps the package.
 */
class MigrationsUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Load the default config values
        $this->mergeConfigFrom(__DIR__ . '/../config/migrations-ui.php', 'migrations-ui');

        // Make sure the migrator class is registered to prevent errors - by
        // default it's only registered in the console and unit tests.
        // Note: singletonIf() is not available until Laravel 6.0.
        $this->app->bindIf('migrator', static function () {
            // @codeCoverageIgnoreStart
            return null;
            // @codeCoverageIgnoreEnd
        }, true);

        // Register custom migrator class to override the built-in one.
        // Use extend() not singleton() because the built-in one is registered
        // after this in tests so takes precedence. This is rather hacky, but we
        // have to make some protected methods public, and it still needs to be
        // a singleton so paths are registered correctly by package service
        // providers.
        /** @see \Illuminate\Database\MigrationServiceProvider::registerMigrator() */
        /** @see \Illuminate\Support\ServiceProvider::loadMigrationsFrom() */
        $this->app->extend('migrator', static function ($base, $app) {
            return new Migrator($app['migration.repository'], $app['db'], $app['files'], $app['events']);
        });

        // Alias our custom class to it so we can use automatic dependency injection
        $this->app->bind(Migrator::class, 'migrator');
    }

    public function boot(): void
    {
        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands(ListPaths::class);
        }

        // Register routes
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        // Register 'migrations-ui::' view namespace
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'migrations-ui');

        // Publish the config/migrations-ui.php file
        $this->publishes([
            __DIR__ . '/../config/migrations-ui.php' => config_path('migrations-ui.php'),
        ], 'migrations-ui-config');
    }
}
