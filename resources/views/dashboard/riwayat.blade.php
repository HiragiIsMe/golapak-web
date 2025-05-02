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

    <div class="table-responsive mb-5">
        <table class="table table-bordered text-center">
            <thead class="bg-warning text-white">
                <tr>
                    <th>Nomor Transaksi</th>
                    <th>Total Item</th>
                    <th>Total Harga</th>
                    <th>Total Kembalian</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                <tr>
                    <td>TRX00{{ $i }}</td>
                    <td>{{ rand(1, 5) }}</td>
                    <td>{{ number_format(rand(10000, 100000), 0, ',', '.') }}</td>
                    <td>{{ number_format(rand(1000, 5000), 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <h4>DETAIL TRANSAKSI</h4>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="bg-warning text-white">
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>{{ number_format(10000, 0, ',', '.') }}</td>
                    <td>{{ rand(1, 3) }}</td>
                    <td>{{ number_format(10000 * rand(1, 3), 0, ',', '.') }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
