<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $table="pictures";


    //start relations

    public function trip(){

        return $this->belongsTo('App\Models\Trip','tripID','pictureID');
    }
    //end relations
}
