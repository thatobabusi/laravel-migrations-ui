<?php

namespace MigrationsUITests\Controllers\RunMigration;

use Illuminate\Support\Facades\App;
use MigrationsUITests\TestCase;
use MigrationsUITests\Util\UsersTableExceptionSeeder;
use MigrationsUITests\Util\UsersTableSeeder;

/**
 * @see \ThatoBabusi\MigrationsUI\Controllers\RunMigrationsController
 */
class FreshTest extends TestCase
{
    protected $migrateFresh = true;

    public function testSuccess()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('three');

        $this->createTable('dummy');

        // === Act ===
        $response = $this->post('/migrations/api/fresh');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableExists('failed_jobs');
        $this->assertTableDoesntExist('dummy');

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
        $this->assertSame('Fresh', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame("Dropped all tables.\nRan 3 migrations.", $response->json('toasts.0.message'), 'toasts.0.message');
        $this->assertIsFloat($response->json('toasts.0.runtime'), 'toasts.0.runtime');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2019_08_19_000000_create_failed_jobs_table.php",
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 1,
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
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testWithViews()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('three');

        $this->createTable('dummy');
        $this->createView('dummy_view');

        config(['migrations-ui.fresh.views' => true]);

        // === Act ===
        $response = $this->post('/migrations/api/fresh');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableExists('failed_jobs');
        $this->assertTableDoesntExist('dummy');
        $this->assertViewDoesntExist('dummy_view');

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
        $this->assertSame('Fresh', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame("Dropped all tables & views.\nRan 3 migrations.", $response->json('toasts.0.message'), 'toasts.0.message');
        $this->assertIsFloat($response->json('toasts.0.runtime'), 'toasts.0.runtime');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2019_08_19_000000_create_failed_jobs_table.php",
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 1,
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
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testWithTypes()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('three');

        $this->createTable('dummy');

        config(['migrations-ui.fresh.types' => true]);

        // === Act ===
        $response = $this->post('/migrations/api/fresh');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableExists('failed_jobs');
        $this->assertTableDoesntExist('dummy');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'toasts' => [
                ['variant', 'title', 'message'],
                ['variant', 'title', 'message', 'runtime'],
            ],
        ]);

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame('warning', $response->json('toasts.0.variant'), 'toasts.0.variant');
        $this->assertSame('Cannot Drop Types', $response->json('toasts.0.title'), 'toasts.0.title');

        if (version_compare(App::version(), '5.8', '<')) {
            $this->assertSame('Not supported in Laravel 5.7 and below.', $response->json('toasts.0.message'), 'toasts.0.message');
        } else {
            $this->assertSame('This database driver does not support dropping all types.', $response->json('toasts.0.message'), 'toasts.0.message');
        }

        $this->assertSame('success', $response->json('toasts.1.variant'), 'toasts.1.variant');
        $this->assertSame('Fresh', $response->json('toasts.1.title'), 'toasts.1.title');
        $this->assertSame("Dropped all tables.\nRan 3 migrations.", $response->json('toasts.1.message'), 'toasts.1.message');
        $this->assertIsFloat($response->json('toasts.1.runtime'), 'toasts.1.runtime');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2019_08_19_000000_create_failed_jobs_table.php",
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 1,
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
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testWithSeed()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('three');

        $this->createTable('dummy');

        config(['migrations-ui.seeder' => UsersTableSeeder::class]);

        // === Act ===
        $response = $this->postJson('/migrations/api/fresh', ['seed' => true]);

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableExists('failed_jobs');
        $this->assertTableDoesntExist('dummy');
        $this->assertDatabaseHas('users', ['email' => 'testuser1@example.com']);

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
        $this->assertSame('Fresh', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame("Dropped all tables.\nRan 3 migrations.\nSeeded the database.", $response->json('toasts.0.message'), 'toasts.0.message');
        $this->assertIsFloat($response->json('toasts.0.runtime'), 'toasts.0.runtime');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2019_08_19_000000_create_failed_jobs_table.php",
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 1,
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
            ['name' => 'users', 'rows' => 5],
        ], $response->json('tables'), 'tables');
    }

    public function testError()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('exceptions');

        $this->createTable('dummy');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/fresh');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableDoesntExist('failed_jobs');
        $this->assertTableDoesntExist('dummy');

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
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testWithSeedError()
    {
        // === Arrange ===
        $path = $this->setMigrationPath('three');

        $this->createTable('dummy');

        config(['migrations-ui.seeder' => UsersTableExceptionSeeder::class]);

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/fresh', ['seed' => true]);

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableExists('failed_jobs');
        $this->assertTableDoesntExist('dummy');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error' . ' in Database Seeder', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:' . ' Test seed exception', $response->json('error.html'), 'error.html');

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => "$path/2019_08_19_000000_create_failed_jobs_table.php",
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 1,
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
            ['name' => 'users', 'rows' => 5],
        ], $response->json('tables'), 'tables');
    }
}
