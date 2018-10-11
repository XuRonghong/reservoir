<?php

namespace App\Http\Controllers\_Web\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\FuncController;
use App\Http\Controllers\_Web\_WebController;
use App\SysMember;
use App\SysMemberInfo;
use App\SysGroupMember;


class InfoController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [ 'member' , 'info' ];
        $this->vTitle = 'Index';
    }


    /*
     *
     */
    public function index ()
    {

        $this->view = View()->make( "_web." . implode( '.' , $this->module ) . '.index' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '會員Information' );

        return $this->view;
    }


    /*
     * 所有 ajax
     */
    public function getList ( Request $request )
    {
        $sort_arr = [];
        $search_arr = [];
        $search_word = $request->input('sSearch') ? $request->input('sSearch') : '' ;
        $iDisplayLength = $request->input('iDisplayLength') ? $request->input('iDisplayLength') : 0 ;
        $iDisplayStart = $request->input('iDisplayStart') ? $request->input('iDisplayStart') : 0 ;
        $sEcho = $request->input( 'sEcho' ) ? $request->input('sEcho') : '' ;
        $column_arr = $request->input( 'sColumns' ) ? $request->input('sColumns') : '' ;
        $column_arr = explode( ',', $column_arr );
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
        $sort_name = $sort_arr[ $request->input( 'iSortCol_0' ) ];
        $sort_dir = $request->input( 'sSortDir_0' );


        $total_count = SysMemberInfo::query()->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })->where('iMemberId','>',1)
            ->count();

        $data_arr = SysMemberInfo::query()->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })->where('iMemberId','>',1)
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
            ->get();
        if ( !$data_arr){
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有資訊!'];
            return $this->rtndata;
        }
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
            $var->iLoginTime = date( 'Y/m/d H:i:s', $var->iLoginTime );
//            //圖片
//            $image_arr = [];
//            $tmp_arr = explode( ';', $var->vImages );
//            $tmp_arr = array_filter( $tmp_arr );
//            foreach ($tmp_arr as $item) {
//                $image_arr[] = FuncController::_getFilePathById( $item );
//            }
//            $var->vImages = $image_arr;
            //
//            $var->vCategoryNum = ( $var->iCategoryId > 0 ) ? FuncController::_getCategoryNum( $var->iCategoryId ) . str_pad( $var->iId, 6, 0, STR_PAD_LEFT ) : "";
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $total_count;
        $this->rtndata ['iTotalRecords'] = $total_count;
        $this->rtndata ['aaData'] = $total_count ? $data_arr : [];

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function edit ( $id )
    {
        //特定權限才可以編輯其他會員資料
        if (session('member.iAcType') > 9 && session('member.iId') != $id){
            return redirect ()->guest ( 'web/login' );
        };
        //
        if ($id == 1 && session('member.iUserId') != $id){
            return redirect ()->guest ( 'web/login' );
        };

        $this->view = View()->make('_web.' . implode('.', $this->module) . '.add');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.edit' => url('web/' . implode('/', $this->module) . "/edit/" . $id )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '編輯會員Information' );


        $DaoMemberInfo = SysMemberInfo::query()->find($id[0]);
        if (!$DaoMemberInfo) {
//            session()->put('check_empty.message', trans('_web_message.empty_id'));
            return redirect('web/' . implode('/', $this->module));
        }
//        if ($DaoMemberInfo) {
//            //圖片
//            $image_arr = [];
//            $tmp_arr = explode(';', $DaoMemberInfo->vImages);
//            $tmp_arr = array_filter($tmp_arr);
//            foreach ($tmp_arr as $item) {
//                $image_arr[] = FuncController::_getFilePathById($item);
//            }
//            $DaoMemberInfo->vImages = $image_arr;
//        } else {
//            $DaoMemberInfo->vImages = [];
//        }

        //
        $this->view->with( 'info', $DaoMemberInfo );

        return $this->view;
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


            $DaoMemberInfo = SysMemberInfo::query()->find( $id );
            $DaoMemberInfo->vUserImage = ( $request->input( 'vUserImage' ) ) ? $request->input( 'vUserImage' ) : "";
            if ($request->exists( 'vUserName' )) {
                $DaoMemberInfo->vUserName = $request->input( 'vUserName' );
            }
            if ($request->exists( 'vUserNameE' )) {
                $DaoMemberInfo->vUserNameE = $request->input( 'vUserNameE' );
            }
            if ($request->exists( 'vUserTitle' )) {
                $DaoMemberInfo->vUserTitle = $request->input( 'vUserTitle' );
            }
            if ($request->exists( 'vUserID' )) {
                $DaoMemberInfo->vUserID = $request->input( 'vUserID' );
            }
            if ($request->exists( 'iUserBirthday' )) {
                $DaoMemberInfo->iUserBirthday = strtotime( $request->input( 'iUserBirthday' ) );
            }
            if ($request->exists( 'vUserEmail' )) {
                $DaoMemberInfo->vUserEmail = $request->input( 'vUserEmail' );
            }
            if ($request->exists( 'vUserContact' )) {
                $DaoMemberInfo->vUserContact = $request->input( 'vUserContact' );
            }
            if ($request->exists( 'vUserZipCode' )) {
                $DaoMemberInfo->vUserZipCode = $request->input( 'vUserZipCode' );
            }
            if ($request->exists( 'vUserCity' )) {
                $DaoMemberInfo->vUserCity = $request->input( 'vUserCity' );
            }
            if ($request->exists( 'vUserArea' )) {
                $DaoMemberInfo->vUserArea = $request->input( 'vUserArea' );
            }
            if ($request->exists( 'vUserAddress' )) {
                $DaoMemberInfo->vUserAddress = $request->input( 'vUserAddress' );
            }

            if ($DaoMemberInfo->save()){
                //Logs
                $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'edit', json_encode( $DaoMemberInfo ) );

                // session
                $DaoMember = SysMember::query()->find( session()->get( 'member.iId') );
                $DaoMemberInfo = SysMemberInfo::query()->find( session()->get( 'member.iId') );
                // Member
                session()->put( 'member', json_decode( json_encode( $DaoMember ), true ) );
                // MemberInfo
                session()->put( 'member.meta', json_decode( json_encode( $DaoMemberInfo ), true ) );

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans( '_web_message.save_success' );
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.save_fail' );
            }

        return response()->json( $this->rtndata );
    }
}
