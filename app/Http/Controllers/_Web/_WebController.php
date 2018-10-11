<?php
// debugbar()->meta($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
//Logs
//$this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );

namespace App\Http\Controllers\_Web;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncController;
use App\LogAction;
use App\LogOrder;
use App\SysMenu;
use App\SysMember;
use App\SysMemberInfo;
use App\SysGroupMember;
use Jenssegers\Agent\Agent;
use App\ModEvent;
use App\ModMessage;
use App\ModTraceCheck;
use App\ModRecord;
use App\ModReservoirMeta;
use App\ModReservoir;
use App\ModReservoirInfo;


class _WebController extends Controller
{
    protected $vTitle = '水庫管理系統';
    protected $func;
    protected $view;
    protected $sys_menu;
    protected $breadcrumb = [];
    protected $module;
    protected $agent;
    /* message category */
    protected $message_total = 0;
    protected $comment_total = 0;
    protected $Permission = [];
    protected $ReservoirType = [];


    /*
     *
     */
    function __construct ()
    {
        $this->vTitle = '水庫安全資訊管理系統';
        session()->put( 'SEO.vTitle' , $this->vTitle );
    }


    /*
     *
     */
    public function _init ()
    {
        $this->Permission = [
            '2'     =>  '網站系統管理員',
            '10'    =>  '管理局-承辦人員',
            '20'    =>  '管理局-中階主管',
            '30'    =>  '管理局-高階主管',
            '40'    =>  '水利署-承辦人員',
            '50'    =>  '水利署-中階主管',
            '60'    =>  '水利署-高階主管',
        ];
        $this->ReservoirType = [
//            0    =>  'type 0',
            1    =>  'type 1',
            2    =>  'type 2',
            3    =>  'type 3',
            4    =>  'type 4',
            5    =>  'type 5',
        ];
    }

    /*
     *
     */
    public function __initial ()
    {
        $this->view = View()->make( config( '_menu.' . $this->func . '.view' ) );
        session()->put( 'menu_parent', config( '_menu.' . $this->func . '.menu_parent' ) );
        session()->put( 'menu_access', config( '_menu.' . $this->func . '.menu_access' ) );
        $mapSysMenu ['bOpen'] = 1;
        $DaoSysMenu = SysMenu::query()->where( $mapSysMenu )->orderBy( 'iRank', 'ASC' )->get();
        $this->sys_menu = $DaoSysMenu->where('iParentId', '=', 0);
        foreach ($this->sys_menu as $key => $var) {
            if ($var->bSubMenu) {
                $var->second = $DaoSysMenu->where('iParentId', '=', $var->iId);
                foreach ($var->second as $key2 => $var2) {
                    if ($var2->bSubMenu) {
                        $var2->third = $DaoSysMenu->where('iParentId', '=', $var2->iId);
                    }
                }
            }
        }
        $this->view->with( 'sys_menu', $this->sys_menu );
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
    }

    /*
     * $action : 1.add 2.edit 3.delete
     * $value : field->value
     */
    public function _saveLogAction ( $table_name, $table_id, $action, $value )
    {
        $DaoLogAction = new LogAction();
        $DaoLogAction->iMemberId = session( 'member.iId' );
        $DaoLogAction->vTableName = $table_name;
        $DaoLogAction->iTableId = $table_id;
        $DaoLogAction->vAction = $action;
        $DaoLogAction->vValue = $value;
        $DaoLogAction->iDateTime = time();
        $DaoLogAction->save();
    }

    /*
     * $action :
     * $value :
     */
    public function _saveLogOrder ( $order_num, $action, $value )
    {
        $DaoLogAction = new LogOrder();
        $DaoLogAction->iMemberId = session( 'member.iId', 0 );
        $DaoLogAction->vUserName = session( 'member.vUserName', 'system' );
        $DaoLogAction->vOrderNum = $order_num;
        $DaoLogAction->vAction = $action;
        $DaoLogAction->vValue = $value;
        $DaoLogAction->iDateTime = time();
        $DaoLogAction->vCreateIP = Request::ip();
        $DaoLogAction->save();
    }


