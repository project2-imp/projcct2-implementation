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
           $message->from('triboite2020@gmail.com','Tripboo Team');
           $message->to($Customeremail)->subject('Input Code below in the verfiction field:');

       });
    }
    //end sendCode

    //start sendBlockMSG
        public function sendBlockMSG($accountEmail , $accountType){
            \Illuminate\Support\Facades\Mail::send(['text'=>view('layouts.customer.blockMSG',compact('accountEmail'))],['tempuser'=>$accountEmail],function($message) use ($accountEmail)
            {
                $message->from('triboite2020@gmail.com','Tripboo Team');
                $message->to($accountEmail)->subject('visit support team for more information');

            });
        return "blocked";
        }
    //end sendBlockMSG


    //start sendBlockMSG
    public function sendUNblockMSG($accountEmail , $accountType){

    }
    //end sendBlockMSG

    //start AcceptAccountMsg
    public function acceptAccountMsg($companyEmail){

        \Illuminate\Support\Facades\Mail::send(['text'=>view('layouts.guest.AcceptCompanyMSG',compact('companyEmail'))],['tempuser'=>$companyEmail],function ($message) use ($companyEmail){
            $message->from('triboite2020@gmail.com','Tripboo Team');
            $message->to($companyEmail)->subject("Accept Email");
        });
    }
    //start AcceptAccountMsg

    //start RejectAccountMsg
    public function rejectAccountMsg($companyEmail){

        \Illuminate\Support\Facades\Mail::send(['text'=>'layouts.guest.rejectCompanyMSG',compact('companyEmail')],['tempuser'=>$companyEmail],function ($message) use ($companyEmail){
            $message->from('triboite2020@gmail.com','Tripboo Team');
            $message->to($companyEmail)->subject("Reject Email");
        });
    }
    //end RejrctAccountMsg
}
