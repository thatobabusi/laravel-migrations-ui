<?php

namespace DaveJamesMiller\MigrationsUI;

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TablesRepository
{
    /** @var \Illuminate\Support\Collection */
    private $tables;

    public function __construct()
    {
        $this->schemaManager = DB::getDoctrineSchemaManager();

        $this->refresh();
    }

    public function refresh()
    {
        $this->tables = collect($this->schemaManager->listTableNames())
            ->mapWithKeys(static function (string $name) {
                return [$name => [
                    'name' => $name,
                    'rows' => DB::table($name)->count(),
                ]];
            });
    }

    public function all(): Collection
    {
        return $this->tables->sortBy('name');
    }
}
