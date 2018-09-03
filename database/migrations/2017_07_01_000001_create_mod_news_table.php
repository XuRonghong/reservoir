<?php
// php artisan make:migration create_mod_news_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModNewsTable extends Migration
{
    protected $table = 'mod_news';

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
                $table->integer( 'iCategoryType' )->default( 0 );
                $table->string( 'vTitle', 255 )->nullable();
                $table->string( 'vSummary', 255 )->nullable();
                $table->string( 'vImages', 255 )->nullable();
                $table->string( 'vUrl', 255 )->nullable();
                $table->longText( 'vDetail' )->nullable();
                $table->integer( 'iStartTime' );
                $table->integer( 'iEndTime' );
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->integer( 'iStatus' )->default( 0 );
                $table->integer( 'iRank' )->default( 0 );
                $table->integer( 'bDel' )->default( 0 );
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
