<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModMessageTable extends Migration
{
    protected $table = 'mod_message';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable( $this->table )) {
            //
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('iId');
                $table->integer('iParentId')->default(0);
                $table->integer('iRank')->default(0)->nullable();
                $table->integer('iCategoryType' )->default( 0 );

                $table->integer('iType' )->default(5)->comment('通知分類');
                $table->integer('iSource')->default(0)->comment('發送者');
                $table->integer('iHead')->default(99)->comment('目標者');
                $table->string( 'vTitle', 63)->nullable()->comment('標頭');
                $table->string( 'vSummary', 127)->nullable()->comment('概要');
                $table->longText('vDetail' )->nullable()->comment('細節');
                $table->string( 'vReadman' )->nullable()->comment('已讀者');
                $table->string( 'vImages', 255 )->nullable()->comment('圖');
                $table->string( 'vNumber', 64)->nullable()->comment('編碼');
                $table->integer('iStartTime' )->default(0)->comment('起始');
                $table->integer('iEndTime' )->default(0)->comment('結束');
                $table->tinyInteger('iCheck')->default(0)->comment('已讀確認');

                $table->integer('iCreateTime');
                $table->integer('iUpdateTime');
                $table->tinyInteger('iStatus')->default(1);
                $table->tinyInteger('bDel')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if (env( 'DB_REFRESH', false )) {
            Schema::dropIfExists( $this->table );
        }
    }
}
