<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled?
    |--------------------------------------------------------------------------
    |
    | By default this package is disabled in the production environment and
    | when debugging is disabled), because it allows users to run arbitrary
    | code.
    |
    */

    'enabled' => config('app.debug') && config('app.env') !== 'production',

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | You can change it if this conflicts with your own routes.
    |
    */

    'path' => '/migrations',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Optionally add middleware to the package routes.
    |
    | e.g. to allow access to certain users only:
    |
    | 'middleware' => ['web', 'can:access-migrations-ui']
    |
    */

    'middleware' => [],

];
