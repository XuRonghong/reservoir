<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysMemberInfo extends Model
{
    public $timestamps = false;
    protected $table = 'sys_member_info';
    protected $primaryKey = 'iMemberId';

    /*
     *
     */
    static function getMemberInfo ( $iId )
    {
        $Dao = SysMemberInfo::find( $iId );
        return $Dao;
    }
}
