<?php

namespace App\Http\Controllers\trips;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    //

    //start showTrips
    public function showTrips( Request $request){

        $company= Company::select('companyID')->where('name',$request->companyName)->get();
        $trips =Trip::where('companyID',$company[0]->companyID)
                    ->where('status','active')->get();

    $arr = array($trips);
    return $arr;

    }
    //end showTrips
}
