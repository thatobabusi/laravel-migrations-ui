<?php

namespace MigrationsUITests\Controllers;

use Illuminate\Support\Facades\Artisan;
use MigrationsUITests\TestCase;
use Mockery;
use Symfony\Component\Console\Output\BufferedOutput;

class ListPathsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Laravel 5.6 didn't include the Artisan testing helpers (expectsOutput, assertExitCode)
        if (method_exists($this, 'withoutMockingConsoleOutput')) {
            $this->withoutMockingConsoleOutput();
        }
    }

    public function testWithDefaultPaths()
    {
        $output = Mockery::mock(BufferedOutput::class . '[writeln]');
        $output->shouldReceive('writeln')->once()->with('["' . database_path('migrations') . '"]', Mockery::any());

        $exitCode = Artisan::call('migrations-ui:list-paths', [], $output);
        $this->assertSame(0, $exitCode);
    }

    public function testWithCustomPath()
    {
        app('migrator')->path('/custom/path');

        $output = Mockery::mock(BufferedOutput::class . '[writeln]');
        $output->shouldReceive('writeln')->once()->with('["/custom/path","' . database_path('migrations') . '"]', Mockery::any());

        $exitCode = Artisan::call('migrations-ui:list-paths', [], $output);
        $this->assertSame(0, $exitCode);
    }
}
