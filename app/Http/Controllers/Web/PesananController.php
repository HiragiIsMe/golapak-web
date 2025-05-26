<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function index()
    {
        $data =  DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->where('transactions.status', '=', 'pending')
                    ->select('transactions.id', 'transactions.transaction_code', 'users.name', 'transactions.status', 'transactions.payment_method')
                    ->get();

        $jumlah = Transaction::where('status', '=', 'pending')->where('order_type', '=', 'dine_in')->where('date', '=', Carbon::today())->count();

        return view('dashboard-checkout.main', ['data' => $data, 'jumlah' => $jumlah]);
    }

    public function getDetail($id)
    {
        try {
            $transaksi = DB::table('transactions')
                ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                ->leftJoin('addresses', 'addresses.user_id', '=', 'users.id')
                ->select(
                    'transactions.*',
                    'users.name as nama_pembeli',
                    'addresses.address as alamat_pembeli'
                )
                ->where('transactions.id', $id)
                ->first();

            if (!$transaksi) {
                Log::info('Data Transaksi:', (array)$transaksi);
            }
            
            Log::info('Data Transaksi:', (array)$transaksi);

            $detail_pesanan = DB::table('transaction_details')
                ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
                ->select(
                    'menus.name as nama_menu',
                    'transaction_details.qty',
                    'transaction_details.main_cost'
                )
                ->where('transaction_details.transaction_id', $id)
                ->get();

            if ($detail_pesanan->isEmpty()) {
                Log::warning('Detail pesanan kosong untuk transaksi ID: '.$id);
            }

            $subtotal = $detail_pesanan->sum(function ($item) {
                return $item->main_cost * $item->qty;
            });

            $delivery_fee = $transaksi->delivery_fee ?? 0;
            $grand_total = $subtotal + $delivery_fee;

            if ($delivery_fee > 0) {
                $detail_pesanan->push((object)[
                    'nama_menu' => 'Ongkir',
                    'qty' => 1,
                    'main_cost' => $delivery_fee,
                    'main_cost_formatted' => number_format($delivery_fee, 0, ',', '.')
                ]);
            }

            $status_map = [
                'pending' => 'Menunggu Konfirmasi',
                'cooking' => 'Sedang Dimasak',
                'on_delivery' => 'Dalam Pengiriman',
                'done' => 'Selesai',
                'canceled' => 'Dibatalkan',
                'canceled_done' => 'Pembatalan Selesai'
            ];
            
            $response = [
                'transaksi' => $transaksi,
                'transaksi' => (object)[
                    'id_transaksi' => $transaksi->id,
                    'status_formatted' => $status_map[$transaksi->status] ?? $transaksi->status,
                    'transaction_code' => $transaksi->transaction_code ?? '-',
                    'order_type' => $transaksi->order_type ?? 'unknown',
                    'nama_pembeli' => $transaksi->nama_pembeli ?? $transaksi->nama_pelanggan_offline ?? 'Tidak diketahui',
                    'alamat_pembeli' => $transaksi->alamat_pembeli ?? 'Alamat tidak tersedia'
                ],
                'detail_pesanan' => $detail_pesanan->map(function($item) {
                    return (object)[
                        'nama_menu' => $item->nama_menu,
                        'qty' => $item->qty,
                        'main_cost_formatted' => 'Rp '.number_format($item->main_cost, 0, ',', '.')
                    ];
                }),
                'subtotal_formatted' => 'Rp '.number_format($subtotal, 0, ',', '.'),
                'grand_total_formatted' => 'Rp '.number_format($grand_total, 0, ',', '.')
            ];

            return view('partials.detail', $response)->render();

        } catch (\Exception $e) {
            Log::error('Error in getDetail: '.$e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function filterStatus(Request $request)
    {
        $data =  DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->where('transactions.status', '=', $request->status)
                    ->select('transactions.id', 'transactions.transaction_code', 'users.name', 'transactions.status', 'transactions.payment_method')
                    ->get();

        $jumlah = Transaction::where('status', '=', 'pending')->where('order_type', '=', 'dine_in')->where('date', '=', Carbon::today())->count();

        return view('dashboard-checkout.main', ['data' => $data, 'jumlah' => $jumlah]);
    }  

    public function cancelPesanan($id)
    {
        Transaction::where('id', '=', $id)->update([
            'status' => 'canceled_done'
        ]);

        return redirect()->back();
    }

    public function acceptPesanan($id)
    {
        $data = Transaction::where('id', '=', $id)->first();

        if($data->status == 'pending') {
            $data->status = 'cooking';
            $data->save();
        }else{
            $data->status = 'on_delivery';
            $data->save();
        }

        return redirect()->back();
    }

    public function cancelDonePesanan($id)
    {
        Transaction::where('id', '=', $id)->update([
            'status' => 'canceled_done'
        ]);

        return redirect()->back();
    }
}
