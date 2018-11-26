<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSysMemberAccess extends Migration
{
    protected $table = 'sys_member_access';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        if ( Schema::hasTable( $this->table )) {
            //
            Schema::table( $this->table, function( Blueprint $table ) {
                $table->integer( 'iTargetKey' )->default( 0 )->comment('目標id');
                $table->string( 'vDetail' )->default( '' )->comment('設定值(字元)');
                $table->integer( 'iNumber' )->default( '' )->comment('設定值(數字)');
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
            Schema::table($this->table , function (Blueprint $table) {
                //
                $table->dropColumn('iTargetKey');
                $table->dropColumn('vDetail');
                $table->dropColumn('iNumber');
            });
        }
    }
}
