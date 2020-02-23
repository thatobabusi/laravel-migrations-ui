<?php

namespace MigrationsUITests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MigrationsUITests\Util\UsersTableExceptionSeeder;

/**
 * @see \DaveJamesMiller\MigrationsUI\Controllers\RunMigrationsController
 */
class RunMigrationsExceptionsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Can't use RefreshDatabase because it tries to use transactions
        // Can't use DatabaseMigrations because it calls migrate:rollback which is expected to fail
        $this->artisan('migrate:fresh');
    }

    public function testMigrateSingle()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/exceptions');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/migrate-single/2014_10_12_100000_create_password_resets_table_ex');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('password_resets');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error'.' in 2014_10_12_100000_create_password_resets_table_ex (up method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test up exception in file', $response->json('error.html'), 'error.html');

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
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/exceptions/2014_10_12_100000_create_password_resets_table_ex.php',
            ],
            [
                'name' => '2014_10_12_000000_create_users_table_ex',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create users table ex',
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/exceptions/2014_10_12_000000_create_users_table_ex.php',
            ],
        ], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
            ['name' => 'password_resets', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testMigrateAll()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/exceptions');
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
        $this->assertSame('Error'.' in 2014_10_12_100000_create_password_resets_table_ex (up method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test up exception in file', $response->json('error.html'), 'error.html');

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
                'batch' => null,
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
            ['name' => 'migrations', 'rows' => 1],
            ['name' => 'password_resets', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testRollbackSingle()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/exceptions');
        $this->markAsRun('2014_10_12_000000_create_users_table_ex');
        $this->markAsRun('2014_10_12_100000_create_password_resets_table_ex');

        $this->createTable('users');
        $this->createTable('password_resets');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/rollback-single/2014_10_12_100000_create_password_resets_table_ex');

        // === Assert ===
        $response->assertOk();

        $this->assertTableDoesntExist('password_resets');
        $this->assertTableExists('users');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error'.' in 2014_10_12_100000_create_password_resets_table_ex (down method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test up exception in file', $response->json('error.html'), 'error.html');

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
                'batch' => 1,
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

    public function testRollbackBatch()
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
        $this->assertSame('Error'.' in 2014_10_12_100000_create_password_resets_table_ex (down method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test up exception in file', $response->json('error.html'), 'error.html');

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

    public function testRollbackAll()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/exceptions');
        $this->markAsRun('2014_10_12_000000_create_users_table_ex', 1);
        $this->markAsRun('2014_10_12_100000_create_password_resets_table_ex', 2);

        $this->createTable('users');
        $this->createTable('password_resets');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/rollback-all');

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
        $this->assertSame('Error'.' in 2014_10_12_100000_create_password_resets_table_ex (down method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test up exception in file', $response->json('error.html'), 'error.html');

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

    public function testFresh()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/exceptions');

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
        $this->assertSame('Error'.' in 2014_10_12_100000_create_password_resets_table_ex (up method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test up exception in file', $response->json('error.html'), 'error.html');

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
                'batch' => null,
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
            ['name' => 'migrations', 'rows' => 1],
            ['name' => 'password_resets', 'rows' => 0],
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testFreshAndSeed()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/three');

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
        $this->assertSame('Error'.' in Database Seeder', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test seed exception', $response->json('error.html'), 'error.html');

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/three/2019_08_19_000000_create_failed_jobs_table.php',
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 1,
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
            ['name' => 'failed_jobs', 'rows' => 0],
            ['name' => 'migrations', 'rows' => 3],
            ['name' => 'password_resets', 'rows' => 0],
            ['name' => 'users', 'rows' => 5],
        ], $response->json('tables'), 'tables');
    }

    public function testRefresh()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/exceptions');
        $this->markAsRun('2014_10_12_000000_create_users_table_ex', 1);

        $this->createTable('users');
        $this->createTable('dummy');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/refresh');

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableDoesntExist('failed_jobs');
        $this->assertTableExists('dummy');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error'.' in 2014_10_12_100000_create_password_resets_table_ex (up method)', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test up exception in file', $response->json('error.html'), 'error.html');

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
                'batch' => null,
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
            ['name' => 'dummy', 'rows' => 0],
            ['name' => 'migrations', 'rows' => 1],
            ['name' => 'password_resets', 'rows' => 0],
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testRefreshAndSeed()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/three');
        $this->markAsRun('2014_10_12_000000_create_users_table', 1);
        $this->markAsRun('2014_10_12_100000_create_password_resets_table', 2);

        $this->createTable('users');
        $this->createTable('password_resets');
        $this->createTable('dummy');

        config(['migrations-ui.seeder' => UsersTableExceptionSeeder::class]);

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/refresh', ['seed' => true]);

        // === Assert ===
        $response->assertOk();

        $this->assertTableExists('users');
        $this->assertTableExists('password_resets');
        $this->assertTableExists('failed_jobs');
        $this->assertTableExists('dummy');

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error'.' in Database Seeder', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test seed exception in file', $response->json('error.html'), 'error.html');

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame([
            [
                'name' => '2019_08_19_000000_create_failed_jobs_table',
                'date' => '2019-08-19 00:00:00',
                'title' => 'create failed jobs table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/three/2019_08_19_000000_create_failed_jobs_table.php',
            ],
            [
                'name' => '2014_10_12_100000_create_password_resets_table',
                'date' => '2014-10-12 10:00:00',
                'title' => 'create password resets table',
                'batch' => 1,
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
            ['name' => 'dummy', 'rows' => 0],
            ['name' => 'failed_jobs', 'rows' => 0],
            ['name' => 'migrations', 'rows' => 3],
            ['name' => 'password_resets', 'rows' => 0],
            ['name' => 'users', 'rows' => 5],
        ], $response->json('tables'), 'tables');
    }

    public function testSeed()
    {
        // === Arrange ===
        Schema::create('users', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
        });

        config(['migrations-ui.seeder' => UsersTableExceptionSeeder::class]);

        // === Act ===
        $response = $this->withExceptionHandling()
            ->post('/migrations/api/seed');

        // === Assert ===
        $response->assertOk();

        $this->assertDatabaseHas('users', ['email' => 'testuser1@example.com']);

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
            'error' => ['title', 'html'],
        ]);

        // Strings are split so they don't appear in the backtrace
        $this->assertSame('Error'.' in Database Seeder', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:'.' Test seed exception in file', $response->json('error.html'), 'error.html');

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame([], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
            ['name' => 'users', 'rows' => 5],
        ], $response->json('tables'), 'tables');
    }
}
