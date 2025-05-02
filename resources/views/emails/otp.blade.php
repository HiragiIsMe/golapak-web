<!DOCTYPE html>
<html>
<head>
    <title>Kode OTP Reset Password</title>
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
        .header {
            background-color: #FF9B17;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #FF9B17;
            letter-spacing: 5px;
            background-color: #f3f3f3;
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Kode OTP Reset Password</h1>
        </div>
        <div class="content">
            <p>Halo, {{ $nama }}</p>
            <p>Anda telah meminta untuk mengatur ulang kata sandi. Gunakan kode OTP berikut untuk melanjutkan proses reset password:</p>
            <div class="otp-code">{{ $kodeotp }}</div>
            <p>Harap masukkan kode ini pada aplikasi kami. Kode akan kadaluarsa dalam beberapa menit.</p>
            <p>Jika Anda tidak meminta reset password ini, abaikan saja email ini.</p>
        </div>
        <div class="footer">
            <p>Salam, <br> Tim Kami</p>
        </div>
    </div>
</body>
</html>
