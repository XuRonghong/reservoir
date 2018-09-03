<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModOrder extends Model
{
    public $timestamps = false;
    protected $table = 'mod_order';
    protected $primaryKey = 'vOrderNum';
    public $incrementing = false;
    
}
