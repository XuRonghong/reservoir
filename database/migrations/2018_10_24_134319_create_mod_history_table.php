<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModHistoryTable extends Migration
{
    protected $table = 'mod_history';

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
                $table->integer('iRank')->nullable();
                $table->integer("iCategoryType")->nullable()->comment('系統類別');
                $table->integer("iType")->nullable()->comment('類別');
                $table->string('iMemberId', 128)->nullable()->comment('創造者');
                $table->string('vTitle', 32)->nullable();
                $table->string('vCode', 255)->nullable();
                $table->string('vFile', 255)->nullable();
                $table->string('vData', 64)->nullable();
                $table->integer('iNum' )->nullable();
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
