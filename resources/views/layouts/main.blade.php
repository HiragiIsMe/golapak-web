<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bakso & Mie Ayam UMKM')</title>
    <link rel="stylesheet" href="{{ asset('css/page/landing_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/kontak.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/tentangkami.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/akun.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/footer.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles') 
</head>
<body>

    @include('partials.navbar') {{-- Memanggil navbar --}}
    
    @yield('content') {{-- Konten halaman yang berubah-ubah --}}

    @include('partials.footer') {{-- Memanggil footer --}}

    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    @stack('scripts')
</body>
</html>
