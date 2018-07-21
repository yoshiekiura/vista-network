<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentFull extends Model
{
    protected $table = 'payment_fulls';

    protected $fillable = [
        'order_id',
        'total',
        'status',
    ];
}
