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
use Illuminate\Support\Facades\Route;

//use Illuminate\Routing\Route;

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
Route::get('showBestCompanies','company\companyController@showBestCompanies')->name('showBestCompanies');
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
Route::get('profile/{customerID}','customer\CustomerController@getCustomerProfile')->name('CustomerProfile');
//---------------------------------
Route::post('bookingTrip','customer\CustomerController@bookingTrip')->name('bookingTrip');
//---------------------------------
Route::post('loginAccount','customer\CustomerController@login')->name('loginAccount');
//---------------------------------
Route::post('customerCardPayment','customer\CustomerController@customerCardPayment')->name('customerCardPayment');
//---------------------------------
Route::post('followCompany','customer\CustomerController@followCompany')->name('followCompany');
//---------------------------------
Route::post('cancelFollowCompany','customer\CustomerController@cancelFollowCompany')->name('cancelFollowCompany');
//---------------------------------
Route::get('getProfileInfo/{customerID}','customer\CustomerController@getProfileInfo')->name('getProfileInfo');
//---------------------------------
Route::post('editProfile','customer\CustomerController@editProfile')->name('editProfile');
//---------------------------------
Route::get('loadActiveTrips/{customerID}','customer\CustomerController@loadActiveTrips')->name('loadActiveTrips');
//---------------------------------
Route::get('customerSearch/{customerID}/{searchContent}','customer\CustomerController@customerSearch')->name('customerSearch');
//---------------------------------
Route::post('customerSearchHistory','customer\CustomerController@customerSearchHistory')->name('customerSearchHistory');
//---------------------------------
Route::get('showTripsResult/{companyID}','customer\CustomerController@showTripsResult')->name('showTrips');
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
Route::get('getCompanies','company\companyController@getCompanies')->name('getCompanies');
//---------------------------------
Route::post('addTrip','company\companyController@addNewTrip')->name('addTrip');
//---------------------------------
Route::get('getPendingCustomers/{companyName}','company\companyController@getPendingCustomers')->name('getPendingCustomers');
//---------------------------------
Route::post('getMorePendingCustoemrs','company\companyController@getMorePendingCustoemrs')->name('getMorePendingCustoemrs');
//---------------------------------
Route::post('checkFollower','company\companyController@checkFollower')->name('checkFollower');
//---------------------------------
Route::post('getFollowers','company\companyController@getFollowers')->name('getFollowers');
//---------------------------------
Route::post('getFollowersNum','company\companyController@getFollowersNum')->name('getFollowersNum');
//---------------------------------
Route::get('loadFollowingCompanies/{customerID}','company\companyController@loadFollowingCompanies')->name('loadFollowingCompanies');
//---------------------------------
Route::post('reportCustomer','company\companyController@reportCustomer')->name('reportCustomer');


//---------------------------------
//=======end company routes========

//=======start trips routes========
Route::post('showTrips','trips\TripController@showTrips')->name('showTrips');
//---------------------------------
Route::post('editTrip','trips\TripController@editTrip')->name('editTrip');
//---------------------------------
Route::post('deleteTrip','trips\TripController@deleteTrip')->name('deleteTrip');
//---------------------------------
Route::get('getTrips/{customerEmail}','trips\TripController@getTrips')->name('getTrips');
//---------------------------------
Route::post('getTripsNum','trips\TripController@getTripsNum')->name('getTripsNum');
//---------------------------------
Route::get('getActiveTrips/{customerID}','trips\TripController@getActiveTrips')->name('getActiveTrips');

//=======end trips routes========

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//=======start passenger routes======
Route::post('addPendingPassenger','passenger\PassengerController@addPendingPassenger')->name('addPendingPassenger');
//---------------------------------
Route::post('addPassenger','passenger\PassengerController@addPassenger')->name('addPassenger');
//---------------------------------
Route::post('deletedPassenger','passenger\PassengerController@deletePassenger')->name('deletePassenger');
//=======end passenger routes========


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
Route::get('getCustomers','admin\AdminController@getCustomersInfo')->name('getCustomers');
//---------------------------------
Route::get('getCompanies','admin\AdminController@getCompaniesInfo')->name('getCompanies');
//---------------------------------
Route::get('getPendingCompanies','Admin\AdminController@getPendingCompanies')->name('getPendingCompanies');
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
Route::post('blockAccount','admin\AdminController@blockAccount')->name('blockAccount');
//---------------------------------
Route::post('unblockAccount','admin\AdminController@unblockAccount')->name('unblockAccount');
//---------------------------------
Route::post('blockCompany','admin\AdminController@blockCompany')->name('blockCompany');
//---------------------------------
Route::post('unblockCompany','admin\AdminController@unblockCompany')->name('unblockCompany');
//---------------------------------
Route::get('getReports','admin\AdminController@getReports')->name('getReports');
//---------------------------------

//=======end admin routes========
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



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
Route::get('getTime','trips\TripController@getCompletedTrips')->name('getCompletedTrips');
