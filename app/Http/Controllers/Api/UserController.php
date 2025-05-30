<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddressRequest;
use App\Http\Requests\User\UpdateAddressRequest;
use App\Models\Address;
use App\Models\BukaTutup;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();

        $response = $user->only(['id', 'name', 'email', 'phone_number']);

        return response()->json([
            'status' => 'success',
            'data' => $response
        ]);
    }

    public function addAdress(AddressRequest $request)
    {
        $data = $request->validated();

        if($data['main_address'] == true) {
            Address::where('user_id', '=', $data['user_id'])->update([
                'main_address' => false
            ]);
        }

        Address::insert([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'main_address' => $data['main_address']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Alamat Berhasil Ditambahkan'
        ], 201);
    }

    public function updateAddress(UpdateAddressRequest $request)
    {
        $data = $request->validated();

        if($data['main_address'] == true) {
            Address::where('user_id', '=', $data['user_id'])->update([
                'main_address' => false
            ]);
        }

        Address::where('id', '=', $data['id'])->update([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'main_address' => $data['main_address']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Alamat Berhasil DiUpdate'
        ], 200);
    }

    public function getAddress($user_id)
    {
        $data = Address::where('user_id', '=', $user_id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteAddress($address_id)
    {
        Address::where('id', '=', $address_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Alamat Berhasil Dihaous'
        ], 200);
    }

    public function status()
    {
        $bukaTutup = BukaTutup::first();
        $isOpen = $bukaTutup ? $bukaTutup->is_open : false;

        return response()->json([
            'is_open' => $isOpen,
            'status' => $isOpen ? 'Toko buka' : 'Toko tutup'
        ]);
    }
}
