<?php

// php artisan make:migration create_mod_cart_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModCartTable extends Migration
{
    protected $table = 'mod_cart';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        if ( !Schema::hasTable( $this->table )) {
            //
            Schema::create( $this->table, function( Blueprint $table ) {
                $table->increments( 'iId' );
                $table->string( 'vSessionId' );
                $table->integer( 'iStoreId' )->default( 0 );
                $table->integer( 'iMemberId' )->default( 0 );
                $table->integer( 'iProductId' )->default( 0 );
                $table->integer( 'iSpecId' )->default( 0 );
                $table->integer( 'iCount' )->default( 1 );
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->tinyInteger( 'bDel' )->default( 0 );
            } );
        } else {

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        //
        if (env( 'DB_REFRESH', false )) {
            Schema::dropIfExists( $this->table );
        }
    }
}
