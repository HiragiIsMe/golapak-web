@extends('layouts.dashboard-admin')

@section('title', 'Edit Menu')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4 rounded" style="background: white; border: 1px solid #ddd;">
        <h4 class="fw-bold mb-4">Edit Menu</h4>
        <form action="/menu/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" class="form-control rounded-pill" id="name" name="name" value="{{ $menu->name }}">
            </div>
            @error('name')
                <div class="text-danger" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="main_cost" class="form-label">Harga Jual</label>
                <input type="number" class="form-control rounded-pill" id="main_cost" name="main_cost" value="{{ $menu->main_cost }}">
            </div>
            @error('main_cost')
                <div class="text-danger" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="tipe" class="form-label">Jenis</label>
                <select class="form-select rounded-pill" id="tipe" name="tipe">
                    <option value="makanan" {{ $menu->tipe == 'makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="minuman" {{ $menu->tipe == 'minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>
            @error('tipe')
                <div class="text-danger" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                @if($menu->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="Gambar Menu" style="max-width: 200px;">
                    </div>
                @endif
                <input type="file" class="form-control rounded-pill" id="image" name="image">
                
                @error('image')
                    <div class="text-danger" style="color: red;">{{ $message }}</div>
                @enderror
                <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                <a href="/menu" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
