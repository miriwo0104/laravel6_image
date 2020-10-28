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

// 下記を追記
// 画像アップロードページ用
Route::get('/input', 'ImageController@input')->name('input');

// 画像アップロード処理用
Route::post('/upload', 'ImageController@upload')->name('upload');
// 上記までを追記