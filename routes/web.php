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

// Route::resource('books', App\Http\Controllers\BookController::class);
Route::resource('books', BookController::class);

Route::resource('users', UserController::class);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
