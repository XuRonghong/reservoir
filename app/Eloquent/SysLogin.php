<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysLogin extends Model
{
    public $timestamps = false;
    protected $table = 'sys_login';
    protected $primaryKey = 'iId';

}
