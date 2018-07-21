<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->integer('product_id');
            $table->string('product_name')->nullable();
            $table->integer('product_price')->nullable();
            $table->string('duration');
            $table->integer('advance_payment');
            $table->integer('installment');
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
        Schema::dropIfExists('payment_installments');
    }
}
