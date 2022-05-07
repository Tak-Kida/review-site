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

Route::get('/', function () {
    return view('welcome');
});

// Book
Route::get('/book/index', 'App\Http\Controllers\BookController@index');
Route::get('/book/register', 'App\Http\Controllers\BookController@register');
Route::post('/book/register', 'App\Http\Controllers\BookController@create');
Route::get('/book/edit/{id}', 'App\Http\Controllers\BookController@edit');
Route::post('/book/edit/{id}', 'App\Http\Controllers\BookController@update');
Route::post('/book/delete/{id}', 'App\Http\Controllers\BookController@delete');
