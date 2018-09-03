<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModPayServiceIdcardPlace extends Model
{
    public $timestamps = false;
    protected $table = 'mod_pay_service_idcard_place';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
