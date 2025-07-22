<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home.php', function () {
    return view('home');
});

// About
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact.php', function () {
    return view('contact');
})->name('contact');

<<<<<<< HEAD
Route::get('/dashboard.blade.php', function () {
    return view('dashboard');
})->name('dashboard');



=======
Route::get('/layout.php', function () {
    return view('layout');
})->name('layout');

Route::get('/camera.php', function () {
    return view('camera');
})->name('user.camera');

Route::get('/layout', [TemplateController::class, 'userLayouts'])->name('user.layout');
Route::get('/custom', [CustomController::class, 'form'])->name('user.custom');
Route::post('/custom', [CustomController::class, 'store'])->name('user.custom.store');
Route::get('/contact', [MessageController::class, 'form'])->name('contact.form');
Route::post('/contact', [MessageController::class, 'store'])->name('contact.send');
Route::get('/preview/{photo}', [CustomController::class, 'preview'])->name('user.preview');