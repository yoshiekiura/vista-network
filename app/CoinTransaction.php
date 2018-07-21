<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinTransaction extends Model
{

    protected $table = 'coin_transactions';
    
    protected $fillable = [
        'transaction_id',
        'coin_id',
        'user_id',
        'number_of_coins',
        'rate',
        'amount',
        'status',
    ];

    public function member()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }

    public function coin()
    {
        return $this->hasOne(Coin::class, 'id', 'coin_id')->withDefault();
    }

}
