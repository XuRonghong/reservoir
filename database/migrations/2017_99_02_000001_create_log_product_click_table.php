<?php
// php artisan make:migration create_log_product_click_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogProductClickTable extends Migration
{
    protected $table = "log_product_click";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        //
        if ( !Schema::hasTable( $this->table )) {
            //
            Schema::create( $this->table, function( Blueprint $table ) {
                $table->increments( 'iId' );
                $table->string( 'vSessionId' )->nullable()->default( 0 );
                $table->integer( 'iMemberId' )->nullable()->default( 0 );
                $table->integer( 'iClickType' )->nullable()->default( 0 ); //1.click 2.keep 3.cart
                $table->integer( 'iProductId' )->nullable()->default( 0 );
                $table->integer( 'iDateTime' )->nullable()->default( 0 );
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
