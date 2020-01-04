<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">

    {{-- Logo --}}
    <a class="navbar-brand" href="{{ route('migrations-ui.home') }}">
        <i class="fab fa-laravel fa-lg mr-2" aria-hidden="true"></i>
        <span class="sr-only">Laravel</span>
        Migrations
        &ndash;
        {{ config('app.name') }}
    </a>

    @yield('navbar-right')

</nav>
