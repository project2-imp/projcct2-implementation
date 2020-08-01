<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersSearchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerSearchs', function (Blueprint $table) {
            $table->bigIncrements('SearchID')->autoIncrement();
            $table->string('searchContent','1000');
            $table->bigInteger('customerID');
            $table->timestamps();
            $table->foreign('customerID')->references('customerID')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customerSearchs');
    }
}
