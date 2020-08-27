<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table ="companys";
    protected $fillable = ['companyID','name','email','phoneNumber','password','address','cardNumber','status','rating','created_at','imagePath'];
    protected $hidden = ['password'];

    /////////////// start relations ///////////////////

    public function card(){

        return $this->hasOne('App\Models\Card','cardNumber','companyID');

    }

    public function trip(){
        return $this->hasMany('App\Models\Trip','companyID','companyID');
    }

    public function companyFollowers(){

        return $this->hasMany('App\Models\CompanyFollower','companyID','companyID');
    }

    public function adminCompany(){

        return $this->hasMany('App\Models\AdminCompany','companyID','companyID');
    }



    /////////////// end relations ///////////////////

}
