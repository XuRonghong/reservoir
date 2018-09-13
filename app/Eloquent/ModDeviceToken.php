<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModDeviceToken extends Model
{
    //
    public $timestamps = false;
    protected $table = 'mod_device_token';
    protected $primaryKey = 'iId';
}
