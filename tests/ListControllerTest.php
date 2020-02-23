<?php

namespace MigrationsUITests;

use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @see \DaveJamesMiller\MigrationsUI\Controllers\ListController
 */
class ListControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testEmptyDatabase()
    {
        // === Arrange ===

        // === Act ===
        $response = $this->get('/migrations/api/list');

        // === Assert ===
        $response->assertOk();

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
        ]);

        $this->assertIsString($response->json('connection'));
        $this->assertIsString($response->json('database'));

        $this->assertSame([], $response->json('migrations'));

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
        ], $response->json('tables'));
    }

    public function testOneMigrationNotRun()
    {
        // === Arrange ===
        $this->migrate(__DIR__ . '/migrations/one', false);

        // === Act ===
        $response = $this->get('/migrations/api/list');

        // === Assert ===
        $response->assertOk();

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
        ]);

        $this->assertIsString($response->json('connection'));
        $this->assertIsString($response->json('database'));

        $this->assertSame([
            [
                'name' => '2014_10_12_000000_create_examples_table',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create examples table',
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/one/2014_10_12_000000_create_examples_table.php',
            ],
        ], $response->json('migrations'));

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
        ], $response->json('tables'));
    }

    public function testOneMigrationHasRun()
    {
        // === Arrange ===
        $this->migrate(__DIR__ . '/migrations/one');

        // === Act ===
        $response = $this->get('/migrations/api/list');

        // === Assert ===
        $response->assertOk();

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
        ]);

        $this->assertIsString($response->json('connection'));
        $this->assertIsString($response->json('database'));

        $this->assertSame([
            [
                'name' => '2014_10_12_000000_create_examples_table',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create examples table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/one/2014_10_12_000000_create_examples_table.php',
            ],
        ], $response->json('migrations'));

        $this->assertSame([
            ['name' => 'examples', 'rows' => 0],
            ['name' => 'migrations', 'rows' => 1],
        ], $response->json('tables'));
    }

    public function testThreeMigrations()
    {
        // === Arrange ===
        $this->migrate(__DIR__ . '/migrations/three', '2014_10_12_000000_create_users_table');
        $this->migrate(__DIR__ . '/migrations/three', '2014_10_12_100000_create_password_resets_table');

        // === Act ===
        $response = $this->get('/migrations/api/list');

        // === Assert ===
        $response->assertOk();

        $response->assertJsonStructure([
            'connection',
            'database',
            'migrations',
            'tables',
        ]);

        $this->assertIsString($response->json('connection'));
        $this->assertIsString($response->json('database'));

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
                'batch' => 2,
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
        ], $response->json('migrations'));

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 2],
            ['name' => 'password_resets', 'rows' => 0],
            ['name' => 'users', 'rows' => 0],
        ], $response->json('tables'));
    }
}
