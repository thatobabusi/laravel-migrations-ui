<?php

namespace ThatoBabusi\MigrationsUI;

class Helpers
{
    public function assetUrl(string $filename): string
    {
        // Roughly based on \Illuminate\Foundation\Mix but works with custom routes
        if (file_exists($hotFile = __DIR__ . '/../build/hot')) {
            // @codeCoverageIgnoreStart
            return trim(file_get_contents($hotFile)) . $filename;
            // @codeCoverageIgnoreEnd
        }

        if (file_exists($manifestFile = __DIR__ . '/../build/mix-manifest.json')) {
            $manifest = json_decode(file_get_contents($manifestFile), true);
            // Need to add then remove the leading "/"
            if (isset($manifest["/$filename"])) {
                $filename = substr($manifest["/$filename"], 1);
            }
        }

        return route('migrations-ui.asset', $filename);
    }
}
