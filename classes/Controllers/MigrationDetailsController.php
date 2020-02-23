<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Models\Migration;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

/**
 * @see \MigrationsUITests\MigrationDetailsTest
 */
class MigrationDetailsController extends Controller
{
    public function __invoke(Migration $migration)
    {
        $response = $migration->toArray();

        try {
            $response['source'] = File::get($migration->file);
        } catch (FileNotFoundException $e) {
            $response['source'] = "# FILE NOT FOUND:\n# {$migration->name}.php";
        }

        return $response;
    }
}
