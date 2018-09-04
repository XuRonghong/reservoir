<?php
// php artisan make:migration create_sys_files_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysFiles;

class CreateSysFilesTable extends Migration
{
    protected $table = 'sys_files';

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
                $table->tinyInteger( 'iType' )->default( 0 ); //1.S3原檔 2.local原檔 3.S3裁切 4.local裁切
                $table->string( 'vFileType', 255 );
                $table->string( 'vFileServer', 255 );
                $table->string( 'vFilePath', 255 );
                $table->string( 'vFileName', 255 );
                $table->string( 'vFileNameSource', 255 )->nullable();
                $table->integer( 'iFileSize' );
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->tinyInteger( 'iStatus' )->default( 0 );
                $table->tinyInteger( 'bDel' )->default( 0 );
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
