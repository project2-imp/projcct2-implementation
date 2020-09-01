<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\EmailsController;
use App\Models\Customer;
use App\Models\PendingCustomer;
use Illuminate\Http\Request;
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
        $rules=[
          'email'=>'required|max:100',
          'password'=>'required|max:255'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        else{
          $customer = Customer::select('email')->where('email',$request->input('email'))
                                               ->where('password',$request->input('password'))->first();
            if($customer != null){
                $customerName = Customer::select('email','name')->where('email',$request->input('email'))->first();

                $status=array(1,$customerName);
               return view('layouts.index',compact('status'));
            }
            else{
                $arr = array('errorr email or password');
                return view('layouts.customer.login',compact('arr'));
            }

        }
    }//end login

    //start bookingTrip
    public function bookingTrip(Request $request){
        $tripNumber=$request->tripID;
        return view('layouts.customer.booking',compact('tripNumber'));
    }
    //end bookingTrip

}
