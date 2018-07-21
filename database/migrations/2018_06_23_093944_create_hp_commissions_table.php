<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('commission_rate');
            $table->date('commission_date');
            $table->float('commission_amount', 8,2);
            $table->text('description');
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
        Schema::dropIfExists('hp_commissions');
    }
}
