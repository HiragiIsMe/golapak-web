@extends('layouts.main')

@section('title', 'Hubungi Kami')

@section('content')
<section class="contact-page">
    <h1 class="contact-title">Hubungi Kami</h1>

    <div class="contact-container">
        <!-- Form -->
        <form class="contact-form" id="whatsapp-form">
            <input type="text" id="nama" name="nama" placeholder="Nama" required>
            <input type="email" id="email" name="email" placeholder="Contoh@Gmail.Com" required>
            <input type="text" id="subject" name="subject" placeholder="Subjek Pesan" required>
            <textarea id="pesan" name="pesan" placeholder="Pesan" required></textarea>
            <button type="submit" class="contact-btn">Kirim</button>
        </form>

        <!-- Info Kontak -->
        <div class="contact-info">
            <div class="info-item">
                <i class="fa-brands fa-whatsapp info-icon"></i>
                <p>+628815072904</p>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope info-icon"></i>
                <p>RobyPunyafela@gmail.com</p>
            </div>
            <div class="info-item">
                <i class="fas fa-map-marker-alt info-icon"></i>
                <p>JL. pengarang, tengah, jambesari, Kab Bondowoso, Jawa Timur 68264</p>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('whatsapp-form').addEventListener('submit', function(e) {
        e.preventDefault(); 

        var nama = document.getElementById('nama').value;
        var email = document.getElementById('email').value;
        var subject = document.getElementById('subject').value;
        var pesan = document.getElementById('pesan').value;

        var nomorWhatsApp = '628815072904'; // Ganti dengan nomor tujuan (gunakan format internasional tanpa tanda +)

        var message = `Halo, saya ${nama}%0AEmail: ${email}%0ASubjek: ${subject}%0APesan: ${pesan}`;

        var url = `https://wa.me/${nomorWhatsApp}?text=${message}`;
        
        window.open(url, '_blank');

        this.reset();
    });
</script>

</section>
@endsection
