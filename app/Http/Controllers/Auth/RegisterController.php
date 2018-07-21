<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\ChargeCommision;
use App\Income;
use App\MemberExtra;
use App\User;
use App\General;
use App\ShippingAddress;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'referrer_id' => 'required',
            'position' => 'required',
            'first_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/'],
            'last_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/'],
            'username' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        $pin = substr(time(), 4);

        $ref_id = $data['referrer_id'];
        $poss = $data['position'];
        $posid =  getLastChildOfLR($ref_id,$poss);

        // $general = General::first();

         $message = '<tr>';
         $message .='<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">';
         $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;color:green;">Our warmest congratulations on your new account opening! This only shows that you have grown your business well. I pray for your prosperous.</p>';
                       
         $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You have taken this path knowing that you can do it. Good luck with your new business. I wish you all the success and fulfillment towards your goal.</p>';
         $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your username is '.$data['username'].' .</p>';

         $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your password is '.$data['password'].' .</p>';

          $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color:red;">Remember, never share your password with otherone. And you are agree with our Terms and Policy.</p>';
          $message .='</td>';
          $message .='</tr>';

        send_email($data['email'], 'Account Created Successfully', $data['first_name'], $message);

        $sms =  'Congratulation, for registration. Your username is '.$data['username'].'. Your password is '.$data['password'].'';
     //   send_sms($data['mobile'], $sms);

        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'referrer_id' => $data['referrer_id'],
            'position' => $data['position'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'join_date' => Carbon::today(),
            'balance' => 0,
            'hp_balance' => 0,
            'coin_balance' => 0,
            'status' => 1,
            'paid_status' => 0,
            'ver_status' => 0,
            'ver_code' => $pin,
            'forget_code' => 0,
            'posid' => $posid,
            'tauth' => 0,
            'tfver' => 1,
            'emailv' => 0,
            'smsv' => 1,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        MemberExtra::create([
           'user_id' => $user['id'],
           'left_paid' => 0,
           'right_paid' => 0,
           'left_free' => 0,
           'right_free' => 0,
           'left_bv' => 0,
           'right_bv' => 0,
        ]);
       ShippingAddress::create([
            'user_id' => $user['id'],
            'fname' => $user['first_name'],
            'lname' => $user['last_name'],
        ]);
        updateMemberBelow($user['id'], 'FREE');
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
