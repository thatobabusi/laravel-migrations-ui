<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Responses\OverviewResponse;
use Illuminate\Routing\Controller;

class ListController extends Controller
{
    public function __invoke()
    {
        return OverviewResponse::make();
    }
}
