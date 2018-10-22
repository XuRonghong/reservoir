<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModInstructions extends Model
{
    public $timestamps = false;
    protected $table = 'mod_instructions';
    protected $primaryKey = 'iId';
}
