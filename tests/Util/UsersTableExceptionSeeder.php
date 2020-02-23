<?php

namespace MigrationsUITests\Util;

use Exception;

class UsersTableExceptionSeeder extends UsersTableSeeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        parent::run();

        throw new Exception('Test seed exception');
    }
}
