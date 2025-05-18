<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\OrderDelivery;
use App\Models\ShippingCost;
use App\Models\Menu;
use App\Models\Courier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function Calculate(Request $request)
    {
        $request->validate([
            'menu' => 'required|array|min:1',
            'menu.*.id' => 'required|exists:menus,id',
            'menu.*.qty' => 'required|integer|min:1',
        ]);

        $totalQty = 0;
        $totalHargaProduk = 0;
        $detailItems = [];

        foreach ($request->menu as $item) {
            $menu = Menu::find($item['id']);

            if($menu->stock == false) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Menu $menu->name Sudah Tidak Tersedia"
                ]);
            }

            if (!$menu) continue;

            $qty = $item['qty'];
            $price = $menu->main_cost;
            $subtotal = $price * $qty;

            $totalQty += $qty;
            $totalHargaProduk += $subtotal;

            $detailItems[] = [
                'id' => (string) $menu->id,
                'nama' => $menu->name,
                'gambar' => $menu->image,
                'qty' => $qty,
                'price' => $price,
                'subtotal' => $subtotal,
            ];
        }

        $shipping = ShippingCost::where('lower_limit', '<=', $totalQty)
            ->where('upper_limit', '>=', $totalQty)
            ->first();

        $biayaOngkir = $shipping ? $shipping->cost : 0;

        $totalBiayaPembayaran = $totalHargaProduk + $biayaOngkir;

        return response()->json([
            'status' => 'success',
            'message' => 'Calculate order successfully',
            'data' => [
                'total_harga_produk' => $totalHargaProduk,
                'biaya_ongkir' => $biayaOngkir,
                'total_biaya_pembayaran' => $totalBiayaPembayaran,
                'details' => $detailItems,
            ]
        ]);
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'menu' => 'required|array|min:1',
            'menu.*.id' => 'required|exists:menus,id',
            'menu.*.qty' => 'required|integer|min:1',
            'address_id' => 'required|exists:addresses,id',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user(); 

            $totalQty = 0;
            $totalMainCost = 0;
            $details = [];

            foreach ($request->menu as $item) {
                $menu = Menu::findOrFail($item['id']);

                if($menu->stock == false) {
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

            $shipping = ShippingCost::where('lower_limit', '<=', $totalQty)
                ->where('upper_limit', '>=', $totalQty)
                ->first();

            $grandTotal = $totalMainCost + $shipping->cost;

            $transaction = Transaction::create([
                'transaction_code' => 'TR' . strtoupper(Str::random(8)),
                'user_id' => $user->id,
                'total_qty' => $totalQty,
                'total_main_cost' => $totalMainCost,
                'delivery_fee' => $shipping->cost,
                'grand_total' => $grandTotal,
                'status' => 'pending',
                'order_type' => 'deliver',
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

            $courier = Courier::first(); 

            OrderDelivery::create([
                'transaction_id' => $transaction->id,
                'courier_id' => $courier->id,
                'adress_id' => $request->address_id,
                'notes' => '',
                'delivery_date' => null,                    
                'arrival_date' => null,
                'status' => 'pending',
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction created successfully',
                'data' => [
                    'transaction_id' => $transaction->id,
                    'transaction_code' => $transaction->transaction_code,
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function transactionProgress()
    {
        $user = Auth::user();
        $datas = Transaction::select('id', 'transaction_code', 'total_qty', 'grand_total', 'date', 'status')
                    ->where('user_id', $user->id)
                    ->where('order_type', 'deliver')
                    ->whereIn('status', ['pending', 'cooking'])
                    ->get();

        return response()->json([
            'status' => 'success',
            'data' => $datas
        ]);
    }

     public function cancelTransaction(Request $request)
    {
        $id = $request->id;

        if(!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or missing transaction_detail_id'
            ]);
        }

        $data = Transaction::find($id);

        if($data->status == 'pending') {

            $data->status = 'canceled';
            $data->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan Berhasil Dibatalkan'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Pesanan tidak bisa dibatalkan karena telah di proses'
        ]);
    }


    public function transactionDetail($id)
    {
        $transactionData = Transaction::select('id', 'transaction_code', 'total_qty', 'total_main_cost', 'delivery_fee', 'grand_total', 'date', 'status')
                        ->where('id', $id)
                        ->first();

        if (!$transactionData) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found',
            ], 404);
        }

        $transactionDetailData = DB::table('transaction_details')
                                    ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
                                    ->select('transaction_details.id', 'menus.name', 'transaction_details.qty', 'transaction_details.main_cost', 'transaction_details.main_subtotal')
                                    ->where('transaction_details.transaction_id', '=', $transactionData->id)
                                    ->get();

        $transactionDeliverydata = DB::table('order_deliveries')
                                        ->join('addresses', 'order_deliveries.adress_id', '=', 'addresses.id')
                                        ->where('order_deliveries.transaction_id', '=', $transactionData->id)
                                        ->select('name', 'phone_number', 'address')
                                        ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                    'transaction' => $transactionData,
                    'details' => $transactionDetailData->map(function ($detail) {
                                return (array) $detail;
                    }),
                    'shipping' => $transactionDeliverydata
            ],
        ]);
    }

    public function transactionShipping()
    {
        $user = Auth::user();
        $datas = Transaction::select('id', 'transaction_code', 'total_qty', 'grand_total', 'date', 'status')
                    ->where('user_id', $user->id)
                    ->where('order_type', 'deliver')
                    ->where('status', 'on_delivery')
                    ->get();

        return response()->json([
            'status' => 'success',
            'data' => $datas
        ]);
    }

    public function transactionHistory()
    {
        $user = Auth::user();
        $datas = Transaction::select('id', 'transaction_code', 'total_qty', 'grand_total', 'date', 'status')
                    ->where('user_id', $user->id)
                    ->where('order_type', 'deliver')
                    ->whereIn('status', ['done', 'canceled'])
                    ->get();

        return response()->json([
            'status' => 'success',
            'data' => $datas
        ]);
    }
    
}
