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
// 画像アップロードページ用
Route::get('/input', 'ImageController@input')->name('input');

// 画像アップロード処理用
Route::post('/upload', 'ImageController@upload')->name('upload');

// 画像一覧ページ用
Route::get('/output', 'ImageController@output')->name('output');

// 画像詳細ページ用
Route::get('/detail/{images_id}', 'ImageController@detail')->name('detail');

// 画像表示ページ用
Route::get('/display/{images_id}', 'ImageController@display')->name('display');

// ダウンロード用
Route::post('/download', 'ImageController@download')->name('download');

// 下記を追記
// zipダウンロード用
Route::post('/zip_download', 'ImageController@zipDownload')->name('zipDownload');