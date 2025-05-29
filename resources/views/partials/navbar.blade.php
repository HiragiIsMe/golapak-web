<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" class="logo">
    </div>

    <div class="navbar-toggle" id="navbar-toggle">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <div class="navbar-center" id="navbar-menu">
        <a href="{{ route('landing') }}" class="nav-link">Beranda</a>
        <a href="{{ route('tentangkami') }}" class="nav-link">Tentang Kami</a>
        <a href="{{ route('menuu') }}" class="nav-link">Menu</a>
        <a href="{{ route('kontak') }}" class="nav-link">Kontak</a>
    </div>

    <div class="navbar-right desktop-only">
        <a href="{{ route('akun') }}" class="btn-order">Login</a>
    </div>
</nav>


<script>
    const toggleBtn = document.getElementById('navbar-toggle');
    const menu = document.getElementById('navbar-menu');

    toggleBtn.addEventListener('click', () => {
        toggleBtn.classList.toggle('active');
        menu.classList.toggle('show');
    });

      document.querySelectorAll('.navbar-center a').forEach(link => {
        link.addEventListener('click', () => {
            toggleBtn.classList.remove('active');
            menu.classList.remove('show');
        });
    });
</script>


