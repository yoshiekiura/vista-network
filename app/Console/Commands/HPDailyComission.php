<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ChargeCommision;
use App\HpTransaction;
use App\HpCommission;
use App\User;
use Carbon\Carbon;
use Auth;

class HPDailyComission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:hpcomission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pay buyer of HP daily comission';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    
        $comission_rate = ChargeCommision::where('id', 1)->value('hp_commission');
        $hashpower = HpTransaction::where('status', 1)->get();
        
        foreach($hashpower as $hp){

            $comission_amount = ($comission_rate / 100) * $hp->price;

            HpCommission::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $hp->transaction_id,
                'commission_rate' => $comission_rate,
                'commission_date' => Carbon::now(),
                'commission_amount' => $comission_amount ,
                'description' => 'HP Daily Commission'
            ]);

            $user_hp_balance = User::where('id', $hp->user_id)->value('hp_balance');
            $new_hp_balance = $user_hp_balance + $comission_amount; 

            User::whereId($hp->user_id)
                ->update([
                    'hp_balance' => $new_hp_balance
            ]);
        }
    }
}











