<?php

namespace DaveJamesMiller\MigrationsUI\Responses;

use DaveJamesMiller\MigrationsUI\Repositories\MigrationsRepository;
use DaveJamesMiller\MigrationsUI\Repositories\TablesRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;

class OverviewResponse implements Responsable
{
    /** @var array */
    private $toasts = [];

    public static function make(): self
    {
        return new static();
    }

    public function withSuccess(string $title, string $message, float $runtime): self
    {
        $variant = 'success';

        $this->toasts[] = compact('variant', 'title', 'message', 'runtime');

        return $this;
    }

    public function withWarning(string $title, string $message): self
    {
        $variant = 'warning';

        $this->toasts[] = compact('variant', 'title', 'message');

        return $this;
    }

    public function withError(string $title, string $message): self
    {
        $variant = 'danger';

        $this->toasts[] = compact('variant', 'title', 'message');

        return $this;
    }

    public function toResponse($request)
    {
        $response = [
            'connection' => config('database.default'),
            'database' => DB::getDatabaseName(),
            'migrations' => app(MigrationsRepository::class)->all()->values(),
            'tables' => app(TablesRepository::class)->all()->values(),
        ];

        if ($this->toasts) {
            $response['toasts'] = $this->toasts;
        }

        return $response;
    }
}
