<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companys', function (Blueprint $table) {
            $table->bigIncrements('companyID')->autoIncrement();
            $table->string('name',100);
            $table->string('email',100);
            $table->integer('phoneNumber');
            $table->string('password',255);
            $table->string('address',255);
            $table->string('status',50);
            $table->bigInteger('cardNumber');
            $table->string('imagePath',1000);
            $table->integer('rating');
            $table->timestamps();
            $table->foreign('cardNumber')->references('cardNumber')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companys');
    }
}
