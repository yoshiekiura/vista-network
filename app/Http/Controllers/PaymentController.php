<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Gateway;
use App\Lib\coinPayments;
use CoinGate\CoinGate;
use App\Lib\BlockIo;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;
use App\General;
use App\Mail\DepositFundEmail;
use Illuminate\Support\Facades\View;
use Mail;
use App\Http\Requests\FundsDepositStripe;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }

    public function gatewayDataPay(Request $request)
    {

        $this->validate($request,
            [
                'amount' => 'required|numeric',
                'payment_charges' => 'required|numeric',
                'payable_total_amount' => 'required|numeric',

            ]);

        $gateway_id = $request->input('gateway');
        $payable_total_amount = $request->input('payable_total_amount');

        $gateway_min_amo = Gateway::where('id', $gateway_id)->value('minamo');
        $gateway_max_amo = Gateway::where('id', $gateway_id)->value('maxamo');


        if($payable_total_amount < $gateway_min_amo || $payable_total_amount > $gateway_max_amo){

            return redirect()->back()->with('alert', 'Requested amount should meet payment gateway minimum or maximum limit.');

        }else{

            $trx = $request->input('trx_preview');

            $data = Deposit::where('trx', $trx)->orderBy('id', 'DESC')->first();
            
            if($data->status != 0)
            {
                return redirect()->back()->with('alert', 'An Error Occurd!');
              //  return response()->json( 'error' );

            }

            $gatewayData = Gateway::where('id', $data->gateway_id)->first();

            if ($data->gateway_id==1)
            {
                $amount = $data->usd_amount;

                $paypal['amount'] = $amount;
                $paypal['sendto'] = $gatewayData->val1;
                $paypal['track'] = $trx;

              //  return response()->json( 'paypal_success' );
                return view('client.payment.paypal', compact('paypal'));

            }

            elseif ($data->gateway_id==2)
            {
                $amount = $data->amount;

                $perfect['amount'] = $amount;
                $perfect['value1'] = $gatewayData->val1;
                $perfect['value2'] = $gatewayData->val2;
                $perfect['track'] = $trx;

                return view('client.payment.perfect', compact('perfect'));
            
            }
            elseif ($data->gateway_id==3)
            { 

                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcrate = $res->USD->last;

                $amount = intval($data->bcam);
                $usd = $amount;
                $btcamount = $usd/$btcrate;
                $btc = round($btcamount, 8);

                $DepositData = Deposit::where('trx',$trx)->orderBy('id', 'DESC')->first();

                if($DepositData->bcam == 0){
                    $blockchain_root = "https://blockchain.info/";
                    $blockchain_receive_root = "https://api.blockchain.info/";
                    $mysite_root = url('/');
                    $secret = "ABIR";
                    $my_xpub = $gatewayData->val2;
                    $my_api_key = $gatewayData->val1;

                    $invoice_id = $trx;
                    $callback_url = $mysite_root . "/ipnbtc?invoice_id=" . $invoice_id . "&secret=" . $secret;


                    $resp = @file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . "&callback=" . urlencode($callback_url) . "&xpub=" . $my_xpub);

                    if (!$resp) {

    //BITCOIN API HAVING ISSUE. PLEASE TRY LATER
                    //    return redirect()->route('home')->with('alert', 'BLOCKCHAIN API HAVING ISSUE. PLEASE TRY LATER');
              //         return response()->json( 'blockchain_issue' );
                        return redirect()->back()->with('alert', 'BLOCKCHAIN API HAVING ISSUE. PLEASE TRY LATER');
                        exit;
                    }

                    $response = json_decode($resp);
                    $sendto = $response->address;

    // $sendto = "1HoPiJqnHoqwM8NthJu86hhADR5oWN8qG7";

                    $data['bcid'] = $sendto;
                    $data['bcam'] = $btc;
                    $data->save();

                }
                $DepositData = Deposit::where('trx',$trx)->orderBy('id', 'DESC')->first();
    /////UPDATE THE SEND TO ID

                $bitcoin['amount'] = $DepositData->bcam;
                $bitcoin['sendto'] = $DepositData->bcid;

                $var = "bitcoin:$DepositData->bcid?amount=$DepositData->bcam";
                $bitcoin['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";

                return view('client.payment.bitcoin', compact('bitcoin'));
            }
            elseif($data->gateway_id == 4)
            {
              //  return view('client.payment.stripe', compact('trx'));
                return redirect()->route('stripe.index', ['trx' => $trx]);
            }
            elseif($data->gateway_id == 5)
            {
                $ipn = route('ipn.skrill');
                $img = asset('assets/images/logo/fsdf.png');

                $gateway = Gateway::find(5);
                $gnl = General::first();
                $amount = intval($data->amount);
                $usd = $amount;

                $sdata['send_pay_request'] =  '<form action="https://www.moneybookers.com/app/payment.pl" method="post" id="pament_form">

                   <input name="pay_to_email" value="'.$gateway->val1.'" type="hidden">

                   <input name="transaction_id" value="'.$data->trx.'" type="hidden">

                   <input name="return_url" value="'.route('home').'" type="hidden">

                   <input name="return_url_text" value="Return '.$gnl->title.'" type="hidden">

                   <input name="cancel_url" value="'.route('home').'" type="hidden">

                   <input name="status_url" value="'.$ipn.'" type="hidden">

                   <input name="language" value="EN" type="hidden">

                   <input name="amount" value="'.$usd.'" type="hidden">

                   <input name="currency" value="USD" type="hidden">

                   <input name="detail1_description" value="'.$gnl->title.'" type="hidden">

                   <input name="detail1_text" value="Add Fund To '.$gnl->title.'" type="hidden">

                   <input name="logo_url" value="'.$img.'" type="hidden">

               </form>';

                return view('client.payment.skrill',$sdata);
            }
            elseif($data->gateway_id == 6)
            {
                $this->coingatePayment($trx);
             //   return redirect()->route('coinGate', ['id' => $trx]);
            }
    //Manual Payments
            elseif($data->gateway_id == 7)
            {
                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcRate = $res->USD->last;
                $amon = $data->amount;
                $amount = $data->amount;
                $bcoin = round($amount/$btcRate,8);
                $method = Gateway::find(7);

    // You need to set a callback URL if you want the IPN to work
                $callbackUrl = route('ipn.coinPay');

    // Create an instance of the class
                $CP = new coinPayments();

    // Set the merchant ID and secret key (can be found in account settings on CoinPayments.net)
                $CP->setMerchantId($method->val1);
                $CP->setSecretKey($method->val2);

    // Create a payment button with item name, currency, cost, custom variable, and the callback URL

                $ntrc = $data->trx;

                $form = $CP->createPayment('Purchase Coin', 'btc',  $bcoin, $ntrc, $callbackUrl);

                return view('client.payment.coinpay', compact('bcoin','amon','form'));
            }
            elseif($data->gateway_id ==8)
            {
                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcRate = $res->USD->last;
                $amon = $data->usd_amount;
                $amount = $data->usd_amount;
                $bcoin = round($amount/$btcRate,8);
                $method = Gateway::find(8);

                $DepositData = Deposit::where('trx',$trx)->orderBy('id', 'DESC')->first();

                if($DepositData->bcam == 0){

                    $apiKey = $method->val1;
                    $version = 2; // API version
                    $pin =  $method->val2;
                    $block_io = new BlockIo($apiKey, $pin, $version);
                    $ad = $block_io->get_new_address();


                    if ($ad->status == 'success')
                    {
                        $data = $ad->data;
                        $sendadd = $data->address;

                        $DepositData['bcid'] = $sendadd;
                        $DepositData['bcam'] = $bcoin;
                        $DepositData->save();
                    }
                    else
                    {
                     //   return response()->json( 'blockio_error' );
                      //  return back()->with('alert', 'Failed to Process');
                        return redirect()->back()->with('alert', 'Failed to Process');
                    }
                }

                $DepositData = Deposit::where('trx',$trx)->orderBy('id', 'DESC')->first();

                $sendadd = $DepositData->bcid;
                $bcoin = $DepositData->bcam;


                $varb = "bitcoin:".$DepositData->bcid ."?amount=".$DepositData->bcam;
                $qrurl =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8\" title='' style='width:300px;' />";

                return view('client.payment.blockio', compact('bcoin','amon','sendadd','qrurl'));
            }
            elseif($data->gateway_id == 9){

                $secret_key = $gatewayData->val1;
                $password = $gatewayData->val2; 
                $password = md5($password);
                $password = strtoupper($password);
            //    $password = '035EEAEEA95899CD8FAE20BB06F98513';
                $gateway_name = $gatewayData->name;

                $DepositData = Deposit::where('trx', $trx)->orderBy('id', 'DESC')->first();
                $user_first_name = User::where('id', $DepositData->user_id)->value('first_name');
                $user_last_name = User::where('id', $DepositData->user_id)->value('last_name');
                $payerEmail = User::where('id', $DepositData->user_id)->value('email');
                $bcam_amount = $DepositData->bcam;
                $usd_amount = $DepositData->usd_amount;
                $dt = $DepositData->created_at;
                $date = $dt->toFormattedDateString();

                $payerName = $user_first_name . "&nbsp;" . $user_last_name;

                $final = [
                    'name' => 'Vista.Network',
                    'secret_key' => $secret_key,
                    'password' => $password,
                    'type' => 'bitcoin',
                    'amount' => $usd_amount,
                    'order_id' => $trx,
                    'currency' => 'USD',
                    'description' => 'Funds deposits at Vista Network'
                ];

                $final_json = json_encode($final);
        
                $url = 'https://www.alfacoins.com/api/create';
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',                                   
                    'Content-Length: ' . strlen($final_json))                              
                );      
                curl_setopt($ch, CURLOPT_POST, true);
             //   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                 
                curl_setopt($ch, CURLOPT_POSTFIELDS, $final_json);                        
                                                                                            
                $result = curl_exec($ch);
                
                $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if($status != 200){

                    return redirect()->back()->with('alert', 'Call to URL {$url} failed with status {$status}, response {$result}, curl_error ' . curl_error($ch) . ', curl_errno ' . curl_errno($ch));

                }else {

                    $result_final = json_decode($result);
                    return view('client.payment.alfacoin', compact('result_final','payerName','payerEmail','trx'));
        
                }

            }
        }    
    }

    public function ipnpaypal()
    {

        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval)
        {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }


        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc'))
        {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value)
        {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }


