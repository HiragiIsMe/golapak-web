<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
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
