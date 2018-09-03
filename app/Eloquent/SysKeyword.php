<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysKeyword extends Model
{
    public $timestamps = false;
    protected $table = 'sys_keyword';
    protected $primaryKey = 'iId';
}
