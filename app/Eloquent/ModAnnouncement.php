<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModAnnouncement extends Model
{
    public $timestamps = false;
    protected $table = 'mod_announcement';
    protected $primaryKey = 'iId';

}
