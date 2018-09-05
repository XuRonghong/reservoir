<?php

namespace App\Http\Controllers\_Portal\News;

use App\Http\Controllers\_Portal\_PortalController;
use App\ModBanner;
use App\SysCategory;
use App\ModNews;
use Illuminate\Http\Request;

class IndexController extends _PortalController
{
    /*
     *
     */
    public function index ()
    {
        $this->module = ['news', 'index'];
        $this->_init();


        //
        $mapCategory['iCategoryType'] = config( '_config.sys_category.news.type' );
        $mapCategory['iParentId'] = config( '_config.sys_category.news.pid' );
        $mapCategory['iStatus'] = 1;
        $mapCategory['bDel'] = 0;
        $DaoCategory = SysCategory::query()->where( $mapCategory )->get();
        $this->view->with( 'sys_category', $DaoCategory );


        //Banner圖
        $mapBanner['iMenuId'] = config('_menu.web.scenes.news.banner.menu_access');
        $mapBanner['bDel'] = 0;
        $DaoBanner = ModBanner::query()->where( $mapBanner )->get();
        $this->getPictureWithId( $DaoBanner );      //用id找到圖片路徑
        $this->view->with( 'banner', $DaoBanner );


        //
        $breadcrumb = [
            trans('_portal.home.title' ) => url( '' ),
        ];
        $this->view->with( 'breadcrumb', $breadcrumb );
        session()->put( 'SEO.vTitle', trans('_portal.news.title' ) );

        return $this->view;
    }


    /*
     * 最新消息列 ajax
     */
    public function getList ( Request $request )
    {
        $category = $request->input( 'category', 0 );

        $time_now = time();    //現在時間 , (格式:1529472159)

        //最新消息
        $mapNews['mod_news.iStatus'] = 1;
        $mapNews['mod_news.bDel'] = 0;
        if ($category)$mapNews['mod_news.iCategoryType'] = $category;   //如果有類別ID的話篩選
        $DaoNews = ModNews::query()->where( $mapNews )
            ->leftjoin( 'sys_category', 'mod_news.iCategoryType', '=', 'sys_category.iId' )
            ->where( 'iStartTime', '<', $time_now )
            ->where( 'iEndTime' , '>', $time_now - 86400 + 1 )
            ->select( 'sys_category.vCategoryName', 'mod_news.*' )
            ->orderBy( 'mod_news.iStartTime' )
            ->paginate( 4 );

        foreach ($DaoNews as $key => $var) {
            $var->iStartTime = date( 'Y/m/d', $var->iStartTime );
            $var->iUpdateTime = date( 'Y/m/d', $var->iUpdateTime );
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $DaoNews->items();
        $this->rtndata ['total'] = $DaoNews->total();
        $this->rtndata ['lastPage'] = $DaoNews->lastPage();
        $this->rtndata ['perPage'] = $DaoNews->perPage();
        $this->rtndata ['currentPage'] = $DaoNews->currentPage();
        $this->rtndata ['links_html'] = $DaoNews->links()->toHtml();    //分頁

        return response()->json( $this->rtndata );
    }


    /*
     * 最新消息詳情頁 blade
     */
    public function detail ( $id )
    {
        $this->module = ['news', 'detail'];
        $this->_init();

        $time_now = time();    //現在時間 , (格式:1529472159)
        $current = null;


        //最新消息
        $mapNews['mod_news.iStatus'] = 1;
        $mapNews['mod_news.bDel'] = 0;
        $DaoNews = ModNews::query()->where( $mapNews )
            ->leftjoin( 'sys_category', 'mod_news.iCategoryType', '=', 'sys_category.iId' )
            ->where( 'iStartTime', '<', $time_now )
            ->where( 'iEndTime' , '>', $time_now - 86400 + 1 )
            ->select( 'sys_category.vCategoryName', 'mod_news.*' )
            ->orderBy( 'mod_news.iStartTime' )
            ->get();
        foreach ($DaoNews as $key => $var) {
            $var->iStartTime = date( 'Y/m/d', $var->iStartTime );
            $var->iUpdateTime = date( 'Y/m/d', $var->iUpdateTime );
            if ($var->iId == $id) {
                $pre = isset( $DaoNews[$key - 1] ) ? $DaoNews[$key - 1] : "";
                $current = $var;
                $next = isset( $DaoNews[$key + 1] ) ? $DaoNews[$key + 1] : "";
                break;
            }
        }
        if (!$current) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['swal_type'] = 'error';
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return redirect( 'news' )->with( 'redirect_message', $this->rtndata );
        }
        $this->view->with( 'pre', isset( $pre ) ? $pre : 0 );
        $this->view->with( 'meta', isset( $current ) ? $current : 0 );
        $this->view->with( 'next', isset( $next ) ? $next : 0 );


        //
        $breadcrumb = [
            trans('_portal.home.title' ) => url( '' ),
            trans('_portal.news.title' ) => url( 'news' ),
        ];
        $this->view->with( 'breadcrumb', $breadcrumb );
        session()->put( 'SEO.vTitle',  trans('_portal.news.content' ) );

        return $this->view;
    }
}
