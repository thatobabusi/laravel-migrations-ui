<?php

namespace ThatoBabusi\MigrationsUI\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;

class TablesRepository
{
    /** @var \Illuminate\Database\DatabaseManager */
    private $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function all(): Collection
    {
        return collect($this->db->getDoctrineSchemaManager()->listTableNames())
            ->mapWithKeys(function (string $name) {
                return [$name => [
                    'name' => $name,
                    'rows' => $this->db->table($name)->count(),
                ]];
            })
            ->sortBy('name');
    }
}
