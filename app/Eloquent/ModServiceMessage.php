<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModServiceMessage extends Model
{
    public $timestamps = false;
    protected $table = 'mod_service_message';
    protected $primaryKey = 'iId';

}
