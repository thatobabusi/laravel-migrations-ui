<?php

namespace MigrationsUITests\Controllers\RunMigration;

use MigrationsUITests\TestCase;

/**
 * @see \DaveJamesMiller\MigrationsUI\Controllers\RunMigrationsController
 */
class MigrateAllTest extends TestCase
{
    protected $migrateFresh = true;

    public function testSuccess()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('three');
        $this->markAsRun('2014_10_12_000000_create_users_table');

        // === Act ===
        $response = $this->post('/migrations/api/migrate-all');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('password_resets');
        $this->assertTableExists('failed_jobs');
        $this->assertTableDoesntExist('users');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'toasts' => [
                ['variant', 'title', 'message', 'runtime'],
            ],
        ]);

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame('success', $response->json('toasts.0.variant'), 'toasts.0.variant');
        $this->assertSame('Migrated', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame('Ran 2 migrations.', $response->json('toasts.0.message'), 'toasts.0.message');
        $this->assertIsFloat($response->json('toasts.0.runtime'), 'toasts.0.runtime');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 2,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2019_08_19_000000_create_failed_jobs_table.php",
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 2,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2014_10_12_100000_create_password_resets_table.php",
            ],
            [
                'name' => '2014_10_12_000000_create_users_table',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create users table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2014_10_12_000000_create_users_table.php",
            ],
        ], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'failed_jobs', 'rows' => 0],
            ['name' => 'migrations', 'rows' => 3],
            ['name' => 'password_resets', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testError()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('exceptions');
        $this->markAsRun('2014_10_12_000000_create_users_table_ex');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/migrate-all');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('password_resets');
        $this->assertTableDoesntExist('failed_jobs');
        $this->assertTableDoesntExist('users');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error' . ' in 2014_10_12_100000_create_password_resets_table_ex (up method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:' . ' Test up exception in file', $response->json('error.html'), 'error.html');

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table_ex',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table ex',
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2019_08_19_000000_create_failed_jobs_table_ex.php",
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table_ex',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table ex',
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2014_10_12_100000_create_password_resets_table_ex.php",
            ],
            [
                'name' => '2014_10_12_000000_create_users_table_ex',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create users table ex',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2014_10_12_000000_create_users_table_ex.php",
            ],
        ], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 1],
            ['name' => 'password_resets', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testNoPendingMigrations()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('one');
        $this->markAsRun('2014_10_12_000000_create_examples_table');

        // === Act ===
        $response = $this->post('/migrations/api/migrate-all');

        // === Assert ===
        $response->assertOk();

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'toasts' => [
                ['variant', 'title', 'message'],
            ],
        ]);

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame('danger', $response->json('toasts.0.variant'), 'toasts.0.variant');
        $this->assertSame('Cannot Run Migrations', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame('No migrations are pending.', $response->json('toasts.0.message'), 'toasts.0.message');

        $this->assertSame([
            [
                'name' => '2014_10_12_000000_create_examples_table',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create examples table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2014_10_12_000000_create_examples_table.php",
            ],
        ], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 1],
        ], $response->json('tables'), 'tables');
    }
}
