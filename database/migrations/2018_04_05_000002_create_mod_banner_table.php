<?php

// php artisan make:migration create_mod_banner_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModBannerTable extends Migration
{
    protected $table = 'mod_banner';

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
                $table->integer( 'iMemberId' );
                $table->integer( 'iMenuId' )->default( 0 )->comment('列表編號');
                $table->integer( 'iType' )->default( 0 )->comment('功能編號');
                $table->string( 'vTitle', 255 )->nullable()->comment('標題');
                $table->string( 'vLang', 20 )->nullable()->comment('語言');
                $table->string( 'vSummary', 255 )->nullable()->comment('簡介');
                $table->string( 'vImages', 255 )->nullable()->comment('圖片');
                $table->string( 'vImagesMobile', 255 )->nullable()->comment('手機圖片');
                $table->string( 'vUrl', 255 )->nullable()->comment('連結');
                $table->longText( 'vDetail' )->nullable()->comment('詳細');
                $table->integer( 'iStartTime' )->comment('開始時間');
                $table->integer( 'iEndTime' )->comment('結束時間');
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->integer( 'iStatus' )->default( 0 );
                $table->integer( 'iRank' )->default( 0 );
                $table->integer( 'bDel' )->default( 0 );
            } );
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
