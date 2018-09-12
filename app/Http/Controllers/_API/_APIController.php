<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
//Logs
//$this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
namespace App\Http\Controllers\_API;

use App\Http\Controllers\Controller;
use App\ModShakemap;
use App\ModEvent;

class _APIController extends Controller
{
    public function shakemap_event_api ()
    {
        $returnList=array();

        $returnList["type"]="event";
        $Dao = ModEvent::query()
            ->where('eventTime', '>=',date("Y-m-d H:i:s",time()-32400))
            ->orderBy('eventTime', 'DESC')
            ->limit(45)
            ->get();
        $returnList["data"] = $Dao ? $Dao : [];
        if ( $Dao->count() == 0){
            $returnList["type"]="normal";
            $DaoShakemap = ModShakemap::query()
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
        $returnList['date'] = date('Y') . '年' . date('m') . '月' . date('d') . '日';
        $returnList['time'] = date('H') . '時' . date('i') . '分' . date('s') . '秒';

        echo json_encode($returnList);

//        return json_encode($returnList);
    }
}
