<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'namespace' => '_API',
    ], function() {

    //
    Route::get( 'get_data', '_APIController@getModData' );
    Route::post( 'put_data', '_APIController@addModData' );
    Route::post( 'post_data', '_APIController@editModData' );
    Route::post( 'get_data/del/{id}', '_APIController@delModData' );

    Route::get( 'device_token', '_APIController@getDeviceToken' );
    Route::post( 'put_token', '_APIController@addModDeviceToken' );


    //
    Route::any( 'shakemap_event_api', '_APIController@shakemap_event_api' );


    Route::group(
        [
            'prefix' => 'category',
            'namespace' => 'Category',
        ], function() {
        Route::get( 'getlist', 'IndexController@getList' );
    } );
    Route::group(
        [
            'prefix' => 'product',
            'namespace' => 'Product',
        ], function() {
        Route::get( 'dosearch', 'IndexController@doSearch' );
        Route::get( 'getlist', 'IndexController@getList' );
    } );
    //
    Route::group(
        [
            'prefix' => 'news',
        ], function() {
        Route::get( 'getlist', 'NewsController@getList' );
    } );
    //
    Route::group(
        [
            'prefix' => 'search',
        ], function() {
        Route::get( 'getlist', 'SearchController@getList' );
    } );
} );



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
