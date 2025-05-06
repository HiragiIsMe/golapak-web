<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Mazer Admin Dashboard')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logut/logout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    @stack('styles')
</head>

<body>
    <div id="app">
        <!-- Sidebar dan Navbar -->
        <div id="sidebar" class="active">
          <div class="sidebar-wrapper active">
              <div class="sidebar-header">
                  <div class="d-flex justify-content-between">
                      <div class="logo">
                          <a href="#"><img src="{{ asset('img/roby.jpg') }}" alt="Logo"> Toko Fadil</a>
                      </div>
                      <div class="toggler">
                          <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                      </div>
                  </div>
              </div>
      
              <div class="sidebar-content">
                  <div class="sidebar-menu">
                      <ul class="menu">
                          <li class="sidebar-title">Menu</li>
                          <li class="sidebar-item {{ Request::is('dashboard-checkout') ? 'active' : '' }}">
                              <a href="{{ route('dashboard-checkout') }}" class='sidebar-link'>
                                  <i class="bi bi-grid-fill"></i>
                                  <span>Dashboard</span>
                              </a>
                          </li>
      
                          <li class="sidebar-item {{ Request::is('dashboard-checkout/kasir*') ? 'active' : '' }}">
                              <a href="{{ route('dashboard-kasir') }}" class='sidebar-link'>
                                  <i class="fa-solid fa-bell-concierge"></i>
                                  <span>Kasir</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
      
              <div class="logout-section">
                  <button class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                  </button>
              </div>
      
              <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
          </div>
      </div>
      
      
        
        <div id="main">
            <header class="mb-3">
                <!-- Navbar Top -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- Konten dinamis -->
            @yield('content')

        </div>
        <!-- Modal Detail Pesanan -->
<div class="modal fade" id="modalDetailPesanan" tabindex="-1" aria-labelledby="modalLabelPesanan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-orange p-4" style="border-radius: 20px; background-color: #efefef;">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center fw-bold">Detail Pesanan (Offline)</h5>
        <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- Jenis Pesanan -->
        <div class="d-flex justify-content-center mb-3">
          <button class="btn btn-outline-secondary me-2 active" id="btnDineIn">Dine In</button>
          <button class="btn btn-warning text-white" id="btnTakeAway">Take Away</button>
        </div>

        <!-- Informasi Transaksi -->
        <div class="mb-3">
          <strong>Kode Transaksi:</strong> XB9380180283 <br>
          <strong>Nama Pembeli:</strong> <input type="text" class="form-control mt-1" value="Budi">
        </div>

        <!-- Tabel Pesanan -->
        <div class="table-responsive mb-4">
          <table class="table text-center">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Qty</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
              <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
              <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
            </tbody>
          </table>
        </div>

        <hr>

        <!-- Ringkasan Harga -->
        <div class="text-end">
          <div>Sub Total: <strong>120.000</strong></div>
          <div>Pajak: <strong>10.000</strong></div>
          <div class="fs-5 fw-bold mt-2">TOTAL: <span class="text-dark">140.000</span></div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4 d-flex justify-content-between">
          <button class="btn btn-secondary">Kembali</button>
          <button class="btn btn-danger">Batalkan Pesanan</button>
          <button class="btn btn-warning text-white">Cetak Struk</button>
        </div>

      </div>
    </div>
  </div>
</div>

    </div>

    <!-- JS -->
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
