<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\News;

use App\Http\Controllers\_Web\_WebController;
use App\ModNews;
use App\SysCategory;
use Illuminate\Http\Request;

class IndexController extends _WebController
{
    public $module = [ 'news', 'index' ];

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

        $map['iCategoryType'] = config( '_config.sys_category.news.type' );
        $map['iParentId'] = config( '_config.sys_category.news.pid' );
        $map['iStatus'] = 1;
        $map['bDel'] = 0;
        $DaoCategory = SysCategory::where( $map )->get();
        $this->view->with( 'sys_category', $DaoCategory );

        return $this->view;
    }

    /*
     *
     */
    public function getList ( Request $request )
    {
        $sort_arr = [];
        $search_arr = [];
        $search_word = $request->input( 'sSearch' );
        $iDisplayLength = $request->input( 'iDisplayLength' );
        $iDisplayStart = $request->input( 'iDisplayStart' );
        $sEcho = $request->input( 'sEcho' );
        $column_arr = explode( ',', $request->input( 'sColumns' ) );
        foreach ($column_arr as $key => $item) {
            if ($item == "") {
                unset( $column_arr[$key] );
                continue;
            }
            if ($request->input( 'bSearchable_' . $key ) == "true") {
                $search_arr[$key] = $item;
            }
            if ($request->input( 'bSortable_' . $key ) == "true") {
                $sort_arr[$key] = $item;
            }
        }
        $sort_name = $sort_arr[$request->input( 'iSortCol_0' )];
        $sort_dir = $request->input( 'sSortDir_0' );

        $map['mod_news.bDel'] = 0;
        $total_count = ModNews::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->where( $map )->count();
        $data_arr = ModNews::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( 'mod_news.' . $item, 'like', '%' . $search_word . '%' );
            }
        } )->leftjoin( 'sys_category', function( $join ) {
            $join->on( 'sys_category.iId', '=', 'mod_news.iCategoryType' );
        } )->where( $map )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->select( 'mod_news.*', 'sys_category.vCategoryName' )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iStartTime = date( 'Y-m-d', $var->iStartTime );
            $var->iEndTime = date( 'Y-m-d', $var->iEndTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;
        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $total_count;
        $this->rtndata ['iTotalRecords'] = $total_count;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $maxRank = ModNews::max( 'iRank' );
        $Dao = new ModNews();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iCategoryType = ( $request->exists( 'iCategoryType' ) ) ? $request->input( 'iCategoryType' ) : 0;
        $Dao->vTitle = ( $request->exists( 'vTitle' ) ) ? $request->input( 'vTitle' ) : "";
        $Dao->vSummary = ( $request->exists( 'vSummary' ) ) ? $request->input( 'vSummary' ) : "";
        $Dao->vImages = ( $request->exists( 'vImages' ) ) ? $request->input( 'vImages' ) : config( 'config.empty_image' );
        $Dao->vUrl = ( $request->exists( 'vUrl' ) ) ? $request->input( 'vUrl' ) : "#";
        $Dao->vDetail = ( $request->exists( 'vDetail' ) ) ? $request->input( 'vDetail' ) : "";
        $Dao->iStartTime = ( $request->exists( 'iStartTime' ) ) ? strtotime( $request->input( 'iStartTime' ) ) : time();
        $Dao->iEndTime = ( $request->exists( 'iEndTime' ) ) ? strtotime( $request->input( 'iEndTime' ) ) : time();
        $Dao->iRank = $maxRank + 1;
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iStatus = ( $request->exists( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 0;
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );
            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
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
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = ModNews::find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if ($request->exists( 'iCategoryType' )) {
            $Dao->iCategoryType = $request->input( 'iCategoryType' );
        }
        if ($request->exists( 'vTitle' )) {
            $Dao->vTitle = $request->input( 'vTitle' );
        }
        if ($request->exists( 'vSummary' )) {
            $Dao->vSummary = $request->input( 'vSummary' );
        }
        if ($request->exists( 'vImages' )) {
            $Dao->vImages = $request->input( 'vImages' );
        }
        if ($request->exists( 'vUrl' )) {
            $Dao->vUrl = $request->input( 'vUrl' );
        }
        if ($request->exists( 'vDetail' )) {
            $Dao->vDetail = $request->input( 'vDetail' );
        }

        $Dao->iStartTime = ( $request->exists( 'iStartTime' ) ) ? strtotime( $request->input( 'iStartTime' ) ) : time();
        $Dao->iEndTime = ( $request->exists( 'iEndTime' ) ) ? strtotime( $request->input( 'iEndTime' ) ) : time();

        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
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
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = ModNews::find( $id );
        if ( !$Dao) {
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
