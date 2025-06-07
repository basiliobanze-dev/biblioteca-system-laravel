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

    // Central redirection to dashboard
    Route::middleware(['auth'])->get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('reader.dashboard');
    })->name('dashboard');

    // Individual Dashboards
    Route::middleware(['auth', 'isAdmin'])->get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    Route::middleware(['auth'])->get('/reader/dashboard', function () {
        return view('dashboard.reader');
    })->name('reader.dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('books', BookController::class);//->middleware(['auth', 'isAdmin']);
    Route::resource('users', 'UserController');//->middleware(['auth', 'isAdmin']);
    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
    // Route::get('/api/books/search', [BookController::class, 'search']);
    Route::get('loans/create', 'LoanController@create')->name('loans.create');
    Route::post('loans', 'LoanController@store')->name('loans.store');
    Route::get('loans', 'LoanController@index')->name('loans.index');
    Route::post('/loans/{loan}/return', 'LoanController@returnProcess')->name('loans.return.process');
    Route::get('track', 'LoanController@track')->name('loans.track');
    Route::get('reports/top-books', 'ReportController@topBooks')->name('reports.top-books');
    Route::get('reports/top-books/pdf', 'ReportController@topBooksPdf')->name('reports.top-books.pdf');
    Route::get('reports/top-users', 'ReportController@topUsers')->name('reports.top-users');
    Route::get('reports/top-users/pdf', 'ReportController@topUsersPdf')->name('reports.top-users.pdf');
    Route::get('audit-logs', 'AuditLogController@index')->name('audit_logs.index');
    Route::get('my-loans', 'LoanController@myLoans')->name('loans.my');   
    Route::get('catalog', 'BookController@catalog')->name('books.catalog');

});


