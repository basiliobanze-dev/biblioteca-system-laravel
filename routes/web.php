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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('books', BookController::class)->middleware(['auth', 'isAdmin']);
    
    Route::resource('users', 'UserController')->middleware(['auth', 'isAdmin']);

    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
});


