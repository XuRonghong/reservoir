<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
//Logs
//$this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
namespace App\Http\Controllers\_API;

use App\ModReservoirMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModReservoir;
use App\ModShakemap;
use App\ModEvent;
use App\ModDeviceToken;
use App\ModData;

class _APIController extends Controller
{
    public function getModData (Request $request)
    {
        if ( !$request->exists('_token')){
            return 404;
        }
        if ( $request->input('_token') != '753951'){
            return 404;
        }
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModData::query()->where($map)->get();
//        echo json_encode( $Dao );
        return json_encode( $Dao );
    }

    public function addModData (Request $request)
    {
        if ( !$request->exists('_token')){
            return $request->input('_token') . '<>' ;
        }
        $Dao = new ModData();
        $Dao->iData1 = $request->exists('data1') ? $request->input('data1') : 0;
        $Dao->vData2 = $request->exists('data2') ? $request->input('data2') : '';
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iStatus = 1;
        $Dao->bDel = 0;
        $Dao->save();
        return json_encode( $Dao );
    }

    public function editModData (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return $request->input('_token') . '<>' ;
        }
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModData::query()->where($map)->findOrFail($id);
        $Dao->iData1 = $request->exists('data1') ? $request->input('data1') : $Dao->iData1;
        $Dao->vData2 = $request->exists('data2') ? $request->input('data2') : $Dao->vData2;
        $Dao->iUpdateTime = time();
        $Dao->iStatus = 1;
        $Dao->bDel = 0;
        $Dao->save();
        return json_encode( $Dao );
    }

    public function delModData (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return $request->input('_token') . '<>' ;
        }
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModData::query()->where($map)->find($id);
        if ($Dao){
            $Dao->bDel = 1;
            $Dao->iUpdateTime = time();
            $Dao->save();
        }
        return 204;
    }


    public function getDeviceToken (Request $request)
    {
        if ( !$request->exists('_token')){
            return 404;
        }
        if ( $request->input('_token') != '84269713'){
            return 404;
        }
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModDeviceToken::query()->where($map)->get();
//        echo json_encode( $Dao );
        return json_encode( $Dao );
    }

    public function addDeviceToken (Request $request)
    {
        if ( !$request->input('_token')){
            return $request->input('_token') . '<>' ;
        }
        $Dao = new ModDeviceToken();
        $Dao->iMemberId = $request->input('userid') ? $request->input('userid') : 0;
        $Dao->vToken = $request->input('token') ? $request->input('token') : '';
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iStatus = 1;
        $Dao->bDel = 0;
        $Dao->save();
        return json_encode( $Dao );
    }
    public function editDeviceToken (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return $request->input('_token') . '<>' ;
        }
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModDeviceToken::query()->where($map)->findOrFail($id);
        $Dao->iMemberId = $request->exists('userid') ? $request->input('userid') : $Dao->iMemberId;
        $Dao->vToken = $request->exists('token') ? $request->input('token') : $Dao->vToken;
        $Dao->iUpdateTime = time();
        $Dao->iStatus = 1;
        $Dao->bDel = 0;
        $Dao->save();
        return json_encode( $Dao );
    }

    public function delDeviceToken (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return $request->input('_token') . '<>' ;
        }
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModDeviceToken::query()->where($map)->find($id);
        if ($Dao){
            $Dao->bDel = 1;
            $Dao->iUpdateTime = time();
            $Dao->save();
        }
        return 204;
    }



    /*
     *
     */
    public function shakemap_event_api ()
    {
        $returnList=array();

        $returnList["type"]="event";
        $Dao = ModEvent::query()
            ->where('eventTime', '>=',date("Y-m-d H:i:s",time()-32400*3))   //北美中部時區的時差-8小時
            ->orderBy('eventTime', 'DESC')
            ->take(45)
            ->get();
        $returnList["data"] = $Dao ? $Dao : [];
        if ( $Dao->count() == 0){
            $returnList["type"]="normal";
            $DaoShakemap = ModShakemap::query()
                ->leftJoin( 'mod_reservoir_meta', function ($join) {
                    $join->on('shakemap.id', '=', 'mod_reservoir_meta.vNumber');
                })
                ->where('id', 'LIKE', 'SD%')
                ->orWhere('id', 'LIKE', 'MD%')
                ->orderBy('id', 'ASC')
                ->get();
            if (!$DaoShakemap){
                DB::reconnect();
                $returnList["data"] = [];
            }
            $returnList["data"] = $DaoShakemap ;
        }
        foreach ($returnList["data"] as $key => $item){
            $oneReservoirMeta = ModReservoirMeta::query()->where('vNumber','=', $item->id)->first();
            $returnList['data2'][$key] = ModReservoir::query()->where('vName', 'LIKE', '%'.$oneReservoirMeta->vStructure.'%')->first();
        }
        $returnList['date'] = date('Y') . '年' . date('m') . '月' . date('d') . '日';
        $returnList['time'] = date('H') . '時' . date('i') . '分' . date('s') . '秒';

        echo json_encode($returnList);

//        return json_encode($returnList);
    }
}
