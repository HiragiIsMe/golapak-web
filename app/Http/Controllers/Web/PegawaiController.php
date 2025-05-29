<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Courier;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        $couriers = Courier::all();

        $combinedUsers = collect();

        foreach ($admins as $admin) {
            $combinedUsers->push([
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => 'Admin',
            ]);
        }

        foreach ($couriers as $courier) {
            $combinedUsers->push([
                'id' => $courier->id,
                'name' => $courier->name,
                'email' => $courier->email,
                'role' => 'Kurir',
            ]);
        }

        return view('dashboard-admin.pegawai', compact('combinedUsers'));
    }

    public function store(Request $request)
    {
        // Validasi umum
        $baseRules = [
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (Admin::where('email', $value)->exists() || Courier::where('email', $value)->exists()) {
                        $fail('Email sudah digunakan');
                    }
                }
            ],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,courier',
        ];

        // Validasi tambahan jika role adalah courier
        if ($request->input('role') === 'courier') {
            $baseRules['phone_number'] = 'required|string|max:15|unique:couriers,phone_number';
        }

        $validator = Validator::make($request->all(), $baseRules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $validated = $validator->validated();

            if ($validated['role'] === 'admin') {
                Admin::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => bcrypt($validated['password']),
                ]);
            } else {
                Courier::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => bcrypt($validated['password']),
                    'phone_number' => $validated['phone_number'],
                    'total_balance' => 0
                ]);
            }

            return redirect()->back()->with('success', 'Data pegawai berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function edit($id)
    {
        $admin = Admin::find($id);
        $courier = Courier::find($id);

        if ($admin) {
            $user = [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => 'Admin',
                'type' => 'admin'
            ];
        } elseif ($courier) {
            $user = [
                'id' => $courier->id,
                'name' => $courier->name,
                'email' => $courier->email,
                'role' => 'Kurir',
                'phone_number' => $courier->phone_number,
                'type' => 'courier'
            ];
        } else {
            abort(404);
        }

        return view('dashboard-admin.pegawai-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi rules
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'role' => 'required|in:admin,courier',
            'password' => 'nullable|string|min:8',
        ];

        if ($request->role === 'courier') {
            $rules['phone_number'] = 'required|string|max:15|unique:couriers,phone_number,' . $id;
        }

        $validated = $request->validate($rules);

        try {
            // Jika role tetap sama, update langsung
            if ($request->previous_type === $validated['role']) {
                if ($validated['role'] === 'admin') {
                    $data = [
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                    ];
                    if (!empty($validated['password'])) {
                        $data['password'] = bcrypt($validated['password']);
                    }
                    Admin::where('id', $id)->update($data);
                } else {
                    $data = [
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'phone_number' => $validated['phone_number'],
                    ];
                    if (!empty($validated['password'])) {
                        $data['password'] = bcrypt($validated['password']);
                    }
                    Courier::where('id', $id)->update($data);
                }
            } else {
                // Role berbeda, pindah data antar tabel
                if ($validated['role'] === 'admin') {
                    // Dari courier ke admin
                    $courier = Courier::findOrFail($id);

                    Admin::create([
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'password' => !empty($validated['password']) ? bcrypt($validated['password']) : $courier->password,
                    ]);

                    $courier->delete();
                } else {
                    // Dari admin ke courier
                    $admin = Admin::findOrFail($id);

                    Courier::create([
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'phone_number' => $validated['phone_number'],
                        'password' => !empty($validated['password']) ? bcrypt($validated['password']) : $admin->password,
                        'total_balance' => 0,
                    ]);

                    $admin->delete();
                }
            }

            return redirect()->route('dashboard-admin.pegawai')
                ->with('success', 'Data pegawai berhasil diperbarui');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function destroy($id)
    {

        $admin = Admin::find($id);
        if ($admin) {
            $admin->delete();
            return redirect()->back()->with('success', 'Admin berhasil dihapus.');
        }

        $courier = Courier::find($id);
        if ($courier) {
            $courier->delete();
            return redirect()->back()->with('success', 'Kurir berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
}
