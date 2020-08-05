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
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//=========start guest routes========
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
Route::get('/createCustomerAccount',function (){
    return view('layouts.guest.inputVCode');
})->name('createCustomerAccount');
//---------------------------------
Route::get('/createCompanyAccount',function (){
    $status = array(0);
    return view('layouts.guest.createCompany',compact('status'));
})->name('createCompanyForm');
//---------------------------------
Route::post('createCustomerAccount','customer\CustomerController@signUP')->name('createCustomerAccount');
//-------------------------------
Route::post('createCompanyAccount','company\CompanyController@AddPendingCompany')->name('createCompanyAccount');
//-------------------------------
Route::post('/validationCode','customer\CustomerController@validateCode')->name('validationCode');
//---------------------------------
//=========end guest routes========

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//=======start customer routes=====

Route::get('/login',function (){
    return view('layouts.customer.login');
})->name('login');
//---------------------------------
Route::get('profile/{name}',function (){
    return view('layouts.customer.profile');
})->name('CustomerProfile');
//---------------------------------
Route::post('loginAccount','customer\CustomerController@login')->name('loginAccount');
//---------------------------------

//=======end customer routes=====

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//=======start company routes=====

Route::get('loginCompaanyAccount',function (){
    return view('layouts.company.loginCompany');
})->name('loginCompanyAccount');
//---------------------------------
Route::get('companyMaster',function (){
    return view('layouts.company.companyMaster');
});
//---------------------------------
Route::post('loginCompany','company\companyController@login')->name('loginCompany');
//---------------------------------
Route::post('addTrip','company\companyController@addNewTrip')->name('addTrip');
//---------------------------------
Route::post('showTrips','trips\TripController@showTrips')->name('showTrips');
//---------------------------------

//=======end company routes========

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//=======start admin routes========

//---------------------------------
Route::get('admin',function (){

    return view('layouts.admin.login');
})->name('admin');
//---------------------------------
Route::post('admin/adminPanel','admin\AdminController@login')->name('admin/adminPanel');
//---------------------------------
Route::get('adminPanel','admin\AdminController@getInformation')->name('admin');
//---------------------------------
Route::get('addAdmin',function (){

    return view('layouts.admin.addAdmin');
})->name('addAdmin');
//---------------------------------
Route::post('addAdmin','admin\AdminController@addNewAdmin')->name('addNewAdmin');
//---------------------------------
Route::get('getCustomers','admin\adminController@getCustomersInfo')->name('getCustomers');
//---------------------------------
route::get('getCompanies','admin\AdminController@getCompaniesInfo')->name('getCompanies');
//---------------------------------
route::get('getPendingCompanies','admin\AdminController@getPendingCompanies')->name('getPendingCompanies');
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

//=======end admin routes========
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
