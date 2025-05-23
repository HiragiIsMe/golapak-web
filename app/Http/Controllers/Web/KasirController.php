<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $makanan = Menu::where('tipe', '=', 'makanan')->get();

        $minuman = Menu::where('tipe', '=', 'minuman')->get();

        return view('dashboard-checkout.kasir', ['makanan' => $makanan, 'minuman' => $minuman]);
    }

    public function checkout(Request $request)
    {
        dd($request);
    }
}
