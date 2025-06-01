<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class LandingController extends Controller
{
 public function index()
    {
        $bestSellers = Menu::select('menus.*', DB::raw('SUM(transaction_details.qty) as total_ordered'))
            ->join('transaction_details', 'menus.id', '=', 'transaction_details.menu_id')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->where('transactions.status', 'done')
            ->groupBy(
                'menus.id',
                'menus.name',
                'menus.image',
                'menus.main_cost',
                'menus.tipe',
                'menus.stock',
                'menus.created_at',
                'menus.updated_at'
            )
            ->orderByDesc('total_ordered')
            ->take(3)
            ->get();

        return view('page.landing', compact('bestSellers'));
    }
}
