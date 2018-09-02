<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferFund extends Model
{
    protected $table = 'transfer_funds';

    protected $fillable = [
        'transaction_id',
        'giver_id',
        'receiver_id',
        'amount',
        'charges',
        'status'
    ];

    public function giver()
    {
        return $this->hasOne(User::class, 'id', 'giver_id')->withDefault();
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id')->withDefault();
    }
}
