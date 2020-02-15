<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\MigrationsRepository;
use DB;
use Illuminate\Routing\Controller;

class ListController extends Controller
{
    public function __invoke(MigrationsRepository $migrationsRepository)
    {
        return [
            'connection' => config('database.default'),
            'database' => DB::getDatabaseName(),
            'migrations' => $migrationsRepository->all()->values(),
            'tables' => DB::getDoctrineSchemaManager()->listTableNames(),
        ];
    }
}
