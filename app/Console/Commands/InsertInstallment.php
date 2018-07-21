<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\PaymentInstallment;
use DB;

class InsertInstallment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InsertInstallment:insertinstallment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new installment';

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
        $install = PaymentInstallment::where('status', 1)->get();

        foreach($install as $in){

            DB::table('schedule_payments')->insert([
                'order_id' => $in->order_id,
                'payment_amount' => $in->installment,
                'due_date' => Carbon::now(),
                'payment_no' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()      
            ]);

        }
    }
}
