<?php

namespace ThatoBabusi\MigrationsUI\Responses;

use ThatoBabusi\MigrationsUI\Repositories\MigrationsRepository;
use ThatoBabusi\MigrationsUI\Repositories\TablesRepository;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\DatabaseManager;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Throwable;

class OverviewResponse implements Responsable
{
    /** @var array */
    private $toasts = [];

    /** @var array|null */
    private $error;

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

    public function withException(string $title, Throwable $e)
    {
        // In Laravel 6.x and below the exception handler can't deal with Throwable's
        if (!$e instanceof Exception && class_exists(FatalThrowableError::class)) {
            $e = new FatalThrowableError($e);
        }

        $html = app(ExceptionHandler::class)->render(request(), $e)->getContent();

        $this->error = compact('title', 'html');

        return $this;
    }

    public function toResponse($request)
    {
        $db = app(DatabaseManager::class);

        $response = [
            'connection' => $db->getDefaultConnection(),
            'database' => $db->getDatabaseName(),
            'migrations' => app(MigrationsRepository::class)->all()->values(),
            'tables' => app(TablesRepository::class)->all()->values(),
        ];

        if ($this->toasts) {
            $response['toasts'] = $this->toasts;
        }

        if ($this->error) {
            $response['error'] = $this->error;
        }

        return $response;
    }
}
