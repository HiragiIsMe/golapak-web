<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Web\AuthController as WebAuthController;
use App\Http\Controllers\Web\KasirController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\PegawaiController;
use App\Http\Controllers\Web\TransactionController;
use App\Http\Controllers\Web\PesananController;
use App\Http\Controllers\Web\StokController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LandingController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Web\DashboardController;

// Route page
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/tentangkami', function () {
    return view('page.tentangkami');
})->name('tentangkami');

Route::get('/menuu', function () {
    return view('page.menu');
})->name('menu');

Route::get('/login', function () {
    return view('page.akun');
})->name('akun');

Route::get('/kontak', function () {
    return view('page.kontak');
})->name('kontak');

Route::post('/login', [WebAuthController::class, 'authenticate'])->name('login');

Route::group(['middleware' => 'auth'], function() {

    Route::post('/set-buka-tutup', [DashboardController::class, 'bukaTutup']);

    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard-admin');

    Route::get('/export-laporan-harian', [DashboardController::class, 'exportLaporanHarian'])->name('laporan.harian');

    Route::get('/pesanan', [PesananController::class, 'index']);

    Route::get('/pesanan/{id}', [PesananController::class, 'getDetail']);

    Route::get('/pesanan-status', [PesananController::class, 'filterStatus']);

    Route::get('/pesanan-cancel/{id}', [PesananController::class, 'cancelPesanan']);

    Route::get('/pesanan-accept/{id}', [PesananController::class, 'acceptPesanan']);

    Route::get('/pesanan-cancel-done/{id}', [PesananController::class, 'cancelDonePesanan']);

    Route::get('/kasir', [KasirController::class, 'index']);

    // Route::post('/checkout', [KasirController::class, 'checkout']);

    Route::get('/stock', [StokController::class, 'index']);

    Route::get('/update-tersedia/{id}', [StokController::class, 'tersedia']);

    Route::get('/update-tidak-tersedia/{id}', [StokController::class, 'tidakTersedia']);

    Route::resource('/menu', MenuController::class);

    Route::get('/dashboard-admin/pegawai', [PegawaiController::class, 'index'])->name('dashboard-admin.pegawai');

    Route::post('/dashboard-admin/pegawai', [PegawaiController::class, 'store'])->name('dashboard-admin.pegawai.store');

    Route::get('/dashboard-admin/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('dashboard-admin.pegawai.edit');

    Route::put('/dashboard-admin/pegawai/{id}', [PegawaiController::class, 'update'])->name('dashboard-admin.pegawai.update');

    Route::delete('/dashboard-admin/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('dashboard-admin.pegawai.destroy');

    Route::get('/dashboard-admin/riwayat-transaksi', [TransactionController::class, 'index'])->name('dashboard-riwayat');

    Route::get('/dashboard-admin/riwayat-transaksi/detail/{id}', [TransactionController::class, 'getDetail']);

    Route::post('/logout', [WebAuthController::class, 'logout'])->name('auth.logout');

});


Route::get('/get-menu', function () {
    $menus = \App\Models\Menu::select('name', 'image', 'main_cost', 'tipe')->get();

    $grouped = $menus->groupBy('tipe')->map(function ($items) {
        return $items->map(function ($item) {
            return [
                'img' => asset('storage/' . $item->image),
                'name' => $item->name,
                'desc' => 'Harga: Rp ' . number_format($item->main_cost), // kamu bisa custom deskripsi
            ];
        });
    });

    return response()->json($grouped);
});






// Route::get('/dashboard-admin/pesanan', [PesananController::class, 'index'])->name('dashboard-pesanan');
// Route::get('/dashboard-admin/kasir', [kasirController::class, 'index'])->name('dashboard-kasir');




// api
Route::get('/activate-account/{token}', [AuthController::class, 'Activation'])->name('activate.account');

Route::get('/activate-success', function(){
    return view('emails.activation-success');
});


