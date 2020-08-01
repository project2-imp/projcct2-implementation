<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('master', function () {
    $status = array(0);
    return view('layouts.master',compact('status'));
})->name('index');
//---------------------------------
Route::get('/', function () {
    $status = array(0);
    return view('layouts.index',compact('status'));
})->name('index');
//---------------------------------
Route::get('/signUP',function (){
    return view('layouts.guest.signUP');
})->name('signUP');
//---------------------------------
Route::get('sendEmail','Emails\EmailsController@SendCode');
//---------------------------------
Route::get('/login',function (){
    return view('layouts.customer.login');
})->name('login');
//---------------------------------
Route::get('/createCompanyAccount',function (){
    $status = array(0);
    return view('layouts.guest.createCompany',compact('status'));
})->name('createCompanyForm');
//---------------------------------
Route::get('loginCompaanyAccount',function (){
    return view('layouts.company.loginCompany');
})->name('loginCompanyAccount');
//---------------------------------
Route::get('/createCustomerAccount',function (){
    return view('layouts.guest.inputVCode');
})->name('createCustomerAccount');
//---------------------------------
Route::get('adminPanel','admin\AdminController@getInformation')->name('admin');
//---------------------------------
Route::get('companyMaster',function (){
    return view('layouts.company.companyMaster');
});
//---------------------------------
Route::get('profile/{name}',function (){
    return view('layouts.customer.profile');
})->name('CustomerProfile');
//---------------------------------
Route::get('ali',function (){
   return view('layouts.admin.pendingCompanies');
});
//---------------------------------
Route::get('getCustomers','admin\adminController@getCustomersInfo')->name('getCustomers');
//---------------------------------
route::get('getCompanies','admin\AdminController@getCompaniesInfo')->name('getCompanies');
//---------------------------------
route::get('getPendingCompanies','admin\AdminController@getPendingCompanies')->name('getPendingCompanies');
//---------------------------------
Route::post('createCustomerAccount','customer\CustomerController@signUP')->name('createCustomerAccount');
////-------------------------------
Route::post('createCompanyAccount','company\CompanyController@AddPendingCompany')->name('createCompanyAccount');
////-------------------------------
Route::post('/validationCode','customer\CustomerController@validateCode')->name('validationCode');
//---------------------------------
Route::post('loginAccount','customer\CustomerController@login')->name('loginAccount');
//---------------------------------
Route::post('loginCompany','company\companyController@login')->name('loginCompany');
//---------------------------------
Route::post('custoemrsCount','admin\AdminController@getCustomersNum')->name('custoemrsCount');
//---------------------------------
Route::post('companiesCount','admin\AdminController@getCompaniesNum')->name('companiesCount');
//---------------------------------
Route::post('companyInfo','admin\AdminController@getCompanyInfo')->name('companyInfo');
//---------------------------------
Route::post('acceptCompany','admin\AdminController@acceptCompany')->name('acceptCompany');
//---------------------------------
Route::post('rejectCompany','admin\AdminController@rejectCompany')->name('rejectCompany');
//---------------------------------
Route::post('addTrip','company\companyController@addNewTrip')->name('addTrip');
//---------------------------------
Route::get('/testConnection', function () {
    try {
        DB::connection()->getPdo();
        if(DB::connection()->getDatabaseName()){
            echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
            die;
        }else{
            die("Could not find the database. Please check your configuration.");
        }
    } catch (\Exception $e) {
        die($e->GetMessage());
    }
});
//---------------------------------
