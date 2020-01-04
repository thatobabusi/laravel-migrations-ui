<div class="modal" id="showMigrationModal" tabindex="-1" role="dialog" aria-labelledby="showMigrationModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showMigrationModalLabel">
                    2018-11-02 23:57:21 &ndash; create posts table
                    {{--<i class="fas fa-cog fa-spin ml-1 text-muted" aria-hidden="true"></i>--}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="row">
                    <div class="col">
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
            <div class="modal-footer">
                <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Migration">
                    <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                </button>
                <button class="btn btn-danger mr-auto" data-toggle="tooltip" data-placement="top" title="Delete Migration">
                    <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                </button>
                {{--<button class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                <button class="btn btn-success font-weight-bold">Apply Migration (Up)</button>
            </div>
        </div>
    </div>
</div>
