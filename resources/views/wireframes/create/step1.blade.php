@extends('migrations-ui::wireframes.layout')

@section('title', 'New Migration')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <button class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Undo" disabled>
                <i class="fas fa-fw fa-undo" aria-hidden="true"></i>
            </button>
            <button class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Redo" disabled>
                <i class="fas fa-fw fa-redo" aria-hidden="true"></i>
            </button>
        </li>
        <li class="nav-item ml-3">
            <a href="{{ route('migrations-ui.wireframes.create.step4') }}" class="btn btn-success font-weight-bold disabled">
                Save &amp; Apply
                <i class="fas fa-caret-right ml-1" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl">

            <div class="card shadow-sm mt-3">
                <h6 class="card-header bg-secondary text-white">
                    Select Action
                </h6>
                <div class="dropdown-menu border-0 d-block position-static w-100">
                    <a class="dropdown-item" href="{{ route('migrations-ui.wireframes.create.step2') }}">Create Table</a>
                    <a class="dropdown-item" href="{{ route('migrations-ui.wireframes.create.step2') }}">Modify Table</a>
                    <a class="dropdown-item" href="{{ route('migrations-ui.wireframes.create.step2') }}">Drop Table</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('migrations-ui.wireframes.create.step2') }}">Custom PHP</a>
                    <a class="dropdown-item" href="{{ route('migrations-ui.wireframes.create.step2') }}">Custom SQL</a>
                </div>
            </div>

        </div>
        <div class="col-xl-4">

            <div class="card shadow-sm mt-3">
                <h6 class="card-header bg-secondary text-white">
                    Settings
                </h6>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticEmail" placeholder="{{ now() }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticEmail" placeholder="" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Down Action</label>
                        <div class="col-sm-9">
                            <select class="custom-select">
                                <option>Revert changes</option>
                                <option>Throw exception</option>
                                <option>Do nothing</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Foreign Keys</label>
                        <div class="col-sm-9">
                            <div class="custom-control custom-checkbox mt-2">
                                <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="custom-control-label" for="defaultCheck1">
                                    Disable foreign key checks during migration
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <h6 class="card-header bg-secondary text-white">
                    <div class="float-right" style="margin: -6px 0;">
                        <a href="{{ route('migrations-ui.wireframes.create.step3') }}" class="btn btn-dark btn-sm font-weight-bold">
                            Customise
                        </a>
                    </div>
                    Preview
                </h6>
                <pre class="card-body mb-0">&lt;?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TBC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}</pre>
            </div>

        </div>
    </div>
@endsection
