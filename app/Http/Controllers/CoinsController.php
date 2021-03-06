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
use Mail;
use App\Mail\CoinPurchaseEmail;
use App\Mail\CoinSellEmail;
use App\Mail\CoinTransferEmail;
use App\Mail\CoinReceiveEmail;

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
        $coin_rate = Coin::where('id', $request->coin_id)->value('rate');
        $coin_amount = $request->coins * $coin_rate;

        if(Auth::user()->balance > $coin_amount){

            $coin = CoinTransaction::create([
               'coin_id' => $request->coin_id,
               'number_of_coins' => $request->coins,
               'rate' => $coin_rate,
               'amount' => $coin_amount,
               'status' => 1,
               'transaction_id' => 'CN'.rand(),
               'user_id' => Auth::user()->id,
            ]);

        //    $total =  $request->total;
            $coin_name = Coin::where('id', $request->coin_id)->value('name');

            $new_balance = Auth::user()->balance - $coin_amount;

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
                'amount' => '-'.$coin_amount,
                'new_balance' => $new_balance,
                'type' => 4,
            ]);

            $general = General::first();
            $user = User::find(Auth::user()->id);

            $objCoin = new \stdClass();
            $objCoin->first_name = $user->first_name;
            $objCoin->trans_id = $coin->transaction_id;
            $objCoin->coin_name = $coin_name;
            $objCoin->coin_number = $request->coins;
            $objCoin->coin_rate = $coin_rate;
            $objCoin->coin_balance = $new_coins_balance;

            Mail::to($user->email)->send(new CoinPurchaseEmail($objCoin));

          //  return redirect('home')->with('message', 'Coins Purchase Request Success.');
            return response()->json(['status' => true, 'balance' => $new_balance, 'coin_balance' => $new_coins_balance]);
        }else{
            return response()->json(['status' => false ]);
        }

    }

    public function coinsWithdraw(Request $request)
    {

        $coin_balance = CoinTransaction::where('user_id', Auth::user()->id)
                                        ->where('coin_id', $request->coin_id)
                                        ->sum('number_of_coins');

        if($coin_balance > $request->coins) {                                

            $coin_rate = Coin::where('id', $request->coin_id)->value('rate');
            $coin_amount = $request->coins * $coin_rate;

            $coins_num = '-' . $request->coins;

            $coin = CoinTransaction::create([
               'coin_id' => $request->coin_id,
               'number_of_coins' => $coins_num,
               'rate' => $coin_rate,
               'amount' => '-'.$coin_amount,
               'status' => 0,
               'transaction_id' => 'CN'.rand(),
               'user_id' => Auth::user()->id,
            ]);

            $coin_name = Coin::where('id', $request->coin_id)->value('name');

            $new_balance = Auth::user()->balance + $coin_amount;

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
                'amount' => $coin_amount,
                'new_balance' => $new_balance,
                'type' => 5,
            ]);

            $general = General::first();
            $user = User::find(Auth::user()->id);

            $objCoin = new \stdClass();
            $objCoin->first_name = $user->first_name;
            $objCoin->trans_id = $coin->transaction_id;
            $objCoin->coin_name = $coin_name;
            $objCoin->coin_number = $request->coins;
            $objCoin->coin_rate = $request->rate;
            $objCoin->coin_balance = $new_coins_balance;

            Mail::to($user->email)->send(new CoinSellEmail($objCoin));

        //    return redirect('home')->with('message', 'Coins Withdraw Request Success.');
            return response()->json(['status' => true, 'balance' => $new_balance, 'coin_balance' => $new_coins_balance]);
        }else{
            return response()->json(['status' => false]);
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
            $coin_name = Coin::where('id', $request->coin_id)->value('name');

            $receiver = User::find($request->username);

            $coin = CoinTransaction::create([
                'transaction_id' => 'CN'.rand(),
                'coin_id' => $request->coin_id,
                'user_id' => $receiver->id,
                'number_of_coins' => $request->coins,
                'rate' => $coin_rate,
                'amount' => $coin_rate*$request->coins,
                'status' => 3
            ]);

            $giver = User::findOrFail(Auth::user()->id);
            $giver->balance = $giver->balance - ($coin_rate*$request->coins);
            $giver->update();
            
            CoinTransaction::create([
                'transaction_id' => 'CN'.rand(),
                'coin_id' => $request->coin_id,
                'user_id' => $giver->id,
                'number_of_coins' => '-'.$request->coins,
                'rate' => $coin_rate,
                'amount' => '-'.$coin_rate*$request->coins,
                'status' => 2
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

            $objCoin = new \stdClass();
            $objCoin->giver_first_name = $giver->first_name;
            $objCoin->giver_last_name = $giver->last_name;
            $objCoin->receiver_first_name = $receiver->first_name;
            $objCoin->receiver_last_name = $receiver->last_name;
            $objCoin->trans_id = $coin->transaction_id;
            $objCoin->coin_name = $coin_name;
            $objCoin->coin_number = $request->coins;
            $objCoin->coin_balance = $giver_coins_balance;

            Mail::to($giver->email)->send(new CoinTransferEmail($objCoin));

            Mail::to($receiver->email)->send(new CoinReceiveEmail($objCoin));

         //   return redirect()->back()->with('message', 'Coins Transfer Success');
            return response()->json(['success' => true, 'balance' => $giver->balance, 'coin_balance' => $giver_coins_balance]);
        }
    }

    public function coinTransactions()
    {
        $coins = CoinTransaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('client.coin.coin-transactions', compact('coins'));
    }

    public function coinTransactionDetails($id)
    {
        $coin = CoinTransaction::findOrFail($id);
        $coin_name = Coin::where('id', $coin->coin_id)->value('name');
        
        if($coin->status == 1){
            $status = 'Buy';
        }
        elseif($coin->status == 0){
            $status = 'Sell';   
        }
        elseif($coin->status == 2){
            $status = 'Transfer';   
        }
        elseif($coin->status == 3){
            $status = 'Received';   
        }
        elseif($coin->status == 4){
            $status = 'Admin Added';   
        }
        elseif($coin->status == 5){
            $status = 'Admin Deducted';   
        }

        return response()->json([
                                'success' => true, 
                                'trans_id' => $coin->transaction_id, 
                                'coin_name' => $coin_name,
                                'coin_num' => $coin->number_of_coins,
                                'coin_rate' => $coin->rate,
                                'coin_amount' => $coin->amount,
                                'status' => $status
                            ]);
    
    }

}
