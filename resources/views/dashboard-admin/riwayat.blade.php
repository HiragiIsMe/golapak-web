@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Riwayat')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>TRANSAKSI</h4>
        <div class="d-flex align-items-center">
            <label for="tanggal" class="me-2">Tanggal Filter</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control me-2" style="width: 200px;">
            <button class="btn btn-warning">Filter</button>
        </div>
    </div>

    <div class="table-responsive mb-3">
        <table class="table table-bordered text-center">
            <thead class="table-orange text-white">
                <tr>
                    <th>Nomor Transaksi</th>
                    <th>Nama User</th>
                    <th>Total Item</th>
                    <th>Total Harga</th>
                    <th>Biaya Ongkir</th>
                    <th>Grand Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $trx)
                <tr>
                    <td>{{ $trx->transaction_code }}</td>
                    <td>{{ $trx->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $trx->total_qty }}</td>
                    <td>Rp {{ number_format($trx->total_main_cost, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($trx->delivery_fee, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->date)->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-info show-detail" 
                                data-id="{{ $trx->id }}">
                            <i class="fas fa-eye"></i> Pilih
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada transaksi ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h4 class="mt-4">DETAIL TRANSAKSI</h4>
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="detail-transaksi">
            <thead class="table-orange text-white">
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr id="default-detail">
                    <td colspan="5" class="text-center py-4">Belum ada transaksi yang dipilih</td>
                </tr>
                <!-- Baris detail akan dimasukkan di sini lewat AJAX -->
            </tbody>
        </table>
    </div>
</div>

<style>
    .table-orange {
        background-color: #f15a24;
    }
    #detail-transaksi {
        margin-top: 20px;
    }
</style>

<script>
    $(document).ready(function() {
    $('.show-detail').click(function() {
    const transactionId = $(this).data('id');
    const button = $(this);

    $('#default-detail').hide();

    $.get(`/dashboard-admin/riwayat-transaksi/detail/${transactionId}`, function(response) {
        // Hapus detail sebelumnya
        $('#detail-transaksi tbody').find('tr.detail-item').remove();

        // Tambahkan isi baru dari response HTML partial
        $('#detail-transaksi tbody').append(response);

        // Update tombol yang aktif
        $('.show-detail').removeClass('btn-success').addClass('btn-info')
                         .html('<i class="fas fa-eye"></i> Pilih');
        button.removeClass('btn-info').addClass('btn-success')
              .html('<i class="fas fa-check"></i> Dipilih');
    });
});
    });
</script>
@endsection

