<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman Arsip</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1f6b4f;
            --primary-dark: #15563e;
            --accent: #d4af37;
            --bg-light: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background: var(--bg-light);
            overflow: hidden;
        }

        /* Sisi Kiri (Form) */
        .left {
            width: 45%;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
            z-index: 10;
        }

        .logo-header {
            position: absolute;
            top: 50px;
            left: 60px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-header img {
            width: 55px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        .logo-header h2 {
            font-size: 14px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .logo-header small {
            display: block;
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            margin-bottom: 35px;
        }

        .login-header h3 {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -1px;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 8px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            font-weight: 700;
            font-size: 13px;
            color: var(--text-main);
            margin-bottom: 8px;
            display: block;
            padding-left: 2px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fdfdfd;
        }

        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            background: white;
            box-shadow: 0 0 0 4px rgba(31,107,79,0.1);
            transform: translateY(-1px);
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            border: none;
            color: white;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(31,107,79,0.3);
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            box-shadow: 0 12px 20px -3px rgba(31,107,79,0.4);
            transform: translateY(-2px);
        }

        .error {
            background: #fef2f2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13px;
            font-weight: 600;
            border-left: 4px solid #ef4444;
            display: flex;
            align-items: center;
        }

        .copyright {
            position: absolute;
            bottom: 40px;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Sisi Kanan (Visual) */
        .right {
            width: 55%;
            background: linear-gradient(135deg, rgba(15, 63, 46, 0.95), rgba(31, 107, 79, 0.9)), 
                        url('https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=2030&auto=format&fit=crop'); /* Gambar perpus abstrak */
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 100px;
            position: relative;
        }

        .right::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent, rgba(0,0,0,0.3));
        }

        .right-content {
            position: relative;
            z-index: 2;
            max-width: 500px;
        }

        .badge-new {
            background: var(--accent);
            color: #4a3701;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: inline-block;
        }

        .right-content h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
            letter-spacing: -2px;
        }

        .right-content p {
            font-size: 18px;
            line-height: 1.6;
            opacity: 0.9;
            font-weight: 400;
            color: #e2e8f0;
        }

        /* Garis Aksen Emas */
        .accent-line {
            width: 60px;
            height: 4px;
            background: var(--accent);
            margin-bottom: 30px;
            border-radius: 2px;
        }

        @media(max-width:1024px){
            .left { width: 50%; padding: 40px; }
            .right { width: 50%; }
        }

        @media(max-width:900px){
            .right { display:none; }
            .left { width:100%; }
            .logo-header { left: 50%; transform: translateX(-50%); text-align: center; }
            .logo-header { flex-direction: column; top: 30px; }
        }
    </style>
</head>

<body>

<div class="left">

    <div class="logo-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Provinsi Bengkulu">
        <div>
            <small>Pemerintah Provinsi Bengkulu</small>
            <h2>DINAS PERPUSTAKAAN<br>DAN KEARSIPAN</h2>
        </div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <h3>Selamat Datang</h3>
            <p>Silakan masuk menggunakan akun administrator Anda.</p>
        </div>

        @if ($errors->any())
            <div class="error">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;margin-right:10px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login-admin">
            @csrf

            <div class="form-group">
                <label for="email">Email Administrator</label>
                <input type="email" id="email" name="email" placeholder="nama@email.com" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Masuk ke Sistem</button>
        </form>
    </div>

    <div class="copyright">
        &copy; 2026 <strong>DPK Provinsi Bengkulu</strong>. All rights reserved.
    </div>

</div>

<div class="right">
    <div class="right-content">
        <div class="badge-new">Official Admin Portal</div>
        <div class="accent-line"></div>
        <h1>Sistem Peminjaman<br>Arsip Digital</h1>
        <p>
            Transformasi kearsipan yang lebih efisien, transparan, dan terintegrasi untuk Provinsi Bengkulu yang lebih maju.
        </p>
    </div>
</div>

</body>
</html>