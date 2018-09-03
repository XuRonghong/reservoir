<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModProductHistory extends Model
{
    public $timestamps = false;
    protected $table = 'mod_product_history';
    protected $primaryKey = 'iId';
    
}
