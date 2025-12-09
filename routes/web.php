<?php

use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\AdminLinkController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

// Public homepage
Route::get('/', function () {
    return view('welcome');
});

// Auth (Breeze)
require __DIR__ . '/auth.php';

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ShortLinkController::class, 'index'])->name('dashboard');
    Route::post('/shorten', [ShortLinkController::class, 'store'])->name('shorten.store');
    Route::delete('/shortlink/{link}', [ShortLinkController::class, 'destroy'])->name('shortlink.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Link management
    Route::get('/links', [AdminLinkController::class, 'index'])->name('links.index');
    Route::get('/links/{link}', [ShortLinkController::class, 'show'])->name('links.show');
    Route::patch('/links/{link}/toggle', [AdminLinkController::class, 'toggleActive'])->name('links.toggle');
    Route::delete('/links/{link}', [AdminLinkController::class, 'destroy'])->name('links.destroy');

    // User management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});

// Redirect harus terakhir
Route::match(['get', 'post'], '/{code}', [ShortLinkController::class, 'redirect'])
    ->where('code', '[A-Za-z0-9-_]{1,100}')
    ->name('short.redirect');
