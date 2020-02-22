<?php

use DaveJamesMiller\MigrationsUI\Middleware\CheckEnabled;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;

Route
    ::prefix(config('migrations-ui.path', 'migrations'))
    ->namespace('DaveJamesMiller\MigrationsUI\Controllers')
    ->middleware([
        CheckEnabled::class,
        EncryptCookies::class,
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
            // Route::post('apply-all', 'RunMigrationsController@applyAll');
            Route::post('apply-single/{migration}', 'RunMigrationsController@applySingle');
            // Route::post('rollback-all', 'RunMigrationsController@rollbackAll');
            // Route::post('rollback-batch/{batch}', 'RunMigrationsController@rollbackBatch')->where('batch', '\d+');
            Route::post('rollback-single/{migration}', 'RunMigrationsController@rollbackSingle');
            Route::post('fresh', 'RunMigrationsController@fresh');
            Route::post('refresh', 'RunMigrationsController@refresh');
            Route::post('seed', 'RunMigrationsController@seed');

            // Not found (to prevent it returning the HTML)
            Route::any('{path?}', 'NotFoundController')->where('path', '.*');

        });

        // Frontend (SPA)
        Route::view('{path?}', 'migrations-ui::app')
            ->where('path', '.*')
            ->name('migrations-ui');

    });
