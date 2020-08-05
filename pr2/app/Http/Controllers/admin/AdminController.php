<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\EmailsController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\SystemAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class AdminController extends Controller
{
    //

    //start login
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
            $admin = SystemAdmin::select('email')->where('email',$request->input('email'))
                ->where('password',$request->input('password'))->first();
            if($admin != null){
                $adminName = Customer::select('name')->where('email',$request->input('email'))->first();
                $name=array($adminName);
                return view('layouts.admin.controlPanel',compact('name'));
            }
            else{
                $arr = array('errorr email or password');
                return view('layouts.customer.login',compact('arr'));
            }

        }

    }
    //end login

    //start addNewAdmin
    public function addNewAdmin(Request $request){
        $rules=[
            'name'=>'required|max:100',
            'email'=>'required|max:100|unique:systemadmins,email',
            'password'=>'required|max:255'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return "error";
        }
        else{
            $admin = SystemAdmin::create(
                [
                    'adminName'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$request->password,
                ]
            );
            return "success";
        }
    }
    //start getCustomersNum
    public function getCustomersNum(){
        $custoemrsNum = Customer::count('name');

        return $custoemrsNum;
        //return view('layouts.admin.adminMaster',compact('arr'));
    }//end getCustomersNum

    //start getCompaniesNum
    public function getCompaniesNum(){

        $companiesNum = Company::count('name');
        return $companiesNum;
    }//end getCompaniesNum

    //start getInformation
    public function getInformation(){
        //$custoemr = $this->getCustomersNum();
        //$companies = $this->getCompaniesNum();
        //$pendingCompanies = $this->getPendingCompanyNum();
        //$arr = array($custoemr,$companies,$pendingCompanies);
        //$arr1=array(0);
        return view('layouts.admin.adminMaster');//,compact('arr')
    }//end getInformation

    //start getPendingCompanyNum
    public function getPendingCompanyNum(){
        $pendingCompanies = Company::where('status','pending')->count('name');
        return $pendingCompanies;
    }

    //start getPendingCompaniesDetails
    public function getPendingCompanies(){
        $companies = Company::select('name','email')->where('status','pending')->get();
        $arr1 = array($companies);
        return $arr1;
    }
    //end getPendingCompaniesDetails

    //start getCustomersInfo
    public function getCustomersInfo(){

        $customers = Customer::select()->get();
        $arr = array($customers);
        return $arr;
    }
    //end getCustomersInfo

    //start getCompaniesInfo
    public function getCompaniesInfo(){
        $companies = Company::select()->where('status','accepted')->get();
        $arr = array($companies);
        return $arr;
    }
    //end getCompaniesInfo

    //start getCompaniesInfo
    public function getCompanyInfo(Request $request){
        $company = Company::select()->where('name',$request->name)->first();
        $arr = array($company);
        return $arr;
    }
    //end getCompaniesInfo

    //start AcceptCompany()
    public function acceptCompany(Request $request){
        $companyEmail = Company::select('email')->where('name',$request->name)->first();
        $companyInfo = Company::where('name',$request->name)->update(['status'=>'accepted']);
        $eController = new EmailsController();
        $eController->acceptAccountMsg($companyEmail);
        $arr = array('company is accepted');
        return $arr;
    }
    //end AcceptCompany()

    //start rejectCompany()
    public function rejectCompany(Request $request){
        $companyEmail = Company::select('email')->where('name',$request->name)->first();
        $company = Company::where('name',$request->name)->delete();
        $eController = new EmailsController();
        $eController->rejectAccountMsg($companyEmail);
        $message = array('company deleted');
        return $message;
    }
    //end AcceptCompany()


}
