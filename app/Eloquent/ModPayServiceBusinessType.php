<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModPayServiceBusinessType extends Model
{
    public $timestamps = false;
    protected $table = 'mod_pay_service_business_type';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
