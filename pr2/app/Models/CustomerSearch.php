<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSearch extends Model
{
    //
    protected $table="customerSearchs";

    //start relations

    public function customer(){

        return $this->hasMany('App\Models\customerSearchs','customerID','SearchID');
    }

    //end relations
}
