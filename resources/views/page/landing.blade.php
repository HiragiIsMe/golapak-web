@extends('layouts.main')

@section('title', 'Beranda - Bakso & Mie Ayam UMKM')

@section('content')

    <!-- Layer 2: Hero Section -->
    <section class="hero" style="background-image: url('{{ asset('img/background.jpg') }}')">
        <div class="hero-content">
            <h1>HARGA MERAKYAT</h1>
            <h1>KUALITAS MANTAP</h1>
            <p>Lezat, Bergizi, dan Terjangkau untuk Semua Kalangan.</p>
        </div>
    </section>

    <!-- Layer 3: Marquee -->
    <div class="marquee">
        <marquee behavior="scroll" direction="left">Selamat datang di website UMKM Mie Ayam Solo Bodowoso - Nikmati cita rasa mie ayam khas Solo dengan kualitas terbaik!</marquee>
    </div>

    <!-- Layer 4: Slider Gambar -->
    <section class="carousel">
        <button class="carousel-btn prev">&#10094;</button> <!-- Tombol Prev -->
    
        <div class="carousel-track-container">
            <ul class="carousel-track">
                <li class="carousel-slide current-slide">
                    <img src="{{ asset('img/landing/Homepage_1.png') }}" alt="Slider 1">
                </li>
                <li class="carousel-slide">
                    <img src="{{ asset('img/landing/Homepage_2.png') }}" alt="Slider 2">
                </li>
                <li class="carousel-slide">
                    <img src="{{ asset('img/landing/Homepage_3.png') }}" alt="Slider 3">
                </li>
                <li class="carousel-slide">
                    <img src="{{ asset('img/landing/Homepage_4.png') }}" alt="Slider 4">
                </li>
                <li class="carousel-slide">
                    <img src="{{ asset('img/landing/putih.png') }}" alt="Slider 5">
                </li>
                <li class="carousel-slide">
                    <img src="{{ asset('img/landing/bakso.jpg') }}" alt="Slider 6">
                </li>
            </ul>
        </div>
        <button class="carousel-btn next">&#10095;</button> <!-- Tombol Next -->
    </section>
    

<!-- Layer 5: Konten Menu -->
<section class="menu-landing" id="menu">
    <h2>Menu Andalan Kami</h2>
    <div class="menu-grid-landing">
        @forelse($bestSellers as $menu)
            <div class="menu-item-landing">
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                <p>{{ $menu->name }}</p>
            </div>
        @empty
            <p>Tidak ada data best seller saat ini.</p>
        @endforelse
    </div>

    <a href="{{ url('/menuu') }}" class="btn-menu-landing">Lihat Semua Menu</a>
</section>



    <!-- Layer 6: Promosi Aplikasi Mobile -->
    <section class="promo-app">
        <img src="{{ asset('img/landing/hengpon.png') }}" alt="hp">
        <div class="promo-text">
            <h1>Download aplikasinya</h1>
            <h2>Sekarang</h2>
            <p>Mudah order dari mana saja lewat aplikasi mobile UMKM Bakso & Mie Ayam!</p>
            <a href="https://github.com/HiragiIsMe/golapak-web  " target="_blank" class="btn-download">Unduh Sekarang</a>
        </div>
    </section>

        <!-- Floating Order Button -->
    <a href="#" class="floating-order-btn" title="Pesan Sekarang">
        <img src="{{ asset('img/landing/bakso-fl.png') }}" alt="Order Button">
    </a>

 
@endsection
