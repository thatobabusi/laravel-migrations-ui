<?php

namespace MigrationsUITests;

use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @see \DaveJamesMiller\MigrationsUI\Controllers\ListController
 */
class ListTest extends TestCase
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

        $this->assertIsString($response->json('connection'), 'connection should be a string');
        $this->assertIsString($response->json('database'), 'database should be a string');

        $this->assertSame([], $response->json('migrations'), 'migrations does not match');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
        ], $response->json('tables'), 'tables does not match');
    }

    public function testOneMigrationNotRun()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/one');

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

        $this->assertIsString($response->json('connection'), 'connection should be a string');
        $this->assertIsString($response->json('database'), 'database should be a string');

        $this->assertSame([
            [
                'name' => '2014_10_12_000000_create_examples_table',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create examples table',
                'batch' => null,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/one/2014_10_12_000000_create_examples_table.php',
            ],
        ], $response->json('migrations'), 'migrations does not match');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 0],
        ], $response->json('tables'), 'tables does not match');
    }

    public function testOneMigrationHasRun()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/one');
        $this->markAsRun('2014_10_12_000000_create_examples_table');

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

        $this->assertIsString($response->json('connection'), 'connection should be a string');
        $this->assertIsString($response->json('database'), 'database should be a string');

        $this->assertSame([
            [
                'name' => '2014_10_12_000000_create_examples_table',
                'date' => '2014-10-12 00:00:00',
                'title' => 'create examples table',
                'batch' => 1,
                // Absolute path because it's outside the project root
                'relPath' => __DIR__ . '/migrations/one/2014_10_12_000000_create_examples_table.php',
            ],
        ], $response->json('migrations'), 'migrations does not match');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 1],
        ], $response->json('tables'), 'tables does not match');
    }

    public function testThreeMigrations()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/three');
        $this->markAsRun('2014_10_12_000000_create_users_table', 1);
        $this->markAsRun('2014_10_12_100000_create_password_resets_table', 2);

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

        $this->assertIsString($response->json('connection'), 'connection should be a string');
        $this->assertIsString($response->json('database'), 'database should be a string');

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
        ], $response->json('migrations'), 'migrations does not match');

        $this->assertSame([
            ['name' => 'migrations', 'rows' => 2],
        ], $response->json('tables'), 'tables does not match');
    }
}
