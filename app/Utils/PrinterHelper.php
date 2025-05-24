<?php

namespace App\Utils;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PrinterHelper
{
    public static function printTransaction($transaction)
    {
        try {
            $connector = new WindowsPrintConnector("POS-80"); 
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("STRUK PEMBELIAN\n");
            $printer->text("Kode: " . $transaction->transaction_code . "\n");
            $printer->text("Tanggal: " . $transaction->date->format('d-m-Y H:i') . "\n");
            $printer->text("-----------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Pembeli: " . $transaction->nama_pelanggan_offline . "\n");
            $printer->text("--------------------------------------------\n");

           foreach ($transaction->details as $detail) {
                $menuName = $detail->menu->name;
                $qty = $detail->qty;
                $hargaSatuan = number_format($detail->main_cost, 0, ',', '.');
                $subtotal = number_format($detail->main_subtotal, 0, ',', '.');

                // Tampilkan nama menu
                $printer->text($menuName . "\n");

                // Bagian kiri tetap
                $leftPart = sprintf(" x%-2s Rp%-10s =", $qty, $hargaSatuan);

                // Gabungkan dengan subtotal rata kanan
                $lineLength = 48; // total karakter baris printer
                $subtotalText = $subtotal;
                $spaces = $lineLength - strlen($leftPart) - strlen($subtotalText);
                $line = $leftPart . str_repeat(" ", $spaces) . $subtotalText;

                $printer->text($line . "\n");
            }

            $printer->text("--------------------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("TOTAL: Rp" . number_format($transaction->grand_total, 0, ',', '.') . "\n");

            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima kasih!\n");

            $printer->feed(3);
            $printer->cut();
            $printer->close();
            } catch (\Exception $e) {
                dd($e);
        }
    }
}


