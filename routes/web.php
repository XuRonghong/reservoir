<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Pay Service
//Route::group( [
//    'prefix' => 'payservice',
//    'namespace' => '_PayService',
//], function() {
//    //藍新科技
//    Route::group( [
//        'prefix' => 'newebpay',
//        'namespace' => 'NewebPay'
//    ], function() {
//        Route::get( 'pay_service/{id}', 'IndexController@pay_service' );
//        Route::any( 'feedback', 'IndexController@feedback' );
//        Route::any( 'receive', 'IndexController@receive' );
//    } );
//} );
//
//// API
//Route::group( [
//    'prefix' => 'api',
//    'namespace' => '_API',
//], function() {
//    //推薦商品的搜尋功能
//    Route::group( [
//        'prefix' => 'product',
//    ], function() {
//        Route::get( 'dosearch', 'SearchController@getList' );
//    } );
//
//    //檔期加入群組的搜尋功能
//    Route::group( [
//        'prefix' => 'group',
//    ], function() {
//        Route::get( 'dosearch', 'SearchController@getGroupList' );
//    } );
//} );
//
//
///*
// * 前台
// */
////不需要登入驗證
//Route::group(
//    [
//        'namespace' => '_Portal',
//    ], function() {
//    Route::get( 'login'     , 'LoginController@index') ->middleware([ 'CheckMallLogout' ]);
//    Route::group([
//        'middleware'=> ['LoginThrottle:5,10']
//    ], function(){
//        Route::post('doLogin'   , 'LoginController@doLogin' );
//    });
//    //
//    Route::post('doSendVerification', 'LoginController@doSendVerification' );//
//    Route::post('doResetPassword'   , 'LoginController@doResetPassword' );//
//    //
//    Route::post('doRegister'        , 'RegisterController@doRegister' );//
//    Route::get( 'doActive/{usercode}', 'RegisterController@doActive' );//
//    //
//    Route::post('doLogout'  , 'LogoutController@doLogout' );
//});
//
////需要登入驗證
//Route::group(
//    [
//        'namespace' => '_Portal',
//        'middleware' => [ 'CheckMallLogin' ]
//    ], function() {
//    //
//    Route::get( '', 'IndexController@index' );
//    //
//    Route::get( 'register' , 'RegisterController@index' );//
//    //
//    Route::get( 'logout', 'LogoutController@index' );
//    //
//    Route::get( 'search', 'SearchController@index' );
//
//    /********************************
//     * Service
//     ********************************/
//    Route::group(
//        [
//            'prefix' => 'service',
//            'namespace' => 'Service',
//        ], function() {
//        Route::group(
//            [
//                'prefix' => 'message',
//            ], function() {
//            Route::get( '', 'MessageController@index' );
//            Route::post( 'doadd', 'MessageController@doAdd' );
//        } );
//        Route::group(
//            [
//                'prefix' => 'member',
//            ], function() {
//            Route::get( '', 'MemberController@index' );
//            Route::post( 'doadd', 'MemberController@doAdd' );
//        } );
//    } );
//
//    /********************************
//     * Keep
//     ********************************/
//    Route::group(
//        [
//            'prefix' => 'keep',
//            'namespace' => 'Keep',
//            'middleware' => 'CheckMallLogin',
//        ], function() {
//        Route::get( '', 'IndexController@index' );
//        Route::post( 'doadd', 'IndexController@doAdd' );
//        Route::post( 'dosave', 'IndexController@doSave' );
//        Route::post( 'dodel', 'IndexController@doDel' );
//        Route::get( 'getlist', 'IndexController@getList' );
//    } );
//
//    //會員購物車
//    Route::group(
//        [
//            'prefix' => 'cart',
//            'namespace' => 'Cart'
//        ], function() {
//        Route::get( '', 'IndexController@index' );
//        Route::post( 'doadd', 'IndexController@doAdd' );
//        Route::post( 'dosave', 'IndexController@doSave' );
//        Route::post( 'dodel', 'IndexController@doDel' );
//        Route::get( 'getlist', 'IndexController@getList' );
//    } );
//
//    /********************************
//     * 商品分類   商品詳細
//     ********************************/
//    Route::group(
//        [
//            'prefix' => 'category',
//            'namespace' => 'Product'
//        ], function() {
//        Route::get( '', 'IndexController@category' );
//        Route::get( '{category_id}', 'IndexController@index' );
//        Route::get( '{category_id}/getlist', 'IndexController@getList' );
//        Route::get( 'mobile/get_cate_list', 'IndexController@getCategoryListOnMobile' );
//    } );
//    Route::group(
//        [
//            'prefix' => 'product',
//            'namespace' => 'Product'
//        ], function() {
//        Route::get( '{code}', 'IndexController@detail' );
//    } );
//
//    /********************************
//     * 新聞公告
//     ********************************/
//    Route::group(
//        [
//            'prefix' => 'news',
//            'namespace' => 'News'
//        ], function() {
//        Route::get( '', 'IndexController@index' );
//        Route::get( 'getlist', 'IndexController@getList' );
//        Route::get( 'detail/{code}', 'IndexController@detail' );
//    } );
//
//    /********************************
//     * 訂單
//     ********************************/
//    Route::group(
//        [
//            'prefix' => 'order',
//            'namespace' => 'Order'
//        ], function() {
//        Route::get( '', 'IndexController@index' );
//        Route::get( 'pay/{order_num}', 'IndexController@pay' );
//        Route::post( 'doadd', 'IndexController@doAdd' );
//        Route::post( 'docheckspec', 'IndexController@doCheckSpec' );
//    } );
//    Route::group(
//        [
//            'prefix' => 'order/{store_id}',
//            'namespace' => 'Order'
//        ], function() {
//        Route::get( '', 'IndexController@index' );
//        Route::get( 'pay/success', 'IndexController@success' );
//        Route::get( 'pay/fail', 'IndexController@fail' );
//        Route::get( 'docheck/{id}', 'IndexController@doCheck' );
//    } );
//
//    /*********************************
//     * 會員中心
//     **********************************/
//    Route::group(
//        [
//            'middleware' => 'CheckMallLogin',
//            'prefix' => 'member_center',
//            'namespace' => 'MemberCenter'
//        ], function() {
//        //
//        Route::get( '', 'InformationController@index' );
//        Route::post( 'dosave', 'InformationController@doSave' );
//        Route::post( 'dosavepassword', 'InformationController@doSavePassword' );
//        //會員訂單清單
//        Route::get( 'order', 'InformationController@_gotoOrder' );
//        Route::get( 'order/{order_id}', 'InformationController@index' );
//        Route::get( 'getlist', 'InformationController@getOrderList' );
//        Route::get( '{resetpw}', 'InformationController@index' );
//        //會員資訊
//        Route::group(
//            [
//                'prefix' => 'information',
//            ], function() {
//            Route::get( 'mycard', 'MyCardController@index' );
//            Route::get( 'edit', 'InformationController@edit' );
//        } );
//
//        //我的收藏
//        Route::group(
//            [
//                'prefix' => 'keep',
//                'namespace' => 'Keep'
//            ], function() {
//            Route::get( '', 'IndexController@index' );
//            Route::post( 'doadd', 'IndexController@doAdd' );
//            Route::post( 'dosave', 'IndexController@doSave' );
//            Route::post( 'dodel', 'IndexController@doDel' );
//            Route::get( 'getlist', 'IndexController@getList' );
//        } );
//    } );
//
//} );





