<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ChargeCommision;
use App\Deposit;
use App\Income;
use App\MemberExtra;
use App\ProductImage;
use App\ProductShipment;
use App\Transaction;
use App\User;
use App\General;
use App\HashPower;
use App\HPImage;
use App\Withdraw;
use App\ShippingAddress;
use App\WithdrawTrasection;
use App\Notification;
use App\SchedulePayment;
use App\PaymentInstallment;
use App\CoinTransaction;
use App\HpTransaction;
use App\Coin;
use App\Order;
use App\Commission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use DB;
use Mail;
use App\Mail\AdminEmailtoUser;
use App\Mail\ShipmentMessageProcessedd; 
use App\Mail\ShipmentMessageDelivered;
use App\Mail\ShipmentMessageRejected;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function adminIndex(){

        return view('admin.home');
    }

    public function saveResetPassword(Request $request){

        $this->validate($request,[
            'passwordold' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Admin::find($request->id)->password;
            $c_id = Admin::find($request->id)->id;
            $user = Admin::findOrFail($c_id);
            if(Hash::check($request->passwordold, $c_password)){
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                return redirect()->back()->withMsg('Password Changes Successfully.');
            }else{
                session()->flash('message', 'Password Not Matched');
                Session::flash('type', 'warning');
                return redirect('admin/home');
            }
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'warning');
            return redirect('admin/home');
        }

    }

    public function usersIndex()
    {
        $user = User::orderBy('id', 'desc')->paginate(15);
        return view('admin.user_mmanagement.index', compact('user'));
    }

    public function indexWithdraw()
    {
        $withdraw = Withdraw::all();
        return view('admin.withdraw.add_withdraw_method', compact('withdraw'));
    }

    public function indexCoins()
    {
        $coins = Coin::all();
        return view('admin.coins.index', compact('coins'));
    }

    public function storeWithdraw(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'min_amo' => 'required|numeric|min:1',
            'max_amo' => 'required|numeric|min:1',
            'chargefx' => 'required',
            'chargepc' => 'required',
            'rate' => 'required',
            'processing_day' => 'required',
        ]);

        $withdraw = Withdraw::create($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = 'assets/images/withdraw/'. $filename;
            Image::make($image)->save($location);
            $withdraw->image =  $filename;
            $withdraw->save();
        }

        return redirect()->back()->withMsg('Created Payment Method Successfully');
    }

    public function storeCoins(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png,svg',
            'min_coins' => 'required',
            'rate' => 'required',
        ]);

        $coin = new Coin;

        $coin->name = $request->input('name');
        $coin->min_coins = $request->input('min_coins');
        $coin->rate = $request->input('rate');

    //    $coin = Coin::create($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = 'assets/images/coins/'. $filename;
            Image::make($image)->save($location);
            $coin->image =  $filename;
        }

        $coin->save();

        return redirect()->back()->withMsg('Created Coins Successfully');
    }

    public function updateWithdraw(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png,svg',
            'min_amo' => 'required|numeric|min:1',
            'max_amo' => 'required|numeric|min:1',
            'chargefx' => 'required',
            'chargepc' => 'required',
            'rate' => 'required',
            'currency' => 'required',
            'processing_day' => 'required',
            'status' => 'required',
        ]);

        $withdraw = Withdraw::whereId($id)
        ->update([
            'name' => $request->name,
            'min_amo' => $request->min_amo,
            'max_amo' => $request->max_amo,
            'chargefx' => $request->chargefx,
            'chargepc' => $request->chargepc,
            'rate' => $request->rate,
            'currency' => $request->currency,
            'processing_day' => $request->processing_day,
            'status' => $request->status,
        ]);

        $general = Withdraw::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = 'assets/images/withdraw/'. $filename;
            Image::make($image)->save($location);
            $general->image =  $filename;
            $general->save();
        }

        return redirect()->back()->withMsg('Updated Payment Method Successfully');
    }

    public function updateCoins(Request $request,$id)
    {
    
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png,svg',
            'min_coins' => 'required',
            'rate' => 'required',
        ]);


        $coin = Coin::whereId($id)
        ->update([
            'name' => $request->name,
            'min_coins' => $request->min_coins,
            'rate' => $request->rate,
            'status' => $request->status,
        ]);

        $general = Coin::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = 'assets/images/coins/'. $filename;
            Image::make($image)->save($location);
            $general->image =  $filename;
            $general->save();
        }

        return redirect()->back()->withMsg('Updated Coins Successfully');
    }

    public function requestWithdraw()
    {
        $withdraw = WithdrawTrasection::orderBy('id', 'desc')->
        where('status', 0)->paginate(15);
        return view('admin.withdraw.withdraw_request', compact('withdraw'));
    }

    public function requestCoins()
    {
        $coins = CoinTransaction::orderBy('id', 'desc')->
        where('status', 1)->paginate(50);
        return view('admin.coins.coins_purchase', compact('coins'));
    }

    public function coinsBalance()
    {
    
        $user = User::all();
        $alxa_coins = CoinTransaction::groupBy('user_id')
                            ->where('coin_id', 1)
                            ->selectRaw('sum(number_of_coins) as sum, user_id')
                            ->get();
                            
        $vista_coins = CoinTransaction::groupBy('user_id')
                            ->where('coin_id', 2)
                            ->selectRaw('sum(number_of_coins) as sum, user_id')
                            ->get();                      

        return view('admin.coins.coins_balance', compact('alxa_coins','vista_coins','user'));
    }

    public function ordersList()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(15);
        return view('admin.orders.orders_list', compact('orders'));
    }

    public function ordersInstallment()
    {
     
        $installment = DB::select('
                        SELECT
                            payment_installments.order_id,
                            payment_installments.product_id,
                            payment_installments.product_name,
                            payment_installments.product_price,
                            payment_installments.duration,
                            payment_installments.advance_payment,
                            payment_installments.installment,
                            payment_installments.status,
                            COUNT(schedule_payments.payment_amount) AS paid_install,
                            SUM(schedule_payments.payment_amount) AS paid_amount
                        FROM
                            payment_installments
                        LEFT JOIN schedule_payments ON payment_installments.order_id = schedule_payments.order_id && schedule_payments.status = 1
                        GROUP BY schedule_payments.payment_amount,payment_installments.order_id,payment_installments.product_id,payment_installments.duration,payment_installments.advance_payment,payment_installments.installment,payment_installments.status,payment_installments.product_name,payment_installments.product_price
                        '); 

        return view('admin.orders.view_install', compact('installment'));
    }

    public function viewInstallmentDetails($order_id)
    {
        $user_id = Order::where('order_id', $order_id)->value('user_id');
        $user_first_name = User::where('id', $user_id)->value('first_name');
        $user_last_name = User::where('id', $user_id)->value('last_name');
        $user_balance = User::where('id', $user_id)->value('balance');
        $schedule = SchedulePayment::where('order_id', $order_id)->orderBy('due_date', 'ASC')->get();

        $installment = DB::select('
                        SELECT
                            payment_installments.order_id,
                            payment_installments.product_id,
                            payment_installments.product_name,
                            payment_installments.product_price,
                            payment_installments.duration,
                            payment_installments.advance_payment,
                            payment_installments.installment,
                            payment_installments.status,
                            payment_installments.created_at,
                            COUNT(schedule_payments.payment_amount) AS paid_install,
                            SUM(schedule_payments.payment_amount) AS paid_amount
                        FROM
                            payment_installments
                        LEFT JOIN schedule_payments ON payment_installments.order_id = schedule_payments.order_id && schedule_payments.status = 1 
                        WHERE 
                            payment_installments.order_id = ? 
                        GROUP BY schedule_payments.payment_amount,payment_installments.order_id,payment_installments.product_id,payment_installments.duration,payment_installments.advance_payment,payment_installments.installment,payment_installments.status,payment_installments.product_name,payment_installments.product_price,payment_installments.created_at
                        ', [$order_id]);

        return view('admin.orders.pay_installment', compact('user_first_name','user_last_name','installment','schedule','user_balance'));
    }

    public function payInstallment(Request $request, $id) {

        $user_id = Order::where('order_id', $request->input('order_id'))->value('user_id');
        $balance = User::where('id', $user_id)->value('balance');
        $installment = PaymentInstallment::where('order_id', $request->input('order_id'))->value('installment');

        if($balance >= $installment){

            $new_balance = $balance - $installment;

            SchedulePayment::whereId($id)->update([
                'status' => 1
            ]);

            User::whereId($user_id)
                    ->update([
                        'balance' => $new_balance
                    ]);

            Transaction::create([
                'user_id' => $user_id,
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'INSTALLMENT'. '#ID'.'-'.'IN'.rand(),
                'amount' => '-'.$installment,
                'new_balance' => $new_balance,
                'type' => 6,
            ]);

            return redirect('admin/orders/installment/pay/' . $request->input('order_id'))->withMsg('Successfully Paid');

        }else {

            Session::flash('error', 'Unsufficient Balance');
            return redirect('admin/orders/installment/pay/' . $request->input('order_id'));
        
        }

    }

    public function viewReferralCommissions() 
    {
        $orders = Order::where('payment_type', 'pay_full')->orderBy('id', 'desc')->get();
        return view('admin.orders.view_commission', compact('orders'));
    }

    public function viewCommissionDetails($order_id)
    {
        $order = Order::where('order_id', $order_id)->get();
        $user_id = Order::where('order_id', $order_id)->value('user_id');
        $user_first_name = User::where('id', $user_id)->value('first_name');
        $user_last_name = User::where('id', $user_id)->value('last_name');
        $user_balance = User::where('id', $user_id)->value('balance');
        $commissions = Commission::where('order_id', $order_id)->orderBy('id', 'asc')->get();

        return view('admin.orders.commission_details', compact('user_first_name','user_last_name','order','user_balance','commissions'));   
    }

    public function requestCoinWithdraw()
    {
        $coins = CoinTransaction::orderBy('id', 'desc')->
        where('status', 0)->paginate(15);
        return view('admin.coins.coins_withdraw', compact('coins'));
    }

    public function detailWithdraw($id)
    {
        $data = WithdrawTrasection::findOrFail($id);
        return view('admin.withdraw.withdraw_detal', compact('data'));
    }

    public function repondWithdraw(Request $request, $id)
    {
         $this->validate($request,[
            'message' => 'required',
        ]);
         WithdrawTrasection::whereId($id)
        ->update([
            'status' => $request->status,
        ]);
        if ($request->status == 1 )
        {
           $withdraw = WithdrawTrasection::find($id);
            $user_id = $withdraw->user_id;
            $user = User::find($user_id);
             $general = General::first();

         
        $message = $request->message;


        send_email($user['email'], 'Withdraw Request Accept', $user->first_name , $message);

            $sms = 'Congratulations! Your Withdraw request  accepted.';
            send_sms($user['mobile'], $sms);

        $sms = $request->message;
        send_sms($user['mobile'], $sms);

            return redirect('admin/withdraw/requests')->withMsg('Paid Complete');
        }else{
            $withdraw = WithdrawTrasection::find($id);
            $user_id = $withdraw->user_id;
            $user = User::find($user_id);
            User::whereId($user_id)
                ->update([
                    'balance' => $user->balance + $withdraw->amount + $withdraw->charge
                ]);

          $message = $request->message;

        send_email($user['email'], 'Withdraw Request Refund' ,$user->first_name, $message);
            $sms = 'Sorry! Withdraw Request Refund';
            send_sms($user['mobile'], $sms);

            return redirect('admin/withdraw/requests')->withMsg('Refund Complete');
        }

    }
    public function showWithdrawLog()
    {
        $withdraw = WithdrawTrasection::orderBy('id', 'desc')->get();
        return view('admin.withdraw.view_log', compact('withdraw'));
    }

    public function showCoinsLog()
    {
        $coins = CoinTransaction::orderBy('id', 'desc')->get();
        return view('admin.coins.view_log', compact('coins'));
    }

    public function indexEmail()
    {
        $temp = General::first();
        if(is_null($temp))
        {
            $default = [
                'esender' => 'email@example.com',
                'emessage' => 'Email Message',
                'smsapi' => 'SMS Message',

            ];
            General::create($default);
            $temp = General::first();
        }
        return view('admin.website.email', compact('temp'));
    }

    public function updateEmail(Request $request)
    {
        $temp = General::first();
        $this->validate($request,[
                'esender' => 'required',
                'emessage' => 'required'
            ]);

        $temp['esender'] = $request->esender;
        $temp['emessage'] = $request->emessage;

        $temp->save();

        return back()->withMsg('Email Settings Updated Successfully!');
    }

    public function smsApi()
    {
        $temp = General::first();
        if(is_null($temp))
        {
            $default = [
                'esender' => 'email@example.com',
                'emessage' => 'Email Message',
                'smsapi' => 'SMS Message',

            ];
            General::create($default);
            $temp = General::first();
        }
        return view('admin.website.sms', compact('temp'));
    }

    public function smsUpdate(Request $request)
    {
        $temp = General::first();

        $this->validate($request,[
                'smsapi' => 'required',
            ]);
        $temp['smsapi'] = $request->smsapi;

        $temp->save();

        return back()->withMsg('SMS Api Updated Successfully!');
    }

    public function indexUserDetail($id)
    {
        $user = User::find($id);
        $available_alxa_coins = CoinTransaction::where('user_id', $id)
                                            ->where('coin_id', 1)
                                            ->sum('number_of_coins');
        $available_vista_coins = CoinTransaction::where('user_id', $id)
                                            ->where('coin_id', 2)
                                            ->sum('number_of_coins');

        return view('admin.user_mmanagement.view',compact('user','available_alxa_coins','available_vista_coins'));
    }

    public function userUpdate(Request $request ,$id)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'birth_day' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        if ($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($request->emailv == 'on'){
            $emailv = 0;
        }else{
            $emailv = 1;
        }

        if ($request->smsv == 'on'){
            $smsv = 0;
        }else{
            $smsv = 1;
        }

        User::whereId($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'birth_day' => $request->birth_day,
            'city' => $request->city,
            'country' => $request->country,
            'status' => $status,
            'emailv' => $emailv,
            'smsv' => $smsv,
        ]);
        return redirect()->back()->withMsg('Successfully Updated');
    }

    public function indexUserBalance($id)
    {
        $user = User::find($id);
        return view('admin.user_mmanagement.balance',compact('user'));
    }

    public function indexBalanceUpdate(Request $request ,$id)
    {
        $this->validate($request,[
            'amount' => 'required|numeric|min:1',
            'message' => 'required',
        ]);

            if ($request->operation == 'on'){
                $user = User::find($id);
                $new_balance = $user['balance'] =  $user['balance'] + $request->amount;
                $user->save();
                $message = $request->message;

                Transaction::create([
                    'user_id' => $id,
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADMIN'. '#ID'.'-'.'ADD'.rand(),
                    'amount' => $request->amount,
                    'new_balance' => $new_balance,
                    'type' => 10,
                ]);

                send_email($user['email'], 'Admin Balance Add' ,$user['first_name'], $message);


                $sms = $request->message;
                send_sms($user['mobile'], $sms);
                return redirect()->back()->withMsg('Balance Add Successful');
            }else{
                $user = User::find($id);
                if ($user->balance > $request->amount){
                    $new_balance = $user['balance'] =  $user['balance'] - $request->amount;
                    $user->save();
                    $message = $request->message;

                    Transaction::create([
                        'user_id' => $id,
                        'trans_id' => rand(),
                        'time' => Carbon::now(),
                        'description' => 'ADMIN'. '#ID'.'-'.'SUBTRACT'.rand(),
                        'amount' => '-'.$request->amount,
                        'new_balance' => $new_balance,
                        'type' => 11,
                    ]);

                    send_email($user['email'], 'Admin Balance Subtract' ,$user['first_name'], $message);
                    $sms = $request->message;
                    send_sms($user['mobile'], $sms);
                    return redirect()->back()->withMsg('Balance Subtract Successful');
                    }
                return redirect()->back()->withdelmsg('Insufficient Balance');
            }

    }

    public function userSendMail($id)
    {
        $user = User::find($id);
        return view('admin.user_mmanagement.user_mail',compact('user'));
    }

    public function userSendMailUser(Request $request, $id)
    {
        $this->validate($request,[
            'subject' => 'required',
            'message' => 'required|max:500',
        ]);

        $user = User::find($id);
        $subject =$request->subject;
        $message = $request->message;
        
        $objAdmin = new \stdClass();
        $objAdmin->first_name = $user->first_name;
        $objAdmin->subject = $subject;
        $objAdmin->message = $message;

        Mail::to($user->email)->send(new AdminEmailtoUser($objAdmin));

        // send_email($user['email'], $subject ,$user['first_name'], $message);
        
        return redirect()->back()->withMsg('Mail Send');

    }

    public function userSendNotification($id)
    {
        $user = User::find($id);
        return view('admin.user_mmanagement.user_notifications',compact('user'));   
    }

    public function userSendNotificationUser(Request $request, $id)
    {
        $user = User::find($id);
        $subject =$request->subject;
        $message = $request->message;

        Notification::create([
            'user_id' => $id,
            'subject' => $subject,
            'message' => $message
        ]);

         return redirect()->back()->withMsg('Notification Send');
    }

    public function matchIndex()
    {
        $match = Income::where('type', 'B')->get();
        return view('admin.matching.index', compact('match'));
    }

    public function matchGenerate(Request $request)
    {
        $this->validate($request,[
            'sure' => 'required',
        ]);

        if ($request->sure == 'SURE' || $request->sure == 'sure'){
                $gen = ChargeCommision::first();
                //GENERATE
                  $ddaa = MemberExtra::where('left_bv', '>',0)
                    ->where('right_bv', '>', 0)
                    ->get();

                foreach ($ddaa as $data) {
                    $lbv = $data->left_bv;
                    $rbv = $data->right_bv;
                    $lowest = ($lbv < $rbv) ? $lbv : $rbv;
                    $bonus = $gen->update_commision_tree * $lowest;
                    $bvp = $lowest;
                    //FLASH
                    $nlbv = $data->left_bv - $lowest;
                    $nrbv = $data->right_bv - $lowest;
                    MemberExtra::where('user_id', $data->user_id)
                    ->update([
                        'left_bv' => $nlbv,
                        'right_bv' => $nrbv,
                    ]);
                    //FLASH
                    $paidid =  User::whereId($data->user_id)->first();
                    if($paidid->paid_status == 1){
                        // ADD THE BALANCE
                        $cbal = User::whereId($data->user_id)->first();
                        $newbal = $cbal->balance + $bonus;
                        $user_b_update = User::whereId($data->user_id)
                        ->update([
                            'balance' => $newbal
                        ]);
                        ///ADD THE BALANCE
                        if ($user_b_update){
                            Transaction::create([
                                'user_id' => $data->user_id,
                                'trans_id' => rand(),
                                'time' => Carbon::now(),
                                'description' => 'Matching Bonus Of '.$bvp.' Users',
                                'amount' => $bonus,
                                'new_balance' => $newbal,
                                'type' => 4,
                                'charge' => 0
                            ]);

                            Income::create([
                                'user_id' => $data->user_id,
                                'amount' => $bonus,
                                'description' => 'Matching Bonus Of '.$bvp.' Users',
                                'type' => 'B'
                            ]);
                        }else{
                            return redirect()->back()->withdelmsg('Something Wrong Please Some Again');
                        }
                    }
                }
            return redirect()->back()->withmsg('Generate Successful');
        }
        else {
            return redirect()->back()->withdelmsg('Invalid Keyword');
        }
    }

    public function userSearch(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user == ''){
            $user_notfound = 0;
            return redirect()->back()->with( 'not_found', 'Oops, User Not Found!');
        }else{
            return view('admin.user_mmanagement.view', compact('user'));
        }
    }

    public function userSearchEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user == ''){
            $user_notfound = 0;
            return redirect()->back()->with( 'not_found', 'Oops, User Not Found!');
        }else{
            return view('admin.user_mmanagement.view', compact('user'));
        }
    }

    public function deactiveUser()
    {
        $user = User::orderBy('id', 'desc')->where('status', 0)->paginate(15);
        return view('admin.deactive_user', compact('user'));
    }

    public function paidUser()
    {
        $user = User::orderBy('id', 'desc')->where('paid_status', 1)->paginate(15);
        return view('admin.paid_user', compact('user'));
    }

    public function freeUser()
    {
        $user = User::orderBy('id', 'desc')->where('paid_status', 0)->paginate(15);
        return view('admin.paid_user', compact('user'));
    }

    public function depositLog()
    {
        $add_fund = Deposit::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.deposit_log', compact('add_fund'));
    }

     public function transBalanceLog()
    {
        $trans = Transaction::where('type', 3)->orderBy('id', 'desc')->get();
        return view('admin.transfer_balance_log', compact('trans'));
    }

    public function transView($id)
    {
        $trans_object = Transaction::where('user_id', $id)->first();
        $trans = Transaction::where('user_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.trans_view', compact('trans', 'trans_object'));
    }

    public function depositView($id)
    {
        $trans_object = Deposit::where('user_id', $id)->first();
        $trans = Deposit::where('user_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.deposit_view', compact('trans', 'trans_object'));
    }

    public function withDrawView($id)
    {
        $trans_object = WithdrawTrasection::where('user_id', $id)->first();
        $trans = WithdrawTrasection::where('user_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.withdraw_view', compact('trans', 'trans_object'));
    }

    public function sendMoneyView($id)
    {
        $trans_object = Transaction::where('user_id', $id)->first();
        $trans = Transaction::where('user_id', $id)->where('type', 3)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.send_money_view', compact('trans', 'trans_object'));
    }

    public function generateAdmin()
    {
        $trans = Transaction::where('type', 5)->orderBy('id', 'desc')->get();
        return view('admin.admin_generate', compact('trans'));
    }

    public function subtractAdmin()
    {
        $trans = Transaction::where('type', 6)->orderBy('id', 'desc')->get();
        return view('admin.admin_subtract', compact('trans'));
    }

    public function refView()
    {
        $trans = Income::where('type', 'R')->orderBy('id', 'desc')->get();
        return view('admin.ref_amount', compact('trans'));
    }

    public function imageDelete(Request $request)
    {
        $p =ProductImage::findOrFail($request->image);
        @unlink('assets/images/product/'.$p->image);
        $p->delete();
        return $request->image;
    }

    public function shipmentIndex()
    {
        $ship = ProductShipment::orderBy('id', 'desc')
            ->where('status', 0)->orWhere('status', 1)
            ->paginate(10);
       return view('admin.shipment', compact('ship'));
    }

    public function shipmentComplete()
    {
        $ship = ProductShipment::orderBy('id', 'desc')
            ->where('status', 2)
            ->paginate(10);
       return view('admin.shipment_success', compact('ship'));
    }

    public function shipmentDetail($id, $order_id)
    {
        $ship = ProductShipment::findOrFail($id);
        $user_id = $ship->user_id;
        $address = ShippingAddress::where('user_id', $user_id)->get();
        return view('admin.shipping_detail', compact('ship','address','order_id'));
    }

    public function shipmentProcess(Request $request, $id)
    {
        $message = $request->message;
        $oid = Order::where('order_id', $request->order_id)->value('id');

        if ($request->status == 1){
            $p = ProductShipment::findOrFail($id);
            $p->status = 1;
            $user = User::findOrFail($p->user_id);
            
            Order::whereId($oid)
            ->update([
                'status' => 1,
            ]);

            $objShip = new \stdClass();
            $objShip->first_name = $user->first_name;
            $objShip->order_id = $p->order_id;
            $objShip->message = $message;

            Mail::to($user->email)->send(new ShipmentMessageProcessedd($objShip));
            
        //    send_email($user['email'], 'Product Processed' ,$user['first_name'], $message);
            $p->save();

            return redirect('admin/shipment')->withMsg('Successfully Done');

        }elseif ($request->status == 2){
            $p = ProductShipment::findOrFail($id);
            $p->status = 2;
            $user = User::findOrFail($p->user_id);
            
            Order::whereId($oid)
            ->update([
                'status' => 2,
            ]);

            $objShip = new \stdClass();
            $objShip->first_name = $user->first_name;
            $objShip->order_id = $p->order_id;
            $objShip->message = $message;

            Mail::to($user->email)->send(new ShipmentMessageDelivered($objShip));
        //    send_email($user['email'], 'Product Delivered' ,$user['first_name'], $message);
            $p->save();
            return redirect('admin/shipment')->withMsg('Successfully Done');

        }else{
            $p = ProductShipment::findOrFail($id);
            $p->status = 3;
            $p->save();

            $user = User::findOrFail($p->user_id);
            $user->balance = $user->balance + $p->price;
            $user->save();
            
            Order::whereId($oid)
            ->update([
                'status' => 3,
            ]);

            $objShip = new \stdClass();
            $objShip->first_name = $user->first_name;
            $objShip->order_id = $p->order_id;
            $objShip->message = $message;

            Mail::to($user->email)->send(new ShipmentMessageRejected($objShip));

        //    send_email($user['email'], 'Buy Request Rejected And Product Price Added' ,$user['first_name'], $message);

            return redirect('admin/shipment')->withMsg('Successfully Done');
        }
    }

    public function shipmentReject()
    {
        $ship = ProductShipment::orderBy('id', 'desc')
            ->where('status', 3)
            ->paginate(10);
        return view('admin.shipment_reject', compact('ship'));
    }

    public function hashpowerIndex()
    {
        $product = HashPower::orderBy('id', 'desc')->paginate(10);
        return view('admin.hplp.index', compact('product'));
    }

    public function hashpowerStore(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'price' => 'numeric|min:0',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $p = HashPower::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $filename = uniqid().time().'.'.'jpg';
                $image->move('assets/images/hash', $filename);
                $data = $filename;
                HPImage::create([
                    'product_id' => $p->id,
                    'image' => $data,
                ]);
            }

        }
        return back()->withMsg('Successfully Create');
    }

    public function hashpowerEdit($id){
    
        $product = HashPower::findOrFail($id);
        return view('admin.hplp.edit', compact('product'));

    }

    public function hashpowerUpdate(Request $request, HashPower $hash_power){

        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'price' => 'numeric|min:0',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $id = $request->product_id;

        HashPower::whereId($id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price
            ]);

        if($request->hasfile('image'))
        {
            for ($i = 0; $i < count($request->image_id); $i++)
            {

                $image = $request->file('image');
                if ($request->image_id[$i] == null){
                    $filename = uniqid().time().'.'.'jpg';
                    $image[$i]->move('assets/images/hash', $filename);
                    $data[$i] = $filename;
                    HPImage::updateOrCreate(['id' => $request->image_id[$i],],
                        [
                            'image' => $data[$i],
                            'product_id' => $id
                        ]);
                }

            }

        }

        return redirect('admin/hash-power')->withMsg('Successfully Update');
    }

    public function hashpowerDelete($id)
    {

        $p = HPImage::where('product_id',$id)->get();
        foreach ($p as $d){
            @unlink('assets/images/hash/'.$d->image);
            $d->delete();
        }

        $hash_power = HashPower::findOrFail($id);
        $hash_power->delete();
        return back()->withMsg('Successfully Delete');
    }

    public function hashpowerTransactions()
    {
        $hashpower = HpTransaction::orderBy('id', 'desc')->where('status', 1)->paginate(15);

        return view('admin.hplp.hplp_transactions', compact('hashpower'));
    }

    public function hashpowerBalances()
    {
      //  $hashpower = HpTransaction::orderBy('id', 'desc')->where('status', 1)->paginate(15);
        $comission = ChargeCommision::where('id', 1)->value('hp_commission');
        $hp_balance = User::orderBy('id', 'desc')->paginate(15);

        return view('admin.hplp.hplp_balance', compact('comission','hp_balance'));
    }

}
