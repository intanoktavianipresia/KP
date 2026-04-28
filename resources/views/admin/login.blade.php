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

        .left {
            width: 45%;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: clamp(20px, 5vw, 60px);
            position: relative;
            z-index: 10;
        }

        .right {
            width: 55%;
            background: linear-gradient(135deg, rgba(15, 63, 46, 0.95), rgba(31, 107, 79, 0.9)), 
                        url('https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=2030&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
        }

        .logo-header {
            position: absolute;
            top: clamp(30px, 5vh, 50px);
            left: clamp(24px, 5vw, 60px);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-header img {
            width: clamp(45px, 6vw, 55px);
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        .logo-header h2 {
            font-size: clamp(12px, 1.5vw, 14px);
            font-weight: 800;
            color: var(--primary);
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .logo-header small {
            display: block;
            font-size: clamp(9px, 1.2vw, 11px);
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h3 {
            font-size: clamp(24px, 4vw, 32px);
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -1px;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: clamp(13px, 2vw, 14px);
            margin-top: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 700;
            font-size: 13px;
            color: var(--text-main);
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: #fdfdfd;
        }

        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            background: white;
            box-shadow: 0 0 0 4px rgba(31,107,79,0.1);
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
            transition: 0.3s;
            box-shadow: 0 10px 15px -3px rgba(31,107,79,0.3);
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .copyright {
            position: absolute;
            bottom: 30px;
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .right-content {
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
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -2px;
        }

        .right-content p {
            font-size: clamp(15px, 2vw, 18px);
            line-height: 1.6;
            color: #e2e8f0;
        }

        .accent-line {
            width: 60px;
            height: 4px;
            background: var(--accent);
            margin-bottom: 30px;
            border-radius: 2px;
        }


        @media (max-width: 1024px) {
            .left { width: 50%; }
            .right { width: 50%; }
        }

        @media (max-width: 900px) {
            body { overflow-y: auto; height: auto; min-height: 100vh; display: block; }
            .right { display: none; } /* Visual kanan hilang di mobile */
            .left { 
                width: 100%; 
                min-height: 100vh;
                padding: 160px 24px 100px 24px; 
                justify-content: center;
            }
            .logo-header { 
                left: 50%;
                transform: translateX(-50%);
                width: 100%;
                justify-content: center;
                text-align: center;
            }
            .login-container { margin: 0 auto; }
            .login-header { text-align: center; }
            .copyright { 
                position: relative; 
                bottom: 0; 
                margin-top: 50px; 
                text-align: center;
                width: 100%;
            }
        }

        /* HP Sangat Kecil */
        @media (max-width: 480px) {
            .left { padding-top: 140px; }
            .login-header h3 { font-size: 26px; }
            .form-group input { padding: 12px 15px; }
        }
    </style>
</head>

<body>

<div class="left">
    <div class="logo-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
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
            <div style="background: #fef2f2; color: #991b1b; padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 13px; border-left: 4px solid #ef4444; display: flex; align-items: center;">
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