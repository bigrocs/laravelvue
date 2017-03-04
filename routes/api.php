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

Route::group(['prefix' => 'admin', 'middleware' => 'api', 'namespace' => 'Api\Admin'], function () {
    Route::post('main', [ 'as' => 'api.main.index', 'uses' => 'MainController@index']);
});
/**
 * system路由
 */
Route::group(['prefix' => 'admin/system', 'middleware' => 'auth:api', 'namespace' => 'Api\Admin'], function () {

    Route::post('system', [ 'as' => 'api.system.index', 'uses' => 'SystemController@index']);
    Route::post('system/update', ['as' => 'api.system.update', 'uses' => 'SystemController@update']);

    Route::post('config', [ 'as' => 'api.config.index', 'uses' => 'ConfigController@index']);
    Route::post('config/status', ['as' => 'api.config.status', 'uses' => 'ConfigController@status']);
    Route::post('config/delete', ['as' => 'api.config.delete', 'uses' => 'ConfigController@delete']);
    Route::post('config/add', ['as' => 'api.config.add', 'uses' => 'ConfigController@add']);
    Route::post('config/store', ['as' => 'api.config.store', 'uses' => 'ConfigController@store']);
    Route::post('config/edit', ['as' => 'api.config.edit', 'uses' => 'ConfigController@edit']);
    Route::post('config/update', ['as' => 'api.config.store', 'uses' => 'ConfigController@update']);

    Route::post('upload/image', [ 'as' => 'api.upload.image', 'uses' => 'UploadController@postImage']);
});
