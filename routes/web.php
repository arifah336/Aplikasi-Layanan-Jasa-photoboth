<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;

// =========================
// Admin Authentication
// =========================
Route::get('/admin/login', [AuthController::class, 'loginForm'])->name('admin.login.form');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// =========================
// Admin Area (protected)
// =========================
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Transactions
    Route::get('/admin/transactions', [PaymentController::class, 'index'])->name('admin.transactions');
    Route::delete('/admin/transactions/{id}', [PaymentController::class, 'destroy'])->name('admin.transactions.delete');
    
    // Users
    Route::get('/admin/users', [UserController::class, 'index'])
        ->middleware('auth')
        ->name('admin.users');
    
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])
        ->middleware('auth')
        ->name('admin.users.delete');

    // Custom_Layout
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/custom-layout', [TemplateController::class, 'index'])->name('admin.custom_layout');
        Route::post('/admin/custom-layout', [TemplateController::class, 'store'])->name('admin.custom_layout.store');

        // ✅ Tambahkan route edit & update & delete
        Route::get('/admin/custom-layout/{id}/edit', [TemplateController::class, 'edit'])->name('admin.custom_layout.edit');
        Route::put('/admin/custom-layout/{id}', [TemplateController::class, 'update'])->name('admin.custom_layout.update');
        Route::delete('/admin/custom-layout/{id}', [TemplateController::class, 'destroy'])->name('admin.custom_layout.delete');
    });

   Route::middleware(['auth'])->group(function () {
        
        // ✅ Route untuk halaman settings
        Route::get('/admin/settings', function () {
            return view('settings');
        })->name('admin.settings');

        // ✅ Route untuk update profil dan password
        Route::put('/admin/profile', [UserController::class, 'updateProfile'])->name('admin.profile.update');
        Route::put('/admin/password', [UserController::class, 'updatePassword'])->name('admin.password.update');
    });

    // Messages
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages');

    // Logout
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

});

// =========================
// User Area
// =========================
// Home
Route::get('/home', function () {
    return view('home');
});

// About
Route::get('/about', function () {
    return view('about');
})->name('about');

// Camera
Route::get('/camera', function () {
    return view('camera');
})->name('user.camera');

Route::get('/layout', [TemplateController::class, 'userLayouts'])->name('user.layout');
Route::get('/custom', [CustomController::class, 'form'])->name('user.custom');
Route::post('/custom', [CustomController::class, 'store'])->name('user.custom.store');
Route::get('/contact', [MessageController::class, 'form'])->name('contact.form');
Route::post('/contact', [MessageController::class, 'store'])->name('contact.send');
Route::get('/preview/{photo}', [CustomController::class, 'preview'])->name('user.preview');