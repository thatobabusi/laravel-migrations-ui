<?php

use DaveJamesMiller\MigrationsUI\Middleware\CheckEnabled;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;

Route
    ::prefix(config('migrations-ui.path', 'migrations'))
    ->namespace('DaveJamesMiller\MigrationsUI\Controllers')
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

        // Assets
        Route::get('assets/{path}', 'AssetController')
            ->where('path', '.*')
            ->name('migrations-ui.asset');

        // API
        Route::prefix('api')->group(static function () {

            Route::get('list', 'ListController');
            Route::get('migration-details/{migration}', 'MigrationDetailsController');

            // Not found (to prevent it returning the HTML)
            Route::any('{path?}', 'NotFoundController')->where('path', '.*');

        });

        // Frontend (SPA)
        Route::view('{path?}', 'migrations-ui::app')
            ->where('path', '.*')
            ->name('migrations-ui');

        // // All migrations
        // Route::post('apply-all', [RunMigrationsController::class, 'applyAll'])
        //     ->name('migrations-ui.apply-all');
        //
        // Route::post('rollback-all', [RunMigrationsController::class, 'rollbackAll'])
        //     ->name('migrations-ui.rollback-all');
        //
        // Route::post('fresh', [RunMigrationsController::class, 'fresh'])
        //     ->name('migrations-ui.fresh');
        //
        // Route::post('refresh', [RunMigrationsController::class, 'refresh'])
        //     ->name('migrations-ui.refresh');
        //
        // Route::post('seed', [RunMigrationsController::class, 'seed'])
        //     ->name('migrations-ui.seed');
        //
        // // Batches
        // Route::post('batch/{batch}/rollback', [RunMigrationsController::class, 'rollbackBatch'])
        //     ->where('batch', '\d+')
        //     ->name('migrations-ui.rollback-batch');
        //
        // // Single migrations (must be after other routes)
        // Route::post('{migration}/apply', [RunMigrationsController::class, 'applySingle'])
        //     ->name('migrations-ui.apply');
        //
        // Route::post('{migration}/rollback', [RunMigrationsController::class, 'rollbackSingle'])
        //     ->name('migrations-ui.rollback');

    });
