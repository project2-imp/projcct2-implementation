<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class AdminController extends Controller
{
    //
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
        $companyInfo = Company::where('name',$request->name)->update(['status'=>'accepted']);
        $arr = array('company is accepted');
        return $arr;
    }
    //end AcceptCompany()

    //start rejectCompany()
    public function rejectCompany(Request $request){
        $company = Company::where('name',$request->name)->delete();
        $message = array('company deleted');
        return $message;
    }
    //end AcceptCompany()


}
