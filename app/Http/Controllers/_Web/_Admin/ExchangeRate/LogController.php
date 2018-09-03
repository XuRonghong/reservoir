<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\ExchangeRate;

use App\Http\Controllers\_Web\_WebController;
use App\LogExchangeRate;
use Illuminate\Http\Request;

class LogController extends _WebController
{
    public $module = [ 'admin', 'exchange_rate', 'log' ];

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            $this->module[0] . '.' . $this->module[1] => "#",
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
        ];
        $this->func = "web." . implode( '.', $this->module );
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function getList ( Request $request )
    {
        $search_word = $request->input( 'sSearch' );
        $iDisplayLength = $request->input( 'iDisplayLength' );
        $iDisplayStart = $request->input( 'iDisplayStart' );
        $sEcho = $request->input( 'sEcho' );
        $sort_arr = explode( ',', $request->input( 'sColumns' ) );
        $sort_name = $sort_arr[$request->input( 'iSortCol_0' )];
        $sort_dir = $request->input( 'sSortDir_0' );
        //remove null
        $sort_arr = array_filter( $sort_arr );

        $total_count = LogExchangeRate::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->count();


        $data_arr = LogExchangeRate::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iDateTime = date( 'Y/m/d', $var->iDateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $total_count;
        $this->rtndata ['iTotalRecords'] = $total_count;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }
}
