<div class="mb-3">
    <div><strong>Status Transaksi:</strong> 
        <span class="text-danger fw-bold">{{ $transaksi->status_formatted }}</span>
    </div>
    <div><strong>Kode Transaksi:</strong> {{ $transaksi->transaction_code }}</div>
    <div><strong>Jenis Pesanan:</strong> 
        Delivery
    <div><strong>Nama Pembeli:</strong> 
        {{ $transaksi->nama_pembeli ?? $transaksi->nama_pelanggan_offline }}
    </div>
    <div>
        <div><strong>Metode Pembayaran :</strong>
        {{ $transaksi->metode_bayar }}</div>
    </div>
    <div>
        <div><strong>Nomor Rekening :</strong>
        @if ($transaksi->metode_bayar == 'cod')
            -
        @else
            {{ $transaksi->rekening }}
        @endif</div>
    </div>
</div>

<!-- Tabel Pesanan -->
<div class="table-responsive mb-3">
    <table class="table text-center">
        <thead>
            <tr><th>Nama</th><th>Qty</th><th>Harga</th></tr>
        </thead>
        <tbody>
            @foreach($detail_pesanan as $item)
                <tr>
                    <td>{{ $item->nama_menu }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ $item->main_cost_formatted }}</td>
                </tr>
            @endforeach
            <tr class="fw-bold text-danger">
                <td colspan="2">Sub Total</td>
                <td>Rp {{ $subtotal_formatted }}</td>
            </tr>
            <tr class="fw-bold text-danger">
                <td colspan="2">TOTAL</td>
                <td>Rp {{ $grand_total_formatted }}</td>
            </tr>
        </tbody>
    </table>
</div>
    
<!-- Alamat Pembeli -->
<div class="mb-4">
    <strong>Alamat Pembeli :</strong>
    <div>{{ $transaksi->alamat_pembeli }}</div>
</div>

<!-- Tombol Aksi -->
<div class="d-flex justify-content-between">
    @if ($transaksi->status_formatted == 'Menunggu Konfirmasi')
        <a href="/pesanan-cancel/{{ $transaksi->id_transaksi }}"><button class="btn btn-danger">Batalkan Pembelian</button></a>
    @endif
    
   @if ($transaksi->status_formatted != 'Dibatalkan')
        <a href="/pesanan-accept/{{ $transaksi->id_transaksi }}"><button class="btn btn-primary">
        @if ($transaksi->status_formatted == 'Menunggu Konfirmasi')
            Konfirmasi Pembelian
        @else
            Selesaikan Memasak
        @endif
    </button></a>
   @endif

    @if ($transaksi->status_formatted == 'Dibatalkan')
        <a href="/pesanan-cancel-done/{{ $transaksi->id_transaksi }}"><button class="btn btn-danger">Konfirmasi Pembatalan</button></a>
    @endif
</div>