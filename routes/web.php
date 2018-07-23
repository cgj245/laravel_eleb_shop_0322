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

Route::get('shops','ShopController@index')->name('shops.index');
Route::get('/shops/create','ShopController@create')->name('shops.create');
Route::post('/shops','ShopController@store')->name('shops.store');
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::delete('logout','LoginController@destroy')->name('logout');

Route::resource('shop_users','shop_userController');
Route::resource('menu_cates','MenuCateController');
Route::resource('menus','MenuController');
Route::resource('actions','ActionController');
