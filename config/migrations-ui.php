<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled?
    |--------------------------------------------------------------------------
    |
    | By default, Migrations UI is only enabled in the 'local' environment,
    | and only when debugging is enabled.
    |
    */

    'enabled' => env('MIGRATIONS_UI_ENABLED', null),

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | The URI path where Migrations UI will be accessible.
    | You can change it if this conflicts with your own routes.
    |
    */

    'path' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Fresh
    |--------------------------------------------------------------------------
    |
    | Drop views and/or types (Postgres only) when running Fresh?
    |
    */

    'fresh' => [
        'views' => false,
        'types' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Seed
    |--------------------------------------------------------------------------
    |
    | Which database seeder should we use?
    |
    */

    'seeder' => DatabaseSeeder::class,

];
