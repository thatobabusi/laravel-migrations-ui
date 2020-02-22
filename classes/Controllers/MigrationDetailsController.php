<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Models\Migration;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class MigrationDetailsController extends Controller
{
    public function __invoke(Migration $migration)
    {
        try {
            $source = File::get($migration->file);
        } catch (FileNotFoundException $e) {
            $source = "# FILE NOT FOUND:\n# {$migration->file}";
        }

        return [
            'name' => $migration->name,
            'source' => $source,
        ];
    }
}
