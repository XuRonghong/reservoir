<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModShakemap extends Model
{
    public $timestamps = false;
    protected $table = 'shakemap';
    protected $primaryKey = 'keyValue';
    protected $fillable = [
        'id', 'NET', 'LOCATION', 'time', 'scale',
    ];

}
