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

Route::group(['namespace' => '\App\Http\Controllers'], function () {
    // book routes
    Route::get('/', 'BookController@index')->name('books.index');
    Route::post('books/create', 'BookController@create')->name('books.store');
    Route::post('books/{id}/update', 'BookController@update')->name('books.update');
    Route::delete('books/{id}', 'BookController@delete')->name('books.delete');
    Route::get('books/download/{downloadItem}/{downloadAs}', 'BookController@download')->name('books.download');
});