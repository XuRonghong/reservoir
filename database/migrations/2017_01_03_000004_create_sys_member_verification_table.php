<?php
// php artisan make:migration create_sys_member_verification_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysMemberVerificationTable extends Migration
{
    protected $table = 'sys_member_verification';

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
                $table->integer( 'iMemberId' );
                $table->string( 'vVerification', 50 );
                $table->integer( 'iStartTime' );
                $table->integer( 'iEndTime' );
                $table->tinyInteger( 'iStatus' )->default( 0 );
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