// $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        $paypalURL = "https://secure.paypal.com/cgi-bin/webscr";
        $ch = curl_init($paypalURL);
        if ($ch == FALSE)
        {
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
        $res = curl_exec($ch);
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));

        if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0)
        {


            $receiver_email  = $_POST['receiver_email'];
            $mc_currency  = $_POST['mc_currency'];
            $mc_gross  = $_POST['mc_gross'];
            $track = $_POST['custom'];

            $DepositData = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();
            $gatewayData = Gateway::find(1);
            $dt = $DepositData->created_at;
            $created_format = $dt->toFormattedDateString();

            $amount = $DepositData->usd_amount;
            $bdt_amount = $DepositData->amount;

            if($receiver_email==$gatewayData->val1 && $mc_currency=="USD" && $mc_gross ==$amount && $DepositData->status=='0')
            {

                $user = User::find($DepositData['user_id']);
                $new_balance = $user['balance'] = $user['balance'] + $DepositData->$bdt_amount;

                Transaction::create([
                    'user_id' => $DepositData['user_id'],
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                    'amount' => $DepositData['amount'],
                    'new_balance' => $new_balance,
                    'type' => 2,
                ]);

                $user->save();

                $DepositData['status'] = 1;
                $DepositData->save();

                $general = General::first();

                $objDeposit = new \stdClass();
                $objDeposit->first_name = $user['first_name'];
                $objDeposit->amount = $DepositData['amount'];
                $objDeposit->trans_id = $track;
                $objDeposit->date = $created_format; 
                $objDeposit->gateway = 'Paypal';

                Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));

        
        /* $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);
                $sms = $message;
                send_sms($user['mobile'], $sms); */

            //    return redirect()->route('home')->withMsg('Added Successfully!');
                return redirect()->back()->with('success', 'Funds deposit successfully!');

            }
        }

    }

    public function ipnperfect()
    {

        $gatewayData = Gateway::find(2);

        $passphrase=strtoupper(md5($gatewayData->val2));


        define('ALTERNATE_PHRASE_HASH',  $passphrase);
        define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
        $string=
            $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
            $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
            $_POST['PAYMENT_BATCH_NUM'].':'.
            $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
            $_POST['TIMESTAMPGMT'];

        $hash=strtoupper(md5($string));
        $hash2 = $_POST['V2_HASH'];

        if($hash==$hash2){

            $amo = $_POST['PAYMENT_AMOUNT'];
            $unit = $_POST['PAYMENT_UNITS'];
            $track = $_POST['PAYMENT_ID'];

            $DepositData = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();
            $dt = $DepositData->created_at;
            $created_format = $dt->toFormattedDateString();

            $amount = $DepositData->usd_amount;
            $bdt_amount = $DepositData->amount;

            if($_POST['PAYEE_ACCOUNT']==$gatewayData->val1 && $unit=="USD" && $amo ==$amount && $DepositData->status=='0'){


                $user = User::find($DepositData['user_id']);
                $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];

                Transaction::create([
                    'user_id' => $DepositData['user_id'],
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                    'amount' => $DepositData['amount'],
                    'new_balance' => $new_balance,
                    'type' => 2,
                ]);

                $user->save();

                $DepositData['status'] = 1;
                $DepositData->save();

                $general = General::first();

                $objDeposit = new \stdClass();
                $objDeposit->first_name = $user['first_name'];
                $objDeposit->amount = $DepositData['amount'];
                $objDeposit->trans_id = $track;
                $objDeposit->date = $created_format; 
                $objDeposit->gateway = 'Perfect Money';

                Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));

    /*     $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

                $sms = $message;
                send_sms($user['mobile'], $sms); */

             //   return redirect()->route('home')->withMsg('Deposit Successfull!');
                return redirect()->back()->with('success', 'Funds deposit successfully!');

            }
        }

    }

    public function ipnbtc(){

        $gatewayData = Gateway::find(3);

        $track = $_GET['invoice_id'];
        $secret = $_GET['secret'];
        $address = $_GET['address'];
        $value = $_GET['value'];
        $confirmations = $_GET['confirmations'];
        $value_in_btc = $_GET['value'] / 100000000;

        $trx_hash = $_GET['transaction_hash'];

        $DepositData = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();
        $dt = $DepositData->created_at;
        $created_format = $dt->toFormattedDateString();

        if ($DepositData->status == 0) {

            if ($DepositData->bcam==$value_in_btc && $DepositData->bcid==$address && $secret=="ABIR" && $confirmations>2){

                $DepositData['status'] = 1;

                $user = User::find($DepositData['user_id']);
                $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];

                Transaction::create([
                    'user_id' => $DepositData['user_id'],
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                    'amount' => $DepositData['amount'],
                    'new_balance' => $new_balance,
                    'type' => 2,
                ]);

                $user->save();

                $DepositData->save();

                $general = General::first();

                $objDeposit = new \stdClass();
                $objDeposit->first_name = $user['first_name'];
                $objDeposit->amount = $DepositData['amount'];
                $objDeposit->trans_id = $track;
                $objDeposit->date = $created_format; 
                $objDeposit->gateway = 'Block Chain';

                Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));


        /* $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

                $sms = $message;
                send_sms($user['mobile'], $sms); */

            //    return redirect()->route('home')->withMsg( 'Deposit Successfull!');
                return redirect()->back()->with('success', 'Added Successfully!');

            }

        }

    }

    public function ipnstripe(FundsDepositStripe $request)
    {
      //  $track =   Session::get('Track')

        $cc = $request->input('cardNumber');
        $expM = $request->input('cardExpiryMonth');
        $expY = $request->input('cardExpiryYear');
        $cvc = $request->input('cardCVC');

        $trx = $request->input('track');

        $data = Deposit::where('trx', $trx)->orderBy('id', 'DESC')->first();
         
        $dt = $data->created_at;
        $date = $dt->toFormattedDateString();
        $gateway_name = 'Stripe';
        $usd_amount = $data->usd_amount;

    //    $exp = $pieces = explode("/", $_POST['cardExpiry']);
    //    $emo = trim($exp[0]);
    //    $eyr = trim($exp[1]);
        $cnts = $data->usd_amount*100;

        $gatewayData = Gateway::find(4);

        Stripe::setApiKey($gatewayData->val1);

        try{
            
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $expM,
                    "exp_year" => $expY,
                    "cvc" => "$cvc"
                )
            ));

            try{
                $charge = Charge::create(array(
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $cnts,
                    'description' => 'item',
                ));


                if ($charge['status'] == 'succeeded') {

                    $user = User::find($data['user_id']);
                    $new_balance = $user['balance'] =  $user['balance'] + $data['amount'];

                    Transaction::create([
                        'user_id' => $data['user_id'],
                        'trans_id' => rand(),
                        'time' => Carbon::now(),
                        'description' => 'ADD FUND'. '#ID'.'-'.$trx,
                        'amount' => $data['amount'],
                        'new_balance' => $new_balance,
                        'type' => 2,
                        'charge' => $data['trx_charge']
                    ]);

                    $user->save();

                    $data['status'] = 1;
                    $data->save();

                    $general = General::first();

                    $objDeposit = new \stdClass();
                    $objDeposit->first_name = $user['first_name'];
                    $objDeposit->amount = $data['amount'];
                    $objDeposit->trans_id = $trx;
                    $objDeposit->date = $date; 
                    $objDeposit->gateway = 'Stripe';

                    Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));

                  //  $sms = $message;
                 //   send_sms($user['mobile'], $sms);
                
            //    return redirect()->route('home')->with('success', 'Added Successfully!');
              //    return redirect()->back()->with('success', 'Funds Deposit Successfully!');  
                    return view('client.payment.thanks', compact('gateway_name','trx','usd_amount','date'));

                }

            }
            catch (Exception $e){
              //  return redirect()->route('home')->with('alert', $e->getMessage());
                return view('client.payment.stripe')->with('alert', $e->getMessage());
            }

        }catch (Exception $e){
            // return redirect()->route('home')->with('alert', $e->getMessage());
            return view('client.payment.stripe')->with('alert', $e->getMessage());
        }

    }

    public function ipncoin(Request $request)
    {
        $track = $request->custom;
        $status = $request->status;
        $amount1 = floatval($request->amount1);
        $currency1 = $request->currency1;

        $DepositData = Deposit::where('trx', $track)->first();
        $dt = $DepositData->created_at;
        $created_format = $dt->toFormattedDateString();

        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcRate = $res->USD->last;
        $amount = $DepositData->bcam;
        $bcoin = round($amount/$btcRate,8);

        if ($currency1 == "btc" && $amount1 >= $bcoin && $DepositData->status == '0')
        {
            if ($status>=100 || $status==2)
            {
                $user = User::find($DepositData['user_id']);
                $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];

                Transaction::create([
                    'user_id' => $DepositData['user_id'],
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                    'amount' => $DepositData['amount'],
                    'new_balance' => $new_balance,
                    'type' => 2,
                ]);

                $user->save();

                $DepositData['status'] = 1;
                $DepositData->save();

                $general = General::first();

    /*     $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

                $sms = $message;
                send_sms($user['mobile'], $sms); */

                $objDeposit = new \stdClass();
                $objDeposit->first_name = $user['first_name'];
                $objDeposit->amount = $amount;
                $objDeposit->trans_id = $track;
                $objDeposit->date = $created_format; 
                $objDeposit->gateway = 'Coin Payment';

                Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));


            }
        }

    }


    //CoinGate
    public function coingatePayment($trx)
    {
      //  $track = Session::get('Track');

        if (is_null($trx))
        {
            return redirect()->back();
        }

        $DepositData = Deposit::where('trx',$trx)->first();

        $amount = $DepositData->bcam;
        
        $gateway =Gateway::find(6);
        //return $DepositData;
        \CoinGate\CoinGate::config(array(
            'environment' => 'sandbox', // sandbox OR live
            'app_id'      =>  $gateway->val1,
            'api_key'     =>  $gateway->val2,
            'api_secret'  =>  $gateway->val3
        ));

        $post_params = array(
            'order_id'          => $DepositData->trx,
            'price'             => $amount,
            'currency'          => 'BTC',
            'receive_currency'  => 'BTC',
            'callback_url'      => route('ipn.coinGate'),
            'cancel_url'        => route('home'),
            'success_url'       => route('home'),
            'title'             => 'AF#'.$DepositData->trx,
            'description'       => 'Add Fund'
        );

        $order = \CoinGate\Merchant\Order::create($post_params);

        if ($order)
        {
         //   return response()->json( 'coin_gate' );
            return redirect($order->payment_url);
        } else {
            echo "Something Wrong with your API";
        }
    }

    public function coinGateIPN(Request $request)
    {

        $DepositData = Deposit::where('trx',$request->order_id)->first();
        $dt = $DepositData->created_at;
        $created_format = $dt->toFormattedDateString();

        $amount = $DepositData->bcam;

        if($request->status=='paid'&& $request->price == $amount && $DepositData->status=='0')
        {
            $user = User::find($DepositData['user_id']);
            $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];

            Transaction::create([
                'user_id' => $DepositData['user_id'],
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                'amount' => $DepositData['amount'],
                'new_balance' => $new_balance,
                'type' => 2,
            ]);

            $user->save();

            $DepositData['status'] = 1;
            $DepositData->save();

            $general = General::first();

            $objDeposit = new \stdClass();
            $objDeposit->first_name = $user['first_name'];
            $objDeposit->amount = $amount;
            $objDeposit->trans_id = $request->order_id;
            $objDeposit->date = $created_format; 
            $objDeposit->gateway = 'Coin Gate';

            Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));

    /*     $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);
            $sms = $message;
            send_sms($user['mobile'], $sms); */

           // return redirect()->route('home')->with('success', 'Payment Complete via CoinGate');
            return redirect()->back()->with('success', 'Payment Complete via CoinGate');
        }
    }


    public function skrillIPN()
    {

        $skrill = Gateway::find(5);
        $concatFields = $_POST['merchant_id']
            .$_POST['transaction_id']
            .strtoupper(md5($skrill->val2))
            .$_POST['mb_amount']
            .$_POST['mb_currency']
            .$_POST['status'];

        $DepositData = Deposit::where('trx',$_POST['transaction_id'])->first();
        $dt = $DepositData->created_at;
        $created_format = $dt->toFormattedDateString();

        if (strtoupper(md5($concatFields)) == $_POST['md5sig'] && $_POST['status'] == 2 && $_POST['pay_to_email'] == $skrill->val1 && $DepositData->status='0') {


            $user = User::find($DepositData['user_id']);
            $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];


            Transaction::create([
                'user_id' => $DepositData['user_id'],
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                'amount' => $DepositData['amount'],
                'new_balance' => $new_balance,
                'type' => 2,
            ]);

            $user->save();

            $DepositData['status'] = 1;
            $DepositData->save();

            $general = General::first();

            $objDeposit = new \stdClass();
            $objDeposit->first_name = $user['first_name'];
            $objDeposit->amount = $DepositData['amount'];
            $objDeposit->trans_id = $_POST['transaction_id'];
            $objDeposit->date = $created_format; 
            $objDeposit->gateway = 'Skrill';

            Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));            


        /*         $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

            $sms = $message;
            send_sms($user['mobile'], $sms); */
        }
    }


    public function blockIpn(Request $request)
    {


//       //##################################################################
// $m = "";
// foreach ($_POST as $key => $value){
// $m.= "$".htmlspecialchars($key)." = ".htmlspecialchars($value)."
// ";
// }
// $m.= "----------------------";
// foreach ($_GET as $key => $value){
// $m.= "$".htmlspecialchars($key)." = ".htmlspecialchars($value)."
// ";
// }
// $m.= "
// ----------------------
// ";
// $file = fopen("75.txt","a");
// fwrite($file,"$m  \n");
// fclose($file);
// //##################################################################



        $DepositData = Deposit::where('status', 0)->where('gateway_id', 8)->where('try','<=',100)->get();
        $dt = $DepositData->created_at;
        $created_format = $dt->toFormattedDateString();


        $method = Gateway::find(8);
        $apiKey = $method->val1;
        $version = 2; // API version
        $pin =  $method->val2;
        $block_io = new BlockIo($apiKey, $pin, $version);


        foreach($DepositData as $data)
        {
            $balance = $block_io->get_address_balance(array('addresses' => $data->bcid));


            $bal = $balance->data->available_balance;

            echo $data->bcid."-".$bal.'<br>';


            if($bal > 0 && $bal >= $data->bcam)
            {
                $user = User::find($data['user_id']);
                $new_balance = $user['balance'] =  $user['balance'] + $data['amount'];

                Transaction::create([
                    'user_id' => $DepositData['user_id'],
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                    'amount' => $DepositData['amount'],
                    'new_balance' => $new_balance,
                    'type' => 2,
                ]);

                $user->save();

                $data['status'] = 1;
                $data['try'] = $data->try+ 1;
                $data->save();

                $general = General::first();

                $objDeposit = new \stdClass();
                $objDeposit->first_name = $user['first_name'];
                $objDeposit->amount = $data['amount'];
                $objDeposit->trans_id = $data['trx'];
                $objDeposit->date = $created_format; 
                $objDeposit->gateway = 'Block IO';

                Mail::to($user['email'])->send(new DepositFundEmail($objDeposit));            


    /*    $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$data['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

                $sms = $message;
                send_sms($user['mobile'], $sms); */


            }
            $data['try'] = $data->try + 1;
            $data->save();
        }
    }

    public function cron()
    {
        file_get_contents(route('ipn.block'));
    }
}	
