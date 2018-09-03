<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModOrderCoupon extends Model
{
    public $timestamps = false;
    protected $table = 'mod_order_coupon';
    protected $primaryKey = 'vOrderNum';
    
}
