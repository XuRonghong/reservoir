<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModReservoirMetaTable extends Migration
{
    protected $table = 'mod_reservoir_meta';

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
                $table->string('vStructure', 128)->nullable()->comment('蓄水建造物');
                $table->string('vLevel', 32)->nullable()->comment('災害潛勢');
                $table->integer('iHeight')->nullable()->comment('壩高(m)');
                $table->integer('iStoreTotal')->nullable()->comment('總蓄水量 (萬m3) ');
                $table->string('vGrade', 16)->nullable()->comment('分級');
                $table->string('vTrustRegion', 32)->nullable()->comment('責任區');
                $table->string('vNumber', 64)->nullable()->comment('站碼');
                $table->string('vNet', 32)->default('WR')->comment('NET');
                $table->string('vAreaCode', 32)->default('00')->comment('區碼');
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
