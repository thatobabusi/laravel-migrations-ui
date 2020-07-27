<?php

namespace ThatoBabusi\MigrationsUI\Commands;

use ThatoBabusi\MigrationsUI\Repositories\MigrationsRepository;
use Illuminate\Console\Command;

class ListPaths extends Command
{
    protected $signature = 'migrations-ui:list-paths';

    protected $hidden = true;

    public function handle(MigrationsRepository $repo)
    {
        $paths = $repo->allPaths();

        $this->output->writeln(json_encode($paths, JSON_UNESCAPED_SLASHES));
    }
}
