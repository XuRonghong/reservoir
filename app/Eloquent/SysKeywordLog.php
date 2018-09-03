<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysKeywordLog extends Model
{
    public $timestamps = false;
    protected $table = 'sys_keyword_log';
    protected $primaryKey = 'iId';
}
