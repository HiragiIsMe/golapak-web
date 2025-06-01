<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'details.menu'])
            ->whereIn('status', ['done', 'canceled'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('tanggal')) {
            $tanggal = $request->tanggal;

            if (Str::contains($tanggal, ' - ')) {
                // Format range: "2025-06-01 - 2025-06-10"
                [$from, $to] = explode(' - ', $tanggal);
                try {
                    $from = Carbon::parse(trim($from))->startOfDay();
                    $to = Carbon::parse(trim($to))->endOfDay();
                    $query->whereBetween('date', [$from, $to]);
                } catch (\Exception $e) {
                    Log::error('Format tanggal range salah: ' . $e->getMessage());
                    // fallback jika salah
                    $query->whereDate('date', now());
                }
            } else {
                // Format satu tanggal
                try {
                    $date = Carbon::parse($tanggal)->startOfDay();
                    $query->whereDate('date', $date);
                } catch (\Exception $e) {
                    Log::error('Format tanggal salah: ' . $e->getMessage());
                    $query->whereDate('date', now());
                }
            }
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
