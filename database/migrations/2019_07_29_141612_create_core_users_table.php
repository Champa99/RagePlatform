<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_users', function (Blueprint $table) {

			$table->charset = 'utf8';
            $table->collation = 'utf8_croatian_ci';

			$table->increments('id');
			$table->string('username', 32)->unique();
			$table->string('email', 128)->unique();
			$table->string('password', 255);
			$table->string('avatar', 255);
			$table->integer('date_registered');
			$table->smallInteger('user_group')->default(2);
			$table->smallInteger('pin_code')->default(0000);
			$table->smallInteger('not_count')->default(0);
			$table->smallInteger('mess_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_users');
    }
}
