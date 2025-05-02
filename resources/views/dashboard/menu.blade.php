@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Menu')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Menu</h4>
        <a href="{{ route('dashboard-menu-create') }}" class="btn btn-primary">+ Tambah Menu</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover rounded shadow-sm">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Jenis</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @php
                    $menus = [
                        ['id' => 1, 'nama' => 'Nasi Goreng', 'harga' => 15000, 'jenis' => 'makanan'],
                        ['id' => 2, 'nama' => 'Es Teh Manis', 'harga' => 5000, 'jenis' => 'minuman'],
                        ['id' => 3, 'nama' => 'Mie Ayam', 'harga' => 12000, 'jenis' => 'makanan'],
                        ['id' => 4, 'nama' => 'Jus Alpukat', 'harga' => 12000, 'jenis' => 'minuman'],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $menu['nama'] }}</td>
                        <td>{{ number_format($menu['harga'], 0, ',', '.') }}</td>
                        <td>{{ ucfirst($menu['jenis']) }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">🔍 Detail</a>
                            <a href="{{ route('dashboard-menu-edit') }}" class="btn btn-info btn-sm">✏️ Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="alert('Menghapus menu: {{ $menu['nama'] }}')">🗑️ Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
