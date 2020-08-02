<?php

namespace App\Http\Controllers\Emails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Mail\sendMail;
use Mail;
//use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    //start sendCode
    /**
     * @param $Customeremail
     * @param $code
     */
    public function SendCode($Customeremail, $code){


       \Illuminate\Support\Facades\Mail::send(['text'=>view('layouts.guest.sendByEmail',compact('code'))],['tempuser'=>$Customeremail],function($message) use ($Customeremail)
       {
           $message->from('ali.monther97@gmail.com','aliMonther');
           $message->to($Customeremail)->subject('Input Code below in the verfiction field:');

       });
    }
    //end sendCode

    //start AcceptAccountMsg
    public function acceptAccountMsg($companyEmail){

        \Illuminate\Support\Facades\Mail::send(['text'=>view('layouts.guest.AcceptCompanyMSG',compact('companyEmail'))],['tempuser'=>$companyEmail],function ($message) use ($companyEmail){
            $message->from('ali.monther97@gmail.com','aliMonther');
            $message->to($companyEmail)->subject("Accept Email");
        });
    }
    //start AcceptAccountMsg

    //start RejectAccountMsg
    public function rejectAccountMsg($companyEmail){

        \Illuminate\Support\Facades\Mail::send(['text'=>'layouts.guest.rejectCompanyMSG',compact('companyEmail')],['tempuser'=>$companyEmail],function ($message) use ($companyEmail){
            $message->from('ali.monther97@gmail.com','aliMonther');
            $message->to($companyEmail)->subject("Reject Email");
        });
    }
    //end RejrctAccountMsg
}
