<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Utils\PrinterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class KasirController extends Controller
{
    public function index()
    {
        $makanan = Menu::where('tipe', '=', 'makanan')->where('stock', '=', 1)->get();

        $minuman = Menu::where('tipe', '=', 'minuman')->where('stock', '=', 1)->get();

        return view('dashboard-checkout.kasir', ['makanan' => $makanan, 'minuman' => $minuman]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'menu' => 'required|array|min:1',
            'menu.*.id' => 'required|exists:menus,id',
            'menu.*.qty' => 'required|min:1',
            'pembeli' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $totalQty = 0;
            $totalMainCost = 0;
            $details = [];

            foreach ($request->menu as $item) {
                $menu = Menu::findOrFail($item['id']);

                if (!$menu->stock) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Menu $menu->name Sudah Tidak Tersedia"
                    ]);
                }

                $qty = $item['qty'];
                $subtotal = $menu->main_cost * $qty;

                $details[] = [
                    'menu_id' => $menu->id,
                    'main_cost' => $menu->main_cost,
                    'qty' => $qty,
                    'main_subtotal' => $subtotal,
                ];

                $totalQty += $qty;
                $totalMainCost += $subtotal;
            }

            $transaction = Transaction::create([
                'transaction_code' => 'TR' . strtoupper(Str::random(8)),
                'nama_pelanggan_offline' => $request->pembeli,
                'total_qty' => $totalQty,
                'total_main_cost' => $totalMainCost,
                'delivery_fee' => 0,
                'grand_total' => $totalMainCost,
                'status' => 'done',
                'order_type' => 'deliver',
                'payment_method' => 'cash',
                'date' => now(),
            ]);

            foreach ($details as $detail) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $detail['menu_id'],
                    'main_cost' => $detail['main_cost'],
                    'qty' => $detail['qty'],
                    'main_subtotal' => $detail['main_subtotal'],
                ]);
            }

            $transaction->load('details.menu');
            PrinterHelper::printTransaction($transaction);
           

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

}
