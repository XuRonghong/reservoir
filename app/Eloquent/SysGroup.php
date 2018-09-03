<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysGroup extends Model
{
    public $timestamps = false;
    protected $table = 'sys_group';
    protected $primaryKey = 'iId';
    protected $fillable = [
        'iMemberId', 'iManagerId', 'iGroupType', 'vGroupCode', 'vGroupName', 'iLimitCount', 'iCreateTime', 'iUpdateTime'
    ];

}
