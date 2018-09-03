<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModNews extends Model
{
    public $timestamps = false;
    protected $table = 'mod_news';
    protected $primaryKey = 'iId';

}
