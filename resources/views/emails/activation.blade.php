<!DOCTYPE html>
<html>
<head>
    <title>Aktivasi Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            background-color: #FF9B17;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .header {
            background-color: #FF9B17;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            color: #ffffff;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Aktivasi Akun Anda</h1>
        </div>
        <p>Halo, {{ $penerima }}</p>
        <p>Terima kasih telah mendaftar! Silakan klik tombol di bawah ini untuk mengaktifkan akun Anda dan mulai menggunakan layanan kami:</p>
        <div class="button-container">
            <a href="{{ $activationUrl }}" class="button">Aktifkan Akun</a>
        </div>
        <p>Jika Anda tidak melakukan pendaftaran ini, abaikan saja email ini.</p>
        <p>Salam<br>Tim Kami</p>
    </div>
</body>
</html>
