<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoinTransaction;
use App\Transaction;
use App\General;
use App\Coin;
use App\User;
use Carbon\Carbon;
use Auth;

class CoinsController extends Controller
{

	public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }

    public function index()
    {

    	$alxa_rate = Coin::where('id', 1)->value('rate');
    	$vista_rate = Coin::where('id', 2)->value('rate');
    	$available_alxa_coins = CoinTransaction::where('user_id', Auth::user()->id)
    										->where('coin_id', 1)
    										->sum('number_of_coins');
    	$available_vista_coins = CoinTransaction::where('user_id', Auth::user()->id)
    										->where('coin_id', 2)
    										->sum('number_of_coins');

    	return view('client.coin.index', compact('alxa_rate', 'vista_rate', 'available_alxa_coins', 'available_vista_coins'));
    
    }

    public function coinPreview(Request $request)
    {

    	$this->validate($request,[
            'coins' => 'required|numeric|min:1',
        ]);

    	$coin_id = $request->coin_id;
    	$coins = $request->coins; 
    	$rate = Coin::where('id', $coin_id)->value('rate');
    	$balance = User::where('id', Auth::user()->id)->value('balance');

    	return view('fonts.coins.coins_preview', compact('coin_id', 'coins', 'rate', 'balance'));

    }

    public function withdrawPreview(Request $request)
    {

        $this->validate($request,[
            'coins' => 'required|numeric|min:1',
        ]);

        $coin_id = $request->coin_id;
        $coins = $request->coins;
        $coins_balance = $request->coin_balance; 
        $rate = Coin::where('id', $coin_id)->value('rate');
        $balance = User::where('id', Auth::user()->id)->value('balance');

        return view('fonts.coins.withdraw_preview', compact('coin_id', 'coins', 'rate', 'balance', 'coins_balance'));

    }

    public function coinsPurchase(Request $request)
    {
        
        if(Auth::user()->balance >= $request->total){

            $coin = CoinTransaction::create([
               'coin_id' => $request->coin_id,
               'number_of_coins' => $request->coins,
               'rate' => $request->rate,
               'amount' => $request->total,
               'status' => 1,
               'transaction_id' => 'CN'.rand(),
               'user_id' => Auth::user()->id,
            ]);

            $total =  $request->total;

            $new_balance = Auth::user()->balance - $total;

            $new_coins_balance = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', $request->coin_id)
                                            ->sum('number_of_coins');

            User::whereId(Auth::user()->id)
                ->update([
                   'balance' => $new_balance
                ]);

            Transaction::create([
                'user_id' => $coin->user_id,
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'COIN'. '#ID'.'-'.$coin->transaction_id,
                'amount' => '-'.$coin->amount,
                'new_balance' => $new_balance,
                'type' => 4,
            ]);

            $general = General::first();
            $user = User::find(Auth::user()->id);

            $message ='Hello! Your coins purchase request is success. You purchased coin : '.$coin->coins.' 
             your current balance is '.$new_balance.$general->symbol.' .';

            send_email($user['email'], 'Successfully Withdraw' ,$user['first_name'], $message);

          //  return redirect('home')->with('message', 'Coins Purchase Request Success.');
            return response()->json(['success' => true, 'balance' => $new_balance, 'coin_balance' => $new_coins_balance]);
        }else{
            return response()->json(['success' => false ]);
        }

    }

    public function coinsWithdraw(Request $request)
    {
        
        $coin_balance = CoinTransaction::where('user_id', Auth::user()->id)
                                        ->where('coin_id', $request->coin_id)
                                        ->sum('number_of_coins');

        if($coin_balance >= $request->coins) {                                

            $coins_num = '-' . $request->coins;
            $total_amount = $request->total;

            $coin = CoinTransaction::create([
               'coin_id' => $request->coin_id,
               'number_of_coins' => $coins_num,
               'rate' => $request->rate,
               'amount' => '-'.$total_amount,
               'status' => 0,
               'transaction_id' => 'CN'.rand(),
               'user_id' => Auth::user()->id,
            ]);

            $total =  $request->total;

            $new_balance = Auth::user()->balance + $total;

            $new_coins_balance = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', $request->coin_id)
                                            ->sum('number_of_coins');

            User::whereId(Auth::user()->id)
                ->update([
                   'balance' => $new_balance
                ]);

            Transaction::create([
                'user_id' => $coin->user_id,
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'COIN'. '#ID'.'-'.$coin->transaction_id,
                'amount' => $total_amount,
                'new_balance' => $new_balance,
                'type' => 5,
            ]);

            $general = General::first();
            $user = User::find(Auth::user()->id);

            $message ='Hello! Your coins withdraw request is success. You withdraw coins : '.$coin->coins.' 
             your current balance is '.$new_balance.$general->symbol.' .';

            send_email($user['email'], 'Successfully Withdraw' ,$user['first_name'], $message);

        //    return redirect('home')->with('message', 'Coins Withdraw Request Success.');
            return response()->json(['success' => true, 'balance' => $new_balance, 'coin_balance' => $new_coins_balance]);
        }else{
            return response()->json(['success' => false]);
        }

    }

    public function transferCoinIndex($coin_id)
    {

        $coin_name = Coin::where('id', $coin_id)->value('name');
        $available_coins = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', $coin_id)
                                            ->sum('number_of_coins');

        return view('fonts.coins.coins_transfer', compact('available_coins', 'coin_name', 'coin_id'));
    }

    public function transferCoins(Request $request) 
    {
        
        $coin_balance = CoinTransaction::where('user_id', Auth::user()->id)
                                        ->where('coin_id', $request->coin_id)
                                        ->sum('number_of_coins');

        $receiver = User::find($request->username);
        
        if(!$receiver){
            return response()->json(['success' => 'username']);   
        }                                
        else if($coin_balance < $request->coins){
            return response()->json(['success' => false]);
           // return redirect()->back()->with('alert','Insufficient Balance');
        }else{

            $coin_rate = Coin::where('id', $request->coin_id)->value('rate');

            $receiver = User::find($request->username);

            $coin = CoinTransaction::create([
                'coin_id' => $request->coin_id,
                'number_of_coins' => $request->coins,
                'rate' => $coin_rate,
                'amount' => $coin_rate*$request->coins,
                'status' => 3,
                'transaction_id' => 'CN'.rand(),
                'user_id' => $receiver->id
            ]);

            $giver = User::findOrFail(Auth::user()->id);
            $giver->balance = $giver->balance - ($coin_rate*$request->coins);
            $giver->update();
            
            CoinTransaction::create([
                'coin_id' => $request->coin_id,
                'number_of_coins' => '-'.$request->coins,
                'rate' => $coin_rate,
                'amount' => '-'.$coin_rate*$request->coins,
                'status' => 2,
                'transaction_id' => 'CN'.rand(),
                'user_id' => $giver->id
            ]);           

            $giver_coins_balance = CoinTransaction::where('user_id', Auth::user()->id)
                                            ->where('coin_id', $request->coin_id)
                                            ->sum('number_of_coins'); 

            Transaction::create([
                'user_id' => Auth::user()->id,
                'trans_id' => rand(),
                'time' => Carbon::now(),
                'description' => 'COIN TRANSFER'. '#ID'.'-'.$coin->transaction_id,
                'amount' => '-'.$coin_rate*$request->coins,
                'new_balance' => $giver->balance,
                'type' => 6
            ]);

            $general = General::first();

            $message ='Thank you! Your coins transfer process is complete.Your transfer coins : '.$request->coins. 'Your current balance is '.$giver->balance.'';

            send_email($giver->email, 'Coins Transfer Complete' ,$giver->first_name, $message);



            $message ='Congratulation! Your coins add process is complete.
        '.$giver->first_name.' '.$giver->last_name.' transfer '.$request->coins.' to your account.</p>';

            send_email($receiver['email'], 'Coins Add Complete' ,$receiver['first_name'], $message);

         //   return redirect()->back()->with('message', 'Coins Transfer Success');
            return response()->json(['success' => true, 'balance' => $giver->balance, 'coin_balance' => $giver_coins_balance]);
        }
    }

    public function coinTransactions()
    {
        $coins = CoinTransaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('client.coin.coin-transactions', compact('coins'));
    }

}
