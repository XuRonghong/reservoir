<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModPayServiceOrderLog extends Model
{
    public $timestamps = false;
    protected $table = 'mod_pay_service_order_log';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
