<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModRecord extends Model
{
    public $timestamps = false;
    protected $table = 'mod_record';
    protected $primaryKey = 'iId';

}
