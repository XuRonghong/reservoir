<?php

// php artisan make:migration create_sys_setting_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysSettingTable extends Migration
{
    protected $table = 'sys_setting';

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
                $table->integer( 'iType' )->default( 1 );

                $table->string( 'vLang', 255 )->default( "zh-tw" );
                $table->string( 'vTitle', 255 )->nullable();
                $table->string( 'vUrl', 255 )->nullable();
                $table->string( 'vCss', 255 )->nullable();
                $table->string( 'vImage', 255 )->nullable();
                $table->longText( 'vDetail' )->nullable();

                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->tinyInteger( 'iStatus' )->default( 0 );
                $table->tinyInteger( 'bDel' )->default( 0 );
            } );

        } else {
            if ( !Schema::hasColumn( $this->table, 'iId' )) {
                Schema::table( $this->table, function( $table ) {
                    $table->increments( 'iId' );
                } );
            } else {

            }
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
