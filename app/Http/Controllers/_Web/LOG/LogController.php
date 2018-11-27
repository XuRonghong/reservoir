<?php

namespace App\Http\Controllers\_Web\LOG;

use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\LogLogin;
use App\LogAction;


class LogController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [ 'log' ];
    }


    /*
     *
     */
    public function index ()
    {
//        $this->module = [ 'member'  ];
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.index');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
//            implode('.', $this->module) . '.log_login' => url('web/' . implode('/', $this->module) . ".index")
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        session()->put( 'SEO.vTitle' , '登入紀錄' );


        $DaoLogLogin = LogLogin::query()
            ->join('sys_member','iMemberId','=','sys_member.iId')
//            ->orderBy('iDateTime','desc')
            ->select(['log_login.*','sys_member.vAccount','sys_member.iAcType','sys_member.vCreateIP'])
            ->get();
        if (!$DaoLogLogin) {
            session()->put('check_empty.message', trans('_web_message.empty_id'));
            return redirect('web/' . implode('/', $this->module));
        }
        foreach ($DaoLogLogin as $item) {
            $item->iDateTime = date('Y/m/d H:i:s', $item->iDateTime);
        }
        $this->view->with( 'info', $DaoLogLogin );

        return $this->view;
    }


    /*
 *
 */
    public function edit ()
    {
//        $this->module = [ 'member'  ];
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.edit');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
//            implode('.', $this->module) . '.log_login' => url('web/' . implode('/', $this->module) . ".index")
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        session()->put( 'SEO.vTitle' , '登入紀錄' );


        $DaoLog = LogAction::query()
            ->join('sys_member','iMemberId','=','sys_member.iId')
//            ->orderBy('iDateTime','desc')
            ->select(['log_action.*','sys_member.vAccount','sys_member.iAcType','sys_member.vCreateIP'])
            ->get();
        if (!$DaoLog) {
            session()->put('check_empty.message', trans('_web_message.empty_id'));
            return redirect('web/' . implode('/', $this->module));
        }
        foreach ($DaoLog as $item) {
            $item->iDateTime = date('Y/m/d H:i:s', $item->iDateTime);
        }
        $this->view->with( 'info', $DaoLog );

        return $this->view;
    }


    /*
     *
     */
    public function attr (Request $request , $id)
    {
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.attr');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
//            implode('.', $this->module) . '.meta' => url('web/' . implode('/', $this->module) . "/meta")
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);


        $DaoLog = LogAction::query()->find($id);
        if (!$DaoLog) {
            session()->put('check_empty.message', trans('_web_message.empty_id'));
            return redirect('web/' . implode('/', $this->module));
        }

//        $DaoLog->vValue = json_decode( $DaoLog->vValue, false );
//        $DaoLog->vValue = urldecode( $DaoLog->vValue ) ;

        $this->view->with( 'info', $DaoLog );

        return $this->view;
    }


    /*
     * all list ajax
     */
    public function getList ( Request $request )
    {
        $keyword = $request->input('keyword') ? '%'.$request->input('keyword').'%' : '%' ;
        $field = $request->input( 'field' ) ? $request->input('field') : 'iDateTime' ;
        $sort = $request->input( 'sort' ) ? $request->input('sort') : 'desc' ;

        $DaoLogLogin = LogLogin::query()
            ->join('sys_member','iMemberId','=','sys_member.iId')
//            ->where(function ($query) use ($keyword){
//                $query->where( "vProductName", 'like', $keyword )
//                    ->orWhere( "iId", 'like', $keyword );
//            })
            ->orderBy( $field , $sort )
            ->select(['log_login.*','sys_member.vAccount','sys_member.iAcType','sys_member.vCreateIP'])
            ->paginate( 10 );
        if ( !$DaoLogLogin){
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有DATA!'];
            return $this->rtndata;
        }

        //
        $this->rtndata['status'] = 1;
        $this->rtndata['aaData'] = $DaoLogLogin->items();
        $this->rtndata ['total'] = $DaoLogLogin->total();
        $this->rtndata ['lastPage'] = $DaoLogLogin->lastPage();
        $this->rtndata ['perPage'] = $DaoLogLogin->perPage();
        $this->rtndata ['currentPage'] = $DaoLogLogin->currentPage();
        $this->rtndata ['links_html'] = str_replace('span','a',$DaoLogLogin->links()->toHtml());    //分頁

        return response()->json( $this->rtndata );
    }

}
