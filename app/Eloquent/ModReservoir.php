<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModReservoir extends Model
{
    public $timestamps = false;
    protected $table = 'mod_reservoir';
    protected $primaryKey = 'iId';
    protected $fillable = [
        'iRank', 'iType', 'vCode', 'vRegion', 'vName', 'vLocation',
        'vCounty', 'iCreateTime', 'iUpdateTime', 'iSum','iStatus','bDel'
    ];

}
