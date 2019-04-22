<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_data', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('using_service_id');
            $table->integer('use_value_prev');
            $table->integer('use_value_curr');
            $table->integer('use_value');
            $table->date('use_date');
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
        Schema::dropIfExists('use_data');
    }
}
