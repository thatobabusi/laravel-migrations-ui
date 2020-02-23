<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use Illuminate\Http\Request;

class NotFoundController
{
    public function __invoke(Request $request)
    {
        return response(view('migrations-ui::404'), 404);
    }
}
