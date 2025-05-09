<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    </div>
    <div class="navbar-center">
        <a href="{{ route('landing') }}" class="nav-link">Beranda</a>
        <a href="{{ route('tentangkami') }}" class="nav-link">Tentang Kami</a>
        <a href="{{ route('menuu') }}" class="nav-link">Menu</a>
        <a href="{{ route('kontak') }}" class="nav-link">Kontak</a>
    </div>
    <div class="navbar-right">
        <a href="{{ route('akun') }}" class="btn-order">Login</a>
    </div>    
</nav>
