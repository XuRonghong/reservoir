<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAction extends Model
{
    public $timestamps = false;
    protected $table = 'log_action';
    protected $primaryKey = 'iId';
    
}
