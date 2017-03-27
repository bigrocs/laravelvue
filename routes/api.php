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
/*
|--------------------------------------------------------------------------
| Admin主路由设置 routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'api', 'namespace' => 'Api\Admin'], function () {
    Route::post('main', [ 'as' => 'api.admin.main.index', 'uses' => 'MainController@index']);
});
/*
|--------------------------------------------------------------------------
| Admin授权路由设置 routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin/system', 'as' => 'api.admin.system.', 'middleware' => ['admin','auth:api'], 'namespace' => 'Api\Admin'], function () {

    Route::post('system', [ 'as' => 'system.index', 'uses' => 'SystemController@index']);
    Route::post('system/update', ['as' => 'system.update', 'uses' => 'SystemController@update']);

    Route::post('config', [ 'as' => 'config.index', 'uses' => 'ConfigController@index']);
    Route::post('config/status', ['as' => 'config.status', 'uses' => 'ConfigController@status']);
    Route::post('config/delete', ['as' => 'config.delete', 'uses' => 'ConfigController@delete']);
    Route::post('config/add', ['as' => 'config.add', 'uses' => 'ConfigController@add']);
    Route::post('config/store', ['as' => 'config.store', 'uses' => 'ConfigController@store']);
    Route::post('config/edit', ['as' => 'config.edit', 'uses' => 'ConfigController@edit']);
    Route::post('config/update', ['as' => 'config.store', 'uses' => 'ConfigController@update']);

    Route::post('upload/image', [ 'as' => 'upload.image', 'uses' => 'UploadController@postImage']);

    Route::post('user', [ 'as' => 'user.index', 'uses' => 'UserController@index']);
});

/*
|--------------------------------------------------------------------------
| Cms主路由设置 routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'cms', 'middleware' => 'api', 'namespace' => 'Api\cms'], function () {
    Route::post('main', [ 'as' => 'api.cms.main.index', 'uses' => 'MainController@index']);
});