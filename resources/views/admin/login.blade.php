<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem Peminjaman Arsip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', Arial, sans-serif;
        }

        body{
            display:flex;
            height:100vh;
            background:#f3f5f8;
        }

        .left{
            width:50%;
            background:#f9fafb;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            position:relative;
            padding:40px;
        }

        .logo-header{
            position:absolute;
            top:40px;
            left:60px;
            display:flex;
            align-items:center;
            gap:15px;
        }

        .logo-header img{
            width:65px;
        }

        .logo-header h2{
            font-size:18px;
        }

        .logo-header small{
            font-size:13px;
            color:#555;
        }

        .login-box{
            background:white;
            width:420px;
            padding:45px;
            border-radius:16px;
            box-shadow:0 15px 35px rgba(0,0,0,0.08);
            border:1px solid #e5e7eb;
        }

        .login-box h3{
            text-align:center;
            font-size:22px;
            font-weight:600;
            margin-bottom:25px;
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            font-weight:600;
            font-size:14px;
            margin-bottom:6px;
            display:block;
        }

        .form-group input{
            width:100%;
            padding:13px;
            border-radius:10px;
            border:1px solid #d1d5db;
            font-size:14px;
            transition:0.3s;
        }

        .form-group input:focus{
            border-color:#1f6b4f;
            outline:none;
            box-shadow:0 0 0 2px rgba(31,107,79,0.15);
        }

        .btn-login{
            width:100%;
            padding:13px;
            background:#1f6b4f;
            border:none;
            color:white;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .btn-login:hover{
            background:#15563e;
        }

        .error{
            background:#ffe5e5;
            color:#c0392b;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
            font-size:13px;
        }

        .copyright{
            position:absolute;
            bottom:20px;
            left:50%;
            transform:translateX(-50%);
            font-size:12px;
            color:#777;
        }

        .right{
            width:50%;
            background:linear-gradient(135deg,#0f3f2e,#1f6b4f);
            color:white;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:80px;
            position:relative;
        }

        .right::before{
            content:"";
            position:absolute;
            left:0;
            top:0;
            width:6px;
            height:100%;
            background:#d4af37;
        }

        .right-content{
            max-width:500px;
        }

        .right-content h1{
            font-size:34px;
            margin-bottom:20px;
        }

        .right-content p{
            font-size:16px;
            line-height:1.7;
        }

        @media(max-width:900px){
            .right{ display:none; }
            .left{ width:100%; }
        }
    </style>
</head>

<body>

<div class="left">

    <div class="logo-header">
        <img src="{{ asset('images/logo.png') }}">
        <div>
            <h2>DINAS PERPUSTAKAAN DAN KEARSIPAN</h2>
            <small>Provinsi Bengkulu</small>
        </div>
    </div>

    <div class="login-box">
        <h3>Login Sistem</h3>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login-admin">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

    <div class="copyright">
        © 2026 Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu
    </div>

</div>

<div class="right">
    <div class="right-content">
        <h1>SISTEM PEMINJAMAN ARSIP</h1>
        <p>
            Sistem administrasi peminjaman arsip berbasis web untuk mendukung
            proses pengajuan, monitoring, dan pengelolaan arsip secara digital.
        </p>
    </div>
</div>

</body>
</html>
