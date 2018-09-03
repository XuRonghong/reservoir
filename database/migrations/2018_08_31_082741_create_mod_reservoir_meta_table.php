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
                $table->string('vStructure', 128)->nullable();
                $table->string('vLevel', 32)->nullable();
                $table->integer('iHeight')->nullable();
                $table->integer('iStoreTotal')->nullable();
                $table->string('vGrade', 16)->nullable();
                $table->string('vTrustRegion', 32)->nullable();
                $table->string('vNumber', 64)->nullable();
                $table->string('vNet', 32)->default('WR');
                $table->string('vAreaCode', 32)->default('00');
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
