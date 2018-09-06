<?php
// php artisan make:migration create_sys_member_info_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysMemberInfo;

class CreateSysMemberInfoTable extends Migration
{
    protected $table = 'sys_member_info';

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
                $table->integer( 'iMemberId' )->unique();
                $table->string( 'vUserImage', 255 )->nullable();
                $table->string( 'vUserName', 255 )->nullable();
                $table->string( 'vUserNameE', 255 )->nullable();
                $table->string( 'vUserTitle', 255 )->nullable();
                $table->string( 'vUserID', 255 )->nullable();
                $table->integer( 'iUserBirthday' )->default( 0 );
                $table->string( 'vUserEmail', 255 )->nullable();
                $table->string( 'vUserContact', 255 )->nullable();
                $table->string( 'vUserZipCode', 255 )->nullable();
                $table->string( 'vUserCity', 255 )->nullable();
                $table->string( 'vUserArea', 255 )->nullable();
                $table->string( 'vUserAddress', 255 )->nullable();
            } );
            $data_arr = [
                [
                    "vUserImage" => env('APP_URL') . "/images/admin.jpg",
                    "vUserName" => "Admin",
                    "vUserEmail" => "admin@kahap.com",
                    "vUserContact" => ""
                ],
                [
                    "vUserImage" => env('APP_URL') . "/images/manager.jpg",
                    "vUserName" => "Manager",
                    "vUserEmail" => "kahap@kahap.com",
                    "vUserContact" => ""
                ],
                [
                    "vUserImage" => env('APP_URL') . "/images/manager.jpg",
                    "vUserName" => "Kahap",
                    "vUserEmail" => "admin@kahap.com",
                    "vUserContact" => ""
                ],
            ];
            $iMemberId = 1;
            foreach ($data_arr as $key => $var) {
                $Dao = new SysMemberInfo ();
                $Dao->iMemberId = $iMemberId;
                $Dao->vUserImage = $var ['vUserImage'];
                $Dao->vUserName = $var ['vUserName'];
                $Dao->vUserEmail = $var ['vUserEmail'];
                $Dao->vUserContact = $var ['vUserContact'];
                $Dao->save();
                $iMemberId++;
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
