<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BookController;

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

// Book
Route::get('/api/book/index-json', 'App\Http\Controllers\BookController@getIndex');
Route::get('/api/book/detail-json/{id}', 'App\Http\Controllers\BookController@getDetail');
Route::post('/api/book/register', 'App\Http\Controllers\BookController@create');
Route::post('/api/book/edit/{id}', 'App\Http\Controllers\BookController@update');
Route::post('/api/book/delete/{id}', 'App\Http\Controllers\BookController@delete');

// Chapter
Route::post('/chapter/register/{id}', 'App\Http\Controllers\ChapterController@create');
Route::get('/chapter/edit/{id}', 'App\Http\Controllers\ChapterController@edit');
Route::post('/chapter/edit/{id}', 'App\Http\Controllers\ChapterController@update');
Route::post('/chapter/delete/{id}', 'App\Http\Controllers\ChapterController@delete');

// Author
Route::get('/api/author/index-json', 'App\Http\Controllers\AuthorController@getIndex');
Route::get('/api/author/detail-json/{id}', 'App\Http\Controllers\AuthorController@getDetail');
Route::post('/api/author/register', 'App\Http\Controllers\AuthorController@create');
Route::post('/api/author/edit/{id}', 'App\Http\Controllers\AuthorController@update');
Route::post('/api/author/delete/{id}', 'App\Http\Controllers\AuthorController@delete');

// Publisher
Route::get('/publisher/index-json', 'App\Http\Controllers\PublisherController@getIndex');
Route::get('/publisher/detail-json/{id}', 'App\Http\Controllers\PublisherController@getDetail');
Route::post('/publisher/register', 'App\Http\Controllers\PublisherController@create');
Route::post('/publisher/edit/{id}', 'App\Http\Controllers\PublisherController@update');
Route::post('/publisher/delete/{id}', 'App\Http\Controllers\PublisherController@delete');

// Root
Route::get('/{any}', function() {
    return view('app');
})->where('any', '.*');
