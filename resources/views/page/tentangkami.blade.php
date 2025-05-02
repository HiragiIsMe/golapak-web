@extends('layouts.main')

@section('title', 'Tentang Kami')

@section('content')
<section class="tentangkami-page">
    <!-- Background Foto + Overlay + Title -->
    <div class="hero-section" style="background: url('{{ asset('img/tentangkami/bg.jpg') }}') no-repeat center center/cover;">
        <div class="hero-overlay">
            <h1 class="hero-title">Tentang Kami</h1>
        </div>
    </div>

    <!-- Logo dan Deskripsi -->
    <section class="about-section">
        <img src="{{ asset('img/logo.png') }}" alt="Logo UMKM" class="about-logo">
        <p class="about-desc">
            Kami adalah UMKM yang berdedikasi untuk menghadirkan produk terbaik kepada pelanggan. Dengan komitmen terhadap kualitas dan pelayanan, kami terus berkembang dan berinovasi.
        </p>
    </section>

    <!-- Visi dan Misi -->
    <section class="visimisi-section">
        <div class="visimisi-card">
            <h2>Visi</h2>
            <p>Mewujudkan UMKM terdepan dengan produk berkualitas tinggi dan pelayanan terbaik untuk masyarakat.</p>
        </div>
        <div class="visimisi-card">
            <h2>Misi</h2>
            <p>Memberikan layanan terbaik, menjaga kualitas produk, serta berkontribusi dalam pemberdayaan ekonomi lokal.</p>
        </div>
    </section>

    <!-- Lokasi Toko -->
    <section class="lokasi-section">
        <h2>Lokasi Kami</h2>
        <p>Jl. Contoh Alamat No. 123, Kota Contoh, Indonesia</p>
        <a href="https://maps.google.com/?q=-6.200000,106.816666" target="_blank" class="btn-maps">Buka di Google Maps</a>
    </section>
</section>
@endsection
