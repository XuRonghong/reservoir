<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModActivitySchedule extends Model
{
    public $timestamps = false;
    protected $table = 'mod_activity_schedule';
    protected $primaryKey = 'iId';

}
