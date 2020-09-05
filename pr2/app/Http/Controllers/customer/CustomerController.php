<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\passenger\PassengerController;
use App\Http\Controllers\payment\PaymentController;
use App\Models\Card;
use App\Models\Company;
use App\Models\Customer;
use App\Models\PendingCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyWrite;


class CustomerController extends Controller
{

    //start signUP
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function signUP(Request $request){

        $rules=$this->getRules();
        $val = Validator::make($request->all(),$rules);

        if($val->fails()){
            return redirect()->back()->withErrors($val)->withInput($request->all());
        }
        $VCode=$this->GenerateCode();
        PendingCustomer::create(
            [
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
                'phoneNumber'=>$request->input('phoneNumber'),
                'address'=>$request->input('address'),
                'VCode'=>$VCode,
            ]
        );

            $eController = new EmailsController();
            $eController->SendCode($request->input('email'),$VCode);
            return view('layouts.guest.inputVCode');


    }//end signUP

    //start validateCode
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function validateCode(Request $request){

      $customer=PendingCustomer::select('VCode')->where('email',$request->input('email'))
                                                ->where('VCode',$request->input('VCode'))->first();
      if($customer !=null){
        return $this->AddCustomer($request->input('email'));
      }
      else{
      return redirect()->back();
      }


    }//end validateCode

    //start GenerateCode
    /**
     * @return int
     */
    public function GenerateCode(){

        return mt_rand(100000, 999999);
    }//end GenerateCode

    //start getRules
    /**
     * @return array
     */
    public function getRules(){
        /* -------DOC------------
     * get rules for customer registeration from
     * */
       return $rules=[
            'name'=>'required|max:100|min:3|alpha',
            'email'=>'required|unique:customers,email|max:100',
            'password'=>'required|max:255',
            'phoneNumber'=>'required|unique:pendingcustomers,phoneNumber|max:11',
            'address'=>'required|max:255|min:6'
        ];

    }//end getRules

    //start AddCustomer
    /**
     * @param $customerEmail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function AddCustomer($customerEmail){

        /*-----------------------DOC-----------------------
         * select customer information from pendingCustoemrs table
         * delete customer info from pendingCustoemrs table
         * add customer info from Custoemrs table
         * redirect customer to login page
         * */

        $customerInfo = PendingCustomer::where('email',$customerEmail)->first();
        $pendingCus = PendingCustomer::where('email',$customerEmail)->delete();
        Customer::create(
            [
                'name'=>$customerInfo->name,
                'email'=>$customerInfo->email,
                'password'=>$customerInfo->password,
                'phoneNumber'=>$customerInfo->phoneNumber,
                'address'=>$customerInfo->address,
                'status'=>'newCustomer',
            ]
        );
        return view('layouts.customer.login');
    }//start AddCustomer



    //start login
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request){
        //make rules for validate info
        $rules=[
          'email'=>'required|max:100',
          'password'=>'required|max:255'
        ];

        $validator = Validator::make($request->all(),$rules);
        //info is fails
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        //info is correct
        else{
            //check if customer info exist in the database
            $customer = Customer::select('email')->where('email',$request->input('email'));
            //if exist
            if($customer != null){
                //get customer email && name
                $customerName = Customer::select('email','name')->where('email',$request->input('email'))->first();
                $status=array(1,$customerName);
               //pass customer info to the view
                return view('layouts.index',compact('status'));
            }
            //if not exist
            else{
                $arr = array('errorr email or password');
                return view('layouts.customer.login',compact('arr'));
            }

        }
    }
    //end login


    
    //start bookingTrip
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bookingTrip(Request $request){
        $tripNumber=$request->tripID;
        return view('layouts.customer.booking',compact('tripNumber'));
    }
    //end bookingTrip


    //start validCustomer
    /**
     * @param $status
     * @param $cardNumber
     * @return string
     */
    public function validCustomer($status, $cardNumber){

            if($status == "blocked" ) {
                return "customer blocked";
            }

            else if ($status != "blocked" && $cardNumber == null){
                return "no card Number";
            }

            else if ($status != "blocked" && $cardNumber != null){
                return "accepted customer";
            }


    }
    //end validCustomer


    //start sufficientAmount
    /**
     * @param $seatsNum
     * @param $seatPrice
     * @param $cardBallance
     * @return float|int
     */
    public function sufficientAmount($seatsNum, $seatPrice, $cardBallance){
        $totalCost = $seatsNum * $seatPrice;
        if($cardBallance -$totalCost >=0){

            return $totalCost;
        }
        else{
            return -1;
        }
    }
    //end sufficientAmount


    //start getCustomerInfo
    /**
     * @param Request $request
     * @return string
     */
    public function customerCardPayment(Request $request){
        $customer = Customer::select('cardNumber','status')->where('email',$request->email)
            ->where('password',$request->password)
            ->where('cardNumber',$request->cardNumber)
        ->first();
        //check if customer info exist in database
        if($customer !=null){
            $customerResult = $this->validCustomer($customer->status,$customer->cardNumber);

            if($customerResult === "accepted customer"){
        //end chicking
                $customerCard = Card::select('balance')->where('cardNumber',$request->cardNumber)->first();
        //check if number of seats values is accepted
                $amountResult = $this->sufficientAmount($request->seatsNumber,$request->seatPrice,$customerCard->balance);
                //if not accepted
                if($amountResult == -1){
                    return "The card does not contain sufficient amount for booking";
                }
                //if accepted
                else{
                    $customerID = Customer::select('customerID')->where('email',$request->email)->first();
                    //-----add new passenger place---
                    $newPassenger = new PassengerController();
                    $decreaseSeats = $newPassenger->DecreaseSeats($request->tripID,$request->seatsNumber);
                    if($decreaseSeats == "seats Decreased"){
                        $newPassenger->addNewPassenger($customerID->customerID,$request->tripID,$request->companyID,'accepted',$request->seatsNumber);
                    //--end add new passenger place--

                   //------payment place-------------
                        $payment = new PaymentController();
                        $payment->decreaseCardBalance($customer->cardNumber,$customerCard->balance,$amountResult);
                        $companyCard = Company::select('cardNumber')->where('companyID',$request->companyID)->first();
                        $companyBalance = Card::select('balance')->where('cardNumber',$companyCard->cardNumber)->first();
                        $payment->increaseCardBalance($companyCard->cardNumber,$companyBalance->balance,$amountResult);
                  //-----------end payment place------
                    }
                    else{
                        return $decreaseSeats;
                    }

                    return "booking successfully";
                }
            }
            else{
                return $customerResult;
            }
        }
        else{
            return "error";
        }


    }
    //end getCustomerInfo
}