    /*
     * 丟檔案id取得圖片檔路徑 get()
     */
    public function getPictureWithId ( $Dao )
    {
        if ( !isset($Dao) ) return "No data input";

        foreach ($Dao as $key => $var) {
            //圖片
            $image_arr = [];
            if ($var->vImages) {
                $tmp_arr = explode(';', $var->vImages);
                $tmp_arr = array_filter($tmp_arr);
                foreach ($tmp_arr as $item) {
                    $image_arr[] = FuncController::_getFilePathById($item);
                }
                if ($tmp_arr) {
                    $var->vImages = $image_arr;
                } else {
                    $var->vImages = [];
                }
            }
            //手機圖片
            $image_arr = [];
            if ($var->vImagesMobile) {
                $tmp_arr = explode(';', $var->vImagesMobile);
                $tmp_arr = array_filter($tmp_arr);
                foreach ($tmp_arr as $item) {
                    $image_arr[] = FuncController::_getFilePathById($item);
                }
                if ($tmp_arr) {
                    $var->vImagesMobile = $image_arr;
                } else {
                    $var->vImagesMobile = [];
                }
            }
        }

        return null;
    }

    /*
     * 丟檔案id取得圖片檔路徑 first()
     */
    public function firstPictureWithId ( $DaoFirst )
    {
        if ( !isset($DaoFirst) ) return "No data input only one";

        //圖片
        $image_arr = [];
        if ($DaoFirst->vImages) {
            $tmp_arr = explode(';', $DaoFirst->vImages);
            $tmp_arr = array_filter($tmp_arr);
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById($item);
            }
        }
        if ($tmp_arr) {
            $DaoFirst->vImages = $image_arr;
        } else {
            $DaoFirst->vImages = [];
        }
        //手機圖片
        $image_arr = [];
        if ($DaoFirst->vImagesMobile) {
            $tmp_arr = explode(';', $DaoFirst->vImagesMobile);
            $tmp_arr = array_filter($tmp_arr);
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById($item);
            }
        }
        if ($tmp_arr) {
            $DaoFirst->vImagesMobile = $image_arr;
        } else {
            $DaoFirst->vImagesMobile = [];
        }

        return null;
    }


    /*
     *
     */
    protected function gotosuperdo ($DaoMember)
    {
        //紀錄登入時間與識別碼
        $DaoMember->vSessionId = session()->getId();
        $DaoMember->iLoginTime = time();
        $DaoMember->save();

        // session
        $DaoMemberInfo = SysMemberInfo::query()->find( $DaoMember->iId );
        // Member
        session()->put( 'member', json_decode( json_encode( $DaoMember ), true ) );
        // MemberInfo
        session()->put( 'member.meta', json_decode( json_encode( $DaoMemberInfo ), true ) );

        //
        FuncController::_addLog( 'login' );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' ) ;
        $this->rtndata ['rtnurl'] =  url('web/member');

        return response()->json( $this->rtndata );
    }


    /*
     * get ModMessage list
     */
    public function getDaoMessage ($set_check = true)
    {
        //
        $mapMessage['iStatus'] = 1;
        $mapMessage['bDel'] = 0;
        if ($set_check) $mapMessage['iCheck'] = session('member.iAcType') < 10 ? 0 : session('member.iAcType') - 10;
        $DaoMessage = ModMessage::query()->where($mapMessage)
            ->where('iHead' , '>', session('member.iAcType'))
            ->orderBy('iCreateTime' , 'desc')
            ->get();
        if ($DaoMessage){
            foreach ($DaoMessage as $var){
                $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
                $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
                //分類 : 大於50是 訊息  小於50是地震通知
                if ($var->iType > 50){
                    $this->message_total ++ ;
                } else {
                    $this->comment_total ++ ;
                }
            }
        }

        return $DaoMessage;
    }
}
