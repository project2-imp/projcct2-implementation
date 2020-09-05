<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //start increaseCardBalance
    public function increaseCardBalance($companyCard,$cardBalance,$amount){
        DB::table('cards')->where('cardNumber',$companyCard)
            ->update(['balance'=>$cardBalance+$amount]);

    }
    //end increaseCardBalance

    //start decreaseCardBalance
    public function decreaseCardBalance($card,$cardBalance,$amount){
        DB::table('cards')->where('cardNumber',$card)
            ->update(['balance'=>$cardBalance-$amount]);
    }
    //end dcreaseCardBalance


}
