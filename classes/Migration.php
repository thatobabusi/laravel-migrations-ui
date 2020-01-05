<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Routing\UrlRoutable;
use LogicException;

class Migration implements UrlRoutable
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

        if (preg_match('/^(\d{4}_\d{2}_\d{2}_\d{2}\d{2}\d{2})_(.+)$/', $name, $matches)) {
            $this->date = CarbonImmutable::createFromFormat('Y_m_d_His', $matches[1]);
            $this->title = $matches[2];
        } else {
            $this->date = null;
            $this->title = $name;
        }

        $this->title = str_replace('_', ' ', $this->title);
    }

    public function isApplied(): bool
    {
        return $this->batch !== null;
    }

    public function isMissing(): bool
    {
        return $this->file === null;
    }

    //--------------------------------------
    // UrlRoutable
    //--------------------------------------

    public function getRouteKeyName()
    {
        throw new LogicException("Laravel doesn't actually use this method outside the Model class, yet it's in the interface :-/");
    }

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
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        throw new LogicException('Child route bindings not supported');
    }
}
