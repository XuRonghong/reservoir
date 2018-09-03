<?php
// php artisan make:migration create_sys_group_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysGroup;

class CreateSysGroupTable extends Migration
{
    protected $table = 'sys_group';

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
                $table->integer( 'iManagerId' );
                $table->integer( 'iGroupType' ); // 1.部門 2.店家 3.合作廠商
                $table->string( 'vGroupCode', 255 );
                $table->string( 'vGroupName', 255 );
                $table->integer( 'iLimitCount' );
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->tinyInteger( 'bPublic' )->default( 0 );
                $table->tinyInteger( 'iStatus' )->default( 0 );
                $table->tinyInteger( 'bDel' )->default( 0 );
            } );

            $data_arr = [
                [
                    "iId" => 1,
                    "iMemberId" => 1,
                    "iManagerId" => 1,
                    "iGroupType" => 3, //部門
                    "vGroupCode" => "Kapaphr",
                    "vGroupName" => "Kapaphr部門",
                    "iLimitCount" => 0
                ],
                [
                    "iId" => 2,
                    "iMemberId" => 1,
                    "iManagerId" => 1,
                    "iGroupType" => 4, //店家
                    "vGroupCode" => "Kapaphr",
                    "vGroupName" => "Kapaphr店家",
                    "iLimitCount" => 0
                ],
                [
                    "iId" => 3,
                    "iMemberId" => 1,
                    "iManagerId" => 1,
                    "iGroupType" => 5, //部落客
                    "vGroupCode" => "Kapaphr",
                    "vGroupName" => "Kapaphr部落客",
                    "iLimitCount" => 0
                ],
                [
                    "iId" => 4,
                    "iMemberId" => 1,
                    "iManagerId" => 1,
                    "iGroupType" => 6, //供應商
                    "vGroupCode" => "Kapaphr",
                    "vGroupName" => "Kapaphr供應商",
                    "iLimitCount" => 0
                ],
                [
                    "iId" => 5,
                    "iMemberId" => 1,
                    "iManagerId" => 1,
                    "iGroupType" => 99, //一般會員
                    "vGroupCode" => "Kapaphr",
                    "vGroupName" => "Kapaphr一般會員",
                    "iLimitCount" => 0
                ],
            ];
            foreach ($data_arr as $key => $var) {
                $Dao = new SysGroup ();
                $Dao->iId = $var ['iId'];
                $Dao->iMemberId = $var ['iMemberId'];
                $Dao->iManagerId = $var ['iManagerId'];
                $Dao->iGroupType = $var ['iGroupType'];
                $Dao->vGroupCode = $var ['vGroupCode'];
                $Dao->vGroupName = $var ['vGroupName'];
                $Dao->iLimitCount = $var ['iLimitCount'];
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->bPublic = 0;
                $Dao->iStatus = 1;
                $Dao->bDel = 0;
                $Dao->save();
            }
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