// 首頁先導向後臺登入頁
Route::get( '', function (){
    return redirect('web/login');
} ) ;
/*
 * 後台
 */
Route::group(
    [
//        'middleware' => 'CheckLang',
//        'middleware' => 'NewInitial',
        'prefix' => 'web',
        'namespace' => '_Web'
    ], function() {

        Route::get( '', 'LoginController@indexView')->name('index') ;
        //
        //Route::get( 'register', 'RegisterController@index' );
        //Route::post( 'doRegister', 'RegisterController@doRegister' );

        Route::get( 'login', 'LoginController@indexView') ;
        Route::group([
//                'middleware'=> ['LoginThrottle:5,10']
            ], function(){
            Route::post('doLogin', 'LoginController@doLogin' );
            Route::post('doLoginMobile', 'LoginController@doLoginMobile' );
        });

        //
        Route::get( 'forgotpassword', 'LoginController@forgotpassword' );
        Route::post( 'doSendVerification', 'LoginController@doSendVerification' );
        Route::post( 'doResetPassword', 'LoginController@doResetPassword' );

        //
        Route::any( 'logout', 'LoginController@logoutView' );
        Route::post( 'dologout', 'LoginController@doLogout' );

        //
        Route::post( 'doSetLocale/{locale}', 'LocaleController@doSetLocale' );

        //
        Route::group(
            [
                'middleware' => 'CheckLogin'
            ], function() {
             Route::get( 'index', 'IndexController@index' );

            /**********************************************************
             * Upload Images
             *********************************************************/
            Route::post( 'upload_image', 'UploadController@doUploadImage' );
            Route::post( 'upload_image_base64', 'UploadController@doUploadImageBase64' );

            /**********************************************************
             * Import Excel
             *********************************************************/
            Route::get( 'import_excel', 'ExcelController@index')->name('excel_index');
            Route::post('import_excel', 'ExcelController@import')->name('import');


            /**********************************************************
             * Member
             *********************************************************/
            Route::group(
                [
                    'prefix' => 'member',
                    'namespace' => 'Member',
//                    'middleware' => 'CheckAuthLogin'
                ], function() {
//                Route::get( 'userinfo', 'IndexController@index' );
//                Route::post( 'userinfo/dosave', 'IndexController@doSave' );
//                Route::post( 'userinfo/dosavepassword', 'IndexController@doSavePassword' );

                //
                Route::get( '', 'IndexController@index' );
                Route::any( 'getlist', 'IndexController@getList' );
                Route::get( 'add', 'IndexController@add' );
                Route::post( 'doadd', 'IndexController@doAdd' );
                Route::get( 'edit/{id}', 'IndexController@edit' );
                Route::post( 'dosave', 'IndexController@doSave' );
                Route::post( 'dosaveshow', 'IndexController@doSaveShow' );
                Route::post( 'dosavepassword', 'IndexController@doSavePassword' );
                Route::get( 'attr/{id}', 'IndexController@attr' );

                Route::group(
                    [
                        'prefix' => 'info',
                    ], function() {
                    //
                    Route::get( '', 'InfoController@index' );
                    Route::any( 'getlist', 'InfoController@getList' );
//                    Route::get( 'add', 'InfoController@add' );
//                    Route::post( 'doadd', 'InfoController@doAdd' );
                    Route::get( 'edit/{id}', 'InfoController@edit' );
                    Route::post( 'dosave', 'InfoController@doSave' );
//                    Route::post( 'dosaveshow', 'InfoController@doSaveShow' );
                } );
            } );


            /*************************************
             * 水庫資訊
             *************************************/
            Route::group(
                [
                    'prefix' => 'reservoir',
                    'namespace' => 'Reservoir',
                ], function() {

                    Route::get( '', 'IndexController@index' );
                    Route::any( 'getlist', 'IndexController@getList' );
                    Route::get( 'add', 'IndexController@add' );
                    Route::post( 'doadd', 'IndexController@doAdd' );
                    Route::get( 'edit/{id}', 'IndexController@edit' );
                    Route::post( 'dosave', 'IndexController@doSave' );
                    Route::post( 'dosaveshow', 'IndexController@doSaveShow' );
                    Route::post( 'dodel', 'IndexController@doDel' );
                    Route::get( 'attr/{id}', 'IndexController@attr' );
                    Route::post( 'dosaveattr', 'IndexController@doSaveAttributes' );

                    Route::group(
                        [
                            'prefix' => 'meta',
//                            'namespace' => 'Reservoir',
                        ], function() {

                        Route::get( '', 'MetaController@index' );
                        Route::get( 'getlist', 'MetaController@getList' );
                        Route::get( 'add', 'MetaController@add' );
                        Route::post( 'doadd', 'MetaController@doAdd' );
                        Route::get( 'edit/{id}', 'MetaController@edit' );
                        Route::post( 'dosave', 'MetaController@doSave' );
                        Route::post( 'dosaveshow', 'MetaController@doSaveShow' );
                        Route::post( 'dodel', 'MetaController@doDel' );
                        Route::get( 'attributes/{id}', 'MetaController@attributes' );
                        Route::post( 'dosaveattr', 'MetaController@doSaveAttributes' );
                    } );
            } );

            /*************************************
             * 地震event資訊
             *************************************/
            Route::group(
                [
                    'prefix' => 'event',
//                    'namespace' => '',
                ], function() {

                Route::get( '', 'IndexController@eventView' );
                Route::get( 'getlist', 'IndexController@getEventList' );
                Route::get( 'add', 'IndexController@addEvent' );
                Route::post( 'doadd', 'IndexController@doAddEvent' );
                Route::get( 'edit/{id}', 'IndexController@editEvent' );
                Route::post( 'dosave', 'IndexController@doSaveEvent' );
                Route::post( 'dosaveshow', 'IndexController@doSaveShowEvent' );
                Route::post( 'dodel', 'IndexController@doDelEvent' );
                Route::get( 'attr/{id}', 'IndexController@attrEvent' );
//                Route::post( 'dosaveattr', 'IndexController@doSaveAttributesEvent' );

            } );

            /*************************************
             * Log資訊
             *************************************/
            Route::group(
                [
                    'prefix' => 'log',
                    'middleware' => 'CheckSuperLogin',
                    'namespace' => 'LOG',
                ], function() {

                //
                Route::group(
                    [
                        'prefix' => 'login',
                    ], function() {
                    //
                    Route::get( '', 'LogController@index' );
//                    Route::any( 'getlist', 'LogController@getList' );
//                    Route::get( 'add', 'LogController@add' );
//                    Route::post( 'doadd', 'LogController@doAdd' );
//                    Route::get( 'edit/{id}', 'LogController@edit' );
//                    Route::post( 'dosave', 'LogController@doSave' );
//                    Route::post( 'dosaveshow', 'LogController@doSaveShow' );
                } );
                //
                Route::group(
                    [
                        'prefix' => 'edit',
                    ], function() {
                    //
                    Route::get( '', 'LogController@edit' );
                    Route::get( 'attr/{id}', 'LogController@attr' );
//                    Route::any( 'getlist', 'LogController@getList' );
//                    Route::get( 'add', 'LogController@add' );
//                    Route::post( 'doadd', 'LogController@doAdd' );
//                    Route::get( 'edit/{id}', 'LogController@edit' );
//                    Route::post( 'dosave', 'LogController@doSave' );
//                    Route::post( 'dosaveshow', 'LogController@doSaveShow' );
                } );

            } );

            Route::get( 'shakemap', 'IndexController@shakemap' );
            Route::get( 'shakemap2', 'IndexController@shakemap2' );


            /* Ajax */
            Route::post( 'addmessage', 'IndexController@addMessage');
            Route::post( 'savemessage', 'IndexController@doSaveMessage');
            Route::post( 'getcomment', 'IndexController@getCommentList');
            Route::post( 'getmessage', 'IndexController@getMessageList');


            /*************************************
             * 通知訊息
             *************************************/
            Route::group(
                [
                    'prefix' => 'message',
                    'namespace' => 'Message',
                ], function() {

                Route::get( '', 'IndexController@index' );
//                Route::any( 'getlist', 'IndexController@getList' );
//                Route::get( 'add', 'IndexController@add' );
//                Route::post( 'doadd', 'IndexController@doAdd' );
//                Route::get( 'edit/{id}', 'IndexController@edit' );
                Route::post( 'dosave', 'IndexController@doSave' );
//                Route::post( 'dosaveshow', 'IndexController@doSaveShow' );
                Route::get( 'dodelall', 'IndexController@doDelAll' );
                Route::get( 'attr/{id}', 'IndexController@attr' );
//                Route::post( 'dosaveattr', 'IndexController@doSaveAttributes' );

                Route::group(
                    [
                        'prefix' => 'center',
//                    'namespace' => '',
                    ], function() {

                    Route::get( '', 'CenterController@index' );
                    Route::get( 'getlist', 'CenterController@getList' );
                    Route::get( 'add', 'CenterController@add' );
                    Route::post( 'doadd', 'CenterController@doAdd' );
                    Route::get( 'edit/{id}', 'CenterController@edit' );
                    Route::post( 'dosave', 'CenterController@doSave' );
//                    Route::post( 'dosaveshow', 'centerController@doSaveShow' );
                    Route::post( 'dodel', 'CenterController@doDel' );
                    Route::get( 'dodelall', 'CenterController@doDelAll' );
                    Route::get( 'attr/{id}', 'CenterController@attr' );
//                Route::post( 'dosaveattr', 'IndexController@doSaveAttributesEvent' );

                } );
            } );


            /***********************************************************
             * Admin
             ***********************************************************/
//            Route::group(
//                [
//                    'prefix' => 'admin',
//                    'namespace' => '_Admin',
//                    'middleware' => 'CheckAdmin'
//                ], function() {
//                //
//                Route::group(
//                    [
//                        'prefix' => 'member',
//                        'namespace' => 'Member',
//                    ], function() {
//                    Route::group(
//                        [
//                            'prefix' => 'service'
//                        ], function() {
//                        Route::get( '', 'ServiceController@index' );
//                        Route::get( 'getlist', 'ServiceController@getList' );
//                        Route::post( 'doadd', 'ServiceController@doAdd' );
//                        Route::post( 'dosave', 'ServiceController@doSave' );
//                        Route::get( 'access/{id}', 'ServiceController@access' );
//                        Route::post( 'dosaveaccess', 'ServiceController@doSaveAccess' );
//                        Route::post( 'docancelservice', 'ServiceController@doCancelService' );
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'customer'
//                        ], function() {
//                        Route::get( '', 'CustomerController@index' );
//                        Route::get( 'getlist', 'CustomerController@getList' );
//                        Route::post( 'doadd', 'CustomerController@doAdd' );
//                        Route::post( 'dosave', 'CustomerController@doSave' );
//                        Route::get( 'access/{id}', 'CustomerController@access' );
//                        Route::post( 'dosaveaccess', 'CustomerController@doSaveAccess' );
//                        Route::post( 'doupgrade', 'CustomerController@doUpGrade' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/member/excel/customer');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'employee'
//                        ], function() {
//                        Route::get( '', 'EmployeeController@index' );
//                        Route::get( 'getlist', 'EmployeeController@getList' );
//                        Route::post( 'doadd', 'EmployeeController@doAdd' );
//                        Route::post( 'dosave', 'EmployeeController@doSave' );
//                        Route::get( 'access/{id}', 'EmployeeController@access' );
//                        Route::post( 'dosaveaccess', 'EmployeeController@doSaveAccess' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/member/excel/employee');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'store'
//                        ], function() {
//                        Route::get( '', 'StoreController@index' );
//                        Route::get( 'getlist', 'StoreController@getList' );
//                        Route::post( 'doadd', 'StoreController@doAdd' );
//                        Route::post( 'dosave', 'StoreController@doSave' );
//                        Route::get( 'access/{id}', 'StoreController@access' );
//                        Route::post( 'dosaveaccess', 'StoreController@doSaveAccess' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/member/excel/store');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'blogger'
//                        ], function() {
//                        Route::get( '', 'BloggerController@index' );
//                        Route::get( 'getlist', 'BloggerController@getList' );
//                        Route::post( 'doadd', 'BloggerController@doAdd' );
//                        Route::post( 'dosave', 'BloggerController@doSave' );
//                        Route::get( 'access/{id}', 'BloggerController@access' );
//                        Route::post( 'dosaveaccess', 'BloggerController@doSaveAccess' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/member/excel/blogger');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'supplier'
//                        ], function() {
//                        Route::get( '', 'SupplierController@index' );
//                        Route::get( 'getlist', 'SupplierController@getList' );
//                        Route::post( 'doadd', 'SupplierController@doAdd' );
//                        Route::post( 'dosave', 'SupplierController@doSave' );
//                        Route::get( 'access/{id}', 'SupplierController@access' );
//                        Route::post( 'dosaveaccess', 'SupplierController@doSaveAccess' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/member/excel/supplier');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'excel',
//                            'namespace' => 'Excel',
//                        ], function(){
//                        Route::group(
//                            [
//                                'prefix' => 'customer',
//                            ], function() {
//                            Route::get('','CustomerController@index');
//                            Route::get('getlist','CustomerController@getList');
//                            Route::post('upload-csv-excel','CustomerController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','CustomerController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','CustomerController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'employee',
//                            ], function() {
//                            Route::get('','EmployeeController@index');
//                            Route::get('getlist','EmployeeController@getList');
//                            Route::post('upload-csv-excel','EmployeeController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','EmployeeController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','EmployeeController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'store',
//                            ], function() {
//                            Route::get('','StoreController@index');
//                            Route::get('getlist','StoreController@getList');
//                            Route::post('upload-csv-excel','StoreController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','StoreController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','StoreController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'blogger',
//                            ], function() {
//                            Route::get('','BloggerController@index');
//                            Route::get('getlist','BloggerController@getList');
//                            Route::post('upload-csv-excel','BloggerController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','BloggerController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','BloggerController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'supplier',
//                            ], function() {
//                            Route::get('','SupplierController@index');
//                            Route::get('getlist','SupplierController@getList');
//                            Route::post('upload-csv-excel','SupplierController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','SupplierController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','SupplierController@downloadExcelFromFile');
//                        });
//                    });
//                } );
//                //
//                Route::group(
//                    [
//                        'prefix' => 'group',
//                        'namespace' => 'Group',
//                    ], function() {
//                    Route::group(
//                        [
//                            'prefix' => 'customer'
//                        ], function() {
//                        Route::get( '', 'CustomerController@index' );
//                        Route::get( 'getlist', 'CustomerController@getList' );
//                        Route::get( 'getmember', 'CustomerController@getMember' );
//                        Route::post( 'doadd', 'CustomerController@doAdd' );
//                        Route::post( 'dosave', 'CustomerController@doSave' );
//                        Route::post( 'dodel', 'CustomerController@doDel' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/group/excel/customer');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'employee'
//                        ], function() {
//                        Route::get( '', 'EmployeeController@index' );
//                        Route::get( 'getlist', 'EmployeeController@getList' );
//                        Route::get( 'getmember', 'EmployeeController@getMember' );
//                        Route::post( 'doadd', 'EmployeeController@doAdd' );
//                        Route::post( 'dosave', 'EmployeeController@doSave' );
//                        Route::post( 'dodel', 'EmployeeController@doDel' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/group/excel/employee');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'store'
//                        ], function() {
//                        Route::get( '', 'StoreController@index' );
//                        Route::get( 'getlist', 'StoreController@getList' );
//                        Route::get( 'getmember', 'StoreController@getMember' );
//                        Route::post( 'doadd', 'StoreController@doAdd' );
//                        Route::post( 'dosave', 'StoreController@doSave' );
//                        Route::post( 'dodel', 'StoreController@doDel' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/group/excel/store');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'blogger'
//                        ], function() {
//                        Route::get( '', 'BloggerController@index' );
//                        Route::get( 'getlist', 'BloggerController@getList' );
//                        Route::get( 'getmember', 'BloggerController@getMember' );
//                        Route::post( 'doadd', 'BloggerController@doAdd' );
//                        Route::post( 'dosave', 'BloggerController@doSave' );
//                        Route::post( 'dodel', 'BloggerController@doDel' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/group/excel/blogger');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'supplier'
//                        ], function() {
//                        Route::get( '', 'SupplierController@index' );
//                        Route::get( 'getlist', 'SupplierController@getList' );
//                        Route::get( 'getmember', 'SupplierController@getMember' );
//                        Route::post( 'doadd', 'SupplierController@doAdd' );
//                        Route::post( 'dosave', 'SupplierController@doSave' );
//                        Route::post( 'dodel', 'SupplierController@doDel' );
//                        Route::get( 'excel', function(){
//                            return redirect('web/admin/group/excel/supplier');
//                        });
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'excel',
//                            'namespace' => 'Excel',
//                        ], function(){
//                        Route::group(
//                            [
//                                'prefix' => 'customer',
//                            ], function() {
//                            Route::get('','CustomerController@index');
//                            Route::get('getlist','CustomerController@getList');
//                            Route::post('upload-csv-excel','CustomerController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','CustomerController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','CustomerController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'employee',
//                            ], function() {
//                            Route::get('','EmployeeController@index');
//                            Route::get('getlist','EmployeeController@getList');
//                            Route::post('upload-csv-excel','EmployeeController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','EmployeeController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','EmployeeController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'store',
//                            ], function() {
//                            Route::get('','StoreController@index');
//                            Route::get('getlist','StoreController@getList');
//                            Route::post('upload-csv-excel','StoreController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','StoreController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','StoreController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'blogger',
//                            ], function() {
//                            Route::get('','BloggerController@index');
//                            Route::get('getlist','BloggerController@getList');
//                            Route::post('upload-csv-excel','BloggerController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','BloggerController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','BloggerController@downloadExcelFromFile');
//                        });
//                        Route::group(
//                            [
//                                'prefix' => 'supplier',
//                            ], function() {
//                            Route::get('','SupplierController@index');
//                            Route::get('getlist','SupplierController@getList');
//                            Route::post('upload-csv-excel','SupplierController@uploadFileIntoStorage');
//                            Route::post('update-csv-excel','SupplierController@updateFileIntoDB');
//                            Route::get('download-excel-file/{type}','SupplierController@downloadExcelFromFile');
//                        });
//                    });
//                } );
//                //
//                Route::group(
//                    [
//                        'prefix' => 'exchange_rate',
//                        'namespace' => 'ExchangeRate',
//                    ], function() {
//                    Route::group(
//                        [
//                            'prefix' => 'index'
//                        ], function() {
//                        Route::get( '', 'IndexController@index' );
//                        Route::get( 'getlist', 'IndexController@getList' );
//                        Route::post( 'dosave', 'IndexController@doSave' );
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'log'
//                        ], function() {
//                        Route::get( '', 'LogController@index' );
//                        Route::get( 'getlist', 'LogController@getList' );
//                    } );
//                } );
//                //
//                Route::group(
//                    [
//                        'prefix' => 'category',
//                    ], function() {
//                    Route::get( '', 'CategoryController@index' );
//                    Route::get( 'getlist', 'CategoryController@getList' );
//                    Route::post( 'dosave', 'CategoryController@doSave' );
//                    Route::post( 'doadd', 'CategoryController@doAdd' );
//                    Route::group(
//                        [
//                            'prefix' => 'sub_{id}'
//                        ], function() {
//                        Route::get( '', 'CategoryController@sub' );
//                        Route::get( 'getlist', 'CategoryController@getListSub' );
//                        Route::post( 'dosave', 'CategoryController@doSaveSub' );
//                        Route::post( 'doadd', 'CategoryController@doAddSub' );
//                    } );
//                } );
//                //
//                Route::group(
//                    [
//                        'prefix' => 'config',
//                    ], function() {
//                    Route::get( '', 'ConfigController@index' );
//                    Route::get( 'getlist', 'ConfigController@getList' );
//                    Route::post( 'dosave', 'ConfigController@doSave' );
//                    Route::post( 'doadd', 'ConfigController@doAdd' );
//                } );
//            } );
//
//            /*************************************************************
//             * Scenes
//             *************************************************************/
//            Route::group(
//                [
//                    'prefix' => 'scenes',
//                    'namespace' => 'Scenes',
//                ], function() {
//                Route::group(
//                    [
//                        'prefix' => 'login',
//                        'namespace' => 'Login',
//                    ], function() {
//                    //背景圖
//                    Route::group(
//                        [
//                            'prefix' => 'background',
//                        ], function() {
//                        Route::get( '', 'BackgroundController@index' );
//                        Route::post( 'dosave', 'BackgroundController@doSave' );
//                        Route::post( 'doadd', 'BackgroundController@doAdd' );
//                        Route::post( 'dodel', 'BackgroundController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'home',
//                        'namespace' => 'Home',
//                    ], function() {
//                    //滑動圖
//                    Route::group(
//                        [
//                            'prefix' => 'slider',
//                        ], function() {
//                        Route::get( '', 'SliderController@index' );
//                        Route::get( 'getlist', 'SliderController@getList' );
//                        Route::post( 'dosave', 'SliderController@doSave' );
//                        Route::post( 'doadd', 'SliderController@doAdd' );
//                        Route::post( 'dodel', 'SliderController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'header',
//                        'namespace' => 'Header',
//                    ], function() {
//                    //連結編輯
//                    Route::group(
//                        [
//                            'prefix' => 'url',
//                        ], function() {
//                        Route::get( '', 'UrlController@index' );
//                        Route::get( 'getlist', 'UrlController@getList' );
//                        Route::post( 'dosave', 'UrlController@doSave' );
//                        Route::post( 'doadd', 'UrlController@doAdd' );
//                        Route::post( 'dodel', 'UrlController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'footer',
//                        'namespace' => 'Footer',
//                    ], function() {
//                    //連結編輯
//                    Route::group(
//                        [
//                            'prefix' => 'url',
//                        ], function() {
//                        Route::get( '', 'UrlController@index' );
//                        Route::get( 'getlist', 'UrlController@getList' );
//                        Route::post( 'dosave', 'UrlController@doSave' );
//                        Route::post( 'doadd', 'UrlController@doAdd' );
//                        Route::post( 'dodel', 'UrlController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'category',
//                        'namespace' => 'Category',
//                    ], function() {
//                    //banner圖
//                    Route::group(
//                        [
//                            'prefix' => 'banner',
//                        ], function() {
//                        Route::get( '', 'BannerController@index' );
//                        Route::post( 'dosave', 'BannerController@doSave' );
//                        Route::post( 'doadd', 'BannerController@doAdd' );
//                        Route::post( 'dodel', 'BannerController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'product',
//                        'namespace' => 'Product',
//                    ], function() {
//                    //banner圖
//                    Route::group(
//                        [
//                            'prefix' => 'banner',
//                        ], function() {
//                        Route::get( '', 'BannerController@index' );
//                        Route::post( 'dosave', 'BannerController@doSave' );
//                        Route::post( 'doadd', 'BannerController@doAdd' );
//                        Route::post( 'dodel', 'BannerController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'cart',
//                        'namespace' => 'Cart',
//                    ], function() {
//                    //banner圖
//                    Route::group(
//                        [
//                            'prefix' => 'banner',
//                        ], function() {
//                        Route::get( '', 'BannerController@index' );
//                        Route::post( 'dosave', 'BannerController@doSave' );
//                        Route::post( 'doadd', 'BannerController@doAdd' );
//                        Route::post( 'dodel', 'BannerController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'order',
//                        'namespace' => 'Order',
//                    ], function() {
//                    //banner圖
//                    Route::group(
//                        [
//                            'prefix' => 'banner',
//                        ], function() {
//                        Route::get( '', 'BannerController@index' );
//                        Route::post( 'dosave', 'BannerController@doSave' );
//                        Route::post( 'doadd', 'BannerController@doAdd' );
//                        Route::post( 'dodel', 'BannerController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'news',
//                        'namespace' => 'News',
//                    ], function() {
//                    //banner圖
//                    Route::group(
//                        [
//                            'prefix' => 'banner',
//                        ], function() {
//                        Route::get( '', 'BannerController@index' );
//                        Route::post( 'dosave', 'BannerController@doSave' );
//                        Route::post( 'doadd', 'BannerController@doAdd' );
//                        Route::post( 'dodel', 'BannerController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'member_center',
//                        'namespace' => 'MemberCenter',
//                    ], function() {
//                    //banner圖
//                    Route::group(
//                        [
//                            'prefix' => 'banner',
//                        ], function() {
//                        Route::get( '', 'BannerController@index' );
//                        Route::post( 'dosave', 'BannerController@doSave' );
//                        Route::post( 'doadd', 'BannerController@doAdd' );
//                        Route::post( 'dodel', 'BannerController@doDel' );
//                    } );
//                } );
//            } );
//
//            /*************************************************************
//             * Product 商品庫
//             *************************************************************/
//            Route::group(
//                [
//                    'prefix' => 'product',
//                    'namespace' => 'Product',
//                ], function() {
//                /*
//                 * 商品類別管理
//                 */
//                Route::group(
//                    [
//                        'prefix' => 'category',
//                    ], function() {
//                    Route::get( '', 'CategoryController@index' );
//                    Route::get( 'getlist', 'CategoryController@getList' );
//                    Route::post( 'dosave', 'CategoryController@doSave' );
//                    Route::post( 'doadd', 'CategoryController@doAdd' );
//                    Route::post( 'dodel', 'CategoryController@doDel' );
//                    Route::group(
//                        [
//                            'prefix' => 'sub_{id}'
//                        ], function() {
//                        Route::get( '', 'CategoryController@sub' );
//                        Route::get( 'getlist', 'CategoryController@getListSub' );
//                        Route::post( 'dosave', 'CategoryController@doSaveSub' );
//                        Route::post( 'doadd', 'CategoryController@doAddSub' );
//                        Route::post( 'dodel', 'CategoryController@doDelSub' );
//                    } );
//                } );
//                /*
//                 * 商品管理
//                 */
//                Route::group(
//                    [
//                        'prefix' => 'manage',
//                    ], function() {
//                    //A01
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a01',
//                            'namespace' => 'MuseumA01',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                        Route::group(
//                            [
//                                'prefix' => 'purchase/{id}',
//                            ], function() {
//                            Route::get( '', 'PurchaseController@index' );
//                            Route::get( 'getlist', 'PurchaseController@getList' );
//                            Route::post( 'doadd', 'PurchaseController@doAdd' );
//                            Route::post( 'dosave', 'PurchaseController@doSave' );
//                            Route::post( 'dodel', 'PurchaseController@doDel' );
//                        } );
//                        Route::group(
//                            [
//                                'prefix' => 'recommend/{id}',
//                            ], function() {
//                            Route::get( '', 'RecommendController@index' );
//                            Route::get( 'getlist', 'RecommendController@getList' );
//                            Route::post( 'doadd', 'RecommendController@doAdd' );
//                            Route::post( 'dosave', 'RecommendController@doSave' );
//                            Route::post( 'dodel', 'RecommendController@doDel' );
//                        } );
//                        Route::group(
//                            [
//                                'prefix' => 'gifts/{id}',
//                            ], function() {
//                            Route::get( '', 'GiftsController@index' );
//                            Route::get( 'getlist', 'GiftsController@getList' );
//                            Route::post( 'doadd', 'GiftsController@doAdd' );
//                            Route::post( 'dosave', 'GiftsController@doSave' );
//                            Route::post( 'dodel', 'GiftsController@doDel' );
//                        } );
//                        Route::group(
//                            [
//                                'prefix' => 'appraise/{id}',
//                            ], function() {
//                            Route::get( '', 'AppraiseController@index' );
//                            Route::get( 'getlist', 'AppraiseController@getList' );
//                            Route::post( 'doadd', 'AppraiseController@doAdd' );
//                            Route::post( 'dosave', 'AppraiseController@doSave' );
//                            Route::post( 'dodel', 'AppraiseController@doDel' );
//                        } );
//                    } );
//                    //A02
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a02',
//                            'namespace' => 'MuseumA02',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A03
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a03',
//                            'namespace' => 'MuseumA03',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A04
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a04',
//                            'namespace' => 'MuseumA04',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A05
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a05',
//                            'namespace' => 'MuseumA05',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A06
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a06',
//                            'namespace' => 'MuseumA06',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A07
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a07',
//                            'namespace' => 'MuseumA07',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A08
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a08',
//                            'namespace' => 'MuseumA08',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A09
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a09',
//                            'namespace' => 'MuseumA09',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A10
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a10',
//                            'namespace' => 'MuseumA10',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A11
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a11',
//                            'namespace' => 'MuseumA11',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::get( 'add', 'ManageController@addSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::get( 'edit/{subid}', 'ManageController@editSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                    //A12
//                    Route::group(
//                        [
//                            'prefix' => 'museum_a12',
//                            'namespace' => 'MuseumA12',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dosaveshow', 'ManageController@doSaveShow' );
//                        Route::get( 'attributes/{id}', 'ManageController@attributes' );
//                        Route::post( 'dosaveattr', 'ManageController@doSaveAttributes' );
//                        Route::get( 'lang/{id}', 'ManageController@lang' );
//                        Route::post( 'dosavelang', 'ManageController@doSaveLang' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                        Route::post( 'docopy', 'ManageController@doCopy' );
//                        Route::group(
//                            [
//                                'prefix' => 'specification/{id}',
//                            ], function() {
//                            Route::get( '', 'ManageController@specification' );
//                            Route::get( 'getlist', 'ManageController@getListSpecification' );
//                            Route::post( 'doadd', 'ManageController@doAddSpecification' );
//                            Route::post( 'dosave', 'ManageController@doSaveSpecification' );
//                            Route::post( 'dodel', 'ManageController@doDelSpecification' );
//                        } );
//                    } );
//                } );
//                /*
//                 * 運費管理
//                 */
//                Route::group(
//                    [
//                        'prefix' => 'shipping',
//                    ], function() {
//                    Route::get( '', 'ShippingController@index' );
//                    Route::get( 'getlist', 'ShippingController@getList' );
//                    Route::post( 'dosave', 'ShippingController@doSave' );
//                    Route::post( 'doadd', 'ShippingController@doAdd' );
//                    Route::post( 'dodel', 'ShippingController@doDel' );
//                    Route::get( '{error}', function() {
//                        return abort( 503 );
//                    } );
//                } );
//                /*
//                * 付款方式
//                */
//                Route::group(
//                    [
//                        'prefix' => 'pay',
//                    ], function() {
//                    Route::get( '', 'PayController@index' );
//                    Route::get( 'getlist', 'PayController@getList' );
//                    Route::post( 'dosave', 'PayController@doSave' );
//                    Route::post( 'doadd', 'PayController@doAdd' );
//                    Route::post( 'dodel', 'PayController@doDel' );
//                    Route::get( '{error}', function() {
//                        return abort( 503 );
//                    } );
//                } );
//                /*
//                 * LOG
//                 */
//                Route::group(
//                    [
//                        'prefix' => 'log',
//                    ], function() {
//                    Route::get( '', 'LogController@index' );
//                    Route::get( 'getlist', 'LogController@getList' );
//                } );
//            } );
//
//            /***********************************************************
//             * 訂單管理
//             ***********************************************************/
//            Route::group(
//                [
//                    'prefix' => 'order',
//                    'namespace' => 'Order',
//                ], function() {
//                Route::group(
//                    [
//                        'prefix' => 'product',
//                        'namespace' => 'Product',
//                    ], function() {
//                    Route::get( '', 'IndexController@index' );
//                    Route::get( 'getlist', 'IndexController@getList' );
//                    Route::post( 'doadd', 'IndexController@doAdd' );
//                    Route::post( 'dosave', 'IndexController@doSave' );
//                    Route::get( 'doexport', 'IndexController@doExport' );
//                    Route::group(
//                        [
//                            'prefix' => 'meta_{id}'
//                        ], function() {
//                        Route::get( '', 'MetaController@index' );
//                        Route::get( 'getlist', 'MetaController@getList' );
//                        Route::post( 'dosave', 'MetaController@doSave' );
//                    } );
//                } );
//            } );
//
//            /************************************************
//             ** 活動管理
//             ************************************************/
//            Route::group(
//                [
//                    'prefix' => 'activity',
//                    'namespace' => 'Activity',
//                ], function() {
//                Route::group(
//                    [
//                        'prefix' => 'coupon',
//                        'namespace' => 'Coupon',
//                    ], function() {
//                    Route::group(
//                        [
//                            'prefix' => 'ticket',
//                        ], function() {
//                        Route::get( '', 'TicketController@index' );
//                        Route::get( 'getlist', 'TicketController@getList' );
//                        Route::get( 'add', 'TicketController@add' );
//                        Route::post( 'doadd', 'TicketController@doAdd' );
//                        Route::get( 'edit/{id}', 'TicketController@edit' );
//                        Route::post( 'dosave', 'TicketController@doSave' );
//                        Route::post( 'dodel', 'TicketController@doDel' );
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'promotion_code',
//                        ], function() {
//                        Route::get( '', 'PromotionCodeController@index' );
//                        Route::get( 'getlist', 'PromotionCodeController@getList' );
//                        Route::get( 'add', 'PromotionCodeController@add' );
//                        Route::post( 'doadd', 'PromotionCodeController@doAdd' );
//                        Route::get( 'edit/{id}', 'PromotionCodeController@edit' );
//                        Route::post( 'dosave', 'PromotionCodeController@doSave' );
//                        Route::post( 'dodel', 'PromotionCodeController@doDel' );
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'gallery',
//                        ], function() {
//                        Route::get( '', 'GalleryController@index' );
//                        Route::get( 'getlist', 'GalleryController@getList' );
//                        Route::get( 'add', 'GalleryController@add' );
//                        Route::post( 'doadd', 'GalleryController@doAdd' );
//                        Route::get( 'edit/{id}', 'GalleryController@edit' );
//                        Route::post( 'dosave', 'GalleryController@doSave' );
//                        Route::post( 'dodel', 'GalleryController@doDel' );
//                        Route::get( 'lang/{id}', 'GalleryController@lang' );
//                        Route::post( 'dosavelang', 'GalleryController@doSaveLang' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'coin',
//                        'namespace' => 'Coin',
//                    ], function() {
//                    Route::group(
//                        [
//                            'prefix' => 'index',
//                        ], function() {
//                        Route::get( '', 'IndexController@index' );
//                        Route::get( 'getlist', 'IndexController@getList' );
//                        Route::post( 'doadd', 'IndexController@doAdd' );
//                        Route::post( 'dosave', 'IndexController@doSave' );
//                        Route::post( 'dodel', 'IndexController@doDel' );
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'manage',
//                        ], function() {
//                        Route::get( '', 'ManageController@index' );
//                        Route::get( 'getlist', 'ManageController@getList' );
//                        Route::get( 'add', 'ManageController@add' );
//                        Route::post( 'doadd', 'ManageController@doAdd' );
//                        Route::get( 'edit/{id}', 'ManageController@edit' );
//                        Route::post( 'dosave', 'ManageController@doSave' );
//                        Route::post( 'dodel', 'ManageController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'news',
//                        'namespace' => 'News',
//                    ], function() {
//                    Route::group(
//                        [
//                            'prefix' => 'index',
//                        ], function() {
//                        Route::get( '', 'IndexController@index' );
//                        Route::get( 'getlist', 'IndexController@getList' );
//                        Route::post( 'doadd', 'IndexController@doAdd' );
//                        Route::post( 'dosave', 'IndexController@doSave' );
//                        Route::post( 'dodel', 'IndexController@doDel' );
//                    } );
//                } );
//                Route::group(
//                    [
//                        'prefix' => 'schedule',
//                        'namespace' => 'Schedule',
//                    ], function() {
//    //                Route::group(
//    //                    [
//    //                        'prefix' => '',
//    //                    ], function() {
//                    Route::get( '', 'IndexController@index' );
//                    Route::get( 'getlist', 'IndexController@getList' );
//                    Route::post( 'doadd', 'IndexController@doAdd' );
//                    Route::post( 'dosave', 'IndexController@doSave' );
//                    Route::post( 'dodel', 'IndexController@doDel' );
//    //                } );
//
//                    Route::group(
//                        [
//                            'prefix' => 'recommend/{id}',
//                        ], function() {
//                        Route::get( '', 'RecommendController@index' );
//                        Route::get( 'getlist', 'RecommendController@getList' );
//                        Route::post( 'doadd', 'RecommendController@doAdd' );
//                        Route::post( 'dosave', 'RecommendController@doSave' );
//                        Route::post( 'dodel', 'RecommendController@doDel' );
//                    } );
//                    Route::group(
//                        [
//                            'prefix' => 'people/{id}',
//                        ], function() {
//                        Route::get( '', 'PeopleController@index' );
//                        Route::get( 'getlist', 'PeopleController@getList' );
//                        Route::post( 'doadd', 'PeopleController@doAdd' );
//                        Route::post( 'dosave', 'PeopleController@doSave' );
//                        Route::post( 'dodel', 'PeopleController@doDel' );
//                    } );
//                } );
//
//            } );
//
//            /*************************************
//             * 訊息公告
//             *************************************/
//            Route::group(
//                [
//                    'prefix' => 'news',
//                    'namespace' => 'News',
//                ], function() {
//                Route::group(
//                    [
//                        'prefix' => 'index',
//                    ], function() {
//                    Route::get( '', 'IndexController@index' );
//                    Route::get( 'getlist', 'IndexController@getList' );
//                    Route::post( 'doadd', 'IndexController@doAdd' );
//                    Route::post( 'dosave', 'IndexController@doSave' );
//                    Route::post( 'dodel', 'IndexController@doDel' );
//                } );
//            } );
//
//            /*************************************
//             * LOG
//             *************************************/
//            Route::group(
//                [
//                    'prefix' => 'log',
//                    'namespace' => 'LOG',
//                ], function() {
//                Route::group(
//                    [
//                        'prefix' => 'log01',
//                        'namespace' => 'L01',
//                    ], function() {
//                    Route::get( '', 'IndexController@index' );
//                    Route::get( 'getlist', 'IndexController@getList' );
//                    Route::post( 'doadd', 'IndexController@doAdd' );
//                } );
//            } );

        } );
});