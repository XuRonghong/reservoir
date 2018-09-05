<?php

namespace App\Http\Controllers\_Web;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;

class ExcelController extends _WebController
{
    public $module = [ 'excel' ];

    /*
     *
     */
    public function index ()
    {
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.import_export' );
        //
        $breadcrumb = [
            '後臺首頁' => url( '' ),
        ];
        $this->view->with( 'breadcrumb', $breadcrumb );
        $this->view->with( 'module', $this->module );

        return $this->view;
    }

    /*
     *
     */
    public function import(Request $request){

        $chooseType = $request->get('importTable') ? $request->get('importTable') : '';


        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){

                    switch ($chooseType){
                        case 'reservoir':
                            // Excel Sheet 1
                            try {
                                foreach ($data[0] as $key => $value) {
                                    $insert[] = [
                                        'vRegion' => $value->region,
                                        'vName' => $value->name,
                                        'vLocation' => $value->location,
                                        'vCounty' => $value->county,
                                        'iCreateTime' => time(),
                                        'iUpdateTime' => time(),
                                    ];
                                }
                            }catch (\Exception $e){
                                Session::flash('error', $e->getMessage());
                            }

                            try {
                                if (!empty($insert)) {
                                    DB::table('mod_reservoir')->delete();
                                    $insertData = DB::table('mod_reservoir')->insert($insert);
                                    if ($insertData) {
                                        Session::flash('success', 'Your Data has successfully imported');
                                    } else {
                                        Session::flash('error', 'Error inserting the data..');
                                        return back();
                                    }
                                }
                            }catch (\Exception $e){
                                Session::flash('error', $e->getMessage());
                            }

                            // Excel Sheet 2
                            try {
                                foreach ($data[1] as $key => $value) {
                                    $insert2[] = [
                                        'iRank' => $value->rank,
                                        'vStructure' => $value->structure,
                                        'vLevel' => $value->level,
                                        'iHeight' => $value->height == '- ' ? 0 : $value->height,
                                        'iStoreTotal' => $value->store_total == '- ' ? 0 : $value->store_total,
                                        'vGrade' => $value->grade,
                                        'vTrustRegion' => $value->trust_region,
                                        'vNumber' => $value->number,
                                        'vNet' => $value->net,
                                        'vAreaCode' => $value->area_code,
                                        'iCreateTime' => time(),
                                        'iUpdateTime' => time(),
                                    ];
                                }
                            }catch (\Exception $e){
                                Session::flash('error', $e->getMessage());
                            }

                            try {
                                if(!empty($insert)){
                                    DB::table('mod_reservoir_meta')->delete();
                                    $insertData = DB::table('mod_reservoir_meta')->insert($insert2);
                                    if ($insertData) {
                                        Session::flash('success', 'Your Data has successfully imported');
                                    }else {
                                        Session::flash('error', 'Error inserting the data..');
                                        return back();
                                    }
                                }
                            }catch (\Exception $e){
                                Session::flash('error', $e->getMessage());
                            }
                            break;
                        case 'member':
                            Session::flash('error', 'SORRY~會員匯入功能還沒開放');
                            break;
                    }

                }

                return back();

            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }

        return null;
    }

}