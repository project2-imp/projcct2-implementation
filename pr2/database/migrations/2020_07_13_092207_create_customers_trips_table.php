<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customersTrips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customerID');
            $table->bigInteger('tripID');
            $table->string('status',50);
            $table->timestamps();
            $table->foreign('customerID')->references('customerID')->on('customers');
            $table->foreign('tripID')->references('tripID')->on('trips');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customersTrips');
    }
}
