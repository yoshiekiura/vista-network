<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('web_title');
            $table->string('currency');
            $table->string('symbol');
            $table->string('message');
            $table->string('email');
            $table->string('mobile');
            $table->string('status');
            $table->string('about_text');
            $table->string('image')->nullable();
            $table->string('theme');
            $table->string('about_video_link');
            $table->string('footer');
            $table->string('footer_text');
            $table->longText('policy');
            $table->longText('terms');
            $table->text('address');
            $table->text('google_map_address');
            $table->date('start_date');
            $table->text('smsapi');
            $table->boolean('emailver');
            $table->boolean('smsver');
            $table->longText('emessage');
            $table->string('esender');
            $table->string('sec_color');
            $table->boolean('email_nfy')->default(0);
            $table->boolean('sms_nfy')->default(0);
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
        Schema::dropIfExists('generals');
    }
}
