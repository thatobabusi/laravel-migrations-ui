<?php

namespace MigrationsUITests\Repositories;

use DaveJamesMiller\MigrationsUI\Repositories\MigrationsRepository;
use Illuminate\Support\Facades\App;
use MigrationsUITests\TestCase;

class MigrationsRepositoryTest extends TestCase
{
    public function testAllPathsWithDefaultPaths()
    {
        $repo = app(MigrationsRepository::class);

        $this->assertSame([database_path('migrations')], $repo->allPaths());
    }

    public function testAllPathsWithCustomPath()
    {
        app('migrator')->path('/custom/path');

        $repo = app(MigrationsRepository::class);

        $this->assertSame(['/custom/path', database_path('migrations')], $repo->allPaths());
    }

    public function testAllPathsViaArtisan()
    {
        // Note: Can't add a custom path here (as we do above) because this will
        // invoke Artisan in a separate process - but see ListPathsTest for
        // where we do test that case.

        App::partialMock()->expects('runningInConsole')->andReturn(false);

        $repo = app(MigrationsRepository::class);

        $this->assertSame([database_path('migrations')], $repo->allPaths());
    }
}
