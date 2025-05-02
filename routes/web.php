<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route page
Route::get('/', function () {
    return view('page.landing');
})->name('landing');

Route::get('/tentangkami', function () {
    return view('page.tentangkami');
})->name('tentangkami');

Route::get('/menu', function () {
    return view('page.menu');
})->name('menu');

Route::get('/akun', function () {
    return view('page.akun');
})->name('akun');

Route::get('/kontak', function () {
    return view('page.kontak');
})->name('kontak');

Route::get('/dashboard', function () {
    return view('dashboard.main');
})->name('main');