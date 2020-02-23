<?php

namespace DaveJamesMiller\MigrationsUI\Models;

use DaveJamesMiller\MigrationsUI\Repositories\MigrationsRepository;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use LogicException;

class Migration implements Arrayable, UrlRoutable
{
    /*** @var string */
    public $name;

    /** @var string|null */
    public $file;

    /** @var \Carbon\CarbonImmutable */
    public $date;

    /** @var string */
    public $title;

    /** @var int */
    public $batch;

    public function __construct(string $name = null, string $file = null)
    {
        if ($name === null) {
            // Necessary for UrlRoutable to work
            return;
        }

        $this->name = $name;
        $this->file = $file;

        if (preg_match('/^(\d{4})_(\d{2})_(\d{2})_(\d{2})(\d{2})(\d{2})_(.+)$/', $name, $m)) {
            $this->date = "{$m[1]}-{$m[2]}-{$m[3]} {$m[4]}:{$m[5]}:{$m[6]}";
            $this->title = $m[7];
        } else {
            $this->date = null;
            $this->title = $name;
        }

        $this->title = str_replace('_', ' ', $this->title);
    }

    public function relPath(): ?string
    {
        $base = base_path() . DIRECTORY_SEPARATOR;

        if (strpos($this->file, $base) === 0) {
            return substr($this->file, strlen($base));
        }

        return $this->file;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'date' => $this->date,
            'title' => $this->title,
            'batch' => $this->batch,
            'relPath' => $this->relPath(),
        ];
    }

    //--------------------------------------
    // UrlRoutable
    //--------------------------------------

    /** @codeCoverageIgnore */
    public function getRouteKeyName()
    {
        throw new LogicException("Laravel doesn't actually use this method outside the Model class, yet it's in the interface :-/");
    }

    /** @codeCoverageIgnore */
    public function getRouteKey()
    {
        return $this->name;
    }

    public function resolveRouteBinding($name, $field = null)
    {
        // Note: $field was added in Laravel 7
        return app(MigrationsRepository::class)->get($name);
    }

    // Note: This method was added in Laravel 7
    /** @codeCoverageIgnore */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        throw new LogicException('Child route bindings not supported');
    }
}
