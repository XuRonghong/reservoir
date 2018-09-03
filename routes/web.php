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

//不需要登入驗證-前台
//Route::group(
//    [
//        'namespace' => '_Portal',
//    ], function() {
//    //
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

//需要登入驗證-前台
//Route::group(
//    [
//        'namespace' => '_Portal',
//        'middleware' => [ '' ]
//    ], function() {
//    //
//    Route::get( 'register' , 'RegisterController@index' );//
//    //
//    Route::get( 'logout', 'LogoutController@index' );
//    //
//    Route::get( 'search', 'SearchController@index' );
//} );


/*
 * 後台
 */
//Route::get( 'web', '_Web\LoginController@index' );


Route::group(
    [
//        'middleware' => 'CheckLang',
        'prefix' => '',
        'namespace' => '_Web'
    ], function() {


    //
    Route::get('import_excel', 'ExcelController@index')->name('index');
    Route::post('import_excel', 'ExcelController@import')->name('import');


    //
    Route::get( '', 'LoginController@index');
    //
    Route::get( 'home', 'IndexController@index' );
    Route::get( 'add', 'IndexController@add' );
    //
    Route::get( 'member', 'MemberController@index' );
    Route::get( 'member/add', 'MemberController@add' );
    //
    Route::get( 'logout', 'LoginController@index' );


    //
    Route::get('register', 'RegisterController@index');
    Route::post('doRegister', 'RegisterController@doRegister');


    Route::group([
        'middleware' => ['LoginThrottle:5,30']
    ], function () {
        Route::post('doLogin', 'LoginController@doLogin');
    });

});