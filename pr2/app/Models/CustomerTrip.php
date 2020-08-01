<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTrip extends Model
{
    //
    protected $table="customersTrips";

    //start relations

    public function trip(){

        return $this->belongsTo('App\Models\Trip','tripID','id');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer','customerID','id');
    }
    //end relations
}
