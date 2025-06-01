<table style="border-collapse: collapse; width: 100%;">
    <thead>
        {{-- Tambahkan baris kosong agar mulai dari baris 2 --}}
        <tr><td colspan="15" style="border: none;"></td></tr>

        <tr>
            {{-- Geser ke kolom G (kolom ke-7) --}}
            <td colspan="6" style="border: none;"></td>
            <th colspan="9" style="border: 1px solid black; text-align: center; font-weight: bold;">
                Pendapatan Hari ini Tanggal {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
            </th>
        </tr>
        <tr>
            <td colspan="6" style="border: none;"></td>
            <th colspan="4" style="border: 1px solid black; text-align: center;">Pesanan Online</th>
            <th style="border: none;"></th>
            <th colspan="4" style="border: 1px solid black; text-align: center;">Pesanan Offline</th>
        </tr>
        <tr>
            <td colspan="6" style="border: none;"></td>
            <th style="border: 1px solid black; text-align: center;">No</th>
            <th style="border: 1px solid black; text-align: center;">Menu</th>
            <th style="border: 1px solid black; text-align: center;">Qty</th>
            <th style="border: 1px solid black; text-align: center;">Total</th>
            <th style="border: none;"></th>
            <th style="border: 1px solid black; text-align: center;">No</th>
            <th style="border: 1px solid black; text-align: center;">Menu</th>
            <th style="border: 1px solid black; text-align: center;">Qty</th>
            <th style="border: 1px solid black; text-align: center;">Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $max = max(count($online), count($offline));
            $totalOnline = 0;
            $totalOffline = 0;
        @endphp

        @for ($i = 0; $i < $max; $i++)
        <tr>
            <td colspan="6" style="border: none;"></td>
            {{-- Online --}}
            @if(isset($online[$i]))
                <td style="border: 1px solid black; text-align: center;">{{ $i+1 }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $online[$i]->menu_name }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $online[$i]->total_qty }}</td>
                <td style="border: 1px solid black; text-align: center;">Rp.{{ number_format($online[$i]->total_harga, 0, ',', '.') }}</td>
                @php $totalOnline += $online[$i]->total_harga; @endphp
            @else
                <td style="border: 1px solid black;"></td><td style="border: 1px solid black;"></td><td style="border: 1px solid black;"></td><td style="border: 1px solid black;"></td>
            @endif

            <td style="border: none;"></td>

            {{-- Offline --}}
            @if(isset($offline[$i]))
                <td style="border: 1px solid black; text-align: center;">{{ $i+1 }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $offline[$i]->menu_name }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $offline[$i]->total_qty }}</td>
                <td style="border: 1px solid black; text-align: center;">Rp.{{ number_format($offline[$i]->total_harga, 0, ',', '.') }}</td>
                @php $totalOffline += $offline[$i]->total_harga; @endphp
            @else
                <td style="border: 1px solid black;"></td><td style="border: 1px solid black;"></td><td style="border: 1px solid black;"></td><td style="border: 1px solid black;"></td>
            @endif
        </tr>
        @endfor

        <tr>
            <td colspan="6" style="border: none;"></td>
            <td colspan="3" style="border: 1px solid black; text-align: center;"><strong>Total</strong></td>
            <td style="border: 1px solid black; text-align: center;"><strong>Rp.{{ number_format($totalOnline, 0, ',', '.') }}</strong></td>
            <td style="border: none;"></td>
            <td colspan="3" style="border: 1px solid black; text-align: center;"><strong>Total</strong></td>
            <td style="border: 1px solid black; text-align: center;"><strong>Rp.{{ number_format($totalOffline, 0, ',', '.') }}</strong></td>
        </tr>
    </tbody>
</table>
