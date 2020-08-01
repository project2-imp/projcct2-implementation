<?php

namespace App\Http\Controllers\Emails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Mail\sendMail;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    //
    public function SendCode($Customeremail,$code){

        $email=$Customeremail;
        $details = [
          'title' => 'E-BOOKING Company',
          'body' => 'please enter verifaction code to complete register'
        ];

        Mail::to($email)->send(new sendMail($details));
    }
}
