<?php
// php artisan make:migration create_log_login_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogLoginTable extends Migration
{
    protected $table = "log_login";

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
                $table->integer( 'iStoreId' )->nullable();
                $table->integer( 'iMemberId' )->nullable();
                $table->string( 'vAction', 255 )->nullable();
                $table->integer( 'iDateTime' );
                $table->string( 'vIP', 255 )->nullable();
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
