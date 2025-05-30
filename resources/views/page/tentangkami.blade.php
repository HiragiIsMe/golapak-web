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
        <img src="{{ asset('img/logo/logo3.png') }}" alt="Logo UMKM" class="about-logo">
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
    
    <!-- Embed Google Maps -->
    <div class="maps-embed">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8822155371545!2d113.85961!3d-7.9783939!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6c3d801158829%3A0x9e8826c174b49f53!2sMie%20ayam%20solo%20bondowoso!5e0!3m2!1sen!2sid!4v1717057070075!5m2!1sen!2sid" 
            width="100%" 
            height="300" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <p>JL. pengarang, tengah, jambesari, Kab Bondowoso, Jawa Timur 68264</p>
    <a href="https://www.google.com/maps/place/Mie+ayam+solo+bondowoso/@-7.9792516,113.8646762,14.25z/data=!4m6!3m5!1s0x2dd6c3d801158829:0x9e8826c174b49f53!8m2!3d-7.9783939!4d113.85961!16s%2Fg%2F11wnhtz__c?entry=ttu&g_ep=EgoyMDI1MDUyNy4wIKXMDSoASAFQAw%3D%3D" 
       target="_blank" 
       class="btn-maps">
        Buka di Google Maps
    </a>
</section>

</section>
@endsection
