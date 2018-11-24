<?php

namespace DaveJamesMiller\MigrationsUI;

use Illuminate\Support\ServiceProvider;

/**
 * The Laravel service provider, which registers, configures and bootstraps the package.
 */
class MigrationsUIServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->path('config/migrations-ui.php'), 'migrations-ui');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom($this->path('routes.php'));

        $this->loadViewsFrom($this->path('views'), 'migrations-ui');

        $this->publishes([
            $this->path('config/migrations-ui.php') => config_path('migrations-ui.php'),
        ], 'config');
    }

    protected function path(string $path): string
    {
        return dirname(__DIR__) . "/$path";
    }
}
