<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('coin_id');
            $table->integer('user_id');
            $table->integer('number_of_coins');
            $table->float('rate', 8,2);
            $table->float('amount', 8,2);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('coin_transactions');
    }
}
