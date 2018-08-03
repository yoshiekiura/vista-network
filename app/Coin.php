<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $table = 'coins';
    protected $fillable = [
        'name',
        'image',
        'min_coins',
        'rate',
        'status',
    ];

    public function cointransaction()
    {
        return $this->belongsTo(CoinTransaction::class)->withDefault();
    }
}
