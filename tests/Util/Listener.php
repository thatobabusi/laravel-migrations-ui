<?php

namespace MigrationsUITests\Util;

if (class_exists(\NunoMaduro\Collision\Adapters\Phpunit\Printer::class)) {
    // nunomaduro/collision >=4.1.0 (Laravel 7)
    class_alias(\NunoMaduro\Collision\Adapters\Phpunit\Printer::class, Listener::class);
} else {
    // nunomaduro/collision <=4.0.1 (Laravel 5-6)
    class_alias(\NunoMaduro\Collision\Adapters\Phpunit\Listener::class, Listener::class);
}
