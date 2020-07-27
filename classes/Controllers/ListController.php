<?php

namespace ThatoBabusi\MigrationsUI\Controllers;

use ThatoBabusi\MigrationsUI\Responses\OverviewResponse;
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
