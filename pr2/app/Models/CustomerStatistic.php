<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerStatistic extends Model
{
    //
    protected $table="custoemrsstatistics";
    protected  $fillable=['customerID','tripsNum','cashTrips','byCardTrips','totalAmount'];
}
