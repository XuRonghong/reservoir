<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModPayServiceTrade extends Model
{
    public $timestamps = false;
    protected $table = 'mod_pay_service_trade';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
