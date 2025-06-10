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

// Route group protected by authentication middleware
Route::middleware(['auth'])->group(function () {
    // RESTful resource for  books and users
    Route::resource('books', BookController::class);
    Route::resource('users', 'UserController');

    // User profile
    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

    // Loans operations
    Route::get('loans/create', 'LoanController@create')->name('loans.create');
    Route::post('loans', 'LoanController@store')->name('loans.store');
    Route::get('loans', 'LoanController@index')->name('loans.index');
    Route::post('/loans/{loan}/return', 'LoanController@returnProcess')->name('loans.return.process');
    Route::post('/loans/{loan}/approve', 'LoanController@approve')->name('loans.approve');

    // Loan request by user
    Route::get('/loans/request', 'LoanController@requestForm')->name('loans.request');

    // LOan track
    Route::get('track', 'LoanController@track')->name('loans.track');

    // My loans (authenticade user)
    Route::get('my-loans', 'LoanController@myLoans')->name('loans.my');

    // Exclusive dashboard  for readers
    Route::get('/reader/dashboard', 'LoanController@readerDashboard')->name('reader.dashboard');

    // Books catalog and one book detail (user view)
    Route::get('catalog', 'BookController@catalog')->name('books.catalog');
    Route::get('book-detail/{book}', 'BookController@userShow')->name('books.user_show');

    // Top books (report)
    Route::get('reports/top-books', 'ReportController@topBooks')->name('reports.top-books');
    Route::get('reports/top-books/pdf', 'ReportController@topBooksPdf')->name('reports.top-books.pdf');

    // Top users (report)
    Route::get('reports/top-users', 'ReportController@topUsers')->name('reports.top-users');
    Route::get('reports/top-users/pdf', 'ReportController@topUsersPdf')->name('reports.top-users.pdf');

    // AudiLogs
    Route::get('audit-logs', 'AuditLogController@index')->name('audit_logs.index');

    // (search books by API)
    // Route::get('/api/books/search', [BookController::class, 'search']);
});



