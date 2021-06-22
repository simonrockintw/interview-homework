<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'IndexController@index')->name('home');
Route::get('/news/{news}', 'IndexController@show')->where('news', '[0-9]+')->name('news-show');

Route::prefix('backend')->group(function () {
    Route::get('/', 'NewsController@index')->name('home');

    Route::get('/news/index', 'NewsController@showIndexForm')->name('news-record');
    Route::resource('news', 'NewsController');
    Route::put('/news/{news}', 'NewsController@changeDisplay')->where('news', '[0-9]+')->name('news-change-display');
});
