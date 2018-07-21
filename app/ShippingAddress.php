<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'user_id', 
        'fname', 
        'lname',
        'company', 
        'country', 
        'street_address',
        'city', 
        'post_code',
    ];
}
