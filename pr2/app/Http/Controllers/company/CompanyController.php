<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyFollower;
use App\Models\Customer;
use App\Models\CustomerTrip;
use App\Models\Report;
use App\Models\Trip;
use Composer\Autoload\ClassLoader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;


class CompanyController extends Controller
{
    //start AddPendingCompany
    public function AddPendingCompany(Request $request){
            $rules = $this->getRules();
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInputs($request->all());
            }
            $companyCard = $this->CreateVCard();
            $iconExtension = $request->companyIcon->getClientOriginalExtension();
            $iconName=time().'.'.$iconExtension;
            $path='uploads/companiesIcons';
            $request->companyIcon->move($path,$iconName);
            //dd($iconExtension);
        Company::create(
                    [
                        'name'=>$request->input('companyName'),
                        'email'=>$request->input('email'),
                        'password'=>$request->input('password'),
                        'phoneNumber'=>$request->input('phoneNumber'),
                        'address'=>$request->input('address'),
                        'imagePath'=>$iconName,
                        'cardNumber'=>$companyCard,
                        'rating'=>1,
                        'status'=>'pending'
                    ]
                );
                $status= array(1,$request->input('companyName'));
            return view('layouts.guest.createCompany',compact('status'));
    }//end AddPendingCompany

    //start CompanyExist

   public function CompanyExist($companyName){

        /*DOC
         * get company name from copmpanies table
         * check if name exist or no
         * if(exist):return true
         * else:return false
         *
         * */
        $name = Company::where('name',$companyName)->first();
        if($name === null){
            return false;
        }
        else{
            return true;
        }

    }//end CompanyExist

    //start CreateVCard
    public function CreateVCard(){
        /*TODO
         * generate code
         * check if code not exist
         * */

            $status=false;
            while ($status == false){
                $randCode=mt_rand(1000000, 9999999);
                $companyCard = Company::where('cardNumber',$randCode)->first();
                if($companyCard === null){
                    $status =true;
                    return $randCode;
                }
                else{
                    $status = false;
                }
            }
        return $randCode;



    }
    //end CreateVCard

    //start getRules
    public function getRules(){
        /*
        * get rules for company registeration from
        * */
       return $rules=[
           'companyName'=>'required|unique:companys,name|max:100',
           'email'=>'required|unique:companys,email|max:100',
           'password'=>'required|max:255',
           'phoneNumber'=>'required|unique:companys,phoneNumber|max:11',
           'address'=>'required|max:255'
       ];
    }
    //end getRules

    //start login
    public function login(Request $request){

        $company = Company::where('email',$request->input('email'))
                          ->where('password',$request->input('password'))
                          ->where('status','!=','pending')->first();
        if($company != null){
            $Name  = Company::select('name','imagePath')->where('email',$request->input('email'))->first();
            $companyName = array($Name);
            return view('layouts.company.companyControlPanel',compact('companyName'));
        }
        else{
            return redirect()->back();
        }

    }
    //end login

    //start AddNewTrip
    public function addNewTrip(Request $request){

     if($this->blockedCompany($request->companyName) === true){
         return "blocked";
     }
    else{
        $company = Company::select('companyID')->where('name',$request->companyName)->get();


        Trip::create(
        [
            'startStation'=>$request->startStation,
            'stopStation'=>$request->stopStation,
            'departureDate'=>$request->departureDate,
            'departureTime'=>$request->departureTime,
            'numSeats'=>$request->seatsNum,
            'availableSeats'=>$request->seatsNum,
            'priceForSeat'=>$request->price,
            'companyID'=>$company[0]->companyID,
            'status'=>'active',
        ]
        );
        return "success";
    }

    }
    //end AddNewTrip

    //start BlockCompany
    public function blockedCompany($companyName){
        $company = Company::select('status')->where('name',$companyName)->first();
        if($company->status == 'blocked'){
            return true;
        }
        else{
            return false;
        }

    }
    //end BlockCompany

    //start showBestCompanies
    public function showBestCompanies(){
        $companies = Company::select('name','address','rating','imagePath')->orderBy('rating','desc')->get();
        return $companies;
    }
    //end showBestCompanies

    //start getPendingCustomers
    public function getPendingCustomers($companyName){
        $companyID = Company::select('companyID')->where('name',$companyName)->first();
        $pendingCustomers=CustomerTrip::select('customerID','tripID','seatsNumber')->where('status','pending')
            ->where('companyID',$companyID->companyID)->get();
        $customers = array();
        for($i=0;$i<sizeof($pendingCustomers);$i++){
            $customers[$i]= Customer::select('name','email','phoneNumber','address')->where('customerID',$pendingCustomers[$i]->customerID)->first();
        }
        $finalResault = array($pendingCustomers,$customers);
        //return $pendingCustomers;

        return $finalResault;
    }
    //end getPendingCustomers

    //start getMorePendingCustoemrs
     public function getMorePendingCustoemrs(Request $request){
        $customerInfo = Customer::select('name','phoneNumber','email')->where('customerID',$request->customerID)->first();
        if($customerInfo !=null)
        return $customerInfo;
        else{
            return "error";
        }

    }
    //end getMorePendingCustoemrs

    //start getCompanies
    public function getCompanies(){
        $companies = Company::select()->orderBy('rating','desc')->get();
        return $companies;
    }
    //end getCompanies

    //start checkFollower
    public function checkFollower(Request $request){
        $status = CompanyFollower::select()->where('companyID',$request->companyID)
            ->where('customerID',$request->customerID)->first();
        if($status !=null){
            return "follower";
        }
        else{
            return "nonFollower";
        }
    }

    //end checkFollower

    //start getFollowersNum
    public function getFollowersNum(Request $request){
        $company=Company::select("companyID")->where('name',$request->companyID)->first();
        $followers = CompanyFollower::where('companyID',$company->companyID)->count();
        return $followers;
    }
    //end getFollowersNum


    //start getFollowers
    public function getFollowers(Request $request){
        $company=Company::select('companyID')->where('name',$request->companyName)->first();
        $followers = CompanyFollower::select('customerID')->where('companyID',$company->companyID)->get();
        $arr=array(sizeof($followers));
        $customers=array(sizeof($followers));
        for ($i=0;$i<sizeof($followers);$i++){
            $customers[$i]=Customer::select()->where('customerID',$followers[$i]->customerID)->first();
        }
        return $customers;
    }
    //end getFollowers


    //start loadFollowingCompanies
    public function loadFollowingCompanies($customerID){
        $companiesNum = CompanyFollower::where('customerID',$customerID)->count();
        return $companiesNum;
    }
    //end loadFollowingCompanies


    //start reportCustomer
    public function reportCustomer(Request $request){

    $company = Company::select('companyID')->where('name',$request->companyName)->first();
        Report::create(
            [
                'customerID'=>$request->customerID,
                'companyID'=>$company->companyID,
                'reportContent'=>$request->repostContent,
            ]
        );
    return "Report added";
    }
    //end reportCustomer

    //start getCompanyInfo
    public function getCompanyInfo($companyName){
    $company = Company::select()->where('name',$companyName)->first();
    return $company;
    }
    //end getCompanyInfo

    //start editCompanyInfo
    public function editCompanyInfo(Request $request){
        $company = Company::select('email','phoneNumber')->where('name',$request->companyName)->get();
        $newEmail = Company::select('email')->where('email',$request->newEmail)->get();
        $newPhone = Company::select('phoneNumber')->where('phoneNumber',$request->newPhoneNumber)->get();
        $company2 = Company::select('password','address')->where('name',$request->companyName)->first();

        if($company[0]->email != $request->newEmail){

            if ($company[0]->email != $request->newEmail  && sizeof($newEmail) == 0 ){
                DB::table('companys')->where('name',$request->companyName)
                    ->update(['email'=>$request->newEmail]);
            }
            else if($company[0]->email != $request->newEmail  && sizeof($newEmail) > 0 ){
                return "email exist!! try another email";
            }
        }

        if($company2->address != $request->newAddress){
            DB::table('companys')->where('name',$request->companyName)
                ->update(['address'=>$request->newAddress]);
        }

        if($company[0]->phoneNumber != $request->newPhoneNumber){
            if ($company[0]->phoneNumber != $request->newPhoneNumber  && sizeof($newPhone) == 0 ){

                DB::table('companys')->where('name',$request->companyName)
                    ->update(['phoneNumber'=>$request->newPhoneNumber]);
            }
            else if($company[0]->phoneNumber != $request->newPhoneNumber  && sizeof($newPhone) > 0 ){
                return "phone number exist !!! try another phone number";
            }

        }

        if($company2->password != $request->newPassword){
            DB::table('companys')->where('name',$request->companyName)
                ->update(['password'=>$request->newPassword]);
        }

        return "information updated";


        return $request;
    }
    //end editCompanyInfo
}
