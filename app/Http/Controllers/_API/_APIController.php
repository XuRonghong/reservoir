<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
//Logs
//$this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
namespace App\Http\Controllers\_API;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\ModReservoir;
use App\ModShakemap;
use App\ModEvent;
use App\ModDeviceToken;
use App\ModData;

class _APIController extends Controller
{
    public function getModData ()
    {
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModData::query()->where($map)->get();
        echo json_encode( json_decode($Dao), true);
    }


    public function addModData (Request $request)
    {
        $iData1 = $request->exist('data1') ? $request->input('data1') : 0;
        $vData2 = $request->exist('data2') ? $request->input('data2') : '';

        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = new ModData();
        $Dao->iData1 = $iData1;
        $Dao->vData2 = $vData2;
        $Dao->save();

        echo json_encode( json_decode($Dao->iId), true);
    }


    public function addModDeviceToken (Request $request)
    {
        $iId = $request->exist('userid') ? $request->input('userid') : 0;
        $vToken = $request->exist('token') ? $request->input('token') : '';

        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = new ModDeviceToken();
        $Dao->iMemberId = $iId;
        $Dao->vToken = $vToken;
        $Dao->save();

        echo json_encode( json_decode($Dao->iId), true);
    }

    public function getModDeviceToken ()
    {
        $map['bDel'] = 0;
        $map['iStatus'] = 1;
        $Dao = ModDeviceToken::query()->where($map)->get();
        echo json_encode( json_decode($Dao), true);
    }

    public function shakemap_event_api ()
    {
        $returnList=array();

        $returnList["type"]="event";
        $Dao = ModEvent::query()
            ->join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->where('eventTime', '>=',date("Y-m-d H:i:s",time()-32400))   //北美中部時區的時差-8小時
            ->orderBy('eventTime', 'DESC')
            ->limit(45)
            ->get();
        $returnList["data"] = $Dao ? $Dao : [];
        if ( $Dao->count() == 0){
            $returnList["type"]="normal";
            $DaoShakemap = ModShakemap::query()
                ->join( 'mod_reservoir_meta', function ($join) {
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
            $returnList['data2'][$key] = ModReservoir::query()->where('vName', 'LIKE', '%'.$item->vStructure.'%')->first();
//            echo $item->vStructure . '=' . $returnList['data2'][$key]->vLocation .'<br>';
        }
        $returnList['date'] = date('Y') . '年' . date('m') . '月' . date('d') . '日';
        $returnList['time'] = date('H') . '時' . date('i') . '分' . date('s') . '秒';

        echo json_encode($returnList);

//        return json_encode($returnList);
    }
}
