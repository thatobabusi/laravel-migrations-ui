<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\MigrationsRepository;
use Illuminate\Routing\Controller;

class MigrationsController extends Controller
{
    public function index(MigrationsRepository $migrationsRepository)
    {
        return $migrationsRepository->all()->values();
    }
}
