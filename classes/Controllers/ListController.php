<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\MigrationsRepository;
use DaveJamesMiller\MigrationsUI\TablesRepository;
use DB;
use Illuminate\Routing\Controller;

class ListController extends Controller
{
    public function __invoke(MigrationsRepository $migrationsRepository, TablesRepository $tablesRepository)
    {
        return [
            'connection' => config('database.default'),
            'database' => DB::getDatabaseName(),
            'migrations' => $migrationsRepository->all()->values(),
            'tables' => $tablesRepository->all()->values(),
        ];
    }
}
