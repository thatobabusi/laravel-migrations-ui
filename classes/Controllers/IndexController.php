<?php

namespace DaveJamesMiller\LaravelMigrationsUI\Controllers;

use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('migrations-ui::index');
    }
}
