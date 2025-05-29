@foreach ($details as $detail)
<tr class="detail-item">
    <td>{{ $detail->transaction_id }}</td>
    <td>{{ $detail->menu->name ?? 'Menu tidak ditemukan' }}</td>
    <td>Rp {{ number_format($detail->main_cost, 0, ',', '.') }}</td>
    <td>{{ $detail->qty }}</td>
    <td>Rp {{ number_format($detail->main_subtotal, 0, ',', '.') }}</td>
</tr>
@endforeach
