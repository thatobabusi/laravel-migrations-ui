<div class="card shadow-sm my-3">
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
}</pre>
</div>
