<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use DaveJamesMiller\MigrationsUI\Responses\OverviewResponse;
use Illuminate\Routing\Controller;

/**
 * @see \MigrationsUITests\ListTest
 */
class ListController extends Controller
{
    public function __invoke()
    {
        return OverviewResponse::make();
    }
}
