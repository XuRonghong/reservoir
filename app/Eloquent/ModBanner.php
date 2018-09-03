<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModBanner extends Model
{
    public $timestamps = false;
    protected $table = 'mod_banner';
    protected $primaryKey = 'iId';
    protected $fillable = [
        'iMenuId', 'iType', 'vTitle', 'vLang', 'vSummary', 'vImages', 'vUrl', 'vDetail', 'iStartTime', 'iEndTime', 'iCreateTime', 'iUpdateTime'
    ];
    
}
