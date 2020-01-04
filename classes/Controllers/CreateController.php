<?php

namespace DaveJamesMiller\LaravelMigrationsUI\Controllers;

use Illuminate\Routing\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('migrations-ui::create');
    }
}
