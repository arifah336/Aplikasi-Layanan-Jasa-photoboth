<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home.php', function () {
    return view('home');
})->name('home');


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
})->name('camera');

Route::get('/custom.php', function () {
    return view('custom');
})->name('custom');

Route::get('/login.php', function () {
    return view('login');
})->name('login');

Route::get('/contact.php', function () {
    return view('contact');
})->name('contact');

Route::get('/contact.php', function () {
    return view('contact');
})->name('contact');

Route::get('/contact.php', function () {
    return view('contact');
})->name('contact');
>>>>>>> 25bd180dd06b0831d1b3977dd2ed3b457749cffb
