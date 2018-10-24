<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModHistory extends Model
{
    public $timestamps = false;
    protected $table = 'mod_history';
    protected $primaryKey = 'iId';
}
