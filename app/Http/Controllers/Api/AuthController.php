<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\SendPasswordRequest;
use App\Http\Requests\Auth\VerifyPasswordRequest;
use App\Models\User;
use App\Mail\ActivationEmail;
use App\Mail\OTPResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function Register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => bcrypt($data['password']),
        ]);

        $token = Str::random(60);
        $user->activation_token = $token;
        $user->save();
          
        Mail::to($user->email)->send(new ActivationEmail($user->name, $token));
        
        $response = $user->only(['id', 'name', 'email', 'phone_number']);

        return response()->json([
            'status' => 'success',
            'message' => 'User Berhasil Registrasi, Silahkan Cek Email Untuk Proses Aktivasi',
            'data' => $response
        ], 201);
    }

    public function Activation($token)
    {
        $user = User::where('activation_token', $token)->first();

        if ($user) {
            $user->status = true;
            $user->activation_token = null;
            $user->save();

            return redirect('/activate-success');
        }

        return redirect('/login')->with('error', 'Token aktivasi tidak valid.');
    }

    public function SendResetPassword(SendPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if($user) {
            $OTP = rand(100000, 999999);
            $user->otp = $OTP;
            $user->save();

            Mail::to($user->email)->send(new OTPResetPassword($user->full_name, $OTP));

            return response()->json([
                'status' => 'success',
                'message' => 'Kode OTP Telah Dikirimkan Ke Email Anda'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email Tidak Ditemukan'
        ], 404);
    }

    public function VerifyResetPassword(VerifyPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if($user) {
            if($user->otp == $data['kode_otp']) {
                $user->password = bcrypt($data['new_password']);
                $user->otp = null;
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Kode OTP Terkonfirmasi Dan Password Berhasil Direset'
                ], 200);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Kode OTP Tidak Valid'
            ], 400);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email Tidak Ditemukan'
        ], 404);
    }

    public function Login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username Atau Password Salah'
            ], 401);
        }

        if($user->status == 'unactive') {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun Anda Belum Teraktivasi, Silahkan Cek Email Anda Untuk Proses Aktivasi'
            ], 403);
        }
        
        $token = $user->createToken('rahasia')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login Berhasil',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer'
                ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            "status" => "success",
            "message" => "Logout Success"
        ], 200);
    }
}
