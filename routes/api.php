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
});
