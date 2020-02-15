@inject('helpers', 'DaveJamesMiller\MigrationsUI\Helpers')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>
            Migrations
            &ndash;
            {{-- Include the application name to make it easier to distinguish multiple tabs --}}
            {{ config('app.name', 'Laravel') }}
        </title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon borrowed from https://laravel.com/img/favicon/favicon-16x16.png --}}
        <link rel="icon" href="{{ $helpers->assetUrl('favicon.png') }}" type="image/png">

        <link rel="stylesheet" href="{{ $helpers->assetUrl('app.css') }}">

    </head>
    <body class="bg-light">

        <div class="card m-4">
            <div class="card-header">
                <strong>Route Not Found</strong>
            </div>
            <div class="card-body">
                <code>
                    {{ Request::getMethod() }}
                    {{ Request::getRequestUri() }}
                </code>
            </div>
        </div>

    </body>
</html>
