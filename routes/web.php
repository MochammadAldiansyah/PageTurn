<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('landing.index');
});

// User routes (role: user)
Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/borrowings', [\App\Http\Controllers\User\BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/catalog', [\App\Http\Controllers\User\CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{book}/borrow', [\App\Http\Controllers\User\CatalogController::class, 'borrowForm'])->name('catalog.borrow');
    Route::post('/catalog/{book}/borrow', [\App\Http\Controllers\User\CatalogController::class, 'storeBorrow'])->name('catalog.borrow.store');
});

// Admin routes (role: admin)
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // Library Management (Books)
    Route::resource('books', \App\Http\Controllers\Admin\BookController::class)->except(['show']);

    // Borrowing Details Tracking
    Route::get('/borrowings', [\App\Http\Controllers\Admin\BorrowingController::class, 'index'])->name('borrowings.index');
    Route::patch('/borrowings/{detail}/return', [\App\Http\Controllers\Admin\BorrowingController::class, 'markReturned'])->name('borrowings.return');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/landing', [LandingController::class, 'index'])->name('landing');

require __DIR__.'/auth.php';
