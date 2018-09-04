<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\Scenes\MemberCenter;

use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\ModBanner;
use App\SysFiles;
use Illuminate\Http\Request;

class BannerController extends _WebController
{
    public $module = ['scenes', 'member_center', 'banner'];
    protected $iMenuId = 61001;
    protected $max_count = 1;

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

        $map['iMenuId'] = $this->iMenuId;
        $map['bDel'] = 0;
        $data_arr = ModBanner::where( $map )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            //電腦圖片
            $image_arr = [];
            $tmp_arr = explode( ';', $var->vImages );
            $tmp_arr = array_filter( $tmp_arr );
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById( $item );
            }
            $var->images = $image_arr;
            //手機圖片
            $image_arr = [];
            $tmp_arr = explode( ';', $var->vImagesMobile );
            $tmp_arr = array_filter( $tmp_arr );
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById( $item );
            }
            $var->imagesMobile = $image_arr;
            //
            $var->iDateTime = date( 'Y/m/d', $var->iDateTime );
            $var->iStartTime = date( 'Y/m/d', $var->iStartTime );
            $var->iEndTime = date( 'Y/m/d', $var->iEndTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->view->with('banner', $data_arr);

        return $this->view;
    }

    /*
	 *
	 */
    public function doAdd ( Request $request )
    {
        $map['iMenuId'] = $this->iMenuId;
        $map['bDel'] = 0;
        $DaoBanner = ModBanner::where( $map )->get();
        if($DaoBanner->count() >= $this->max_count) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.out_of_max_count' );

            return response()->json( $this->rtndata );
        }

        $maxRank = ModBanner::max( 'iRank' );
        $Dao = new ModBanner ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iMenuId = $this->iMenuId;
        $Dao->iType = $request->input( 'iType', 0 );
        $Dao->vTitle = $request->input( 'vTitle', "" );
        $Dao->vSummary = $request->input( 'vSummary', "" );
        $Dao->vImages = $request->input( 'vImages', "" );
        //處理圖片
        SysFiles::checkImages( explode( ";", $Dao->vImages ) );
        $Dao->vImagesMobile = $request->input( 'vImages', "" );
        //處理圖片
        SysFiles::checkImages( explode( ";", $Dao->vImagesMobile ) );
        $Dao->vUrl = $request->input( 'vUrl', "" );
        $Dao->vDetail = $request->input( 'vDetail', "" );
        $Dao->iStartTime = strtotime( $request->input( 'iStartTime', "Today" ) );
        $Dao->iEndTime = strtotime( $request->input( 'iEndTime', "Today" ) );
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

        $Dao = ModBanner::find( $id );
        if (!$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if ($request->exists( 'iType' )) {
            $Dao->iType = $request->input( 'iType' );
        }
        if ($request->exists( 'vTitle' )) {
            $Dao->vTitle = $request->input( 'vTitle' );
        }
        if ($request->exists( 'vSummary' )) {
            $Dao->vSummary = $request->input( 'vSummary' );
        }
        if ($request->exists( 'vImages' )) {
            $Dao->vImages = $request->input( 'vImages' );
            //處理圖片
            SysFiles::checkImages( explode( ";", $Dao->vImages ) );
        }
        if ($request->exists( 'vImagesMobile' )) {
            $Dao->vImagesMobile = $request->input( 'vImagesMobile' );
            //處理圖片
            SysFiles::checkImages( explode( ";", $Dao->vImagesMobile ) );
        }
        if ($request->exists( 'vUrl' )) {
            $Dao->vUrl = $request->input( 'vUrl' );
        }
        if ($request->exists( 'vDetail' )) {
            $Dao->vDetail = $request->input( 'vDetail' );
        }
        if ($request->exists( 'iStartTime' )) {
            $Dao->iStartTime = strtotime( $request->input( 'iStartTime' ) );
        }
        if ($request->exists( 'iEndTime' )) {
            $Dao->iEndTime = strtotime( $request->input( 'iEndTime' ) );
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

        $Dao = ModBanner::find( $id );
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
