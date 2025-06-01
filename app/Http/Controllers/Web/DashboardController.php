<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Exports\LaporanHarianExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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
    public function laporanHarian()
{
    $today = now()->toDateString();

    $online = $this->getLaporanByOrderType(['deliver'], $today);
    $offline = $this->getLaporanByOrderType(['dine_in', 'take_Away'], $today);

    // Gabung semua dan simpan ke CSV format
    $filename = 'laporan_harian_' . $today . '.csv';

    $handle = fopen('php://temp', 'r+');
    fputcsv($handle, ['Tipe', 'Menu ID', 'Qty Total', 'Harga Total']);

    foreach ($online as $item) {
        fputcsv($handle, ['Online', $item->menu_id, $item->total_qty, $item->total_harga]);
    }

    foreach ($offline as $item) {
        fputcsv($handle, ['Offline', $item->menu_id, $item->total_qty, $item->total_harga]);
    }

    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);

    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ]);
}

private function getLaporanByOrderType(array $types, $date)
{
    return TransactionDetail::select('menu_id', 
        DB::raw('SUM(qty) as total_qty'), 
        DB::raw('SUM(main_subtotal) as total_harga'))
        ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
        ->whereDate('transactions.date', $date)
        ->whereIn('transactions.order_type', $types)
        ->groupBy('menu_id')
        ->get();
}
public function exportLaporanHarian()
{
    $date = now()->toDateString();
    $online = $this->getLaporan(['deliver'], $date);
    $offline = $this->getLaporan(['dine_in', 'take_Away'], $date);

    return Excel::download(new LaporanHarianExport($online, $offline, $date), 'laporan_harian_'.$date.'.xlsx');
}

private function getLaporan(array $types, $date)
{
    return DB::table('transaction_details')
        ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
        ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
        ->select(
            'menus.name as menu_name',
            DB::raw('SUM(transaction_details.qty) as total_qty'),
            DB::raw('SUM(transaction_details.main_subtotal) as total_harga')
        )
        ->whereDate('transactions.date', $date)
        ->whereIn('transactions.order_type', $types)
        ->groupBy('menus.name')
        ->get();
}
}
