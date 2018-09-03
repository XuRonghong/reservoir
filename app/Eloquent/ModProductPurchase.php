<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModProductPurchase extends Model
{
    public $timestamps = false;
    protected $connection = 'center';
    protected $table = 'mod_product_purchase';
    protected $primaryKey = 'iId';

}
