<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModData extends Model
{
    //
    public $timestamps = false;
    protected $table = 'mod_data';
    protected $primaryKey = 'iId';
}
