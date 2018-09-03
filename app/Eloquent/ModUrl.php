<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModUrl extends Model
{
    public $timestamps = false;
    protected $table = 'mod_url';
    protected $primaryKey = 'iId';
    protected $fillable = [
        'iMenuId', 'iType', 'vName', 'vLang', 'vCss', 'vUrl', 'iCreateTime', 'iUpdateTime'
    ];
    
}
