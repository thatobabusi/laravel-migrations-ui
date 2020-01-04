<?php

declare(strict_types=1);

namespace DaveJamesMiller\MigrationsUI;

use Carbon\CarbonImmutable;

class Migration
{
    /*** @var string */
    public $name;

    /** @var string */
    public $file;

    /** @var \Carbon\CarbonImmutable */
    public $date;

    /** @var string */
    public $title;

    /** @var int */
    public $batch;

    public function __construct(string $name, string $file = null)
    {
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
}
