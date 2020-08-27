<?php

namespace App\Http\Controllers\trips;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    //start edit trip
    public function editTrip(Request $request){
            DB::table('trips')->where('tripID',$request->tripID)
                ->update(['departureDate'=>$request->newDate]);
            DB::table('trips')->where('tripID',$request->tripID)
                ->update(['numSeats'=>$request->newSeats]);



        return "updated";
    }
    //end edit trip

    //start deleteTrip
    public function deleteTrip(Request $request){
         Trip::where("tripID",$request->tripID)->delete();
        return "deleted";
    }
    //end deleteTrip
    //start getTrips
    public function getTrips(){

        $trips = Trip::get();
        $companies = array();
        for($i = 0 ;$i<sizeof($trips);$i++){
            $companies[$i]=Company::select('name','imagePath')->where('companyID',$trips[$i]->companyID)->get();
        }
        $arr = array($trips,$companies);
        return $arr;
    }
    //end getTrips


}
