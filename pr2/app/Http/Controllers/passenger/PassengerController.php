<?php

namespace App\Http\Controllers\passenger;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerTrip;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PassengerController extends Controller
{
    //start addPendingPassenger
    public function addPendingPassenger(Request $request){


            if($request->seatsNumber >5){
                return "error in number of seats";
            }
            else{
                $customerID = Customer::select('customerID')->where('phoneNumber',$request->phoneNumber)
                    ->where('password',$request->password)->first();


                if($customerID !=null){

                    CustomerTrip::create(
                        [
                            'customerID'=>$customerID->customerID,
                            'tripID'=>$request->tripID,
                            'status'=>'pending',
                            'seatsNumber'=>$request->seatsNumber,
                            'companyID'=>$request->companyID,
                        ]
                    );
                    return "passenger added";
                }
                else{
                    return "error in customer info";
                }
            }
        }
    //end addPendingPassenger

    //start addPassenger
    public function addPassenger(Request $request){
        DB::table('customerstrips')->where('customerID',$request->customerID)
                                        ->where('tripID',$request->tripID)
            ->update(['status'=>'accepted']);
        return "success";
    }
    //end addPassenger

    //start deletePassenger
    public function deletePassenger(Request $request){
        CustomerTrip::where("tripID",$request->tripID)
            ->where("customerID",$request->customerID)->delete();
        return "success";
    }
    //end deletePassenger

}
