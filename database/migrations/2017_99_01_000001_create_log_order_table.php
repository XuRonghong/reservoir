<?php
// php artisan make:migration create_log_order_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogOrderTable extends Migration
{
    protected $table = "log_order";

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
                $table->integer( 'iMemberId' )->nullable();
                $table->string( 'vUserName', 255 )->nullable();
                $table->string( 'vOrderNum' );
                $table->string( 'vAction', 255 );
                $table->longText( 'vValue' )->nullable();
                $table->integer( 'iDateTime' );
                $table->string( 'vCreateIP', 255 )->nullable();
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
