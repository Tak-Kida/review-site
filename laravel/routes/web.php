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

// Root
Route::get('/', 'App\Http\Controllers\HomeController@index');

// Book
Route::get('/book/index', 'App\Http\Controllers\BookController@index');
Route::get('/book/detail/{id}', 'App\Http\Controllers\BookController@detail');
Route::get('/book/register', 'App\Http\Controllers\BookController@register');
Route::post('/book/register', 'App\Http\Controllers\BookController@create');
Route::get('/book/edit/{id}', 'App\Http\Controllers\BookController@edit');
Route::post('/book/edit/{id}', 'App\Http\Controllers\BookController@update');
Route::post('/book/delete/{id}', 'App\Http\Controllers\BookController@delete');

// Chapter
Route::post('/chapter/register/{id}', 'App\Http\Controllers\ChapterController@create');
Route::get('/chapter/edit/{id}', 'App\Http\Controllers\ChapterController@edit');
Route::post('/chapter/edit/{id}', 'App\Http\Controllers\ChapterController@update');
Route::post('/chapter/delete/{id}', 'App\Http\Controllers\ChapterController@delete');

// Author
Route::get('/author/index', 'App\Http\Controllers\AuthorController@index');
// Route::get('/author/detail/{id}', 'App\Http\Controllers\AuthorController@detail');
Route::get('/author/register', 'App\Http\Controllers\AuthorController@register');
Route::post('/author/register', 'App\Http\Controllers\AuthorController@create');
Route::get('/author/edit/{id}', 'App\Http\Controllers\AuthorController@edit');
Route::post('/author/edit/{id}', 'App\Http\Controllers\AuthorController@update');
Route::post('/author/delete/{id}', 'App\Http\Controllers\AuthorController@delete');

// Publisher
Route::get('/publisher/index', 'App\Http\Controllers\PublisherController@index');
// Route::get('/publisher/detail/{id}', 'App\Http\Controllers\PublisherController@detail');
Route::get('/publisher/register', 'App\Http\Controllers\PublisherController@register');
Route::post('/publisher/register', 'App\Http\Controllers\PublisherController@create');
Route::get('/publisher/edit/{id}', 'App\Http\Controllers\PublisherController@edit');
Route::post('/publisher/edit/{id}', 'App\Http\Controllers\PublisherController@update');
Route::post('/publisher/delete/{id}', 'App\Http\Controllers\PublisherController@delete');
