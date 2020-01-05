<?php

use DaveJamesMiller\MigrationsUI\Controllers\Asset;
use DaveJamesMiller\MigrationsUI\Controllers\Home;
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

        Route::get('/', Home::class)
            ->name('migrations-ui.home');

        Route::get('assets/{path}', Asset::class)
            ->where('path', '.*')
            ->name('migrations-ui.asset');

        Route::post('apply-all', [RunMigrations::class, 'applyAll'])
            ->name('migrations-ui.apply-all');

        Route::post('rollback-all', [RunMigrations::class, 'rollbackAll'])
            ->name('migrations-ui.rollback-all');

        Route::post('{migration}/apply', [RunMigrations::class, 'apply'])
            ->name('migrations-ui.apply');

        Route::post('{migration}/rollback', [RunMigrations::class, 'rollback'])
            ->name('migrations-ui.rollback');

        // Wireframes
        Route::view('wireframes', 'migrations-ui::wireframes.index')->name('migrations-ui.wireframes.index');
        Route::view('wireframes/create', 'migrations-ui::wireframes.create.step1')->name('migrations-ui.wireframes.create');
        Route::view('wireframes/create/step2', 'migrations-ui::wireframes.create.step2')->name('migrations-ui.wireframes.create.step2');
        Route::view('wireframes/create/step3', 'migrations-ui::wireframes.create.step3')->name('migrations-ui.wireframes.create.step3');
        Route::view('wireframes/create/step4', 'migrations-ui::wireframes.create.step4')->name('migrations-ui.wireframes.create.step4');

    });
