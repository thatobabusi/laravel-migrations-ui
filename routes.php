<?php

use DaveJamesMiller\MigrationsUI\Controllers\Asset;
use DaveJamesMiller\MigrationsUI\Controllers\Home;
use DaveJamesMiller\MigrationsUI\Middleware\EnabledMiddleware;

Route
    ::prefix(config('migrations-ui.path', 'migrations'))
    ->middleware(EnabledMiddleware::class)
    ->group(static function () {

        Route::get('/', Home::class)
            ->name('migrations-ui.home');

        Route::get('assets/{path}', Asset::class)
            ->where('path', '.*')
            ->name('migrations-ui.asset');

        // Wireframes
        Route::view('wireframes', 'migrations-ui::wireframes.index')->name('migrations-ui.wireframes.index');
        Route::view('wireframes/create', 'migrations-ui::wireframes.create.step1')->name('migrations-ui.wireframes.create');
        Route::view('wireframes/create/step2', 'migrations-ui::wireframes.create.step2')->name('migrations-ui.wireframes.create.step2');
        Route::view('wireframes/create/step3', 'migrations-ui::wireframes.create.step3')->name('migrations-ui.wireframes.create.step3');
        Route::view('wireframes/create/step4', 'migrations-ui::wireframes.create.step4')->name('migrations-ui.wireframes.create.step4');

    });
