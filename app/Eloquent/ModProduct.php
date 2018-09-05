<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModProduct extends Model
{
    public $timestamps = false;
    protected $table = 'mod_product';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public static function getProductById ( $id, $spec_id = 0 )
    {
        $product['meta'] = self::join( 'mod_product_info', function( $join ) {
            $join->on( 'mod_product_info.iProductId', '=', 'mod_product.iId' );
        } )->join( 'mod_product_price', function( $join ) {
            $join->on( 'mod_product_price.iProductId', '=', 'mod_product.iId' );
        } )->find( $id );
        if ($product['meta']) {
            $mapAttributes['iProductId'] = $id;
            $product['attributes'] = ModProductAttributes::where( $mapAttributes )->get();
            //
            $mapSpec['iProductId'] = $id;
            $mapSpec['bDel'] = 0;
            if ($spec_id) {
                $product['spec'] = ModProductSpec::where( $mapSpec )->find( $spec_id );
            } else {
                $product['spec'] = ModProductSpec::where( $mapSpec )->first();
            }

            return $product;
        } else {
            return false;
        }
    }

    static function checkCategory ( $category_id )
    {
        $data['iCategoryId'] = 0;
        self::where( 'iCategoryId', $category_id )->update( $data );
    }
}
