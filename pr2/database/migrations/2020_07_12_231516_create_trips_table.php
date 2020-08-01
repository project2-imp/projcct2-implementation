<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('tripID')->autoIncrement();
            $table->string('startStation',100);
            $table->string('stopStation',100);
            $table->date('departureDate');
            $table->integer('numSeats');
            $table->integer('priceForSeat');
            $table->bigInteger('companyID');
            $table->string('status',50);
            $table->timestamps();
            $table->foreign('companyID')->references('companyID')->on('companys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
