<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HpCommission extends Model
{
    protected $fillable = [
        'user_id', 'transaction_id','commission_rate','commission_date','commission_amount','description','status'
    ];
}
