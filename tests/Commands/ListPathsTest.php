<?php

namespace MigrationsUITests\Controllers;

use MigrationsUITests\TestCase;

class ListPathsTest extends TestCase
{
    public function testDefaultResponse()
    {
        $this->artisan('migrations-ui:list-paths')
            ->expectsOutput('["' . database_path('migrations') . '"]')
            ->assertExitCode(0);
    }

    public function testCustomPath()
    {
        app('migrator')->path('/custom/path');

        $this->artisan('migrations-ui:list-paths')
            ->expectsOutput('["/custom/path","' . database_path('migrations') . '"]')
            ->assertExitCode(0);
    }
}
