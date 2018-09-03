<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysFiles extends Model
{
    public $timestamps = false;
    protected $table = 'sys_files';
    protected $primaryKey = 'iId';


    static function checkImages ( $images_arr )
    {
        if (is_array( $images_arr )) {
            self::whereIn( 'iId', $images_arr )->update( [ 'iStatus' => 1 ] );
        }
    }
}
