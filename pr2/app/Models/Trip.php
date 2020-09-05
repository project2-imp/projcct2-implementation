<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    protected $table = "trips";
    protected $fillable=['tripID','startStation','stopStation','departureDate','numSeats','availableSeats','priceForSeat','companyID','status'];
    //protected $hidden=[];


    //start relations

    public function company(){

        return $this->belongsTo('App\Models\Company','companyID','id');
    }

    public function subStation(){

        return $this->hasMany('App\Models\SubStation','tripID','id');
    }

    public function picture(){

        return $this->hasMany('App\Models\Picture','tripID','id');
    }

    public function customersTrip(){

        return $this->hasMany('App\Models\CustomerTrip','tripID','id');
    }



    //end relations

}
