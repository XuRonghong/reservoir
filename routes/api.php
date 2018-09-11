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

    //
    Route::group(
        [
            'prefix' => 'shakemap_event_api',
        ], function() {
        Route::post( '', '_APIController@shakemap_event_api' );
    } );
} );



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
