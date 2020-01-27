<?php

use DaveJamesMiller\MigrationsUI\Controllers\Asset;
use DaveJamesMiller\MigrationsUI\Controllers\Home;
use DaveJamesMiller\MigrationsUI\Controllers\MigrationDetails;
use DaveJamesMiller\MigrationsUI\Controllers\RunMigrations;
use DaveJamesMiller\MigrationsUI\CheckEnabled;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;

Route
    ::prefix(config('migrations-ui.path', 'migrations'))
    ->middleware([
        CheckEnabled::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
    ])
    ->group(static function () {

        // Wireframes (TODO: remove once fully implemented)
        Route::view('wireframes', 'migrations-ui::wireframes.index')->name('migrations-ui.wireframes.index');
        Route::view('wireframes/create', 'migrations-ui::wireframes.create.step1')->name('migrations-ui.wireframes.create');
        Route::view('wireframes/create/step2', 'migrations-ui::wireframes.create.step2')->name('migrations-ui.wireframes.create.step2');
        Route::view('wireframes/create/step3', 'migrations-ui::wireframes.create.step3')->name('migrations-ui.wireframes.create.step3');
        Route::view('wireframes/create/step4', 'migrations-ui::wireframes.create.step4')->name('migrations-ui.wireframes.create.step4');

        // Homepage
        Route::get('/', Home::class)
            ->name('migrations-ui.home');

        // Assets
        Route::get('assets/{path}', Asset::class)
            ->where('path', '.*')
            ->name('migrations-ui.asset');

        // All migrations
        Route::post('apply-all', [RunMigrations::class, 'applyAll'])
            ->name('migrations-ui.apply-all');

        Route::post('rollback-all', [RunMigrations::class, 'rollbackAll'])
            ->name('migrations-ui.rollback-all');

        Route::post('fresh', [RunMigrations::class, 'fresh'])
            ->name('migrations-ui.fresh');

        Route::post('refresh', [RunMigrations::class, 'refresh'])
            ->name('migrations-ui.refresh');

        Route::post('seed', [RunMigrations::class, 'seed'])
            ->name('migrations-ui.seed');

        // Batches
        Route::post('batch/{batch}/rollback', [RunMigrations::class, 'rollbackBatch'])
            ->where('batch', '\d+')
            ->name('migrations-ui.rollback-batch');

        // Single migrations
        Route::get('{migration}', MigrationDetails::class)
            ->name('migrations-ui.migration-details');

        Route::post('{migration}/apply', [RunMigrations::class, 'applySingle'])
            ->name('migrations-ui.apply');

        Route::post('{migration}/rollback', [RunMigrations::class, 'rollbackSingle'])
            ->name('migrations-ui.rollback');

    });
