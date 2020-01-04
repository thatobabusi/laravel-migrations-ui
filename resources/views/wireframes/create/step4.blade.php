@extends('migrations-ui::wireframes.layout')

@section('title', 'New Migration')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-4" style="display: none; font-size: 1.8rem; line-height: 1.3;" id="spinner">
            <i class="fas fa-cog fa-spin text-white"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('migrations-ui.wireframes.create.step2') }}" class="btn btn-danger font-weight-bold" onclick="$('#spinner').show()">
                <i class="fas fa-caret-left mr-1"></i>
                Revert
            </a>
        </li>
        <li class="nav-item ml-3">
            <a href="{{ route('migrations-ui.wireframes.index') }}" class="btn btn-success font-weight-bold">
                Finish
                <i class="fas fa-caret-right ml-1"></i>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row mt-3">
        <div class="col">

            <div class="alert alert-success" role="alert">
                <i class="fas fa-check mr-1"></i>
                Migration applied successfully
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xl">

            <div class="card shadow-sm">
                <h6 class="card-header bg-secondary text-white">
                    <tt class="font-weight-bold">2018_11_04_210256_create_users_table.php</tt>
                </h6>
                <div class="card-body">
                    <pre class="mb-0" style="white-space: normal;"><?php highlight_string(<<<'END'
<?php

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
}
END
                        ) ?></pre>
                </div>
            </div>

        </div>
        <div class="col-xl-4">

            <div class="card shadow-sm">
                <h6 class="card-header bg-secondary text-white">
                    ...
                </h6>
                <div class="card-body">
                    ...
                </div>
            </div>

        </div>
    </div>
@endsection
