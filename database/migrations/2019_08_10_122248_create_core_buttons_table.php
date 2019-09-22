<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_buttons', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->mediumInteger('parent')->default(0);
            $table->string('lang_str', 128);
            $table->string('link', 128);
            $table->boolean('expandable')->default(0);
            $table->mediumInteger('display_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_buttons');
    }
}
