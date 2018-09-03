<?php
// php artisan make:migration create_sys_member_info_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysMemberInfo;

class CreateSysGroupInfoTable extends Migration
{
    protected $table = 'sys_group_info';

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
                $table->integer( 'iGroupId' )->unique();
                $table->string( 'vGroupImage', 255 )->nullable()->comment('圖片');
                $table->string( 'vGroupTitle', 255 )->nullable()->comment('簡稱');
                $table->string( 'vGroupID', 255 )->nullable()->comment('統一編號');
                $table->integer( 'iGroupBirthday' )->default( 0 )->comment('創立日期');
                $table->string( 'vGroupEmail', 255 )->nullable()->comment('服務信箱');
                $table->string( 'vGroupEmailDomain', 255 )->nullable()->comment('信箱domain');
                $table->string( 'vGroupContact', 255 )->nullable()->comment('電話');
                $table->string( 'vGroupTax', 255 )->nullable()->comment('傳真');
                $table->string( 'vGroupZipCode', 255 )->nullable()->comment('郵遞區號');
                $table->string( 'vGroupAddress', 255 )->nullable()->comment('地址');
                $table->string( 'vGroupWebsite', 255 )->nullable()->comment('網址');
                $table->text( 'vGroupNote' )->nullable()->comment('附註');
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
