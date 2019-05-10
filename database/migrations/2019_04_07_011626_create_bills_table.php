<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('user_name')->nullable();
            $table->integer('using_service_id');
            $table->integer('use_data_id');
            $table->integer('use_value');
            $table->float('price');
            $table->date('use_date');
            $table->float('discount');
            $table->float('vat');
            $table->float('sum');
            $table->integer('status')->default(0);
            $table->integer('paid_method')->nullable();
            $table->dateTime('paid_date')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
