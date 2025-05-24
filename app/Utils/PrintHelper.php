<?php

namespace App\Helpers;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PrintHelper
{
    public static function printTransaction($transaction)
    {
        $connector = new WindowsPrintConnector("POS-80");
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("STRUK PEMBELIAN\n");
        $printer->text("Kode: " . $transaction->transaction_code . "\n");
        $printer->text("Tanggal: " . $transaction->date->format('d-m-Y H:i') . "\n");
        $printer->text("-----------------------------\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Pembeli: " . $transaction->nama_pelanggan_offline . "\n");
        $printer->text("-----------------------------\n");

        foreach ($transaction->details as $detail) {
            $name = $detail->menu->name;
            $qty = $detail->qty;
            $subtotal = number_format($detail->main_subtotal, 0, ',', '.');

            $printer->text("$name\n");
            $printer->text(" x$qty  Rp$subtotal\n");
        }

        $printer->text("-----------------------------\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $total = number_format($transaction->grand_total, 0, ',', '.');
        $printer->text("TOTAL: Rp$total\n");
        $printer->feed(2);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih!\n");

        $printer->feed(3);
        $printer->cut();
        $printer->close();
    }
}


