<?php

namespace App\Http\Controllers;

use App\ChargeCommision;
use App\Deposit;
use App\Gateway;
use App\Lib\GoogleAuthenticator;
use App\Menu;
use App\Service;
use App\Silder;
use App\Team;
use App\Testimonal;
use App\General;
use App\User;
use App\WithdrawTrasection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\VerificationEmail;
use App\Mail\ForgetPasswordEmail;
use App\Mail\PasswordChangedEmail;
use App\Mail\ContactFormEmail;

class FontendController extends Controller
{
    public function fontIndex()
    {
     /*   $service = Service::all();
        $slider = Silder::all();
        $commision = ChargeCommision::first();
        $team = Team::all();
        $testimonial = Testimonal::all();
        $gateway = Gateway::all();
        $deposit = Deposit::orderBy('id', 'desc')->where('status', 1)->take(5)->get();
        $withdraw = WithdrawTrasection::orderBy('id', 'desc')->where('status', 1)->take(5)->get();
        return view('fonts.index',compact('service',
            'slider', 'commision', 'team', 'testimonial',
            'gateway', 'deposit', 'withdraw')); */

        $mobile = General::where('id',1)->value('mobile');
        $general = General::where('id',1)->get();

        $btc_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/1/?convert=EUR");
        $btcc_usd_euro = json_decode($btc_usd_euro);
           
        $eth_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/1027/?convert=EUR");
        $ethh_usd_euro = json_decode($eth_usd_euro);

        $xrp_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/52/?convert=EUR");
        $xrpp_usd_euro = json_decode($xrp_usd_euro);

        $litecoin_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/2/?convert=EUR");
        $litecoinn_usd_euro = json_decode($litecoin_usd_euro);

        $iota_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/1720/?convert=EUR");
        $iotaa_usd_euro = json_decode($iota_usd_euro);

        $dash_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/131/?convert=EUR");
        $dashh_usd_euro = json_decode($iota_usd_euro);


        return view('welcome', compact('btcc_usd_euro','ethh_usd_euro','xrpp_usd_euro','litecoinn_usd_euro','iotaa_usd_euro','dashh_usd_euro','mobile','general'));
    }

    public function contactIndex()
    {
        return view('fonts.contact');
    }

    public function menuIndex($id)
    {
        $menu_content = Menu::find($id);
        return view('fonts.menu', compact('menu_content'));
    }

    public function termsIndex()
    {
        return view('fonts.terms');
    }

    public function policyIndex()
    {
        return view('fonts.policy');
    }

    public function sendMessage(Request $request)
    {

         $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

         $general = General::first();
        $headers = "From: $request->name <$request->email>\r\n";
        $headers .= "Reply-To: $request->name <$request->email>\r\n";

         mail($general->email, 'Contact Us Message', $request->message, $headers );

         return redirect()->back()->with('message', 'Message Send Complete');
    }

    public function getRefId(Request $request)
    {
        $id = User::where('username', $request->ref_id)->first();
        if ($id == '')
        {
            return "<span class='help-block'><strong style='color: #f90808'>Referrer Name Not Found</strong></span>";
        }else{
            return "<span class='help-block'><strong style='color: #1ed81e'>Referrer Name Matched</strong></span>
                    <input type='hidden' id='referrer_id' value='$id->id' name='referrer_id'>";
        }
    }

    public function getPosition(Request $request)
    {
        if ($request->referrer_id == ''){
            return "<span class='help-block'><strong style='color: #f90808'>At First Put Your Referrer Name</strong></span>";
        }else{
            $referrer_id = $request->referrer_id;
            $poss = $request->pos;
            $willPosition = getLastChildOfLR($referrer_id,$poss);
            $pos = User::where('id', $willPosition)->first();
            return "<span class='help-block'><strong style='color: #1ed81e'>You Will Join Under - $pos->username </strong></span>";
        }
    }

    public function authorization()
    {
        if(Auth::user()->tfver == '1' && Auth::user()->status == '1' && Auth::user()->emailv == 1 && Auth::user()->smsv == 1)
        {
            return redirect('home');
        }
        else
        {
            return view('auth.notauthor');
        }
    }

    public function sendemailver()
    {
        $user = User::find(Auth::user()->id);
        $chktm = $user->vsent+1000;
        if ($chktm >time())
        {
            $delay = $chktm-time();
            return back()->with('alert', 'Please Try after '.$delay.' Seconds');
        }
        else
        {
            $code = substr(rand(),0,6);
            $message = 'Your Verification code is: '.$code;
        //    $user['vercode'] = $code ;
        //    $user['vsent'] = time();
         //   $user->save();
            User::whereId(Auth::user()->id)
                ->update([
                   'vercode' => $code,
                   'vsent' => time()
                ]);
           
            $objVer = new \stdClass();
            $objVer->code = $code;
            $objVer->first_name = $user->first_name;

        //    send_email($user->email,'Verification Code', $user['first_name'], $message);
            Mail::to($user->email)->send(new VerificationEmail($objVer));

        //    $sms = $message;
         //   send_sms($user['mobile'], $sms);
            return back()->with('success', 'Email verification code sent succesfully');
        }

    }
    public function sendsmsver()
    {
        $user = User::find(Auth::id());
        $chktm = $user->vsent+1000;
        if ($chktm >time())
        {
            $delay = $chktm-time();
            return back()->with('alert', 'Please Try after '.$delay.' Seconds');
        }
        else
        {
            $code = substr(rand(),0,6);
            $sms =  'Your Verification code is: '.$code;
            $user['vercode'] = $code;
            $user['vsent'] = time();
            $user->save();

           send_sms($user->mobile, $sms);
            return back()->with('success', 'SMS verification code sent succesfully');
        }


    }

