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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');


Route::group(['prefix' => 'admin', 'middleware' => 'api', 'namespace' => 'Api\Admin'], function () {
    Route::get('main', [ 'as' => 'api.main.index', 'uses' => 'MainController@index']);

    Route::post('system', [ 'as' => 'api.system.index', 'uses' => 'SystemController@index']);
    Route::patch('system/update', ['as' => 'api.system.update', 'uses' => 'SystemController@update']);

    Route::post('config', [ 'as' => 'api.config.index', 'uses' => 'ConfigController@index']);
    Route::patch('config/status', ['as' => 'api.config.status', 'uses' => 'ConfigController@status']);
    Route::patch('config/delete', ['as' => 'api.config.delete', 'uses' => 'ConfigController@delete']);

    Route::post('upload/image', [ 'as' => 'api.upload.image', 'uses' => 'UploadController@postImage']);
});
