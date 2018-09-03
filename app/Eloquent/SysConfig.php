<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysConfig extends Model
{
    public $timestamps = false;
    protected $table = 'sys_config';
    protected $primaryKey = 'iId';

}