    public function emailverify(Request $request)
    {

        $this->validate($request, [
            'code' => 'required'
        ]);

        $user = User::find(Auth::user()->id);

        $code = $request->code;
        if ($user->vercode == $code)
        {
          //  $user['emailv'] = 1;
          //  $user['vercode'] = str_random(10);
          //  $user['vsent'] = 0;
           // $user->save();

            User::whereId(Auth::user()->id)
                ->update([
                   'emailv' => 1,
                   'vercode' => str_random(10),
                   'vsent' => 0
                ]);

            return redirect('home')->with('success', 'Email Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function smsverify(Request $request)
    {

        $this->validate($request, [
            'code' => 'required'
        ]);
        $user = User::find(Auth::id());

        $code = $request->code;
        if ($user->vercode == $code)
        {
            $user['smsv'] = 1;
            $user['vercode'] = str_random(10);
            $user['vsent'] = 0;
            $user->save();

            return redirect('home')->with('success', 'SMS Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function verify2fa( Request $request)
    {
        $user = User::find(Auth::id());

        $this->validate($request,
            [
                'code' => 'required',
            ]);
        $ga = new GoogleAuthenticator();

        $secret = $user->secretcode;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {
            $user['tfver'] = 1;
            $user->save();
            return redirect('home');
        } else {

            return back()->with('alert', 'Wrong Verification Code');
        }

    }


    public function forgotPass(Request $request)
    {
        $this->validate($request,[
                'email' => 'required',
            ]);

        $user = User::where('email', $request->email)->first();
        if ($user == null)
        {
            return back()->with('alert', 'Email not Found!');
        }
        else
        {
            $to =$user->email;
            $code = str_random(30);
          //  $message = 'Use This Link to Reset Password: '.url('/').'/reset/'.$code;
            
            $objPass = new \stdClass();
            $objPass->first_name = $user->first_name;
            $objPass->email = $user->email;
            $objPass->code = $code;

            DB::table('password_resets')->insert(
                ['email' => $to, 'token' => $code, 'created_at' => date("Y-m-d h:i:s"), 'status' => 0]
            );

            Mail::to($user->email)->send(new ForgetPasswordEmail($objPass));

        //    send_email($to, $subject, $name, $message);

            return back()->with('message', 'Password Reset Email Sent Succesfully');
        }

    }

    public function resetLink($code)
    {
        $reset = DB::table('password_resets')->where('token', $code)->orderBy('created_at', 'desc')->first();
        if ( $reset->status == 1)
        {
            return redirect()->route('login')->with('alert', 'Invalid Reset Link');
        }else{
            return view('auth.passwords.reset', compact('reset'));
        }

    }

    public function passwordReset(Request $request)
    {
        $this->validate($request,[
                'email' => 'required',
                'token' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required',
        ]);

        $reset = DB::table('password_resets')->where('token', $request->token)->orderBy('created_at', 'desc')->first();

        $user = User::where('email', $reset->email)->first();
        
        if ( $reset->status == 1)
        {
            return redirect()->route('login')->with('alert', 'Invalid Reset Link');
        }
        else
        {
            if($request->password == $request->password_confirmation)
            {
                $user->password = bcrypt($request->password);
                $user->save();

                DB::table('password_resets')->where('email', $user->email)->update(['status' => 1]);

                $objChange = new \stdClass();
                $objChange->first_name = $user->first_name;

            //    $msg =  'Password Changed Successfully';
                Mail::to($user->email)->send(new PasswordChangedEmail($objChange));
            //    send_email($user->email,'Password Changed', $user->username, $msg);
            //    $sms =  'Password Changed Successfully';
           //     send_sms($user->mobile, $sms);

                return redirect()->route('login')->with('success', 'Password Changed');
            }
            else
            {
                return back()->with('alert', 'Password Not Matched');
            }
        }
    }
    public function pageNotFound()
    {
        return view('error.404');
    }

    public function contactUs(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
    
        $uname = $request->input('name');
        $uemail = $request->input('email');
        $uphone = $request->input('phone');
        $usubject = $request->input('subject');
        $umsg = $request->input('message');

        $general = General::where('id',1)->get();

        $objContact = new \stdClass();
        $objContact->name = $uname;
        $objContact->email = $uemail;
        $objContact->phone = $uphone;
        $objContact->subject = $usubject;
        $objContact->message = $umsg;

        Mail::to('contact@vista.network')->send(new ContactFormEmail($objContact));

        return view('client.contact_thanks', compact('general'));
    
    }

    public function alfaCoinCheck()
    {
        return view('ALFAcoins_59a55d76cf07d59a55d76cf0b559a55d76cf0eb.txt');
    }

    public function notificationURL()
    {
        return view('client.finance.notification');
    }

    public function fundsSuccess()
    {
        return view('client.finance.alfa_success');
    }

}
