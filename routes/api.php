<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Web\KasirController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'Register']);

Route::post('/send-reset-password', [AuthController::class, 'SendResetPassword']);

Route::post('/verify-reset-password', [AuthController::class, 'VerifyResetPassword']);
    
Route::post('/login', [AuthController::class, 'Login']);

Route::post('/login-kurir', [AuthController::class, 'LoginKurir']);

Route::group(['middleware' => ['auth:sanctum', 'auth.user']], function(){

    Route::get('/status-toko', [UserController::class, 'status']);

    Route::get('/user', [UserController::class, 'getUser']);

    Route::post('/add-address', [UserController::class, 'addAdress']);

    Route::post('/delete-address/{address_id}', [UserController::class, 'deleteAdress']);

    Route::put('/update-address', [UserController::class, 'updateAddress']);

    Route::get('/get-address/{user_id}', [UserController::class, 'getAddress']);

    Route::get('/menu/makanan', [ProductController::class, 'getMenuMakanan']);

    Route::get('/menu/minuman', [ProductController::class, 'getMenuMinuman']);

    Route::post('/transaction-calculate', [TransactionController::class, 'Calculate']);

    Route::post('/transaction-create', [TransactionController::class, 'createOrder']);

    Route::get('/transaction-progress', [TransactionController::class, 'transactionProgress']);

    Route::get('/transaction/{id}', [TransactionController::class, 'transactionDetail']);

    Route::post('/transaction-cancel', [TransactionController::class, 'cancelTransaction']);

    Route::get('/transaction-shipping', [TransactionController::class, 'transactionShipping']);

    Route::get('/transaction-history', [TransactionController::class, 'transactionHistory']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum', 'auth.courier']], function(){
    
    Route::get('/shipping-pending', [CourierController::class, 'pendingShipment']);

    Route::get('/shipping/{id}', [CourierController::class, 'shippiingDetail']);

    Route::patch('/shipping-accept', [CourierController::class, 'shippingAccept']);

    Route::get('/shipping-process', [CourierController::class, 'processShipment']);

    Route::patch('/shipping-done', [CourierController::class, 'shippingDone']);
});

Route::post('/checkout', [KasirController::class, 'checkout']);
