<?php
// php artisan make:migration create_sys_member_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysMember;
use Illuminate\Http\Request;

class CreateSysMemberTable extends Migration
{
    protected $table = 'sys_member';

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
                $table->integer( 'iRank' )->nullable();
                $table->string( 'vAgentCode', 20 )->comment('代理商代码');
                $table->integer( 'iUserId' )->unique()->comment('會員編號');
                $table->string( 'vUserCode', 64 )->unique()->comment('會員代號');
                $table->integer( "iAcType" )->comment('存取權限');
                $table->string( 'vAccount', 50 )->unique();
                $table->string( 'vPassword', 255 );
                $table->string( 'vCreateIP', 255 )->comment('註冊的網路位置');
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->string( 'vSessionId' )->nullable();
                $table->integer( 'iLoginTime' )->default( 0 );
                $table->tinyInteger( 'bActive' )->default( 0 );
                $table->tinyInteger( 'iStatus' )->default( 0 );
            } );
            $data_arr = [
                [
                    "iAcType" => 1,
                    "vAccount" => "admin@kahap.com"
                ],
                [
                    "iAcType" => 2,
                    "vAccount" => "manager@kahap.com"
                ],
                [
                    "iAcType" => 2,
                    "vAccount" => "ronghong@kahap.com"
                ],
            ];
            $iUserId = 1000000001;
            foreach ($data_arr as $key => $var) {
                $str = md5( uniqid( mt_rand(), true ) );
                $uuid = substr( $str, 0, 8 ) . '-';
                $uuid .= substr( $str, 8, 4 ) . '-';
                $uuid .= substr( $str, 12, 4 ) . '-';
                $uuid .= substr( $str, 16, 4 ) . '-';
                $uuid .= substr( $str, 20, 12 );
                //
                $Dao = new SysMember ();
                $Dao->vAgentCode = "KAP10001";
                $Dao->iUserId = $iUserId;
                $Dao->vUserCode = $uuid;
                $Dao->iAcType = $var ['iAcType'];
                $Dao->vAccount = $var ['vAccount'];
                $Dao->vPassword = hash( 'sha256', $Dao->vAgentCode .  "abc123"  . $Dao->vUserCode );
                $Dao->vCreateIP = env('APP_URL', '127.0.0.1');
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->bActive = 1;
                $Dao->iStatus = 1;
                $Dao->save();
                $iUserId++;
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
