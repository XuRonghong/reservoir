<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModInstructionsField extends Migration
{
    protected $table = 'mod_instructions';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable( $this->table )) {
            //
            Schema::table($this->table, function (Blueprint $table) {
                $table->integer('iReservoir')->nullable();
                $table->integer("iSource")->nullable();
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
            Schema::table($this->table , function (Blueprint $table) {
                //
                $table->dropColumn('iReservoir');
                $table->dropColumn('iSource');
            });
        }
    }
}
