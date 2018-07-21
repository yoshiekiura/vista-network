<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('status');
            $table->string('mobile')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
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
        Schema::dropIfExists('product_shipments');
    }
}
