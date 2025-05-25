<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $data =  DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->select('transactions.id', 'transactions.transaction_code', 'users.name', 'transactions.status', 'transactions.payment_method')
                    ->get();

        $jumlah = Transaction::where('status', '=', 'pending')->where('order_type', '=', 'dine_in')->where('date', '=', Carbon::today())->count();

        return view('dashboard-checkout.main', ['data' => $data, 'jumlah' => $jumlah]);
    }

    public function getDetail($id)
    {
        // Ambil data transaksi beserta nama user
        $transaksi = DB::table('transactions')
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
            ->select(
                'transactions.*',
                'users.name as nama_pembeli'
            )
            ->where('transactions.id', $id)
            ->first();

        if (!$transaksi) {
            abort(404, 'Transaksi tidak ditemukan.');
        }

        // Ambil detail pesanan dari transaction_details
        $detail_pesanan = DB::table('transaction_details')
            ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
            ->select(
                'menus.name as nama_menu',
                'transaction_details.qty',
                'transaction_details.main_cost'
            )
            ->where('transaction_details.transaction_id', $id)
            ->get();

        // Subtotal dari semua pesanan
        $subtotal = $detail_pesanan->sum(function ($item) {
            return $item->main_cost * $item->qty;
        });

        // Grand total = subtotal + ongkir
        $grand_total = $subtotal + $transaksi->delivery_fee;

        // Tambahkan Ongkir sebagai baris tambahan
        $detail_pesanan->push((object)[
            'nama_menu' => 'Ongkir',
            'qty' => 1,
            'main_cost' => $transaksi->delivery_fee
        ]);

        return view('pesanan.detail', [
            'transaksi' => $transaksi,
            'detail_pesanan' => $detail_pesanan,
            'subtotal' => $subtotal,
            'grand_total' => $grand_total,
        ]);
    }
}
