<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Mazer Admin Dashboard')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logut/logout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-custom/admin.css') }}">
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
                            <a href="index.html"><img src="{{ asset('img/roby.jpg') }}" alt="Logo" srcset=""> Toko fadil</a>   
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ Request::is('dashboard-admin') ? 'active' : '' }}">
                            <a href="{{ route('dashboard-admin') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('menu*') ? 'active' : '' }}">
                            <a href="/menu" class='sidebar-link'>
                                <i class="fa-solid fa-utensils"></i>
                                <span>Daftar Menu</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('stock*') ? 'active' : '' }}">
                            <a href="/stock" class='sidebar-link'>
                                <i class="fa-solid fa-boxes-stacked"></i>
                                <span>Stock Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('dashboard-admin/pegawai*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard-pegawai') }}" class='sidebar-link'>
                                <i class="fa-solid fa-user-group"></i>
                                <span>Pegawai</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('dashboard-admin/riwayat*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard-riwayat') }}" class='sidebar-link'>
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <span>Riwayat Transaksi</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

                <div class="logout-section">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                    <button class="btn-logout" type="submit">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                      </button>
                    </form>
                </div>
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
