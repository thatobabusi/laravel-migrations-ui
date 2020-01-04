<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">

    <a class="navbar-brand" href="{{ route('migrations-ui.index') }}">
        <i class="fab fa-laravel mr-1" aria-hidden="true"></i>
        <span class="sr-only">Laravel</span>
        Migrations
        &ndash;
        {{ config('app.name') }}
    </a>

    @yield('navbar-right')

</nav>
