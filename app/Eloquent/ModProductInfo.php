<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModProductInfo extends Model
{
    public $timestamps = false;
    protected $table = 'mod_product_info';
    protected $primaryKey = 'iProductId';

}
