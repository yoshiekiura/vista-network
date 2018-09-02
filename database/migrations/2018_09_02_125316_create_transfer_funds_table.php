<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_funds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('giver_id');
            $table->integer('receiver_id');
            $table->float('amount', 8,2);
            $table->float('charges', 8,2);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_funds');
    }
}
