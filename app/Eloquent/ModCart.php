<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModCart extends Model
{
    public $timestamps = false;
    protected $table = 'mod_cart';
    protected $primaryKey = 'iId';

}
