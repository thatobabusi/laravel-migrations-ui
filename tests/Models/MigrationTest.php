<?php

namespace MigrationsUITests\Models;

use ThatoBabusi\MigrationsUI\Models\Migration;
use Illuminate\Support\Facades\App;
use MigrationsUITests\TestCase;

class MigrationTest extends TestCase
{
    public function testStandardMigration()
    {
        $file = App::databasePath('migrations/2020_01_02_030405_test_migration.php');

        $migration = new Migration('2020_01_02_030405_test_migration', $file);

        $this->assertSame('2020_01_02_030405_test_migration', $migration->name, 'name');
        $this->assertSame($file, $migration->file, 'file');
        $this->assertSame('2020-01-02 03:04:05', $migration->date, 'date');
        $this->assertSame('test migration', $migration->title, 'title');
        $this->assertSame('database/migrations/2020_01_02_030405_test_migration.php', $migration->relPath(), 'relPath()');
    }

    public function testNoDate()
    {
        $file = App::databasePath('migrations/invalid_test_migration.php');

        $migration = new Migration('invalid_test_migration', $file);

        $this->assertSame('invalid_test_migration', $migration->name, 'name');
        $this->assertSame($file, $migration->file, 'file');
        $this->assertNull($migration->date, 'date');
        $this->assertSame('invalid test migration', $migration->title, 'title');
        $this->assertSame('database/migrations/invalid_test_migration.php', $migration->relPath(), 'relPath()');
    }
}
