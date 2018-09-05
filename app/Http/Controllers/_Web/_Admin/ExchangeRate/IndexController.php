<?php
// debugbar()->meta($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\ExchangeRate;

use App\Http\Controllers\_Web\_WebController;
use App\SysExchangeRate;
use Doctrine\DBAL\Exception\ReadOnlyException;
use Illuminate\Http\Request;

class IndexController extends _WebController
{
    public $module = [ 'admin', 'exchange_rate', 'index' ];

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

        $total_count = SysExchangeRate::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->count();
        $data_arr = SysExchangeRate::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
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
    public function doSave ( Request $request )
    {
        $id = $request->exists( 'iId' ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = SysExchangeRate::find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if ($request->exists( 'fRateValue' )) {
            $Dao->fRateValue = $request->input( 'fRateValue' );
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
