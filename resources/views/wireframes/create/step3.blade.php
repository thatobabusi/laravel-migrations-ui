@extends('migrations-ui::wireframes.layout')

@section('title', 'New Migration')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-4" style="display: none; font-size: 1.8rem; line-height: 1.3;" id="spinner">
            <i class="fas fa-cog fa-spin text-white" aria-hidden="true"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('migrations-ui.wireframes.create.step2') }}" class="btn btn-secondary font-weight-bold">
                <i class="fas fa-caret-left mr-1"></i>
                Back
            </a>
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
    <div class="row mt-3">
        <div class="col-xl">

            <div class="card shadow-sm">
                <h6 class="card-header bg-secondary text-white">
                    Customise Migration
                </h6>
                <div class="card-body">
                        <textarea class="form-control" style="color: #212529; font-family: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace; font-size: 0.875rem" rows="31">&lt;?php

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
        Schema::create('users', function (Blueprint $table) {
            $table-&gt;increments('id');
            $table-&gt;string('name');
            $table-&gt;string('email')-&gt;unique();
            $table-&gt;timestamp('email_verified_at')-&gt;nullable();
            $table-&gt;string('password');
            $table-&gt;rememberToken();
            $table-&gt;timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}</textarea>
                </div>
            </div>

        </div>
        <div class="col-xl-4">

            <div class="card shadow-sm">
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
                </div>
            </div>

        </div>
    </div>
@endsection
