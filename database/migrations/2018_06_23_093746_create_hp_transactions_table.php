<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('transaction_id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('qty');
            $table->integer('price');
            $table->float('total', 8,2);
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
        Schema::dropIfExists('hp_transactions');
    }
}
