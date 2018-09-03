<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModPayServiceSetting extends Model
{
    public $timestamps = false;
    protected $table = 'mod_pay_service_setting';
    protected $primaryKey = 'iPayServiceId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
