@extends('layouts.main')

@section('title', 'Hubungi Kami')

@section('content')
<section class="contact-page">
    <h1 class="contact-title">Hubungi Kami</h1>

    <div class="contact-container">
        <!-- Form -->
        <form class="contact-form">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Contoh@Gmail.Com" required>
            <input type="text" name="subject" placeholder="Subjek Pesan" required>
            <textarea name="pesan" placeholder="Pesan" required></textarea>
            <button type="submit" class="contact-btn">Kirim</button>
        </form>

        <!-- Info Kontak -->
        <div class="contact-info">
            <div class="info-item">
                <i class="fa-brands fa-whatsapp info-icon"></i>
                <p>0000 - 0000 - 0000</p>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope info-icon"></i>
                <p>Ini Email Toko</p>
            </div>
            <div class="info-item">
                <i class="fas fa-map-marker-alt info-icon"></i>
                <p>Lorem Ipsum Dolor Sit Amet</p>
            </div>
        </div>
    </div>
</section>
@endsection
