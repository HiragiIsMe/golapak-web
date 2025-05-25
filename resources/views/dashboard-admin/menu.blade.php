@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Menu')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Menu</h4>
        <a href="/menu/create" class="btn btn-tmbh">+ Tambah Menu</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover rounded shadow-sm">
            <thead class="table-orange text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga Jual</th>
                    <th>Jenis</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">

                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->name}}</td>
                        <td>{{ $data->main_cost }}</td>
                        <td>{{ $data->tipe }}</td>
                        <td>
                            <a href="/menu/{{ $data->id }}/edit" class="btn btn-info btn-sm">✏️ Edit</a>
                            <form style="display:inline-block" action="/menu/{{ $data->id }}" method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                            </form>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>

    .table-orange {
    background-color: #f15a24;
    }
    .btn-tmbh {
    background-color: #09142d;
    color: white;
    border-radius: 13px;
    padding: 6px 20px;
    font-weight: bold;
    }
    
</style>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah submit langsung
                Swal.fire({
                    title: 'Yakin ingin menghapus menu ini?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Lanjutkan submit jika dikonfirmasi
                    }
                });
            });
        });
    </script>
    @if (session('success-insert'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Ditambah',
            text: '{{ session('success') }}',
        });
    </script>
    @endif

    @if (session('success-update'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Diupdate',
            text: '{{ session('success') }}',
        });
    </script>
    @endif

    @if (session('success-delete'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Dihapus',
            text: '{{ session('success') }}',
        });
    </script>
    @endif
@endpush