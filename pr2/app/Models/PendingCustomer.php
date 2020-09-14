<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingCustomer extends Model
{
    //
    protected $table="pendingCustomers";
    protected $fillable=['name','email','password','phoneNumber','address','VCode','imagePath'];
    protected $hidden=['created_at','updated_at'];
}
