<?php

$options = [
    'middleware' => config('migrations-ui.middleware'),
    'namespace' => 'DaveJamesMiller\MigrationsUI\Controllers',
    'prefix' => config('migrations-ui.path'),
];

Route::group($options, function () {

    Route::redirect('/', url('migrations/wireframes'));

    Route::prefix('wireframes')->group(function () {
        Route::view('/', 'migrations-ui::wireframes.index')->name('migrations-ui.wireframes.index');
        Route::view('/create', 'migrations-ui::wireframes.create.step1')->name('migrations-ui.wireframes.create');
        Route::view('/create/step2', 'migrations-ui::wireframes.create.step2')->name('migrations-ui.wireframes.create.step2');
        Route::view('/create/step3', 'migrations-ui::wireframes.create.step3')->name('migrations-ui.wireframes.create.step3');
        Route::view('/create/step4', 'migrations-ui::wireframes.create.step4')->name('migrations-ui.wireframes.create.step4');
    });

});
