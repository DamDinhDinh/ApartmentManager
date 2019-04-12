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
            $table->integer('user_id');
            $table->integer('use_data_id');
            $table->integer('amount');
            $table->float('cost');
            $table->float('discount');
            $table->float('vat');
            $table->float('sum');
            $table->integer('status');
            $table->integer('paid_method');
            $table->dateTime('paid_date');
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
