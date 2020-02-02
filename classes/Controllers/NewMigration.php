<?php

namespace DaveJamesMiller\MigrationsUI\Controllers;

use Illuminate\Routing\Controller;

class NewMigration extends Controller
{
    public function create()
    {
        $upCode = <<<'END'
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
END;

        $downCode = "Schema::dropIfExists('users');";

        return view('migrations-ui::create', compact('upCode', 'downCode'));
    }
}
