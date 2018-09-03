<?php
//Route::group(
//    [
//        'prefix' => 'excel',
//    ], function() {
//    Route::get('',array('as'=>'excel.import','uses'=>'ExcelController@index'));
//    Route::get('getList',array('as'=>'excel.import','uses'=>'ExcelController@getList'));
//    Route::post('upload-csv-excel',array('as'=>'upload-csv-excel','uses'=>'ExcelController@uploadFileIntoStorage'));
//    Route::post('update-csv-excel',array('as'=>'update-csv-excel','uses'=>'ExcelController@updateFileIntoDB'));
//    Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'ExcelController@downloadExcelFromFile'));
//});

namespace App\Http\Controllers\_Web\_Admin\Group\Excel;

use App\Http\Controllers\_Web\_WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class _ExcelController extends _WebController
{
    public $module;
    protected $store_name = 'excel';
    protected $store_key = 'key';
    protected $store_path = 'storage\\exports';
    protected $store_type = 'xls';
    protected $store_full_path;
    protected $query;
    protected $primaryKey = 'vName';
    protected $exportData =
        [
            //'db_code' => 'excel_column_name'
            'iId' => '編號',
            'vName' => '名稱',
        ];

    public function __construct ()
    {
        $this->store_full_path = $this->store_path . '/' . $this->store_name . '.' . $this->store_type;
    }

    /**
     * 檔案上傳並儲存資料
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadFileIntoStorage ( Request $request )
    {
        if ($request->hasFile( 'excel_file' )) {
            $path = $request->file( 'excel_file' )->getRealPath();

            try {
                $data = Excel::load( $path )->get();
            } catch (\Exception $exception) {
                return redirect()->back()->with( 'message', 'File not found.' );
            }

            if (!empty( $data ) && $data->count()) {
                //資料處理
                foreach ($data as $row_idx => $row) {
                    $row = $this->importDataMap( $row );
                    if ($row) {
                        $data[$row_idx] = $row;
                    } else {
                        unset( $data[$row_idx] );
                    }
                }

                //儲存檔案於伺服器
                $this->saveExcelFile( $data->toArray() );
                return redirect()->back()->with( 'message', 'Insert Record successfully.' );
            }
        }
        return redirect()->back()->with( 'message', 'Request data does not have any files to import.' );
    }

    /**
     * 將檔案資料同步於資料庫
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateFileIntoDB ( Request $request )
    {
        //do something insert or update data to db

        return redirect()->back()->with( 'message', 'Insert database successfully.' );
    }

    /**
     * @param Request $request
     * @param $type
     * @return mixed
     */
    public function downloadExcelFromFile ( Request $request, $type )
    {
        try {
            $data = Excel::load( $this->store_full_path )->get();
        } catch (\Exception $exception) {
            $data = collect();
            return $this->downloadExcelFile( $data->toArray(), $type );
        }
        if (!empty( $data ) && $data->count()) {
            //資料處理
            foreach ($data as $row_idx => $row) {
                $row = $this->exportDataMap( $row );
                if ($row) {
                    $data[$row_idx] = $row;
                } else {
                    unset( $data[$row_idx] );
                }
            }
            return $this->downloadExcelFile( $data->toArray(), $type );
        } else {
            $data = collect();
            return $this->downloadExcelFile( $data->toArray(), $type );
        }
    }

    /**
     * Collection 輸入資料前處理每一個item
     * @param array|Collection $row
     * @return array
     */
    public function importDataMap ( $row ): array
    {
        //do something to generate date format

        //請依 importData 固定輸出格式
        foreach ($this->exportData as $key => $value) {
            $result[$key] = isset( $row->$value ) ? trim( $row->$value ) : null;
        }

        return $result;
    }

    /**
     * Collection 輸出資料前處理每一個item
     * @param array|Collection $row
     * @return array
     */
    public function exportDataMap ( $row ): array
    {
        //do something to generate date format

        //請依 exportData 固定輸出格式
        foreach ($this->exportData as $key => $value) {
            $result[$value] = isset( $row->$key ) ? trim( $row->$key ) : null;
        }

        return $result;
    }

    /**
     * @param $Dao
     * @return mixed
     */
    protected function saveExcelFile ( $Dao )
    {
        //加入標頭
        $header = array_keys( $this->exportData );
        array_unshift( $Dao, $header );
        //儲存檔案
        return Excel::create( $this->store_name, function( $excel ) use ( $Dao ) {
            $excel->sheet( 'sheet', function( $sheet ) use ( $Dao ) {
                $sheet->rows( $Dao );
            } );
        } )->store( $this->store_type );
    }

    /**
     * @param $Dao
     * @param $type
     * @return mixed
     */
    protected function downloadExcelFile ( $Dao, $type )
    {
        //加入標頭
        $header = array_values( $this->exportData );
        array_unshift( $Dao, $header );
        //輸出檔案
        return Excel::create( $this->store_name, function( $excel ) use ( $Dao ) {
            $excel->sheet( 'sheet', function( $sheet ) use ( $Dao ) {
                $sheet->rows( $Dao );
            } );
        } )->export( $type );
    }
}