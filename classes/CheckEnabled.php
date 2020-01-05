<?php

namespace DaveJamesMiller\MigrationsUI;

use Closure;

class CheckEnabled
{
    public function handle($request, Closure $next)
    {
        if (!$this->enabled()) {
            abort(403);
        }

        return $next($request);
    }

    private function enabled(): bool
    {
        $enabled = config('migrations-ui.enabled');

        if ($enabled === null) {
            // Note: Don't use app()->isLocal() or app()->environment() because
            // that doesn't re-read the config which makes testing harder
            $enabled = config('app.debug') && config('app.env') === 'local';
        }

        return $enabled;
    }
}
