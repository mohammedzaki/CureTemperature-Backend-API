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

Route::resource('users', 'UserAPIController');

Route::resource('deviceFeeds', 'DeviceFeedsAPIController');

//Route::put('users/saveDeviceToken/{user}', 'UserAPIController@saveDeviceToken')->name('users.saveDeviceToken');

Route::resource('user_cates', 'UserCateAPIController');