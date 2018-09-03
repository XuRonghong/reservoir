<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModOrderInvoice extends Model
{
    public $timestamps = false;
    protected $table = 'mod_order_invoice';
    protected $primaryKey = 'vOrderNum';
    public $incrementing = false;

}
