<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'details.menu'])
            ->whereIn('status', ['done', 'canceled'])
            ->orderBy('created_at', 'desc');

        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('date', $request->tanggal);
        }

        $transactions = $query->get();

        return view('dashboard-admin.riwayat', compact('transactions'));
    }


    public function getDetail($id)
    {
        try {
            $details = TransactionDetail::with('menu')
                ->where('transaction_id', $id)
                ->get();

            return view('partials.tabel_detail', compact('details'));
        } catch (\Exception $e) {
            Log::error('GAGAL AMBIL DETAIL TRANSAKSI: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengambil detail'], 500);
        }
    }
}
