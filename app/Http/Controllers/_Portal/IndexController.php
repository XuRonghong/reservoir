<?php

namespace App\Http\Controllers\_Portal;

use App\ModActivityScheduleProduct;
use App\ModBanner;
use App\ModNews;
use App\ModProduct;
use App\SysCategory;
use App\SysGroupMember;
use App\ModProductCategory;
use Illuminate\Http\Request;

class IndexController extends _PortalController
{
    /*
     * 首頁
     */
    public function index ( Request $request )
    {
        $this->module = ['index'];
        //$this->_init();     //初始化

        $this->view = View()->make( "_portal." . implode( '.' , $this->module ) );


        $news_count = 2 ;       //最新消息數量
        $time_now = time();    //現在時間 , (格式:1529472159)


        //最新消息
//        $mapNews['iStatus'] = 1;
        $mapNews['bDel'] = 0;
        $DaoNews = ModNews::query()->where( $mapNews )
//            ->where( 'iStartTime', '<', $time_now )
//            ->where( 'iEndTime', '>', $time_now - 86400 + 1 )
//            ->orderBy( 'iCreateTime' , 'desc' )
//            ->take( $news_count )
            ->get();
        foreach ($DaoNews as $item){
            //
//            $item->vUrl = url('reservoir/detail/' . $item->iId );
        }
        $this->view->with( 'reservoir', $DaoNews );


        //meta-org
        $og = [
            "url" => url( '' ),
            "type" => "website",
            "title" => config( '_website.web_title' ),
            "description" => config( '_website.web_description' ),
            "images" => "",
        ];
        $this->view->with( 'og', $og );

        session()->put( 'SEO.vTitle', trans('_portal.home.title') );
        //存上一頁網址，來源
        $this->putPrevPageToSession();

        return $this->view;
    }
}
