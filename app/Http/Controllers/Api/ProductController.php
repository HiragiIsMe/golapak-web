<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class ProductController extends Controller
{
    public function getMenuMakanan()
    {
        $data = Menu::select('name', 'image', 'main_cost')
                ->where('tipe', '=', 'makanan')
                ->where('stock', '=', 1)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getMenuMinuman()
    {
        $data = Menu::select('name', 'image', 'main_cost')
                ->where('tipe', '=', 'minuman')
                ->where('stock', '=', 1)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
