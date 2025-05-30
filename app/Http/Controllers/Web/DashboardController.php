<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Admin;
use App\Models\Courier;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $jumlahTransaksi = Transaction::whereDate('date', $today)->count();
        $pesananDiproses = Transaction::where('status', 'cooking')->count();
        $jumlahPegawai = Admin::count() + Courier::count();
        $totalPengguna = User::count();

        // Pemasukan bulanan (untuk grafik atau ringkasan)
        $rawIncome = Transaction::selectRaw('MONTH(date) as month, SUM(grand_total) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Pastikan semua nilai dikonversi ke integer (hilangkan string)
        $monthlyIncome = array_map('intval', array_replace(
            array_fill(1, 12, 0),
            $rawIncome
        ));


        return view('dashboard-admin.main', compact(
            'jumlahTransaksi',
            'pesananDiproses',
            'jumlahPegawai',
            'monthlyIncome',
            'totalPengguna'
        ));
    }
}
