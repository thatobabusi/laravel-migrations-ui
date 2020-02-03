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
        <script src="{{ $helpers->assetUrl('app.js') }}" defer></script>

    </head>
    <body class="bg-light"
        data-app-name="{{ config('app.name', 'Laravel') }}"
        data-home-url="{{ url('/') }}"
        data-url-base="{{ Request::getBasePath() . route('migrations-ui', [], false) }}"
    >
        <div id="app" class="loading">
            Loading...
        </div>
    </body>
</html>
