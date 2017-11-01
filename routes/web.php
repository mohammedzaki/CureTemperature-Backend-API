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

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::resource('users', 'UserController');

Route::resource('permissions', 'PermissionController');

Route::resource('roles', 'RoleController');

Route::resource('deviceCategories', 'DeviceCategoryController');

Route::resource('devices', 'DeviceController');