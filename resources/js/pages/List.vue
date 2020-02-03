<script>
    import MigrationsList from '../components/MigrationsList';
    import Navbar from '../components/Navbar';
    import TablesList from '../components/TablesList';

    export default {
        components: { MigrationsList, Navbar, TablesList },
    }
</script>

<template>
    <div>

        <Navbar></Navbar>

        <!--<div aria-live="polite" aria-atomic="true" style="position: absolute; top: 50px; right: 20px; width: 350px; z-index: 1030;">

            @foreach (['danger', 'warning', 'success', 'info', 'primary', 'secondary', 'light', 'dark'] as $type)
                @if ($message = session("migrations-ui::$type"))

                    <div class="toast" role="alert" aria-atomic="true" data-delay="5000">
                        <div class="toast-header text-{{ $type }}">

                            <strong class="mr-auto">
                                @if ($type === 'danger')
                                <i class="fa fa-exclamation-circle mr-2"></i>
                                {{ session("migrations-ui::$type-title", 'Error') }}
                                @elseif ($type === 'warning')
                                <i class="fa fa-exclamation-triangle mr-2"></i>
                                {{ session("migrations-ui::$type-title", 'Warning') }}
                                @elseif ($type === 'success')
                                <i class="fa fa-check mr-2"></i>
                                {{ session("migrations-ui::$type-title", 'Success') }}
                                @elseif ($type === 'info')
                                <i class="fa fa-info-circle mr-2"></i>
                                {{ session("migrations-ui::$type-title", 'Information') }}
                                @endif
                            </strong>

                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="toast-body">
                            {{ $message }}
                        </div>
                    </div>

                @endif
            @endforeach

        </div>-->

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-xl">
                    <MigrationsList></MigrationsList>
                </div>
                <div class="col-xl-4">
                    <TablesList></TablesList>
                </div>
            </div>
        </div>

        <!--<div class="modal fade" id="migration-popup" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="migration-popup-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <pre id="migration-popup-code" class="m-0 p-3 language-php"></pre>
                    </div>
                </div>
            </div>
        </div>-->

    </div>
</template>
