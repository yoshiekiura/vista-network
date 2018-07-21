<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInstallment extends Model
{
    protected $table = 'payment_installments';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'duration',
        'advance_payment',
        'installment',
        'status',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->withDefault();
    }
}
