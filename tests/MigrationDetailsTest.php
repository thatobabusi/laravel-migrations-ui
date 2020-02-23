<?php

namespace MigrationsUITests;

use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @see \DaveJamesMiller\MigrationsUI\Controllers\MigrationDetailsController
 */
class MigrationDetailsTest extends TestCase
{
    use RefreshDatabase;

    public function testMigrationNotRun()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/three');

        // === Act ===
        $response = $this->get('/migrations/api/migration-details/2014_10_12_100000_create_password_resets_table');

        // === Assert ===
        $response->assertOk();

        $this->assertSame([
            'name' => '2014_10_12_100000_create_password_resets_table',
            'date' => '2014-10-12 10:00:00',
            'title' => 'create password resets table',
            'batch' => null,
            // Absolute path because it's outside the project root
            'relPath' => __DIR__ . '/migrations/three/2014_10_12_100000_create_password_resets_table.php',
            'source' => file_get_contents(__DIR__ . '/migrations/three/2014_10_12_100000_create_password_resets_table.php'),
        ], $response->json());
    }

    public function testMigrationHasBeenRun()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/three');
        $this->markAsRun('2014_10_12_100000_create_password_resets_table');

        // === Act ===
        $response = $this->get('/migrations/api/migration-details/2014_10_12_100000_create_password_resets_table');

        // === Assert ===
        $response->assertOk();

        $this->assertSame([
            'name' => '2014_10_12_100000_create_password_resets_table',
            'date' => '2014-10-12 10:00:00',
            'title' => 'create password resets table',
            'batch' => 1,
            // Absolute path because it's outside the project root
            'relPath' => __DIR__ . '/migrations/three/2014_10_12_100000_create_password_resets_table.php',
            'source' => file_get_contents(__DIR__ . '/migrations/three/2014_10_12_100000_create_password_resets_table.php'),
        ], $response->json());
    }

    public function testMigrationSourceMissing()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/empty');
        $this->markAsRun('2014_10_12_100000_file_is_missing');

        // === Act ===
        $response = $this->get('/migrations/api/migration-details/2014_10_12_100000_file_is_missing');

        // === Assert ===
        $response->assertOk();

        $this->assertSame([
            'name' => '2014_10_12_100000_file_is_missing',
            'date' => '2014-10-12 10:00:00',
            'title' => 'file is missing',
            'batch' => 1,
            // Absolute path because it's outside the project root
            'relPath' => null,
            'source' => "# FILE NOT FOUND:\n# 2014_10_12_100000_file_is_missing.php",
        ], $response->json());
    }

    public function testMigrationDoesNotExist()
    {
        // === Arrange ===
        $this->setMigrationPath(__DIR__ . '/migrations/empty');

        // === Act ===
        $response = $this->withExceptionHandling()
            ->get('/migrations/api/migration-details/2014_10_12_100000_invalid_name');

        // === Assert ===
        $response->assertNotFound()
            ->assertSee('Not Found');
    }
}
