<?php
// debugbar()->meta($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\Scenes\Footer;

use App\Http\Controllers\_Web\_WebController;
use App\ModUrl;
use Illuminate\Http\Request;

class UrlController extends _WebController
{
    public $module = ['scenes', 'footer', 'url'];
    protected $iMenuId = 60401;

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            $this->module[0] => "#",
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->func = "web." . implode( '.', $this->module );
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $map['iMenuId'] = $this->iMenuId;
        $map['bDel'] = 0;
        $data_arr = ModUrl::where( $map )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iEndTime = date( 'Y/m/d', $var->iEndTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
	 *
	 */
    public function doAdd ( Request $request )
    {
        $map['iMenuId'] = $this->iMenuId;
        $maxRank = ModUrl::where($map)->max( 'iRank' );
        $Dao = new ModUrl ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iMenuId = $this->iMenuId;
        $Dao->iType = $request->input( 'iType', 0 );
        $Dao->vName = $request->input( 'vName', "" );
        $Dao->vLang = $request->input( 'vLang', "zh-tw" );
        $Dao->vCss = $request->input( 'vCss', "" );
        $Dao->vUrl = $request->input( 'vUrl', "" );
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iRank = $maxRank + 1;
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'add', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
    *
    */
    public function doSave ( Request $request )
    {
        $id = $request->input( 'iId', 0 );

        $Dao = ModUrl::find( $id );
        if (!$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if ($request->exists( 'iType' )) {
            $Dao->iType = $request->input( 'iType' );
        }
        if ($request->exists( 'vName' )) {
            $Dao->vName = $request->input( 'vName' );
        }
        if ($request->exists( 'vLang' )) {
            $Dao->vLang = $request->input( 'vLang' );
        }
        if ($request->exists( 'vCss' )) {
            $Dao->vCss = $request->input( 'vCss' );
        }
        if ($request->exists( 'vUrl' )) {
            $Dao->vUrl = $request->input( 'vUrl' );
        }
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = $request->input( 'iStatus' ) == "change" ? !$Dao->iStatus : $request->input( 'iStatus' );
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doDel ( Request $request )
    {
        $id = $request->input( 'iId', 0 );

        $Dao = ModUrl::find( $id );
        if (!$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao->bDel = 1;
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.delete_success' );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'delete', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.delete_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
