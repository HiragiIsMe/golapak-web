@extends('layouts.dashboard-admin')

@section('title', 'Tambah Menu')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4 rounded" style="background: white; border: 1px solid #ddd;">
        <h4 class="fw-bold mb-4">Tambah Menu</h4>
        <form action="/menu" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Menu</label>
                <input type="text" class="form-control rounded-pill" id="nama" name="name" placeholder="Masukkan nama menu">
            </div>
            @error('name')
                <div class="text-danger" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="nama" class="form-label">Gambar</label>
                <input type="file" class="form-control rounded-pill" id="image" name="image" placeholder="Masukkan nama menu">
            </div>
            @error('image')
                <div class="text-danger" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="harga" class="form-label">Harga Jual</label>
                <input type="number" class="form-control rounded-pill" id="harga" name="main_cost" placeholder="Masukkan harga">
            </div>
            @error('main_cost')
                <div class="text-danger" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select class="form-select rounded-pill" id="jenis" name="tipe">
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>
            </div>
            @error('tipe')
                <div class="text-danger" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                <a href="/menu" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
