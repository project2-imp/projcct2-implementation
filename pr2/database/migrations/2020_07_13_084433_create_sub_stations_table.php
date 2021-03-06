<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subStations', function (Blueprint $table) {
            $table->bigIncrements('stationID')->autoIncrement();
            $table->string('stationName',255);
            $table->bigInteger('tripID');
            $table->timestamps();
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
        Schema::dropIfExists('subStations');
    }
}
