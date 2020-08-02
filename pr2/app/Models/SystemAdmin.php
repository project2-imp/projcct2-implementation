<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemAdmin extends Model
{
    //
    protected $table="systemadmins";
    protected $fillable = ['adminName','email','password'];
    //start relations

    public function adminCompany(){

        return $this->hasMany('App\Models\AdminCompany','adminID','adminID');
    }
    
    //end relastions

}
