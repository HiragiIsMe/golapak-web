<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Web\AuthController as WebAuthController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\StokController;
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

Route::get('/menuu', function () {
    return view('page.menu');
})->name('menuu');

Route::get('/login', function () {
    return view('page.akun');
})->name('akun');

Route::get('/kontak', function () {
    return view('page.kontak');
})->name('kontak');

Route::post('/login', [WebAuthController::class, 'authenticate'])->name('login');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard-admin', function () {
        return view('dashboard-admin.main');
    })->name('dashboard-admin');

    Route::get('/stock', [StokController::class, 'index']);

    Route::get('/update-tersedia/{id}', [StokController::class, 'tersedia']);

    Route::get('/update-tidak-tersedia/{id}', [StokController::class, 'tidakTersedia']);

    Route::resource('/menu', MenuController::class);

    Route::post('/logout', [WebAuthController::class, 'logout'])->name('auth.logout');
});

// Route dashboard admin



Route::get('/dashboard-admin/pegawai', function () {
    return view('dashboard-admin.pegawai');
})->name('dashboard-pegawai');

Route::get('/dashboard-admin/riwayat-transaksi', function () {
    return view('dashboard-admin.riwayat');
})->name('dashboard-riwayat');


// dashboard kasir
Route::get('/dashboard-admin/pesanan', function () {
    return view('dashboard-checkout.main');
})->name('dashboard-pesanan');

Route::get('/dashboard-admin/kasir', function () {
    return view('dashboard-checkout.kasir');
})->name('dashboard-kasir');

// Route::get('/dashboard-admin/pesanan', [PesananController::class, 'index'])->name('dashboard-pesanan');
// Route::get('/dashboard-admin/kasir', [kasirController::class, 'index'])->name('dashboard-kasir');




// api
Route::get('/activate-account/{token}', [AuthController::class, 'Activation'])->name('activate.account');

Route::get('/activate-success', function(){
    return view('emails.activation-success');
});


