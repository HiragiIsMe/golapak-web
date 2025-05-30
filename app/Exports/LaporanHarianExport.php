<?php

namespace App\Exports;

use App\Models\TransactionDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanHarianExport implements FromView
{
    protected $online;
    protected $offline;
    protected $date;

    public function __construct($online, $offline, $date)
    {
        $this->online = $online;
        $this->offline = $offline;
        $this->date = $date;
    }

    public function view(): View
    {
        return view('exports.laporan-harian', [
            'online' => $this->online,
            'offline' => $this->offline,
            'date' => $this->date
        ]);
    }
}
