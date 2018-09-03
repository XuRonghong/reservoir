<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysCategory extends Model
{
    public $timestamps = false;
    protected $table = 'sys_category';
    protected $primaryKey = 'iId';

    static function getCategory ( $iCategoryType, $iParentId )
    {
        $mapMuseum['iCategoryType'] = $iCategoryType;
        $mapMuseum['iParentId'] = $iParentId;

        return SysCategory::where( $mapMuseum )->get();
    }
}
