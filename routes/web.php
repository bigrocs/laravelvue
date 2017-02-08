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
/*
|--------------------------------------------------------------------------
| 后台路由设置 routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin','namespace' => 'Admin','as' => 'admin.'], function () {
    // 后台首页设置BEGIN
    Route::get ('/login'                        , 'LoginController@getLogin'              )->name('login');
    Route::post('/login'                        , 'LoginController@postLogin');
    // 后台首页设置EN
});
Route::group(['prefix' => 'admin',
    // 'middleware' => 'auth.admin'
], function () {
    Route::get('/{vue_capture?}', function () {
        return view('admin.index');
    })->where('vue_capture', '[\/\w\.-]*');
});
