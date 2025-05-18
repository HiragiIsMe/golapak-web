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
        <marquee behavior="scroll" direction="left">Promo Spesial Hari Ini! Gratis Es Teh untuk Setiap Pembelian Bakso Jumbo!</marquee>
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
                    <img src="{{ asset('img/landing/bakso.jpg') }}" alt="Slider 5">
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
            <div class="menu-item-landing">
                <img src="{{ asset('img/landing/1.jpeg') }}" alt="Menu 1">
                <p>Bakso Jumbo</p>
            </div>
            <div class="menu-item-landing">
                <img src="{{ asset('img/landing/2.jpg') }}" alt="Menu 2">
                <p>Mie Ayam Komplit</p>
            </div>
            <div class="menu-item-landing">
                <img src="{{ asset('img/landing/3.jpeg') }}" alt="Menu 3">
                <p>Bakso Urat</p>
            </div>
        </div>
        <button class="btn-menu-landing">Lihat Semua Menu</button>
    </section>

    <!-- Layer 6: Promosi Aplikasi Mobile -->
    <section class="promo-app">
        <img src="{{ asset('img/landing/hengpon.png') }}" alt="hp">
        <div class="promo-text">
            <h1>Download aplikasinya</h1>
            <h2>Sekarang</h2>
            <p>Mudah order dari mana saja lewat aplikasi mobile UMKM Bakso & Mie Ayam!</p>
            <button class="btn-download">Unduh Sekarang</button>
        </div>
    </section>

        <!-- Floating Order Button -->
    <a href="#" class="floating-order-btn" title="Pesan Sekarang">
        <img src="{{ asset('img/landing/bakso-fl.png') }}" alt="Order Button">
    </a>

 
        @endsection
