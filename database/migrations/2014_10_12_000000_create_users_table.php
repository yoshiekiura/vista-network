<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('referrer_id')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('position')->nullable();
            $table->string('first_name');
            $table->string('last_name');    
            $table->string('ssn')->nullable();
            $table->string('balance')->nullable();
            $table->float('hp_balance', 8,2)->nullable();
            $table->integer('coin_balance')->nullable();
            $table->string('join_date');
            $table->string('status');
            $table->string('paid_status')->nullable();
            $table->string('ver_status')->nullable();
            $table->string('ver_code')->nullable();
            $table->string('forget_code')->nullable();
            $table->date('birth_day')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
