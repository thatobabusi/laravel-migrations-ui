<?php

namespace MigrationsUITests;

use DaveJamesMiller\MigrationsUI\MigrationsUIServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            MigrationsUIServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }
}
