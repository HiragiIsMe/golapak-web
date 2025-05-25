@extends('layouts.dashboard-admin')

@section('title', 'Data Pegawai')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Pegawai</h4>
        <!-- Tombol Tambah Pegawai -->
        <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#modalCreatePegawai">
            + Tambah Pegawai
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
           <thead class="table-orange text-white">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i <= 10; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Lorem</td>
                    <td>Ipsum</td>
                    <td>Admin</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPegawai">
                            ✏️ Edit
                        </button>
                        <button class="btn btn-danger btn-sm">🗑️ Hapus</button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

<!-- Modal CREATE Pegawai -->
<div class="modal fade" id="modalCreatePegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-orange">
            <div class="modal-body bg-light-grey p-4">
                <h5 class="text-center fw-bold text-orange mb-4">DATA PEGAWAI</h5>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-orange">Username</label>
                            <input type="text" class="form-control input-orange">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-orange">Nama</label>
                            <input type="text" class="form-control input-orange">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-orange">Role</label>
                            <input type="text" class="form-control input-orange">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-orange">Password</label>
                            <input type="password" class="form-control input-orange">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-orange">SIMPAN</button>
                        <button type="button" class="btn btn-orange" data-bs-dismiss="modal">BATAL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal EDIT Pegawai -->
<div class="modal fade" id="modalEditPegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-orange">
            <div class="modal-body bg-light-grey p-4">
                <h5 class="text-center fw-bold text-orange mb-4">EDIT PEGAWAI</h5>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-orange">Username</label>
                            <input type="text" class="form-control input-orange" value="Lorem">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-orange">Nama</label>
                            <input type="text" class="form-control input-orange" value="Ipsum">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-orange">Role</label>
                            <input type="text" class="form-control input-orange" value="Admin">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-orange">Password</label>
                            <input type="password" class="form-control input-orange">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-orange">SIMPAN</button>
                        <button type="button" class="btn btn-orange" data-bs-dismiss="modal">BATAL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>

.table-orange {
    background-color: #f15a24;
}
    /* style buat create ama edit */
    .text-orange {
        color: #f15a24;
    }
    .btn-orange {
        background-color: #09142d;
        color: white;
        border-radius: 13px;
        padding: 6px 20px;
        font-weight: bold;

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
