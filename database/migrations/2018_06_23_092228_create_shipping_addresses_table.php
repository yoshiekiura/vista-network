<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
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
        Schema::dropIfExists('shipping_addresses');
    }
}
