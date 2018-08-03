<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HpTransaction extends Model
{
    protected $table = 'hp_transactions';

    protected $fillable = [
        'transaction_id','product_id','user_id','qty','price','total','status'
    ];

    public function memberrr()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }

    public function hashproduct()
    {
        return $this->hasOne(HashPower::class, 'id', 'product_id')->withDefault();
    }

}
