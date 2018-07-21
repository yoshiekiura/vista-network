<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChargeCommision;
use App\HpTransaction;
use App\HpCommission;
use App\Transaction;
use App\HashPower;
use App\General;
use App\User;
use Auth;
use Carbon\Carbon;

class HashpowerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }
    
    public function index()
    {
        $product = HashPower::orderBy('id', 'asc')->paginate(8);
        $hp_comm = ChargeCommision::where('id', 1)->value('hp_commission');
        $hp_bonus = ChargeCommision::where('id', 1)->value('hp_miner_bonus');

        return view('client.hp.index', compact('product','hp_comm','hp_bonus'));
    }

    public function shopingView($id)
    {
    	$product = HashPower::findOrFail($id);
        return view('fonts.hplp.view', compact('product'));
    }

    public function buyProduct(Request $request)
    {

        $g = General::first();
        $p = HashPower::findOrFail($request->hp_product_id);
        $balance = Auth::user()->balance;
        settype($balance, "float");

        if ($balance >= $p->price){
         //   var_dump($balance);
         //   die;
            $user = User::findOrFail(Auth::user()->id);

            $new_balance = $balance - $p->price;
            $new_hp_balance = $user->hp_balance + $p->price;

            $hp = HpTransaction::create([
                        'transaction_id' => 'HP'.rand(),
                        'product_id' => $request->hp_product_id, 
                        'user_id' => Auth::user()->id,
                        'qty' => 1,
                        'price' => $p->price,
                        'total' => $p->price
                    ]);


            User::whereId(Auth::user()->id)
                    ->update([
                        'balance' => $new_balance,
                        'hp_balance' => $new_hp_balance
                    ]);

            Transaction::create([
                'user_id' => Auth::user()->id,
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'HP/LP BUY'. '#ID'.'-'.$hp->transaction_id,
                'amount' => '-'.$p->price,
                'new_balance' => $new_balance,
                'type' => 7,
            ]);  


            $hp_trans_count = HpTransaction::where('user_id', Auth::user()->id)
                                    ->where('product_id', $request->hp_product_id)
                                    ->count();

            if($hp_trans_count == 1) {

                $hp_miner_bonus = ChargeCommision::where('id', 1)->value('hp_miner_bonus');
                $fast_miner_bonus = ($hp_miner_bonus/100)*$p->price;
                $referrer_id = User::where('id', Auth::user()->id)->value('referrer_id');
                $referrer_balance = User::where('id', $referrer_id)->value('balance');
                $referrer_new_balance = $referrer_balance + $fast_miner_bonus;
                
                if($referrer_id != NULL || $referrer_id != ""){
                    
                    Transaction::create([
                        'user_id' => $referrer_id,
                        'trans_id' => rand(),
                        'time' => Carbon::now(),
                        'description' => 'FAST MINER BONUS'. '#ID'.'-'.$hp->transaction_id,
                        'amount' => $fast_miner_bonus,
                        'new_balance' => $referrer_new_balance,
                        'type' => 9,
                    ]);

                    HpCommission::create([
                        'user_id' => $referrer_id,
                        'transaction_id' => $hp->transaction_id,
                        'commission_rate' => $hp_miner_bonus,
                        'commission_date' => Carbon::now(),
                        'commission_amount' => $fast_miner_bonus,
                        'description' => 'HP FAST MINER BONUS'
                    ]);

                    User::whereId($referrer_id)
                        ->update([
                            'balance' => $referrer_new_balance
                    ]);              
                }     

            }
            
            
            $message = 'You bought '.$p->title.' successfully. And Product price '.$g->symbol.$p->price.' charged from your balance.
         And your current balance is '.$g->symbol.$new_balance.'. 
         And Your current Shopping Status is pending, wait for approval.';

                send_email($user->email, 'HP/LP Buy Complete' ,$user->first_name, $message); 

            //    return redirect('hash-power')->with('message', 'Paid Complete');
                return response()->json( $new_hp_balance );
            
        }else{
          //  return redirect('hash-power')->with('alert', 'You do not have enough balance to purchase this product.');
                return response()->json( false );
        }
    }

    public function hpHistory() {

        $hashpower = HpTransaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        
        return view('client.hp.history', compact('hashpower'));

    }

}
