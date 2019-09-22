<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('log_date');
            $table->string('member_name', 64);
            $table->string('lang_str', 128);
            $table->string('action', 128);
            $table->string('ip', 32);
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_logs');
    }
}
