<?php

namespace App\Http\Controllers;

use App\ChargeCommision;
use App\Income;
use App\MemberExtra;
use App\Deposit;
use App\Gateway;
use App\Lib\GoogleAuthenticator;
use App\Product;
use App\ProductShipment;
use App\Transaction;
use App\Commission;
use App\HpCommission;
use App\User;
use App\Withdraw;
use App\General;
use App\HpTransaction;
use App\SchedulePayment;
use App\WithdrawTrasection;
use App\Notification;
use App\CoinTransaction;
use App\Coin;
use App\ShippingAddress;
use App\Order;
use App\PaymentFull;
use App\PaymentInstallment;
use App\Mail\PasswordChangedEmail;
use App\Mail\ProductPurchaseEmail;
use App\Mail\ProductPurchaseInstallmentEmail;
use Mail;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }

    public function index()
    {
        $available_alxa_coins = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', 1)
                                            ->sum('number_of_coins');
        $available_vista_coins = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', 2)
                                            ->sum('number_of_coins');

        $alxa_rate = Coin::where('id', 1)->value('rate');
        $vista_rate = Coin::where('id', 2)->value('rate');

        $btc_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/1/?convert=EUR");
        $btcc_usd_euro = json_decode($btc_usd_euro);
      
        $btc_gbp = file_get_contents("https://api.coinmarketcap.com/v2/ticker/1/?convert=GBP");
        $btcc_gbp = json_decode($btc_gbp);
      
        $eth_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/1027/?convert=EUR");
        $ethh_usd_euro = json_decode($eth_usd_euro);

        $eth_gbp = file_get_contents("https://api.coinmarketcap.com/v2/ticker/1027/?convert=GBP");
        $ethh_gbp = json_decode($eth_gbp);

        $xrp_usd_euro = file_get_contents("https://api.coinmarketcap.com/v2/ticker/52/?convert=EUR");
        $xrpp_usd_euro = json_decode($xrp_usd_euro);

        $xrp_gbp = file_get_contents("https://api.coinmarketcap.com/v2/ticker/52/?convert=GBP");
        $xrpp_gbp = json_decode($xrp_gbp); 


        $alexa_trade = CoinTransaction::where('user_id', Auth::user()->id)
                                    ->where('coin_id', 1)
                                    ->orderBy('id','desc')
                                    ->paginate(11);

        $vista_trade = CoinTransaction::where('user_id', Auth::user()->id)
                                    ->where('coin_id', 2)
                                    ->orderBy('id','desc')
                                    ->paginate(11);

        $hashpower = HpTransaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);

        $hp_commission = ChargeCommision::where('id', 1)->value('hp_commission');

        return view('client.index',compact('available_alxa_coins','available_vista_coins','alxa_rate','vista_rate','btcc_usd_euro','btcc_gbp','ethh_usd_euro','ethh_gbp','xrpp_usd_euro','xrpp_gbp','alexa_trade', 'vista_trade', 'hashpower', 'hp_commission'));

    //    return view('client.index',compact('available_alxa_coins','available_vista_coins','alxa_rate','vista_rate','alexa_trade','vista_trade','hashpower'));
    }

    public function getHPTaskProgress()
    {
        $hp_balance = User::where('id', Auth::user()->id)->value('hp_balance');
        return $hp_balance;
    }

    public function binarySummeryindex()
    {
        $cbv = MemberExtra::where('user_id', Auth::user()->id)->first();
        return view('client.marketing.binary_summary', compact('cbv'));
    }

    public function treeIndex()
    {
        
        $referrers_count = User::where('referrer_id', Auth::user()->id)->count();
        $treefor = Auth::user()->username;
        
        return view('client.marketing.my_tree', compact('treefor', 'referrers_count'));
    }

    public function getTreeData()
    {
        $referrers = User::where('referrer_id', Auth::user()->id)->pluck('username');
        $root = Auth::user()->username;
        $sponsors = $referrers->toArray();    
        array_unshift($sponsors, $root);
        
        return $sponsors;
    }

    public function referralIndex()
    {
        $ref = User::where('referrer_id', Auth::user()->id)->paginate(15);
        $total = User::where('referrer_id', Auth::user()->id)->count();
        return view('client.marketing.my_referral', compact('ref','total'));
    }

    public function referraCommsisionlIndex()
    {
       /* $ref_income = Income::where('user_id', Auth::user()->id)
            ->where('type', 'R')
            ->orderBy('id', 'desc')->get(); */
        $ref_commission = Commission::where('referrer_id', Auth::user()->id)
                                    ->orderBy('id', 'desc')->get();
        return view('client.income.referral_commission', compact('ref_commission'));
    }

    public function binaryCommsisionlIndex()
    {
        $b_income = Income::where('user_id', Auth::user()->id)
            ->where('type', 'B')
            ->orderBy('id', 'desc')->get();
        return view('client.income.binary_commission', compact('b_income'));
    }

    public function hpCommsisionlIndex()
    {
        $hp_income = HpCommission::where('user_id', Auth::user()->id)
                                ->orderBy('id', 'desc')->get();
        return view('client.income.hp_commission', compact('hp_income'));
    }

    public function fundIndex()
    {
        $gates = Gateway::where('status', 1)->get();
        return view('client.finance.add_fund', compact('gates'));
    }

    public function withdrawIndex()
    {
        $gates = Withdraw::where('status', 1)->get();
        return view('client.finance.request_withdraw', compact('gates'));
    }

    public function withdrawPreview(Request $request)
    {
        /* $this->validate($request, [
            'gateway' =>'required',
            'amount' => 'required|numeric|min:1'
        ]); */

        $amount = $request->amount;
        $method = Withdraw::find($request->gateway);

        if ($request->amount < Auth::user()->balance && $request->amount > $method->min_amo && $request->amount < $method->max_amo)
        {
            
          //  return view('fonts.finance.withdraw_preview', compact('method', 'amount'));
            $one = $amount + $method->chargefx;
            $two = ($amount * $method->chargepc)/100;
            $charge = $method->chargefx + ( $amount *  $method->chargepc )/100;
            $total_withdraw = $amount - $charge;
            $method_cur = $amount / $method->rate;

            $content = '';
            $content .= '<table cellpadding="5" style="width: 100%">';
            $content .= '<tr>';
            $content .= '<td style="width: 50%;">Payment Gateway</td>';
            $content .= "<th style=\"width: 50%;\">{$method->name}</th>";
            $content .= '</tr>';
            $content .= '<tr>';
            $content .= '<td style="width: 50%;">Requested Amount</td>';
            $content .= "<th style=\"width: 50%;\">USD {$amount}</th>";
            $content .= '</tr>';
            $content .= '<tr class="text-danger">';
            $content .= '<td>Total Charges</td>';
            $content .= "<th>{$charge}</th>";
            $content .= '</tr>';
            $content .= '<tr>';
            $content .= '<td>Total Withdraw Amount</td>';
            $content .= "<th>USD {$total_withdraw}</th>";
            $content .= '</tr>';
            $content .= '<tr>';
            $content .= '<td>Information to Withdraw Money</td>';
            $content .= '<td></td>';
            $content .= '</tr>';
            $content .= '<tr>';
            $content .= "<td colspan='2'>";
            $content .= "<input type=\"hidden\" name=\"amount\" value=\"{$amount}\" ><input type=\"hidden\" name=\"charge\" value=\"{$charge}\"><input type=\"hidden\" name=\"method_name\" value=\"{$method->name}\"><input type=\"hidden\" name=\"processing_time\" value=\"{$method->processing_day}\" ><input type=\"hidden\" name=\"method_cur\" value=\"{$method_cur}\" ><textarea name=\"detail\" placeholder=\"Provide all information\" class=\"form-control\"></textarea>";
            $content .= "</td>";
            $content .= '</tr>';
            $content .= '</table>';

            return response()->json(['success' => $method->id, 'html' => $content]);

        }else{
          //  return redirect()->back()->with('alert', 'There having some problem with you');
            return response()->json(['success' => false]);
        }

    }

    public function transferFundIndex()
    {
        $comission = ChargeCommision::first();
        return view('client.finance.fund_transfer', compact('comission'));
    }

