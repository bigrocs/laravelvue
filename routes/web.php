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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin',  'namespace' => 'Api\Admin'], function () {
	Route::get('login', [ 'as' => 'api.auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', [ 'as' => 'api.auth.login', 'uses' => 'AuthController@Login']);
    Route::post('logout', [ 'as' => 'api.auth.logout', 'uses' => 'AuthController@Logout']);
});
/*
|--------------------------------------------------------------------------
| 后台路由设置 routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
    Route::get('/{vue_capture?}', function () {
        return view('admin.index');
    })->where('vue_capture', '[\/\w\.-]*');
});
