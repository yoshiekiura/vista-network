<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\RegisterEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function send()
    {
        $objReg = new \stdClass();
    //    $objDemo->demo_one = 'Demo One Value';
    //    $objDemo->demo_two = 'Demo Two Value';
        $objReg->sender = 'Vista Network';
        $objReg->receiver = 'Yasir Naeem';
 
        Mail::to("yasir.sherwani@gmail.com")->send(new RegisterEmail($objReg));
    }

}
