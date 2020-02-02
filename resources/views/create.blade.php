@extends('migrations-ui::_layout')

@section('title', 'New Migration')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        {{--
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
        --}}
        <li class="nav-item ml-3">
            <a href="#" class="btn btn-success font-weight-bold">
                Save &amp; Apply
                <i class="fas fa-caret-right ml-1" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col-xl">

                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-secondary text-white" style="line-height: 1.2;">
                        {{--<div class="float-right" style="margin: -6px 0;">
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up">
                                <i class="fas fa-fw fa-arrow-alt-circle-up" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down" disabled>
                                <i class="fas fa-fw fa-arrow-alt-circle-down" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                                <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                        Custom PHP--}}
                        <a class="float-right font-weight-normal text-white" href="https://laravel.com/docs/migrations" target="_blank">
                            <i class="fas fa-question-circle" aria-hidden="true"></i>
                            Laravel Docs
                        </a>
                        <h6 class="m-0">New Migration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md">
                                <label class="form-label">Up</label>
                                <textarea class="form-control" rows="8" style="height: calc(100vh - 250px); min-height: 200px;">{{ $upCode }}</textarea>
                            </div>
                            <div class="form-group col-md">
                                <label class="form-label">Down</label>
                                <textarea class="form-control" rows="8" style="height: calc(100vh - 250px); min-height: 200px;">{{ $downCode }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-4">

                <div class="card shadow-sm my-3">
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
                                <input type="text" class="form-control" id="staticEmail" placeholder="create users table" aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">
                                    <code>{{ now()->format('Y_m_d_His') }}_create_users_table.php</code><br>
                                </small>
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
                            <div class="col-sm-9 offset-sm-3">
                                <div class="custom-control custom-checkbox mt-1">
                                    <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="custom-control-label" for="defaultCheck1">
                                        Disable foreign key checks during migration
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm my-3">
                    <h6 class="card-header bg-secondary text-white">
                        {{--<div class="float-right" style="margin: -6px 0;">
                            <a href="{{ route('migrations-ui.wireframes.create.step3') }}" class="btn btn-dark btn-sm font-weight-bold">
                                Customise
                            </a>
                        </div>--}}
                        Preview
                    </h6>
                    <pre class="card-body mb-0">&lt;?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
{{ preg_replace('/^/m', '        ', $upCode) }}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
{{ preg_replace('/^/m', '        ', $downCode) }}
    }
}</pre>
                </div>

            </div>
        </div>
    </div>
@endsection