//    public function transacPinIndex()
//    {
//        return view('fonts.finance.trans_pin');
//    }

    public function transacHistory()
    {
        // type = 2 => add fund
        // type = 3 => wthdraw fund
        // type = 8 => transfer fund
        $types = [2, 3, 8];
        $trans = Transaction::where('user_id', Auth::user()->id)
                            ->whereIn('type', $types)
                            ->orderBy('id', 'desc')
                            ->paginate(10);

        return view('client.finance.transaction-history', compact('trans'));
    }

    public function profileIndex()
    {
       return view('client.profile');
    }

    public function shippingIndex()
    {
     
       $ship = ShippingAddress::where('user_id', Auth::user()->id)->get();   
       return view('client.shipping', compact('ship'));
    }

    public function fundDepositPreview($id)
    {
        $gate = Gateway::find($id);

        if(is_null($gate)){
             return back()->with('alert', 'Please Select a Payment Gateway');
        }
        else{
            return view('client.finance.preview', compact('gate'));
        }
    }

    public function getGatewayData($gateway, $amount)
    {

        $gate = Gateway::findOrFail($gateway);

        if ( $amount < $gate->minamo || $amount > $gate->maxamo)
        {
           //  return back()->with('alert', 'Invalid Amount');
            return response()->json( 'invalid_amount' );
         //   return response()->json(['success' => 'invalid_amount', 'id' => $gate->id]);
        }
        else
        {
            if ($gate->id == 3 || $gate->id == 6 || $gate->id == 7 || $gate->id == 8)
                {
                    $all = file_get_contents("https://blockchain.info/ticker");
                    
                    if($all){

                        $res = json_decode($all);
                        $btcrate = $res->USD->last;
                    //    $btcrate = 0.12344;

                        $btcamount = $amount/$btcrate;
                        $btc = round($btcamount, 8);

                        $one = $amount + $gate->chargefx;
                        $two = ($amount * $gate->chargepc)/100;

                        $charge = $gate->chargefx + (( $amount *  $gate->chargepc )/100);
                        $totalbase = $amount+$charge;
                        $totalusd = $totalbase/$gate->rate;
                        $payablebtc = round($totalusd/$btcrate, 8); // user will pay this amount of BTC
                        $payable_amount = $one + $two;

                        $sell['user_id'] = Auth::user()->id;
                        $sell['gateway_id'] = $gate->id;
                        $sell['amount'] = $amount;
                        $sell['status'] = 0;
                        $sell['usd_amount'] = number_format($payable_amount, 2);
                        $sell['bcam'] = $payablebtc;
                        $sell['trx_charge'] = $charge;
                        $sell['trx'] = 'DP'.rand();
                        
                        Deposit::create($sell);

                        Session::put('Track', $sell['trx']);

                     //   return view('client.finance.preview', compact('btc','gate','amount', 'payablebtc'));
                        return response()->json(['status' => 'success', 'data' => $sell]);
                    
                    }else{

                        return response()->json(['status' => 'error', 'msg' => 'Technical Error, Please try later.']);    
                        
                    }
                }
                else
                {
                //    $amount = $request->amount;
                //    $usd = $request->amount;

                    $one = $amount + $gate->chargefx;
                    $two = ($amount * $gate->chargepc)/100;

                    $charge = $gate->chargefx + ( $amount *  $gate->chargepc )/100;
                    $payable_amount = $charge + $amount;

                    $sell['user_id'] = Auth::id();
                    $sell['gateway_id'] = $gate->id;
                    $sell['amount'] = $amount;
                    $sell['status'] = 0;
                    $sell['usd_amount'] = number_format($payable_amount, 2);
                    $sell['trx_charge'] = $charge;
                    $sell['trx'] = 'DP'.rand();

                    Deposit::create($sell);

                    Session::put('Track', $sell['trx']);

                 //   $in_usd = number_format(($one + $two)/$gate->rate, 2);
                 //   $payable_amount = $one + $two;

                //    return view('client.finance.preview', compact('usd','gate','amount'));

                    return response()->json(['status' => 'success', 'data' => $sell]);
        
                }
        }    

    }

    public function storeDeposit(Request $request)
    {
        /* $this->validate($request,[
                'amount' => 'required',
                'gateway' => 'required',
            ]); */

        $gate = Gateway::findOrFail($request->gateway);

        if ( $request->amount < $gate->minamo || $request->amount > $gate->maxamo)
        {
            return back()->with('alert', 'Invalid Amount');
           // return response()->json( 'invalid_amount' );
         //   return response()->json(['success' => 'invalid_amount', 'id' => $gate->id]);
        }
        else
        {

            if(is_null($gate))
            {
                 return back()->with('alert', 'Please Select a Payment Gateway');
               //  return response()->json( 'gateway' );
             //   return response()->json(['success' => 'gateway', 'id' => $gate->id]);
            }
            else
            {

                if ($gate->id == 3 || $gate->id == 6 || $gate->id == 7 || $gate->id == 8)
                {
                    $all = file_get_contents("https://blockchain.info/ticker");
                    $res = json_decode($all);
                    $btcrate = $res->USD->last;
                //    $btcrate = 0.12344;

                    $amount = $request->amount;


                    $btcamount = $request->amount/$btcrate;
                    $btc = round($btcamount, 8);

                    $one = $amount + $gate->chargefx;
                    $two = ($amount * $gate->chargepc)/100;

                    $charge = $gate->chargefx + (( $amount *  $gate->chargepc )/100);
                    $totalbase = $amount+$charge;
                    $totalusd = $totalbase/$gate->rate;
                    $payablebtc = round($totalusd/$btcrate, 8); // user will pay this amount of BTC


                    $sell['user_id'] = Auth::id();
                    $sell['gateway_id'] = $gate->id;
                    $sell['amount'] = $amount;
                    $sell['status'] = 0;
                    $sell['bcam'] = $payablebtc;
                    $sell['trx_charge'] = $charge;
                    $sell['trx'] = 'DP'.rand();
                    
                    Deposit::create($sell);

                    Session::put('Track', $sell['trx']);

                    return view('client.finance.preview', compact('btc','gate','amount', 'payablebtc'));

                //    $payable_amount = $one + $two;
                /*    $content = '';
                    $content .= '<table cellpadding="5" style="width: 100%">';
                    $content .= '<tr>';
                    $content .= '<td style="width: 50%;">Payment Gateway</td>';
                    $content .= "<th style=\"width: 50%;\">{$gate->name}</th>";
                    $content .= '</tr>';
                    $content .= '<tr>';
                    $content .= '<td>Requested Amount</td>';
                    $content .= "<th>{$amount}</th>";
                    $content .= '</tr>';
                    $content .= '<tr class="text-danger">';
                    $content .= '<td>Total Charges</td>';
                    $content .= "<th>{$charge}</th>";
                    $content .= '</tr>';
                    $content .= '<tr>';
                    $content .= '<td>Total Payable Amount</td>';
                    $content .= "<th>{$payable_amount}</th>";
                    $content .= '</tr>'; 
                    $content .= '<tr class="text-warning">';
                    $content .= '<td>In BTC</td>';
                    $content .= "<th>{$payablebtc}<input type=\"hidden\" name=\"Track\" value=\"{$sell['trx']}\"></th>";
                    $content .= '</tr>';
                    $content .= '</table>'; */

                //    return response()->json(['success' => $gate->id, 'html' => $content]);
                
                }
                else
                {
                    $amount = $request->amount;
                    $usd = $request->amount;

                    $one = $amount + $gate->chargefx;
                    $two = ($amount * $gate->chargepc)/100;

                    $charge = $gate->chargefx + ( $amount *  $gate->chargepc )/100;

                    $sell['user_id'] = Auth::id();
                    $sell['gateway_id'] = $gate->id;
                    $sell['amount'] = $amount;
                    $sell['status'] = 0;
                    $sell['usd_amount'] = number_format(($one + $two)/$gate->rate, 2);
                    $sell['trx_charge'] = $charge;
                    $sell['trx'] = 'DP'.rand();

                    Deposit::create($sell);

                    Session::put('Track', $sell['trx']);

                    $in_usd = number_format(($one + $two)/$gate->rate, 2);
                    $payable_amount = $one + $two;

                    return view('client.finance.preview', compact('usd','gate','amount'));

                /*    $content = '';
                    $content .= '<table style="width: 100%" cellpadding="5">';
                    $content .= '<tr>';
                    $content .= '<td style="width: 50%;">Payment Gateway</td>';
                    $content .= "<th style=\"width: 50%;\">{$gate->name}</th>";
                    $content .= '</tr>';
                    $content .= '<tr>';
                    $content .= '<td>Requested Amount</td>';
                    $content .= "<th>{$amount}</th>";
                    $content .= '</tr>';
                    $content .= '<tr class="text-danger">';
                    $content .= '<td>Total Charges</td>';
                    $content .= "<th>{$charge}</th>";
                    $content .= '</tr>';
                    $content .= '<tr>';
                    $content .= '<td>Total Payable Amount</td>';
                    $content .= "<th>{$payable_amount}</th>";
                    $content .= '</tr>'; 
                    $content .= '<tr class="text-warning">';
                    $content .= '<td>In USD</td>';
                    $content .= "<th>{$in_usd}<input type=\"hidden\" name=\"Track\" value=\"{$sell['trx']}\"></th>";
                    $content .= '</tr>';
                    $content .= '</table>'; */

                //    return response()->json(['success' => $gate->id, 'html' => $content]);
        
                }
            }
        }
    }

    public function storeWithdraw(Request $request)
    {
        $this->validate($request,[
                'amount' => 'required',
                'charge' => 'required',
                'method_name' => 'required',
                'processing_time' => 'required',
                'method_cur' => 'required',
            ]);


        $withdraw = WithdrawTrasection::create([
           'amount' => $request->amount,
           'charge' => $request->charge,
           'method_name' => $request->method_name,
           'processing_time' => $request->processing_time,
           'detail' => $request->detail,
           'method_cur' => $request->method_cur,
           'withdraw_id' => 'WD'.rand(),
           'user_id' => Auth::user()->id,
        ]);

        $total =  $request->amount + $request->charge;

        $new_balance = Auth::user()->balance - $total;

        User::whereId(Auth::user()->id)
            ->update([
               'balance' => $new_balance
            ]);

        Transaction::create([
            'user_id' => $withdraw->user_id,
            'trans_id' => rand(),
            'time' => Carbon::now(),
            'description' => 'WITHDRAW'. '#ID'.'-'.$withdraw->withdraw_id,
            'amount' => '-'.$withdraw->amount,
            'new_balance' => $new_balance,
            'type' => 3,
            'charge' => $request->charge,
        ]);

         $general = General::first();
         $user = User::find(Auth::user()->id);

         $message ='Welcome! Your Withdraw request is success, Please wait for processing days.Your Withdraw amount : '.$withdraw->amount.$general->symbol.' 
         our current balance is '.$new_balance.$general->symbol.' .';

           send_email($user['email'], 'Successfully Withdraw' ,$user['first_name'], $message);



     //   return redirect('home')->with('message', 'Withdraw Request Success, Wait for processing day');
          return redirect()->back()->with('message', 'Withdraw Request Success, Wait for processing day');
    }

    public function confirmUserAjax(Request $request)
    {
        if (Auth::user()->username == $request->name)
        {
              $result = array(
                    'status' => 'warning',
                    'msg' => 'This is your own Username'
              );  
              return $result;
         //   return "<span class='btn btn-warning btn-block'><i class='la la-warning'></i> Your Username</span>";
        }else{
            $user_name = User::where('username', $request->name)->first();

            if ($user_name == '')
            {
                
                $result = array(
                    'status' => 'danger',
                    'msg' => 'Username Not Found!'
                );

                return $result;
              //  return "<span class='btn btn-danger btn-block'><i class='la la-close'></i> Username not found</span>";
            }
            else{

                $result = array(
                    'status' => 'success',
                    'msg' => 'Username Found!',
                    'transferer_id' => "<i class='la la-check text-success'></i> Username Found!<input type='hidden' name='username' value='{$user_name->id}'>",
                ); 

                return $result;
             //   return "<span class='btn btn-success btn-block'><i class='la la-check'></i> Username Found</span>
                  //          <input type='hidden' name='username' value='$user_name->id' >";
            }

        }

    }

    public function transferFund(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required|numeric|min:1',
            'username' => 'required',
        ]);

        dd($request->all());

        if(Auth::user()->balance < $request->amount)
        {
            return redirect()->back()->with('alert','Insufficient Balance');
        }else{
            $comission = ChargeCommision::first();
            $charge = ($request->amount * $comission->transfer_charge)/100;

            $total = $charge+$request->amount;

            $user = User::findOrFail($request->username);
            $user->balance = $user->balance + $request->amount;
            $user->update();

            $transferer = User::findOrFail(Auth::user()->id);
            $transferer->balance = $transferer->balance - $total;
            $transferer->update();

            Transaction::create([
                'user_id' => Auth::user()->id,
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'BALANCE TRANSFER'. '#ID'.'-'.'BT'.rand(),
                'amount' => $request->amount,
                'new_balance' => $transferer->balance,
                'type' => 8,
                'charge' => $charge,
            ]);

            $general = General::first();

            $message ='Thank you! Your balance transfer process is complete.Your transfer amount : '.$request->amount.$general->symbol.' .Your transfer charge : '.$charge.$general->symbol.'
            Your current balance is '.$transferer->balance.'';

            send_email($transferer->email, 'Balance Transfer Complete' ,$transferer->first_name, $message);



            $message ='Congratulation! Your balance add process is complete.
        '.$transferer->first_name.' '.$transferer->last_name.' transfer '.$request->amount.$general->symbol.' to your fund.</p>';

            send_email($user['email'], 'Balance Add Complete' ,$user['first_name'], $message);

            return redirect()->back()->with('message', 'Amount Transfer Success');
        }
        
    }

    public function getChargeAjax(Request $request)
    {
        $comission = ChargeCommision::first();
        $general = General::first();
        $charge = ($request->inputAmount * $comission->transfer_charge)/100;
        $total = $charge+$request->inputAmount;

        $amount = floatval($request->inputAmount);
        if ($amount == '' || $amount <= 0)
        {
            return "<span style='color: red'>Invalid Amount</span>";
        }else{
            return "<span style='color: red'>With $comission->transfer_charge % Charge, Your Total cost amount is $total $general->symbol</span>";
        }

    }

    public function pinChange(Request $request)
    {
        $this->validate($request, [
            'passwordold' =>'required',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);

        $id = Auth::user()->id;

           if ($request->password == $request->password_confirmation)
           {
               $c_pin = User::find($id);
               if($request->passwordold == $c_pin->trans_pin)
               {
                   User::whereId($id)
                       ->update([
                           'trans_pin' => $request->password
                       ]);
                   return redirect()->back()->with('message','PIN Changes Successfully.');
               }else
                   {
                   session()->flash('alert', 'PIN Not Match');
                   return redirect()->back();
               }
           }else{
               return redirect()->back()->with('alert','Confirm Password Not Matched');
           }

    }

    public function resetPin(Request $request)
    {
        $this->validate($request,[
            'pranto' =>'required'
        ]);

        $pin = substr(time(), 4);
       
        if ($request->pranto == "RESETPIN") 
        {
            $user = User::findOrFail(Auth::user()->id);
            $user->trans_pin = $pin;
            $user->save();

             $message = 'And your new PIN is '.$pin .'';
             $message .='<p style="color:red;">Remember, never share this PIN with anyone.</p>';
               
            send_email($user['email'], 'Reset Transaction PIN' ,$user['first_name'], $message);

            return redirect()->back()->with('message', 'RESETPIN request success, please check your mail.');
        }

        return redirect()->back()->with('alert', 'Opps, type "RESETPIN".And Try again please.');

    }

    public function updateProfile(Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'month' => 'required',
            'day' => 'required',
            'year' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'country' => 'required',
            'image' => 'mimes:png,jpg,jpeg,svg,gif'
        ]);

        User::whereId(Auth::user()->id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'email' => $request->email,
                'birth_day' => $request->year.'-'.$request->month.'-'.$request->day,
            ]);

        $user = User::find(Auth::user()->id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = 'assets/images/user_profile_pic/'. $filename;
            Image::make($image)->save($location);
            $user->image =  $filename;
            $user->save();
        }
        return redirect('profile')->with('message', 'Profile Successfully Updated ');
    }

    public function updateShipping(Request $request)
    {

        $this->validate($request,[
            'fname' => 'required',
            'lname' => 'required',
            'country' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'post_code' => 'required'
        ]); 

        ShippingAddress::find($request->ship_id)
            ->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'company' => $request->company,
                'country' => $request->country,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'post_code' => $request->post_code
            ]);

        return redirect('shipping')->with('message', 'Shipping Address Successfully Updated ');
    }

    public function securityIndex()
    {
        return view('client.password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'passwordold' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);

        try {
            $c_password = User::find($request->id)->password;
            $c_id = User::find($request->id)->id;
            $user = User::findOrFail($c_id);

            if(Hash::check($request->passwordold, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                $objChange = new \stdClass();
                $objChange->first_name = $user->first_name;

                Mail::to($user->email)->send(new PasswordChangedEmail($objChange));

                return redirect()->back()->with('message','Password Change Successfully.');
            }else{
                session()->flash('alert', 'Password Not Match');
                Session::flash('type', 'warning');
                return redirect()->back();
            }
        }catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }

    public function twoFactorIndex()
    {
        $gnl = General::first();
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl(Auth::user()->username.'@'.$gnl->web_title, $secret);
        $prevcode = Auth::user()->secretcode;
        $prevqr = $ga->getQRCodeGoogleUrl(Auth::user()->username.'@'.$gnl->web_title, $prevcode);

        return view('client.goauth.create', compact('secret','qrCodeUrl','prevcode','prevqr'));
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request,[
                'code' => 'required',
            ]);

        $user = User::find(Auth::id());
        $ga = new GoogleAuthenticator();

        $secret = $user->secretcode;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode)
        {
            $user = User::find(Auth::id());
            $user['tauth'] = 0;
            $user['tfver'] = 1;
            $user['secretcode'] = '0';
            $user->save();

           $message =  'Google Two Factor Authentication Disabled Successfully';
           send_email($user['email'], 'Google 2FA' ,$user['first_name'], $message);



           $sms =  'Google Two Factor Authentication Disabled Successfully';
           send_sms($user->mobile, $sms);

            return back()->with('message', 'Two Factor Authenticator Disable Successfully');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function create2fa(Request $request)
    {
        $user = User::find(Auth::id());
        $this->validate($request,[
                'key' => 'required',
                'code' => 'required',
            ]);

        $ga = new GoogleAuthenticator();

        $secret = $request->key;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;
        if ($oneCode == $userCode)
        {
            $user['secretcode'] = $request->key;
            $user['tauth'] = 1;
            $user['tfver'] = 1;
            $user->save();

         $message ='Google Two Factor Authentication Enabled Successfully';
        send_email($user['email'], 'Google 2FA' ,$user['first_name'], $message);


           $sms =  'Google Two Factor Authentication Enabled Successfully';
           send_sms($user->mobile, $sms);

            return back()->with('message', 'Google Authenticator Enabeled Successfully');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }
    public function searchTreeIndex(Request $request)
    {
        $data = User::where('username', $request->username)->first();
        if ($data != '' && $data->username != Auth::user()->username){
            if(isset($_GET['username'])) {
                $treefor = $_GET['username'];
            }else{
                $treefor = $request->username;
            }
            $count = \App\User::where('id', Auth::user()->id)->count();
            if($count == 0){
                return redirect('/tree')->with('alert', 'Opps, No user found');
            }
            $midd = \App\User::where('username', $treefor)->first();
            $uid = Auth::user()->id;
            if(treeeee($midd->id,$uid)==0 && $midd->id!=$uid){
                return redirect('/tree')->with('alert', 'You have no permission to view this Tree');
            }
            return view('fonts.marketing.my_tree', compact('treefor'));
        }else{
            return redirect()->back()->with('alert', 'Opps, No user found');
        }

    }

    public function updatePremium()
    {
       $comission = ChargeCommision::first();
        $user = User::find(Auth::id());
        $ref_id = $user->referrer_id;
        $ref_user = User::find($ref_id);
        $new = $ref_user['balance']  = $ref_user['balance'] + $comission->update_commision_sponsor;
        $ref_user->save();

        Transaction::create([
            'user_id' => $ref_user->id,
            'trans_id' => rand(),
            'time' => Carbon::now(),
            'description' => 'REFERRAL COMMISSION'. '#ID'.'-'.'REF'.rand(),
            'amount' => $comission->update_commision_sponsor,
            'new_balance' => $new,
            'type' => 1,
            'charge' => 0,
        ]);

        Income::create([
            'user_id' => $ref_user->id,
            'amount' => $comission->update_commision_sponsor,
            'description' => 'Deposit Commision From'.' ' . $user->username,
            'type' => 'R'
        ]);

        $new_balance = $user['balance'] =  $user['balance'] - $comission['update_charge'];
        $user['paid_status'] = 1;
        $user->save();

        // Taka to sponsor
        updatePaid($user->id);
        // UPDATE BV
        updateDepositBV($user->id,'1');
        Transaction::create([
            'user_id' => $user->id,
            'trans_id' => rand(),
            'time' => Carbon::now(),
            'description' => 'UPGRADE TO PREMIUM'. '#ID'.'-'.'UPDATE'.rand(),
            'amount' => '-'.$comission['update_charge'],
            'new_balance' => $new_balance,
            'type' => 2,
            'charge' => 0,
        ]);

        return redirect()->back()->with('message','Congratulations, You are successfully upgrade your account' );
    }

    public function shoopingIndex()
    {
        $product = Product::orderBy('id', 'desc')->paginate(12);
        return view('client.shopping.index', compact('product'));
    }

    public function shoopingView($id)
    {
        $product = Product::findOrFail($id);
        $shipping = DB::table('shipping_addresses')->where('user_id', Auth::user()->id)->get();
        return view('client.shopping.view', compact('product','shipping'));
    }

    public function buyProduct(Request $request)
    {

        $g = General::first();
        $p = Product::findOrFail($request->product);
        
        if($request->payment_type == 'pay_full'){
            $prodQty = $request->product_quantity;
            $total = $request->product_quantity * $p->price;
        }else{
            $prodQty = 1;
            $total = $prodQty * $request->advance;
        }        
        
        if (Auth::user()->balance > $total){

            $user = User::findOrFail(Auth::user()->id);

            $new_balance = $user->balance - $total;
    
            $order = Order::create([
                        'order_id' => 'PR'.rand(),
                        'user_id' => $user->id,
                        'payment_type' => $request->payment_type,
                        'product_id' => $request->product,
                        'product_price' => $p->price,
                        'qty' => $prodQty,
                        'total' => $total,
                    ]);

            User::whereId(Auth::user()->id)
                    ->update([
                        'balance' => $new_balance
                    ]);

            Transaction::create([
                'user_id' => $user->id,
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'PRODUCT BUY'. '#ID'.'-'.$order->order_id,
                'amount' => '-'.$total,
                'new_balance' => $new_balance,
                'type' => 1,
            ]); 

            
            if($request->payment_type == 'pay_full'){

                // recursively calling function for referral commission
                referralCommission($user->referrer_id, $user->id, $order->order_id);

                PaymentFull::create([
                    'order_id' => $order->order_id,
                    'total' => $total,
                ]);

                ProductShipment::create([
                    'order_id' => $order->order_id,
                    'user_id' => $user->id,
                    'product_id' => $p->id,
                    'status' => 0,
                    'mobile' => $request->mobile,
                    'street_address' => $request->street_address,
                    'city' => $request->city,
                    'country' => $request->country,
                    'post_code' => $request->post_code,
                ]); 

                $order_id = $order->order_id;

                $objProduct = new \stdClass();
                $objProduct->first_name = $user->first_name;
                $objProduct->order_id = $order->order_id;
                $objProduct->product_title = $p->title;
                $objProduct->product_price = $p->price;
                $objProduct->balance = $new_balance;

                Mail::to($user->email)->send(new ProductPurchaseEmail($objProduct));

                return view('client.shopping.thanks', compact('order_id'));
            //    return redirect()->route('shopping.user.index')->with('message', 'Paid Complete, Wait for Delivery');
            //    return response()->json( 'full' );

            }else{

                $current_date = Carbon::now();
                $startDate = new Carbon('first day of next month');
                $time = strtotime($startDate);
                $payment_no = 1;

                PaymentInstallment::create([
                    'order_id' => $order->order_id,
                    'product_id' => $p->id,
                    'product_name' => $p->title,
                    'product_price' => $p->price,
                    'duration' => $request->duration,
                    'advance_payment' => $request->advance,
                    'installment' => $request->installment,
                    'status' => 0,
                ]);

                for($i=1; $i<=$request->duration; $i++){

                    $date = date('Y-m-d', $time);

                    SchedulePayment::create([
                        'order_id' => $order->order_id,
                        'payment_amount' => $request->installment,
                        'due_date' => $date,
                        'payment_no' => $payment_no,
                        'status' => 0,
                    ]);

                    $payment_no++;
                    $time = strtotime('+1 month', $time);

                }

                $order_id = $order->order_id;

                $objProduct = new \stdClass();
                $objProduct->first_name = $user->first_name;
                $objProduct->order_id = $order->order_id;
                $objProduct->product_title = $p->title;
                $objProduct->product_price = $p->price;
                $objProduct->installment = $request->installment;
                $objProduct->duration = $request->duration;
                $objProduct->payment_no = $payment_no;

                Mail::to($user->email)->send(new ProductPurchaseInstallmentEmail($objProduct));
              
                return view('client.shopping.thanks', compact('order_id'));  
            //    return redirect()->route('shopping.user.index')->with('message', 'Paid Complete');
            //    return response()->json( 'installment' );

            } 

            
        }else{
           // return redirect('shopping')->with('alert', 'You do not have enough balance to purchase this product.');
              return response()->json( 'balance' );
        }
    }

    public function shoppingHistory()
    {
     
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);  
        return view('client.shopping.shopping-history', compact('orders'));
    }


    public function wallet()
    {
        $alxa_rate = Coin::where('id', 1)->value('rate');
        $vista_rate = Coin::where('id', 2)->value('rate');

        $available_alxa_coins = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', 1)
                                            ->sum('number_of_coins');
        $available_vista_coins = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', 2)
                                            ->sum('number_of_coins');

        $hp_comm = ChargeCommision::where('id', 1)->value('hp_commission');

        return view('client.finance.wallet', compact('alxa_rate', 'vista_rate', 'available_alxa_coins', 'available_vista_coins', 'hp_comm'));
    
    }

    public function viewNotifications()
    {
        Notification::where('user_id', Auth::user()->id)
                    ->update([
                       'status' => 1
                    ]);

        $notification = Notification::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);

        return view('client.notification.view_notification', compact('notification'));
    }

}

