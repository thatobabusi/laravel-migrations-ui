@foreach (['danger', 'warning', 'success', 'info', 'primary', 'secondary', 'light', 'dark'] as $type)
    @if ($message = session("migrations-ui::$type"))
        <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach
