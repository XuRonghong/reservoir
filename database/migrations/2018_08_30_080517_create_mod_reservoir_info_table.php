<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModReservoirInfoTable extends Migration
{
    protected $table = 'mod_reservoir_info';

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
                $table->integer('iReservoirId');
                $table->integer('iRank')->nullable()->comment('序次');
                $table->integer("iType")->nullable()->comment('水庫類別');
                $table->string('vCode', 255)->nullable();
                $table->text( 'vImages' )->nullable()->comment('水庫照片'); //圖片
                $table->string('vSafe', 64)->comment('');
                $table->integer('iSafeValue')->comment('安全值');
                $table->integer('iCreateTime');
                $table->integer('iUpdateTime');
                $table->integer('iSum')->default(0)->comment('總量');
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
