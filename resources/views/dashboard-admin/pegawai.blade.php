@extends('layouts.dashboard-admin')

@section('title', 'Data Pegawai')

@section('content')
    <div class="container mt-4">
        {{-- Alert Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Alert Sukses/Error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Data Pegawai</h4>
            <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#modalCreatePegawai">
                + Tambah Pegawai
            </button>
        </div>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-orange text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($combinedUsers as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['role'] }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditPegawai"
                                    data-id="{{ $user['id'] }}"
                                    data-name="{{ $user['name'] }}"
                                    data-email="{{ $user['email'] }}"
                                    data-role="{{ strtolower($user['role']) }}"
                                    @if (isset($user['phone_number'])) data-phone="{{ $user['phone_number'] }}" @endif>
                                    ✏️ Edit
                                </button>
                                <form action="{{ route('dashboard-admin.pegawai.destroy', $user['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pegawai ini?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Create Pegawai --}}
    <div class="modal fade" id="modalCreatePegawai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-orange">
                <div class="modal-body bg-light-grey p-4">
                    <h5 class="text-center fw-bold text-orange mb-4">TAMBAH PEGAWAI</h5>
                    <form action="{{ route('dashboard-admin.pegawai.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control input-orange" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Email</label>
                                <input type="email" name="email" class="form-control input-orange" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Role</label>
                                <select name="role" class="form-select input-orange" id="createRole" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="courier">Kurir</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Password</label>
                                <input type="password" name="password" class="form-control input-orange" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control input-orange">
                            </div>
                            <div class="col-md-6 mb-3" id="phoneField" style="display:none;">
                                <label class="form-label text-orange">Nomor Telepon</label>
                                <input type="text" name="phone_number" class="form-control input-orange">
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

    {{-- Modal Edit Pegawai --}}
    <div class="modal fade" id="modalEditPegawai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-orange">
                <div class="modal-body bg-light-grey p-4">
                    <h5 class="text-center fw-bold text-orange mb-4">EDIT PEGAWAI</h5>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="previous_type" id="previousType">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Nama</label>
                                <input type="text" name="name" class="form-control input-orange" id="editName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Email</label>
                                <input type="email" name="email" class="form-control input-orange" id="editEmail" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Role</label>
                                <select name="role" class="form-select input-orange" id="editRole" required>
                                    <option value="admin">Admin</option>
                                    <option value="courier">Kurir</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Password</label>
                                <input type="password" name="password" class="form-control input-orange">
                                <small class="text-muted">Minimal 8 karakter</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-orange">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control input-orange">
                            </div>
                            <div class="col-md-6 mb-3" id="editPhoneField" style="display:none;">
                                <label class="form-label text-orange">Nomor Telepon</label>
                                <input type="text" name="phone_number" class="form-control input-orange" id="editPhone">
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

    {{-- Style --}}
    <style>
        .table-orange {
            background-color: #f15a24;
        }
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // CREATE modal: show/hide phone input
        document.getElementById('createRole').addEventListener('change', function () {
            document.getElementById('phoneField').style.display = this.value === 'courier' ? 'block' : 'none';
        });

        const editModal = document.getElementById('modalEditPegawai');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');
            const phone = button.getAttribute('data-phone') || '';

            document.getElementById('editForm').action = `/dashboard-admin/pegawai/${id}`;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;

            const phoneField = document.getElementById('editPhoneField');
            const phoneInput = document.getElementById('editPhone');

            if (role === 'courier') {
                phoneField.style.display = 'block';
                phoneInput.value = phone;
                phoneInput.required = true;
            } else {
                phoneField.style.display = 'none';
                phoneInput.value = '';
                phoneInput.required = false;
            }

            // Update dynamically on role change in edit modal
            document.getElementById('editRole').addEventListener('change', function () {
                if (this.value === 'courier') {
                    phoneField.style.display = 'block';
                    phoneInput.required = true;
                } else {
                    phoneField.style.display = 'none';
                    phoneInput.required = false;
                }
            });
        });
    });
</script>
@endpush
