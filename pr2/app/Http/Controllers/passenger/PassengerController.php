<?php

namespace App\Http\Controllers\passenger;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerTrip;
use Illuminate\Http\Request;
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
}
