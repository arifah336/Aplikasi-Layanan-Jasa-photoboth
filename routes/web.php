<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home.blade.php', function () {
    return view('home');
})->name('home');


Route::get('/about.blade.php', function () {
    return view('about');
})->name('about');

Route::get('/contact.blade.php', function () {
    return view('contact');
})->name('contact');

Route::get('/login.blade.php', function () {
    return view('login');
});

Route::get('/transtactions.blade.php', function () {
    return view('transtactions');
});

Route::get('/dashboard.blade.php', function () {
    return view('dashboard');
});

Route::get('/customers.blade.php', function () {
    return view('customers');
});

Route::get('/custome_layout.blade.php', function () {
    return view('custome_layout');
});

Route::get('/settings.blade.php', function () {
    return view('settings');
});