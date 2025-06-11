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

use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// CENTRAL REDIRECTION DASHBOARD
Route::middleware(['auth'])->get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : (auth()->user()->role === 'librarian'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('reader.dashboard'));
})->name('dashboard');

// ADMIN DASHBOARD (ALSO USED BY LIBRARIAN)
Route::middleware(['auth', 'isAdminOrLibrarian'])->get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->name('admin.dashboard');

// READER DASHBOARD
// Route::middleware(['auth', 'isReader'])->get('/reader/dashboard', function () {
//     return view('dashboard.reader');
// })->name('reader.dashboard');

// Route::middleware(['auth', 'isReader'])->get('/reader/dashboard', [LoanController::class, 'readerDashboard'])
//     ->name('reader.dashboard');

Route::middleware(['auth', 'isReader'])->get('/reader/dashboard', 'LoanController@readerDashboard')
    ->name('reader.dashboard');

// ALL USERS AUTHENTICADE
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

    Route::post('loans', 'LoanController@store')->name('loans.store');
});

// ADMIN AND LIBRARIAN ROUTES
Route::middleware(['auth', 'isAdminOrLibrarian'])->group(function () {
    Route::resource('books', BookController::class);
    Route::get('loans/create', 'LoanController@create')->name('loans.create');
    Route::get('loans', 'LoanController@index')->name('loans.index');
    Route::post('/loans/{loan}/return', 'LoanController@returnProcess')->name('loans.return.process');
    Route::post('/loans/{loan}/approve', 'LoanController@approve')->name('loans.approve');
    Route::get('track', 'LoanController@track')->name('loans.track');
    
    // REPORTS
    Route::get('reports/top-books', 'ReportController@topBooks')->name('reports.top-books');
    Route::get('reports/top-books/pdf', 'ReportController@topBooksPdf')->name('reports.top-books.pdf');
    Route::get('reports/top-users', 'ReportController@topUsers')->name('reports.top-users');
    Route::get('reports/top-users/pdf', 'ReportController@topUsersPdf')->name('reports.top-users.pdf');
});

// ADMIN ROUTES
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('users', 'UserController');
    Route::get('audit-logs', 'AuditLogController@index')->name('audit_logs.index');
});

// READERS ROUTES
Route::middleware(['auth', 'isReader'])->group(function () {
    Route::get('my-loans', 'LoanController@myLoans')->name('loans.my');
    Route::get('catalog', 'BookController@catalog')->name('books.catalog');
    Route::get('book-detail/{book}', 'BookController@userShow')->name('books.user_show');
    Route::get('/loans/request', 'LoanController@requestForm')->name('loans.request');
});