<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModReservoirMeta extends Model
{
    public $timestamps = false;
    protected $table = 'mod_reservoir_meta';
    protected $primaryKey = 'iId';
    protected $fillable = [
        'iRank', 'vStructure', 'vLevel', 'iHeight', 'iStoreTotal', 'vGrade', 'vTrustRegion', 'vNumber', 'vNet', 'vAreaCode',
        'iCreateTime', 'iUpdateTime', 'iSum','iStatus','bDel'
    ];

}
