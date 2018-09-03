<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
//Logs
//$this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;
use App\LogAction;
use App\LogOrder;
use App\SysMenu;
use Illuminate\Support\Facades\Request;

class _WebController extends Controller
{
    public $func;
    public $view;
    public $sys_menu;
    public $breadcrumb = [];

    protected $agent;
    protected $device;
    protected $module;

    /*
     *
     */
    public function __construct ()
    {
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
        $DaoSysMenu = SysMenu::where( $mapSysMenu )->orderBy( 'iRank', 'ASC' )->get();
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
}
