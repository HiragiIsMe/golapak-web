@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Home')

@section('content')
<div class="d-flex justify-content-end align-items-center mb-3">
    <label class="form-switch me-2">
        <input type="checkbox" id="toggle-toko" checked>
        <i></i>
    </label>
    <span id="status-toko" class="fw-bold">Toko Online Aktif</span>
</div> 

<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Transaksi hari ini</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahTransaksi }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="fa-solid fa-fire-burner"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pesanan diproses</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pesananDiproses }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fa-solid fa-people-group"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Pengguna</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalPengguna }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="fa-solid fa-user-nurse"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Pegawai</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahPegawai }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pemasukan</h4>
                             {{-- <h6 class="font-extrabold mb-0">Rp {{ number_format($pemasukan, 0, ',', '.') }}</h6> --}}
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('img/roby.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">Admin</h5>
                            <h6 class="text-muted mb-0">@aku adalah admin</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .form-switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}

.form-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.form-switch i {
  position: absolute;
  cursor: pointer;
  background-color: #ccc;
  border-radius: 34px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  transition: .4s;
}

.form-switch i:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

.form-switch input:checked + i {
  background-color: #4caf50;
}

.form-switch input:checked + i:before {
  transform: translateX(24px);
}

</style>
<script>
document.getElementById('toggle-toko').addEventListener('change', function() {
    let statusText = document.getElementById('status-toko');
    if (this.checked) {
        statusText.textContent = 'Toko Online Aktif';
    } else {
        statusText.textContent = 'Toko Online Nonaktif';
    }
});
</script>



@endsection