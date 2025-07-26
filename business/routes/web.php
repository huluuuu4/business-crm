<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Livewire\SuperadminDashboard;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'store'])->name('contact.store');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('customers', CustomerController::class);
    
    // --- Add this entire block for Deal routes ---
    Route::get('/customers/{customer}/deals/create', [DealController::class, 'create'])->name('deals.create');
    Route::post('/customers/{customer}/deals', [DealController::class, 'store'])->name('deals.store');
    Route::get('/deals/{deal}', [DealController::class, 'show'])->name('deals.show');
    Route::get('/deals/{deal}/edit', [DealController::class, 'edit'])->name('deals.edit');
    Route::put('/deals/{deal}', [DealController::class, 'update'])->name('deals.update');
    Route::delete('/deals/{deal}', [DealController::class, 'destroy'])->name('deals.destroy');
    // --- End of Deal routes block ---
    
    Route::post('/deals/{deal}/notes', [NoteController::class, 'store'])->name('notes.store');
    
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Superadmin Route
    Route::get('/superadmin/dashboard', SuperadminDashboard::class)->name('superadmin.dashboard');
    
    // User Management Routes for Admins
    Route::middleware('can:is-admin')->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
    });
});

require __DIR__.'/auth.php';