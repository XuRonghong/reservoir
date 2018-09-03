<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModOrderInfo extends Model
{
    public $timestamps = false;
    protected $table = 'mod_order_info';
    protected $primaryKey = 'vOrderNum';

}
