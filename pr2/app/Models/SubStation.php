<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubStation extends Model
{
    //
    protected $table="subStations";

    //start relations

        public function trip(){

            return $this->belongsTo('App\Models\Trip','tripID','stationID');
        }
    //end relations
}
