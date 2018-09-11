<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModEvent extends Model
{
    public $timestamps = false;
    protected $table = 'event';
    protected $primaryKey = 'keyValue';
    protected $fillable = [
        'id', 'NET', 'LOCATION', 'eventTime', 'PGA',
    ];

}
