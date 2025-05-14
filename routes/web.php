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

Route::get('/layout.blade.php', function () {
    return view('layout');
});

Route::get('/custom.blade.php', function () {
    return view('layout');
});

Route::get('/camera.blade.php', function () {
    return view('layout');
});