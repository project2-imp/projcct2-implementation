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
    public function addPendingPassenger(Request $request)
    {
        if ($request->seatsNumber > 5) {
            return "error in number of seats";
        } else {
            $customerID = Customer::select('customerID')->where('phoneNumber', $request->phoneNumber)
                ->where('password', $request->password)->first();
            if ($customerID != null) {
                $decrease = $this->DecreaseSeats($request->tripID , $request->seatsNumber);
                if($decrease == "seats Decreased" ){
                    $newPassenger = $this->addNewPassenger($customerID->customerID, $request->tripID, $request->companyID, "pending", $request->seatsNumber);
                    return $newPassenger;
                }
                else{
                    return "alimono";
                }


            } else {
                return "error in customer info";
            }
        }
    }
    //end addPendingPassenger

    //start addPassenger
    public function addPassenger(Request $request)
    {
        DB::table('customerstrips')->where('customerID', $request->customerID)
            ->where('tripID', $request->tripID)
            ->update(['status' => 'accepted']);

        return "customer accepted";
    }
    //end addPassenger

    //start addNewPassenger
    public function addNewPassenger($customerID, $tripID, $companyID, $status, $seatsNum)
    {
        CustomerTrip::create(
            [
                'customerID' => $customerID,
                'tripID' => $tripID,
                'status' => $status,
                'seatsNumber' => $seatsNum,
                'companyID' => $companyID,
            ]
        );
        return "passenger added";
    }
    //end addNewPassenger

    //start deletePassenger
    public function deletePassenger(Request $request)
    {
        CustomerTrip::where("tripID", $request->tripID)
            ->where("customerID", $request->customerID)->delete();
        return "customer deleted";
    }
    //end deletePassenger

    //start DecreaseSeats
    public function DecreaseSeats($tripID,$seatsNumber)
    {
        $availableSeats = Trip::select('availableSeats')->where('tripID', $tripID)->first();
        if ($availableSeats->availableSeats - $seatsNumber >= 0) {
            DB::table('trips')->where('tripID', $tripID)
                ->update(['availableSeats' => $availableSeats->availableSeats - $seatsNumber]);
            return "seats Decreased";
        }
        else {
            return "error in number of seats";
        }
        //end DecreaseSeats
    }
}
