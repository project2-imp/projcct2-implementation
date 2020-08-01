<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminCompany extends Model
{
    //
    protected $table="adminsCompanies";

    //start relations

    public function company(){

        return $this->belongsTo('App\Models\Company','companyID','id');

    }

    public function admin(){

        return $this->belongsTo('App\Models\SystemAdmin','adminID','id');

    }


    //end relations
}
