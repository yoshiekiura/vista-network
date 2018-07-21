<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargeCommision extends Model
{
    protected $table = 'charge_commisions';
    protected $fillable = [
        'transfer_charge',
        'withdraw_charge',
        'update_charge',
        'update_commision_tree',
        'update_commision_sponsor',
        'hp_commission',
        'hp_miner_bonus',
        'update_text'
    ];
}
