<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysGroupInfo extends Model
{
    public $timestamps = false;
    protected $table = 'sys_group_info';
    protected $primaryKey = 'iGroupId';
    
}
