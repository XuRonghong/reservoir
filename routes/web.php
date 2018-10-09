<?php

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
                'middleware'=> ['LoginThrottle:5,10']
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
             * 追蹤查核內容
             *************************************/
            Route::group(
                [
                    'prefix' => 'record',
                    'namespace' => 'Record',
                ], function() {

                Route::group(
                    [
                        'prefix' => 'trace',
                    ], function() {

                    Route::get( '', 'TraceController@index' );
                    Route::get( 'getlist', 'TraceController@getList' );
                    Route::get( 'add', 'TraceController@add' );
                    Route::post( 'doadd', 'TraceController@doAdd' );
                    Route::get( 'edit/{id}', 'TraceController@edit' );
                    Route::post( 'dosave', 'TraceController@doSave' );
                    Route::post( 'dosaveshow', 'TraceController@doSaveShow' );
                    Route::post( 'dodel', 'TraceController@doDel' );
                    Route::get( 'attributes/{id}', 'TraceController@attributes' );
                    Route::post( 'dosaveattr', 'TraceController@doSaveAttributes' );

                } );

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

        } );
});