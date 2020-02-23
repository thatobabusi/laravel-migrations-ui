<?php

namespace MigrationsUITests;

use DaveJamesMiller\MigrationsUI\Models\Migration;

class MigrationModelTest extends TestCase
{
    public function testDateParse()
    {
        $file = dirname(__DIR__) . '/vendor/orchestra/testbench-core/laravel/database/migrations/2020_01_02_030405_test_migration.php';

        $migration = new Migration('2020_01_02_030405_test_migration', $file);

        $this->assertSame('2020_01_02_030405_test_migration', $migration->name, 'name');
        $this->assertSame($file, $migration->file, 'file');
        $this->assertSame('2020-01-02 03:04:05', $migration->date, 'date');
        $this->assertSame('test migration', $migration->title, 'title');
        $this->assertSame('database/migrations/2020_01_02_030405_test_migration.php', $migration->relPath(), 'relPath()');
    }

    public function testDateBlank()
    {
        $file = dirname(__DIR__) . '/vendor/orchestra/testbench-core/laravel/database/migrations/invalid_test_migration.php';

        $migration = new Migration('invalid_test_migration', $file);

        $this->assertSame('invalid_test_migration', $migration->name, 'name');
        $this->assertSame($file, $migration->file, 'file');
        $this->assertNull($migration->date, 'date');
        $this->assertSame('invalid test migration', $migration->title, 'title');
        $this->assertSame('database/migrations/invalid_test_migration.php', $migration->relPath(), 'relPath()');
    }
}
