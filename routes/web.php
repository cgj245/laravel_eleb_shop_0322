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
Route::get('updateStatus','OrderController@updateStatus')->name('updateStatus');
Route::get('orderCount','OrderController@orderCount')->name('orderCount');
Route::get('menuCount','MenuController@menuCount')->name('menuCount');

Route::resource('shop_users','shop_userController');
Route::resource('menu_cates','MenuCateController');
Route::resource('menus','MenuController');
Route::resource('actions','ActionController');
Route::resource('orders','OrderController');
Route::resource('eventShops','EventShopController');
Route::resource('events','EventController');

Route::get('updatestatus','EventController@updatestatus')->name('updatestatus');

//上传图片
Route::post('upload',function (){
    $storage=\Illuminate\Support\Facades\Storage::disk('oss');
    $fileName=$storage->putFile('upload',request()->file('file'));
    return [
        'fileName'=>$storage->url($fileName)
    ];
})->name('upload');