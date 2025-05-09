<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get('/user', [UserController::class, 'getUser']);

    Route::post('/add-address', [UserController::class, 'addAdress']);

    Route::put('/update-address', [UserController::class, 'updateAddress']);

    Route::get('/get-address/{user_id}', [UserController::class, 'getAddress']);

    Route::get('/menu/makanan', [ProductController::class, 'getMenuMakanan']);

    Route::get('/menu/minuman', [ProductController::class, 'getMenuMinuman']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
