<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $table = "cards";
    protected $fillable=['cardNumber','balance','cardType'];
    //protected $hidden=[];

    /////////////// start relations ///////////////////

    public function customer(){

        return $this->belongsTo('App\Models\Customer','cardNumber','cardNumber');

    }

    public function company(){

        return $this->belongsTo('App\Models\Company','cardNumber','cardNumber');

    }

    /////////////// end relations ///////////////////

}
