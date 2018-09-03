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


/*
 * 後台
 */

//不需要登入驗證
Route::group(
    [
        'namespace' => '_Web',
    ], function() {
    Route::get( '' , 'LoginController@indexView') ;//->middleware([ 'CheckMallLogout' ]);

    Route::get( 'login' , 'LoginController@indexView') ;//->middleware([ 'CheckMallLogout' ]);
    Route::group([
//        'middleware'=> ['LoginThrottle:5,10']
    ], function(){
        Route::post('doLogin'   , 'LoginController@doLogin' );
    });
    //
    //Route::get('register', 'LoginController@registerView');
    Route::post('doRegister' , 'LoginController@doRegister' );//
    //
    Route::post('doSendVerification', 'LoginController@doSendVerification' );//
    Route::post('doResetPassword'   , 'LoginController@doResetPassword' );//
    Route::get( 'doActive/{usercode}', 'LoginController@doActive' );//
    //
    Route::post('logout' , 'LoginController@logoutView' );
    Route::post('doLogout' , 'LoginController@doLogout' );
});

//需要登入驗證
Route::group(
    [
        'middleware' => 'CheckMallLogin',
        'prefix' => '',
        'namespace' => '_Web'
    ], function() {

    //
    Route::get('import_excel', 'ExcelController@index')->name('index');
    Route::post('import_excel', 'ExcelController@import')->name('import');

    //
    Route::get( 'home', 'IndexController@index' );
    Route::get( 'add', 'IndexController@add' );
    //
    Route::get( 'member', 'MemberController@index' );
    Route::get( 'member/add', 'MemberController@add' );
    //
    Route::get( 'logout', 'LoginController@logoutView' );
    Route::post( 'dologout', 'LoginController@doLogout' );


    /*********************************
     * 會員中心
     **********************************/
    Route::group(
        [
            'middleware' => 'CheckMallLogin',
            'prefix' => 'member_center',
            'namespace' => 'MemberCenter'
        ], function() {

        //會員資訊
        Route::get( '', 'InformationController@index' );
        Route::post( 'dosave', 'InformationController@doSave' );
        Route::post( 'dosavepassword', 'InformationController@doSavePassword' );


        //我的收藏
        Route::group(
            [
                'prefix' => 'keep',
                'namespace' => 'Keep'
            ], function() {
            Route::get( '', 'IndexController@index' );
            Route::post( 'doadd', 'IndexController@doAdd' );
            Route::post( 'dosave', 'IndexController@doSave' );
            Route::post( 'dodel', 'IndexController@doDel' );
            Route::get( 'getlist', 'IndexController@getList' );
        } );
    } );

});