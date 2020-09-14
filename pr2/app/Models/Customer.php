<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    protected $table="customers";
    protected $fillable=['customerID','name','email','password','phoneNumber','address','imagePath'];
    protected $hidden=['created_at','updated_at'];
    /////////////// start relations ///////////////////

    public function card(){

        return $this->hasOne('App\Models\Card','cardNumber','customerID');

    }

    public function customersTrip(){

        return $this->hasMany('App\Models\CustomerTrip','customerID','customerID');
    }

    public function customerSearch(){

        return $this->hasMany('App\Models\CustomerSearch','customerID','customerID');
    }

    public function companyFollowers(){

        return $this->hasMany('App\Models\CompanyFollower','customerID','customerID');
    }

    public function report(){

        return $this->hasOne('App\Models\Report','customerID','customerID');
    }



    /////////////// end relations ///////////////////
}
