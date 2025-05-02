@extends('layouts.dashboard-admin')

@section('title', 'Edit Menu')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4 rounded" style="background: white; border: 1px solid #ddd;">
        <h4 class="fw-bold mb-4">Edit Menu</h4>
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Menu</label>
                <input type="text" class="form-control rounded-pill" id="nama" name="nama" value="Nasi Goreng">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control rounded-pill" id="harga" name="harga" value="15000">
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select class="form-select rounded-pill" id="jenis" name="jenis">
                    <option value="makanan" selected>Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                <a href="{{ route('dashboard-menu') }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
