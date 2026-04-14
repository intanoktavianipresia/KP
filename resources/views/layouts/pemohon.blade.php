<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Peminjaman Arsip | DPK Bengkulu</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #064e3b;
            --primary-light: #0d7a5d;
            --accent: #d4af37;
            --text-dark: #1e293b;
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fcfcfc;
            margin: 0;
        }

        /* TOP HEADER */
        .top-header {
            background: var(--primary);
            color: white;
            padding: 20px 0;
            border-bottom: 3px solid var(--accent);
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-text strong {
            font-size: 1.3rem;
            letter-spacing: 0.5px;
            display: block;
            line-height: 1.2;
            font-weight: 800;
        }

        .header-text small {
            font-size: 0.9rem;
            opacity: 0.8;
            font-weight: 500;
            text-transform: uppercase;
        }

        /* NAVBAR */
        .navbar-custom {
            background: white;
            padding: 0;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.02);
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark) !important;
            padding: 25px 25px !important;
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 4px;
            background: var(--primary);
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
            background: rgba(6, 78, 59, 0.03);
        }

        .navbar-nav .nav-link i {
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover i {
            transform: translateY(-2px);
            color: var(--accent);
        }

        main { min-height: 70vh; }

        /* =========================================
           FOOTER STYLING (PERBAIKAN SESUAI GAMBAR)
           ========================================= */
        .footer {
            background: #064e3b; /* Hijau Tua Solid */
            color: white;
            padding: 70px 0 40px 0;
            margin-top: 50px;
        }

        .footer-logo {
            width: 80px;
            margin-bottom: 20px;
        }

        .footer h6 {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
            margin-bottom: 25px;
            color: white;
        }

        /* Kotak Jam Layanan Transparan */
        .jam-layanan-box {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(5px);
        }

        .jam-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .jam-item:last-child {
            margin-bottom: 0;
        }

        /* Kontak & Alamat */
        .footer-info p {
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .footer-info i {
            color: var(--accent);
            font-size: 1.2rem;
            margin-top: 3px;
        }

        /* Peta Lokasi dengan Border Emas */
        .map-container {
            border: 4px solid var(--accent);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .copyright-section {
            background: #053d2e;
            color: rgba(255, 255, 255, 0.5);
            text-align: center;
            padding: 20px 0;
            font-size: 0.85rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body>

    <header class="top-header">
        <div class="container-fluid px-5">
            <div class="brand-wrapper">
                <img src="{{ asset('images/logo.png') }}" width="60" alt="Logo">
                <div class="header-text text-white">
                    <strong>DINAS PERPUSTAKAAN DAN KEARSIPAN</strong>
                    <small>Provinsi Bengkulu</small>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-5">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon') ? 'active' : '' }}" href="{{ url('/pemohon') }}">
                            <i class="bi bi-house-door-fill"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/informasi*') ? 'active' : '' }}" href="{{ url('/pemohon/informasi') }}">
                            <i class="bi bi-journal-text"></i> Prosedur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/peminjaman*') ? 'active' : '' }}" href="{{ url('/pemohon/peminjaman') }}">
                            <i class="bi bi-file-earmark-arrow-up-fill"></i> Ajukan Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/status*') ? 'active' : '' }}" href="{{ url('/pemohon/status') }}">
                            <i class="bi bi-search-heart-fill"></i> Cek Status
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/kontak*') ? 'active' : '' }}" href="{{ url('/pemohon/kontak') }}">
                            <i class="bi bi-chat-dots-fill"></i> Hubungi Kami
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container-fluid px-5">
            <div class="row g-5">
                
                <div class="col-lg-4">
                    <img src="{{ asset('images/logo.png') }}" class="footer-logo" alt="Logo">
                    <h6>Jam Layanan Kearsipan</h6>
                    <div class="jam-layanan-box">
                        <div class="jam-item">
                            <span>Senin - Kamis</span>
                            <span class="fw-bold">07.45 - 16.15</span>
                        </div>
                        <div class="jam-item">
                            <span>Jumat</span>
                            <span class="fw-bold">07.45 - 16.45</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 footer-info">
                    <h6>Kontak & Alamat</h6>
                    <p>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Mahoni No.12, Padang Jati,<br>Kec. Ratu Samban, Kota Bengkulu<br>Bengkulu 38222</span>
                    </p>
                    <p>
                        <i class="bi bi-telephone-fill"></i>
                        <span>(0736) 26095</span>
                    </p>
                    <p>
                        <i class="bi bi-envelope-fill"></i>
                        <span>perpus.bengkulu@gmail.com</span>
                    </p>
                </div>

                <div class="col-lg-4">
                    <h6>Peta Lokasi</h6>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.9542456453!2d102.2741!3d-3.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwNDgnMDAuMCJTIDEwMsKwMTYnMjYuOCJF!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="200" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <div class="copyright-section">
        © 2026 <strong>DPK Provinsi Bengkulu</strong>. All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>