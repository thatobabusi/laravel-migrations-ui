<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\MigrationsRepository;
use DB;
use Illuminate\Routing\Controller;

class Home extends Controller
{
    public function __invoke(MigrationsRepository $migrationsRepository)
    {
        $migrations = $migrationsRepository->all();

        $connection = config('database.default');
        $database = DB::getDatabaseName();
        $tables = DB::getDoctrineSchemaManager()->listTableNames();

        return view('migrations-ui::home', compact('migrations', 'connection', 'database', 'tables'));
    }
}
