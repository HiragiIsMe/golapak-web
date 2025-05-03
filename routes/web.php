<?php

use App\Http\Controllers\Api\AuthController;
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



// Route dashboard admin
Route::get('/dashboard-admin', function () {
    return view('dashboard-admin.main');
})->name('dashboard-admin');

Route::get('/dashboard-admin/menu', function () {
    return view('dashboard-admin.menu');
})->name('dashboard-menu');

Route::get('/dashboard-admin/menu/create', function () {
    return view('crud.menu-create');
})->name('dashboard-menu-create');

Route::get('/dashboard-admin/menu/edit', function () {
    return view('crud.menu-edit');
})->name('dashboard-menu-edit');

Route::get('/dashboard-admin/stock-barang', function () {
    return view('dashboard-admin.stock');
})->name('dashboard-stock');

Route::get('/dashboard-admin/pegawai', function () {
    return view('dashboard-admin.pegawai');
})->name('dashboard-pegawai');

Route::get('/dashboard-admin/riwayat-transaksi', function () {
    return view('dashboard-admin.riwayat');
})->name('dashboard-riwayat');


// dashboard kasir
Route::get('/dashboard-checkout', function () {
    return view('dashboard-checkout.main');
})->name('dashboard-checkout');

Route::get('/dashboard-checkout/kasir', function () {
    return view('dashboard-checkout.kasir');
})->name('dashboard-kasir');


// api
Route::get('/activate-account/{token}', [AuthController::class, 'Activation'])->name('activate.account');

Route::get('/activate-success', function(){
    return view('emails.activation-success');
});


