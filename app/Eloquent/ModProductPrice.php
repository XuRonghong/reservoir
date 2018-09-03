<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModProductPrice extends Model
{
    public $timestamps = false;
    protected $table = 'mod_product_price';
    protected $primaryKey = 'iProductId';

}
