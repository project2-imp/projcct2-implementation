<?php

namespace App\Http\Controllers\trips;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerTrip;
use App\Models\Report;
use App\Models\Trip;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

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

    //start getTrips for index page
    public function getTrips($customerEmail){
        $email = Customer::select('email')->where('email',$customerEmail)->first();
        if($email == null){
            $trips = Trip::get();
            $companies = array();
            for($i = 0 ;$i<sizeof($trips);$i++){
                $companies[$i]=Company::select('name','imagePath')->where('companyID',$trips[$i]->companyID)->get();
            }
            $arr = array($trips,$companies);
            return $arr;
        }
        else{
            return "customer show trips algorithem";
        }


    }
    //end getTrips for index page

    //start getTripsNum
    public function getTripsNum(Request $request){
        $company = Company::select('companyID')->where('name',$request->companyName)->first();
        $trips = Trip::where('companyID',$company->companyID)->count();
        return $trips;
    }
    //end getTripsNum

    //start getActiveTrips
    public function getActiveTrips($customerID){
        $trips = CustomerTrip::select('tripID','seatsNumber')->where('customerID',$customerID)->get();
        $customerTrips = array(sizeof($trips));
        for($i=0;$i<sizeof($trips);$i++){
            $customerTrips[$i]=Trip::select('startStation','stopStation','departureDate','priceForSeat')->where('tripID',$trips[$i]->tripID)->first();

        }
        $finalInfo = array($customerTrips,$trips);
    return $finalInfo;


    }
    //end getActiveTrips

    //start getCompletedTrips
    public function getCompletedTrips(){

    }
    //end getCompletedTrips
}
