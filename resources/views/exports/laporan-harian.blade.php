<table>
    <thead>
        <tr>
            <th colspan="4">Pendapatan Hari ini Tanggal {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</th>
            <th></th>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th colspan="4">Pesanan Online</th>
            <th></th>
            <th colspan="4">Pesanan Offline</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Qty</th>
            <th>Total Pendapatan</th>
            <th></th>
            <th>No</th>
            <th>Menu</th>
            <th>Qty</th>
            <th>Total Pendapatan</th>
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
            {{-- Online --}}
            @if(isset($online[$i]))
                <td>{{ $i+1 }}</td>
                <td>{{ $online[$i]->menu_name }}</td>
                <td>{{ $online[$i]->total_qty }}</td>
                <td>Rp.{{ number_format($online[$i]->total_harga, 0, ',', '.') }}</td>
                @php $totalOnline += $online[$i]->total_harga; @endphp
            @else
                <td></td><td></td><td></td><td></td>
            @endif

            <td></td>

            {{-- Offline --}}
            @if(isset($offline[$i]))
                <td>{{ $i+1 }}</td>
                <td>{{ $offline[$i]->menu_name }}</td>
                <td>{{ $offline[$i]->total_qty }}</td>
                <td>Rp.{{ number_format($offline[$i]->total_harga, 0, ',', '.') }}</td>
                @php $totalOffline += $offline[$i]->total_harga; @endphp
            @else
                <td></td><td></td><td></td><td></td>
            @endif
        </tr>
        @endfor

        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>Rp.{{ number_format($totalOnline, 0, ',', '.') }}</strong></td>
            <td></td>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>Rp.{{ number_format($totalOffline, 0, ',', '.') }}</strong></td>
        </tr>
    </tbody>
</table>
