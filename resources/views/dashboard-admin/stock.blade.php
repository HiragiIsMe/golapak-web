@extends('layouts.dashboard-admin')

@section('title', 'Stock Barang')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Stock Barang</h4>
        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateBarang">
            + Tambah Barang
        </button> --}}
    </div>

    <!-- Table dummy -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover rounded shadow-sm text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['main_cost'] }}</td>
                        <td>
                            @if ($data['stock'] == true)
                                <a href="/update-tersedia/{{ $data['id'] }}" class="btn btn-success btn-sm"> Tersedia</a>
                            @else
                                <a href="/update-tidak-tersedia/{{ $data['id'] }}" class="btn btn-danger btn-sm"> Tidak Tersedia</a>
                            @endif
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Create -->
{{-- <div class="modal fade" id="modalCreateBarang" tabindex="-1" aria-labelledby="modalCreateBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-orange">
            <div class="modal-body bg-light-grey p-4 rounded">
                <h5 class="text-center fw-bold text-orange mb-4">DATA BARANG</h5>
                <form>
                    <div class="mb-3">
                        <label class="form-label text-orange">Nama Barang</label>
                        <input type="text" class="form-control input-orange">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-orange">Harga Barang</label>
                        <input type="number" class="form-control input-orange">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-orange">Stok Barang</label>
                        <input type="number" class="form-control input-orange">
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-orange">SIMPAN</button>
                        <button type="button" class="btn btn-orange" data-bs-dismiss="modal">BATAL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit (duplikat create) -->
<div class="modal fade" id="modalEditBarang" tabindex="-1" aria-labelledby="modalEditBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-orange">
            <div class="modal-body bg-light-grey p-4 rounded">
                <h5 class="text-center fw-bold text-orange mb-4">EDIT BARANG</h5>
                <form>
                    <div class="mb-3">
                        <label class="form-label text-orange">Nama Barang</label>
                        <input type="text" class="form-control input-orange" value="Lorem Ipsum">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-orange">Harga Barang</label>
                        <input type="number" class="form-control input-orange" value="10000">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-orange">Stok Barang</label>
                        <input type="number" class="form-control input-orange" value="10">
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-orange">SIMPAN</button>
                        <button type="button" class="btn btn-orange" data-bs-dismiss="modal">BATAL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<style>
    .text-orange {
        color: #f15a24;
    }
    .btn-orange {
        background-color: #f15a24;
        color: white;
        border-radius: 6px;
        padding: 6px 20px;
    }
    .bg-light-grey {
        background-color: #eaeaea;
        border-radius: 12px;
    }
    .border-orange {
        border: 3px solid #f15a24;
        border-radius: 12px;
    }
    .input-orange {
        border: 2px solid #f15a24;
        border-radius: 6px;
    }
</style>

@endsection
