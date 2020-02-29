<?php

namespace MigrationsUITests;

use DaveJamesMiller\MigrationsUI\MigrationsUIServiceProvider;
use DaveJamesMiller\MigrationsUI\Migrator;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use PHPUnit\Framework\Constraint\Constraint;

define('ARTISAN_BINARY', __DIR__ . '/artisan');

// Note: Must not be abstract because we use it in the 'artisan' script
class TestCase extends TestbenchTestCase
{
    protected $enableDebugging = true;
    protected $migrateFresh = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        // Can't use RefreshDatabase because it tries to use transactions
        // Can't use DatabaseMigrations because it calls migrate:rollback which is expected to fail
        // Also we need it to drop views as well as tables
        // Can't easily make a custom trait because they're hard-coded in setUpTheTestEnvironmentTraits()
        if ($this->migrateFresh) {
            $this->artisan('migrate:fresh', ['--drop-views' => true]);
        }
    }

    protected function getPackageProviders($app)
    {
        return [
            MigrationsUIServiceProvider::class,
        ];
    }

    protected function resolveApplicationConfiguration($app)
    {
        // Load .env file
        $app->useEnvironmentPath(__DIR__ . '/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        // Load configuration files
        parent::resolveApplicationConfiguration($app);

        // Enable debug mode, except in the EnabledOrDisabledTest where we want
        // the default settings
        if ($this->enableDebugging) {
            config(['app.debug' => true, 'app.env' => 'local']);
        }
    }

    protected function assertTableExists(string $table, string $message = '')
    {
        $this->assertThat($table, $this->isTable(), $message);
    }

    protected function assertTableDoesntExist(string $table, string $message = '')
    {
        $this->assertThat($table, $this->logicalNot($this->isTable()), $message);
    }

    private function isTable()
    {
        return new class extends Constraint {
            protected function matches($table): bool
            {
                return Schema::hasTable($table);
            }

            public function toString(): string
            {
                return 'table exists';
            }
        };
    }

    protected function assertViewExists(string $table, string $message = '')
    {
        $this->assertThat($table, $this->isView(), $message);
    }

    protected function assertViewDoesntExist(string $table, string $message = '')
    {
        $this->assertThat($table, $this->logicalNot($this->isView()), $message);
    }

    private function isView()
    {
        return new class extends Constraint {
            protected function matches($view): bool
            {
                // Only tested in MySQL
                return (bool)DB::selectOne(
                    'SELECT 1 FROM information_schema.tables WHERE table_schema = ? AND table_name = ? AND table_type = ?',
                    [DB::getDatabaseName(), $view, 'VIEW']
                );
            }

            public function toString(): string
            {
                return 'view exists';
            }
        };
    }

    protected function createTable(string $table): void
    {
        Schema::create($table, static function (Blueprint $table) {
            $table->bigIncrements('id');
        });

        // Sanity check
        $this->assertTableExists($table);
    }

    protected function createView(string $view): void
    {
        $name = DB::getQueryGrammar()->wrap($view);

        DB::statement("CREATE VIEW $name AS SELECT 1 AS id");

        // Sanity check
        $this->assertViewExists($view);
    }

    protected function markAsRun(string $migration, int $batch = 1): void
    {
        DB::table('migrations')->insert(compact('migration', 'batch'));
    }

    protected function setMigrationPath(string $path): string
    {
        $fullPath = __DIR__ . '/migrations/' . $path;

        // Add to the migrator search paths
        app(Migrator::class)->path($fullPath);

        return $fullPath;
    }
}
