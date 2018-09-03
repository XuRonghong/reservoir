<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModOrderAddressee extends Model
{
    public $timestamps = false;
    protected $table = 'mod_order_addressee';
    protected $primaryKey = 'iId';

}
