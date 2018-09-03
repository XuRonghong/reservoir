<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModReservoirInfo extends Model
{
    public $timestamps = false;
    protected $table = 'mod_reservoir_info';
    protected $primaryKey = 'iId';
    protected $fillable = [
        'iReservoirId', 'iRank', 'iType', 'vCode', 'vImages', 'vSafe', 'iSafeValue',
        'iCreateTime', 'iUpdateTime', 'iSum','iStatus','bDel'
    ];

}
