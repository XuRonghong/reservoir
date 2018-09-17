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


    /*
     *
     */
    public function _init ()
    {


        // Message table
//        session()->put( 'message', json_decode( json_encode( $DaoEvent ), true ) );
//        foreach ($DaoEvent as $item){
//            $item->meta = ModReservoirMeta::query()->where('vNumber','=', $item->id)
//                ->select([
//                    'iRank',
//                    'vStructure',
//                    'vLevel',
//                    'iHeight',
//                    'iStoreTotal',
//                    'vGrade',
//                    'vTrustRegion',
//                    'vNumber',
//                    'vNet',
//                    'vAreaCode'])
//                ->first();
//            $item->reservoir = ModReservoir::query()->where('vName', 'LIKE', '%'.$item->meta->vStructure.'%')
//                ->leftJoin( 'mod_reservoir_info', function ($join) {
//                    $join->on('mod_reservoir.iId', '=', 'mod_reservoir_info.iReservoirId');
//                })
//                ->select([
//                    'mod_reservoir.vRegion',
//                    'mod_reservoir.vName',
//                    'mod_reservoir.vLocation',
//                    'mod_reservoir.vCounty',
//                    'mod_reservoir.iSum',
//                    'mod_reservoir_info.iType',
//                    'mod_reservoir_info.vCode',
//                    'mod_reservoir_info.vImages',
//                    'mod_reservoir_info.iSafeValue'])
//                ->first();
//        }




        /*
         *  判斷裝置手機版或電腦版
         */
//        $this->agent = new Agent();
//        if ( $this->agent->isMobile() && !$this->agent->isTablet() ) {
//            $this->view = View()->make( "_template_mobile." . implode( '.' , $this->module ) );


//        } else {
//            $this->view = View()->make( "_template_portal." . implode( '.' , $this->module ) );



//        }

//        $map['iStatus'] = 1;
//        $map['iId'] = session( 'member.iId' , '');
//        $DaoMem = SysMember::query()->where($map)->get();
//        $this->view->with( 'profile', $this->module );

        return ;
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
    public function getDaoMessage ()
    {
        //
        $mapMessage['iStatus'] = 1;
        $mapMessage['bDel'] = 0;
        $mapMessage['iHead'] = session('member.iId' , 0);
        $DaoMessage = ModMessage::query()->where($mapMessage)->get();
        if ($DaoMessage){
            foreach ($DaoMessage as $var){
                $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
                $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
            }
        }

        return $DaoMessage;
    }
}
