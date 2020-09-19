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
use App\ProductSimilarity;
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

        //-----------------------------


        /*

        showTrips()
            trips = getTrips(jsonFilePath)
            selectedTrip = trips->0
            productSimilarity = new ProductSimilarity(trips)
            similarityMatrix  = productSimilarity->calculateSimilarityMatrix()       
            trips = productSimilarity->getProductsSortedBySimularity(selectedTrip,similarityMatrix);
        end
        */





        $tripsData = Trip::all();
        file_put_contents('myTrips.json',json_encode($tripsData));
        $trips = json_decode(file_get_contents(public_path('myTrips.json')));

        $selectedId = intval(app('request')->input('id') ?? '91');
        $selectedProduct = $trips[0];

        $selectedProducts = array_filter($trips, function ($product) use ($selectedId) { return $product->tripID === $selectedId; });
        if (count($selectedProducts)) {
            $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
        }


        $productSimilarity = new ProductSimilarity($trips);
        $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
        $trips          = $productSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);
        $companies = array();
        for($i = 0 ;$i<sizeof($trips);$i++){
            $companies[$i]=Company::select('name','imagePath')->where('companyID',$trips[$i]->companyID)->get();
        }
        $arr = array($trips,$companies);
        return $arr;



        //-----------------------------




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
            $customerTrips[$i]=Trip::select('startStation','stopStation','departureDate','departureTime','priceForSeat')->where('tripID',$trips[$i]->tripID)->first();

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
