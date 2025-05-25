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
}
