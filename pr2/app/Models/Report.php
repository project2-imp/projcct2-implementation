<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table ="reports";
    protected $fillable = ['customerID','companyID','reportContent'];
    protected $hidden = ['created_at','updated_at'];

    public function customer(){

        return $this->belongsTo('App\Model\Customer','customerID','reportID');

    }





}
