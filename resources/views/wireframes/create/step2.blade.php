@extends('migrations-ui::wireframes.layout')

@section('title', 'New Migration')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-4" style="display: none; font-size: 1.8rem; line-height: 1.3;" id="spinner">
            <i class="fas fa-cog fa-spin text-white" aria-hidden="true"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('migrations-ui.wireframes.create') }}" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Undo">
                <i class="fas fa-fw fa-undo" aria-hidden="true"></i>
            </a>
            <button class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Redo" disabled>
                <i class="fas fa-fw fa-redo" aria-hidden="true"></i>
            </button>
        </li>
        <li class="nav-item ml-3">
            <a href="{{ route('migrations-ui.wireframes.create.step4') }}" class="btn btn-success font-weight-bold" onclick="$('#spinner').show()">
                Save &amp; Apply
                <i class="fas fa-caret-right ml-1" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl">

            @include('migrations-ui::wireframes.create.step2.card-create-table')
            @include('migrations-ui::wireframes.create.step2.card-modify-table')
            @include('migrations-ui::wireframes.create.step2.card-drop-table')
            @include('migrations-ui::wireframes.create.step2.card-custom-php')

            <div class="mt-3">
                <div class="btn-group dropup">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add Action
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Create Table</a>
                        <a class="dropdown-item" href="#">Modify Table</a>
                        <a class="dropdown-item" href="#">Drop Table</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Custom PHP</a>
                        <a class="dropdown-item" href="#">Custom SQL</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-4">
            @include('migrations-ui::wireframes.create.step2.card-settings')
            @include('migrations-ui::wireframes.create.step2.card-preview')
        </div>
    </div>
@endsection

@section('footer')
    @include('migrations-ui::wireframes.create.step2.modal-edit-id')
    @include('migrations-ui::wireframes.create.step2.modal-edit-name')
    @include('migrations-ui::wireframes.create.step2.modal-edit-account_id')
    @include('migrations-ui::wireframes.create.step2.modal-edit-index')
    @include('migrations-ui::wireframes.create.step2.modal-edit-foreign-key')
@endsection
