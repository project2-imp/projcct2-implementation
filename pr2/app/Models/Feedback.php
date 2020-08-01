<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table="feedbacks";

    //start relations


    public function follower(){

        return $this->belongsTo('App\Models\CompanyFollower','followerID','feedID');
    }

    //end relations

}
