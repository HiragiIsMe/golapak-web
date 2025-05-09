<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index() 
    {
        $data = Menu::select('id', 'name', 'main_cost', 'stock')->get();

        return view('dashboard-admin.stock', ['datas' => $data, "no" => 1]);
    }

    public function tersedia($id)
    {
        Menu::where('id', '=', $id)->update([
            'stock' => false
        ]);

        return redirect()->back();
    }

    public function tidakTersedia($id)
    {
         Menu::where('id', '=', $id)->update([
            'stock' => true
        ]);

        return redirect()->back();
    }
}
