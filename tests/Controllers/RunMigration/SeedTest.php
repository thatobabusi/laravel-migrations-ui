<?php

namespace MigrationsUITests\Controllers\RunMigration;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MigrationsUITests\TestCase;
use MigrationsUITests\Util\UsersTableExceptionSeeder;
use MigrationsUITests\Util\UsersTableSeeder;

/**
 * @see \ThatoBabusi\MigrationsUI\Controllers\RunMigrationsController
 */
class SeedTest extends TestCase
{
    protected $migrateFresh = true;

    public function testSuccess()
    {
        // === Arrange ===
        Schema::create('users', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
        });

        config(['migrations-ui.seeder' => UsersTableSeeder::class]);

        // === Act ===
        $response = $this->postJson('/migrations/api/seed');

        // === Assert ===
        $response->assertOk();

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
        $this->assertSame('Seed', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame('Database seeded', $response->json('toasts.0.message'), 'toasts.0.message');
        $this->assertIsFloat($response->json('toasts.0.runtime'), 'toasts.0.runtime');

        $this->assertSame([], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
            ['name' => 'users', 'rows' => 5],
        ], $response->json('tables'), 'tables');
    }

    public function testClassMissing()
    {
        // === Arrange ===

        // === Act ===
        $response = $this->postJson('/migrations/api/seed');

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
        $this->assertSame('Cannot Seed Database', $response->json('toasts.0.title'), 'toasts.0.title');
        $this->assertSame('Unable to find DatabaseSeeder class.', $response->json('toasts.0.message'), 'toasts.0.message');

        $this->assertSame([], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
        ], $response->json('tables'), 'tables');
    }

    public function testError()
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
        $this->assertSame('Error' . ' in Database Seeder', $response->json('error.title'), 'error.title');
        $this->assertStringContainsString('Exception:' . ' Test seed exception in file', $response->json('error.html'), 'error.html');

        $this->assertIsString($response->json('connection'), 'connection');
        $this->assertIsString($response->json('database'), 'database');

        $this->assertSame([], $response->json('migrations'), 'migrations');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
            ['name' => 'users', 'rows' => 5],
        ], $response->json('tables'), 'tables');
    }
}
