<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModPayServiceInfo extends Model
{
    public $timestamps = false;
    protected $table = 'mod_pay_service_info';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
