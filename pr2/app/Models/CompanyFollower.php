<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyFollower extends Model
{
    //
    protected $table="companiesFollowers";
    protected $fillable=['companyID','customerID'];
    //start relations

    public function customer(){

       return $this->belongsTo('App\Models\Customer','customerID','id');

    }

    public function company(){

        return $this->belongsTo('App\Models\Company','companyID','id');

    }

    public function feedback(){

        return $this->hasMany('App\Models\Feedback','followerID','id');
    }
    //end relations
}
