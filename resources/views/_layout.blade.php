<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @yield('title', 'NO TITLE SET')
            &ndash;
            {{-- Include the application name to make it easier to distinguish multiple tabs --}}
            {{ config('app.name', 'Laravel') }}
        </title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon borrowed from https://laravel.com/img/favicon/favicon-16x16.png --}}
        <link rel="icon" href="{{ route('migrations-ui.asset', 'favicon.png') }}" type="image/png">

        <link rel="stylesheet" href="{{ route('migrations-ui.asset', 'migrations-ui.css') }}">
        <script src="{{ route('migrations-ui.asset', 'migrations-ui.js') }}" async></script>

        @stack('head')

    </head>
    <body class="bg-light">

        @include('migrations-ui::_navbar')

        @yield('content')

        @stack('footer')

    </body>
</html>
