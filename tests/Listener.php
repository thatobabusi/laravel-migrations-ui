<?php

namespace MigrationsUITests;

if (class_exists(\NunoMaduro\Collision\Adapters\Phpunit\Printer::class)) {
    // nunomaduro/collision >=4.1.0
    class_alias(\NunoMaduro\Collision\Adapters\Phpunit\Printer::class, Listener::class);
} else {
    // nunomaduro/collision <=4.0.1
    class_alias(\NunoMaduro\Collision\Adapters\Phpunit\Listener::class, Listener::class);
}
