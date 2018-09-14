<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysLoginTable extends Migration
{
    protected $table = 'sys_login';

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
                $table->integer('iRank')->default(0)->nullable();
                $table->integer('iType' )->default( 0 );

                $table->integer('iMemberId')->nullable();
                $table->string('vIP' )->nullable();
                $table->string('vSessionId' )->nullable();
                $table->integer('iLoginTime')->nullable();

                $table->integer('iCreateTime');
                $table->integer('iUpdateTime');
//                $table->tinyInteger('iStatus')->default(1);
                $table->tinyInteger('bDel')->default(0);
            });
        } else {
            //
            Schema::table($this->table, function (Blueprint $table) {
                $table->increments('iId');
                $table->integer('iRank')->default(0)->nullable();
                $table->integer('iType' )->default( 0 );

                $table->integer('iMemberId')->nullable();
                $table->string('vIP' )->nullable();
                $table->string('vSessionId' )->nullable();
                $table->integer('iLoginTime')->nullable();

                $table->integer('iCreateTime');
                $table->integer('iUpdateTime');
//                $table->tinyInteger('iStatus')->default(1);
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
