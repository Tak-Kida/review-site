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
Route::get('/api/book/latest-json', 'App\Http\Controllers\BookController@getLatest');
Route::get('/api/book/detail-json/{id}', 'App\Http\Controllers\BookController@getDetail');
Route::post('/api/book/register', 'App\Http\Controllers\BookController@create');
Route::post('/api/book/edit/{id}', 'App\Http\Controllers\BookController@update');
Route::post('/api/book/delete/{id}', 'App\Http\Controllers\BookController@delete');

// BookAuthor
Route::get('/api/book-author/index-json/{book_id}', 'App\Http\Controllers\BookAuthorController@getIndex');

// Chapter
Route::get('/api/chapter/index-json/{id}', 'App\Http\Controllers\ChapterController@getIndex');
Route::post('api/chapter/register', 'App\Http\Controllers\ChapterController@create');
Route::post('/api/chapter/edit/{id}', 'App\Http\Controllers\ChapterController@update');
Route::post('/api/chapter/delete/{id}', 'App\Http\Controllers\ChapterController@delete');

// Author
Route::get('/api/author/index-json', 'App\Http\Controllers\AuthorController@getIndex');
Route::get('/api/author/detail-json/{id}', 'App\Http\Controllers\AuthorController@getDetail');
Route::post('/api/author/register', 'App\Http\Controllers\AuthorController@create');
Route::post('/api/author/edit/{id}', 'App\Http\Controllers\AuthorController@update');
Route::post('/api/author/delete/{id}', 'App\Http\Controllers\AuthorController@delete');

// Publisher
Route::get('api/publisher/index-json', 'App\Http\Controllers\PublisherController@getIndex');
Route::get('api/publisher/detail-json/{id}', 'App\Http\Controllers\PublisherController@getDetail');
Route::post('api/publisher/register', 'App\Http\Controllers\PublisherController@create');
Route::post('api/publisher/edit/{id}', 'App\Http\Controllers\PublisherController@update');
Route::post('api/publisher/delete/{id}', 'App\Http\Controllers\PublisherController@delete');

// Root
Route::get('/{any}', function() {
    return view('app');
})->where('any', '.*');
