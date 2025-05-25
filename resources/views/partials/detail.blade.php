<div class="modal-body">
    <div class="mb-3">
        <div><strong>Status Transaksi:</strong> 
            <span class="text-danger fw-bold">
                {{ strtoupper(str_replace('_', ' ', $transaksi->status)) }}
            </span>
        </div>
        <div><strong>Kode Transaksi:</strong> {{ $transaksi->transaction_code }}</div>
        <div><strong>Jenis Pesanan:</strong> 
            {{ ucfirst($transaksi->order_type) }}
        </div>
        <div><strong>Nama Pembeli:</strong> 
            {{ $transaksi->nama_pembeli ?? $transaksi->nama_pelanggan_offline }}
        </div>
    </div>

    <div class="table-responsive mb-3">
        <table class="table text-center">
            <thead>
                <tr><th>Nama</th><th>Qty</th><th>Harga</th></tr>
            </thead>
            <tbody>
                @foreach ($detail_pesanan as $item)
                    <tr>
                        <td>{{ $item->nama_menu }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->main_cost, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="fw-bold text-danger"><td colspan="2">Sub Total</td><td>{{ number_format($subtotal, 0, ',', '.') }}</td></tr>
                <tr class="fw-bold text-danger"><td colspan="2">TOTAL</td><td>{{ number_format($grand_total, 0, ',', '.') }}</td></tr>
            </tbody>
        </table>
    </div>

    <div class="mb-4">
        <strong>Alamat Pembeli :</strong>
        <div>Jalan Riau Nomor 21, Krajan Barat, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur</div> <!-- Sesuaikan bila ada di DB -->
    </div>
</div>