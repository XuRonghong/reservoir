<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysSetting extends Model
{
    public $timestamps = false;
    protected $table = 'sys_setting';
    protected $primaryKey = 'iId';
    
}
