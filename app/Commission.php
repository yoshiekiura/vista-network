<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commissions';
    protected $fillable = [
        'user_id',
        'referrer_id',
        'order_id',
        'money_comm',
        'alxa_coin_comm',
        'vista_coin_comm',
        'description',
        'status',
    ];

    public function memberc()
    {
        return $this->hasOne(User::class, 'id', 'referrer_id')->withDefault();
    }
}
