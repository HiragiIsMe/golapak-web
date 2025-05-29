<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::with(['user', 'details.menu'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard-admin.riwayat', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['details.menu'])->findOrFail($id);

        return response()->json([
            'transaction_code' => $transaction->transaction_code,
            'details' => $transaction->details->map(function ($detail) {
                return [
                    'menu' => $detail->menu,
                    'main_cost' => $detail->main_cost,
                    'qty' => $detail->qty,
                    'main_subtotal' => $detail->main_subtotal
                ];
            })
        ]);
    }
}
