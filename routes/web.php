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
Route::group(['prefix' => 'admin',  'namespace' => 'Admin'], function () {
	Route::get('login', [ 'as' => 'admin.auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', [ 'as' => 'admin.auth.login', 'uses' => 'AuthController@postLogin']);
    Route::post('logout', [ 'as' => 'admin.auth.logout', 'uses' => 'AuthController@postLogout']);
});
/*
|--------------------------------------------------------------------------
| 后台路由设置 routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin','middleware' => 'admin', 'as' => 'admin'], function () {
    Route::get('/{vue_capture?}', function () {
        return view('admin.index');
    })->where('vue_capture', '[\/\w\.-]*');
});
