<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchedulePayment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_amount',
        'due_date',
        'payment_no',
        'status'
    ];
}
