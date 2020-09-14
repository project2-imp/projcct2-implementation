<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\passenger\PassengerController;
use App\Http\Controllers\payment\PaymentController;
use App\Models\Card;
use App\Models\Company;
use App\Models\CompanyFollower;
use App\Models\Customer;
use App\Models\CustomerSearch;
use App\Models\CustomerTrip;
use App\Models\PendingCustomer;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyWrite;


class CustomerController extends Controller
{

public function getCustomerProfile(){
    return view('layouts.customer.Profile');
}

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
        $iconExtension = $request->customerIcon->getClientOriginalExtension();
        $iconName=time().'.'.$iconExtension;
        $path='uploads/customersIcons';
        $request->customerIcon->move($path,$iconName);

        PendingCustomer::create(
            [
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
                'phoneNumber'=>$request->input('phoneNumber'),
                'address'=>$request->input('address'),
                'imagePath'=>$iconName,
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


    //start getUpdateRules
    public function getUpdateRules(){
        /* -------DOC------------
     * get rules for customer that update his information
     * */
        return $rules=[
            'name'=>'required|max:100|min:3|alpha',
            'email'=>'required|unique:customers,email|max:100',
            'password'=>'required|max:255',
            'phoneNumber'=>'required|unique:customers,phoneNumber|max:11',
            'address'=>'required|max:255|min:6'
        ];

    }//end getUpdateRules

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
                'imagePath'=>$customerInfo->imagePath,
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
                $customerName = Customer::select('customerID','email','name','imagePath')->where('email',$request->input('email'))->first();
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

    //start followCompany
    public function followCompany(Request $request){
         CompanyFollower::create(
           [
               'companyID'=>$request->companyID,
               'customerID'=>$request->customerID,
           ]
         );
    return "new follower";
    }
    //end followCompany

    //start cancelFollowCompany
    public function cancelFollowCompany(Request $request){
        CompanyFollower::where("companyID",$request->companyID)
                       ->where('customerID',$request->customerID)->delete();
        return "deleted";
    }
    //end cancelFollowCompany

    //start getProfileInfo
    public function getProfileInfo($customerID){
        $customer = Customer::select()->where('customerID',$customerID)->first();
        return $customer;
    }
    //end getProfileInfo

    //start editProfile
    public function editProfile(Request $request){

        $customer = Customer::select('email','phoneNumber')->where('customerID',$request->customerID)->get();
        $newEmail = Customer::select('email')->where('email',$request->newEmail)->get();
        $newPhone = Customer::select('phoneNumber')->where('phoneNumber',$request->newPhoneNumber)->get();
        $customer2 = Customer::select('name','password','address')->where('customerID',$request->customerID)->first();

                 if($customer2->name != $request->newName){
                     DB::table('customers')->where('customerID',$request->customerID)
                         ->update(['name'=>$request->newName]);
                 }

                 if($customer[0]->email != $request->newEmail){

                     if ($customer[0]->email != $request->newEmail  && sizeof($newEmail) == 0 ){
                         DB::table('customers')->where('customerID',$request->customerID)
                             ->update(['email'=>$request->newEmail]);
                     }
                     else if($customer[0]->email != $request->newEmail  && sizeof($newEmail) > 0 ){
                         return "email exist!! try another email";
                     }
                 }

                 if($customer2->address != $request->newAddress){
                     DB::table('customers')->where('customerID',$request->customerID)
                         ->update(['address'=>$request->newAddress]);
                 }

                 if($customer[0]->phoneNumber != $request->newPhoneNumber){
                  if ($customer[0]->phoneNumber != $request->newPhoneNumber  && sizeof($newPhone) == 0 ){

                      DB::table('customers')->where('customerID',$request->customerID)
                          ->update(['phoneNumber'=>$request->newPhoneNumber]);
                     }
                     else if($customer[0]->phoneNumber != $request->newPhoneNumber  && sizeof($newPhone) > 0 ){
                         return "phone number exist !!! try another phone number";
                     }

                 }
                 if($customer2->password != $request->newPassword){
                     DB::table('customers')->where('customerID',$request->customerID)
                         ->update(['password'=>$request->newPassword]);
                 }

                 return "information updated";


    }
    //end editProfile

    //start customerSearch
    public function customerSearch($customerID,$searchContent){


          $search = CustomerSearch::select('searchContent')->where('customerID',$customerID)
                ->where('searchContent',$searchContent)->first();

            if($search == null){
                CustomerSearch::create(
                    [
                        'searchContent'=>$searchContent,
                        'customerID'=>$customerID
                    ]
                );
            }
        $companiesResult = Company::select()->where('name','like','%'.$searchContent.'%')
                        ->orWhere('address','like','%'.$searchContent.'%')->get();

        $tripsResult = Trip::select()->where('startStation','like','%'.$searchContent.'%')
            ->orWhere('stopStation','like','%'.$searchContent.'%')
            ->orWhere('departureDate','like','%'.$searchContent.'%')->get();
        $finalResult = array($companiesResult,$tripsResult);
        return $finalResult;
    }
    //end customerSearch

    //start customerSearchHistory
    public function customerSearchHistory(Request $request){
        if($request->customerID != null){
            $search = CustomerSearch::select('searchContent')->where('customerID',$request->customerID)
                ->where('searchContent','like','%'.$request->searchContent.'%')->limit(5)->get();
            return $search;

        }
        else if ($request->customerID == null){
            $search = CustomerSearch::select('searchContent')->where('searchContent','like','%'.$request->searchContent.'%')->limit(5)->get();
            return $search;
        }
    }
    //end customerSearchHistory

    public function showTripsResult($companyID){

        $trips = Trip::select()->where('companyID',$companyID)->get();
        return $trips;
    }
}
