<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Menu::all();
        return view('dashboard-admin.menu', ["datas" => $data, "no" => 1]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crud.menu-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'main_cost' => 'required|integer',
            'tipe' => 'required|in:makanan,minuman',
        ], [
            'name.required' => 'Nama Menu Wajib Diisi',
            'name.max' => 'Nama Produk Maksimal 50 Karakter',
            'image.required' => 'Gambar Menu Wajib Diisi',
            'main_cost.required' => 'Harga Wajib Diisi',
            'tipe.required' => 'Tipe Menu Wajib Diisi'
        ]);
        

        $imagePath = $request->file('image')->store('gambar-menu', 'public');

        $menu = Menu::create([
            'name' => $request->name,
            'image' => $imagePath,
            'main_cost' => $request->main_cost,
            'tipe' => $request->tipe,
            'stock' => false,
        ]);

        return redirect('/menu')->with('success-insert', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Menu::where('id', '=', $id)->first();
        return view('crud.menu-edit', ["menu" => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:50',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'main_cost' => 'sometimes|integer',
            'tipe' => 'sometimes|in:makanan,minuman'
        ],[
            'name.required' => 'Nama Menu Wajib Diisi',
            'name.max' => 'Nama Produk Maksimal 50 Karakter',
            'main_cost.required' => 'Harga Wajib Diisi',
            'tipe.required' => 'Tipe Menu Wajib Diisi'
        ]);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }

            $menu->image = $request->file('image')->store('menus', 'public');
        }
        $menu->update($request->only([
            'name', 'selling_cost', 'main_cost', 'tipe', 'stock'
        ]));

        return redirect('/menu')->with('success-update', 'Data Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        if (Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect('/menu')->with('success-delete', 'Data Berhasil DiHapus');
    }
}
