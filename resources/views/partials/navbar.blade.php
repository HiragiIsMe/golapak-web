<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    </div>
    <div class="navbar-center">
        <a href="{{ route('landing') }}" class="{{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('tentangkami') }}" class="{{ request()->routeIs('tentangkami') ? 'active' : '' }}">Tentang Kami</a>
        <a href="{{ route('menu') }}"class="{{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
        <a href="{{ route('kontak') }}"class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
    </div>
    <div class="navbar-right">
        <a href="{{ route('akun') }}" class="btn-order">Login</a>
    </div>    
</nav>
