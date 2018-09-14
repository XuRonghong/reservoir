<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModMessage extends Model
{
    public $timestamps = false;
    protected $table = 'mod_message';
    protected $primaryKey = 'iId';

}
