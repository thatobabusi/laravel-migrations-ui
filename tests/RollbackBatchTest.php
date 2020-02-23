<?php

namespace MigrationsUITests;

/**
 * @see \DaveJamesMiller\MigrationsUI\Controllers\RunMigrationsController
 */
class RollbackBatchTest extends TestCase
{
    protected $migrateFresh = true;

    public function testSuccess()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/three');
        $this->markAsRun('2014_10_12_000000_create_users_table', 1);
        $this->markAsRun('2014_10_12_100000_create_password_resets_table', 2);
        $this->markAsRun('2019_08_19_000000_create_failed_jobs_table', 2);

        $this->createTable('users');
        $this->createTable('password_resets');
        $this->createTable('failed_jobs');

        // === Act ===
        $response = $this->post('/migrations/api/rollback-batch/2');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableDoesntExist('password_resets');
        $this->assertTableDoesntExist('failed_jobs');

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
        $this->assertSame('Rolled Back', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame('Rolled back 2 migrations.', $response->json('toasts.0.message'), 'toasts.0.message');
        $this->assertIsFloat($response->json('toasts.0.runtime'), 'toasts.0.runtime');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/three/2019_08_19_000000_create_failed_jobs_table.php',
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/three/2014_10_12_100000_create_password_resets_table.php',
            ],
            [
                'name' => '2014_10_12_000000_create_users_table',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create users table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/three/2014_10_12_000000_create_users_table.php',
            ],
        ], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 1],
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testError()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/exceptions');
        $this->markAsRun('2014_10_12_000000_create_users_table_ex', 1);
        $this->markAsRun('2014_10_12_100000_create_password_resets_table_ex', 2);
        $this->markAsRun('2019_08_19_000000_create_failed_jobs_table_ex', 2);

        $this->createTable('users');
        $this->createTable('password_resets');
        $this->createTable('failed_jobs');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/rollback-batch/2');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableDoesntExist('password_resets');
        $this->assertTableDoesntExist('failed_jobs');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error' . ' in 2014_10_12_100000_create_password_resets_table_ex (down method)', $response->json('error.title'), 'error.title');
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
                'relPath' => __DIR__ . '/migrations/exceptions/2019_08_19_000000_create_failed_jobs_table_ex.php',
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table_ex',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table ex',
                'batch' => 2,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/exceptions/2014_10_12_100000_create_password_resets_table_ex.php',
            ],
            [
                'name' => '2014_10_12_000000_create_users_table_ex',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create users table ex',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/exceptions/2014_10_12_000000_create_users_table_ex.php',
            ],
        ], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 2],
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }
}
