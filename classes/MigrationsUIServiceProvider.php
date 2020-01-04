<?php

namespace DaveJamesMiller\MigrationsUI;

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
    }

    public function boot(): void
    {
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
