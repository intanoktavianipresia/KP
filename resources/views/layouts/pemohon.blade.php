<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
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
            --transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        html, body {
            max-width: 100%;
            overflow-x: hidden; /* Kunci agar tidak bisa geser kanan */
            margin: 0;
            padding: 0;
            position: relative;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fcfcfc;
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container-premium {
            width: 100%;
            padding-right: 20px;
            padding-left: 20px;
            margin-right: auto;
            margin-left: auto;
        }
        @media (min-width: 992px) {
            .container-premium { padding: 0 80px; }
        }

        .top-header {
            background: var(--primary);
            color: white;
            padding: clamp(10px, 2vw, 15px) 0;
            border-bottom: 3px solid var(--accent);
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: clamp(10px, 3vw, 20px);
        }

        .header-text strong {
            font-size: clamp(0.85rem, 4vw, 1.25rem);
            display: block;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: 0.5px;
        }

        .header-text small {
            font-size: clamp(0.6rem, 2.5vw, 0.85rem);
            opacity: 0.9;
            font-weight: 500;
            text-transform: uppercase;
        }

        .navbar-custom {
            background: white;
            padding: 0;
            border-bottom: 1px solid #f1f5f9;
            position: sticky;
            top: 0;
            z-index: 1050;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }

        .navbar-nav .nav-link {
            font-size: 0.9rem;
            font-weight: 700;
            color: #64748b !important;
            padding: 25px 15px !important;
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover, 
        .navbar-nav .nav-link.active {
            color: var(--primary) !important;
        }

        @media (min-width: 992px) {
            .navbar-nav .nav-link::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 4px;
                background: var(--primary);
                transition: var(--transition);
                transform: translateX(-50%);
            }
            .navbar-nav .nav-link.active::after {
                width: 80%; /* Garis bawah elegan */
            }
        }

        @media (max-width: 991.98px) {
            .navbar-custom { padding: 10px 0; }
            .navbar-collapse {
                background: white;
                margin-top: 10px;
                border-top: 2px solid var(--primary);
            }
            .navbar-nav .nav-link {
                padding: 15px 20px !important;
                border-bottom: 1px solid #f1f5f9;
            }
            .navbar-nav .nav-link.active {
                background: #f0fdf4;
                border-left: 5px solid var(--primary);
                padding-left: 25px !important;
            }
        }

        main {
            min-height: 80vh;
            width: 100%;
            overflow: hidden; /* Mencegah konten child nendang ke samping */
        }

        
        .footer {
            background: #064e3b;
            color: white;
            padding: 60px 0 20px;
            margin-top: 50px;
        }

        .footer h6 {
            color: var(--accent);
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.9rem;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .jam-layanan-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
        }

        .jam-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .footer-info p {
            font-size: 0.85rem;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            opacity: 0.8;
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            height: 200px;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .copyright-section {
            background: #043a2c;
            color: rgba(255, 255, 255, 0.5);
            text-align: center;
            padding: 20px;
            font-size: 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .row {
            margin-right: 0 !important;
            margin-left: 0 !important;
        }
    </style>
</head>
<body>

    <header class="top-header">
        <div class="container-premium">
            <div class="brand-wrapper">
                <img src="{{ asset('images/logo.png') }}" style="height: clamp(40px, 8vw, 55px); width: auto;" alt="Logo Bengkulu">
                <div class="header-text text-white">
                    <strong>DINAS PERPUSTAKAAN DAN KEARSIPAN</strong>
                    <small>Provinsi Bengkulu</small>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-premium d-flex justify-content-between align-items-center">
            <span class="navbar-brand d-lg-none fw-bold text-success" style="font-size: 0.8rem;">MENU LAYANAN</span>
            
            <button class="navbar-toggler border-0 shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list" style="font-size: 2.2rem; color: var(--primary);"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mx-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon') ? 'active' : '' }}" href="{{ url('/pemohon') }}">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/informasi*') ? 'active' : '' }}" href="{{ url('/pemohon/informasi') }}">
                            <i class="bi bi-info-circle"></i> Prosedur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/peminjaman*') ? 'active' : '' }}" href="{{ url('/pemohon/peminjaman') }}">
                            <i class="bi bi-file-earmark-plus"></i> Ajukan Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/status*') ? 'active' : '' }}" href="{{ url('/pemohon/status') }}">
                            <i class="bi bi-search"></i> Cek Status
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pemohon/kontak*') ? 'active' : '' }}" href="{{ url('/pemohon/kontak') }}">
                            <i class="bi bi-chat-dots"></i> Hubungi Kami
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
        <div class="container-premium">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <img src="{{ asset('images/logo.png') }}" style="height: 60px; margin-bottom: 20px;">
                    <h6>Jam Layanan</h6>
                    <div class="jam-layanan-box">
                        <div class="jam-item">
                            <span>Senin - Kamis</span>
                            <span class="fw-bold">07.45 - 16.15</span>
                        </div>
                        <div class="jam-item">
                            <span>Jumat</span>
                            <span class="fw-bold">07.45 - 16.45</span>
                        </div>
                        <div class="small text-warning mt-2" style="font-size: 0.75rem;">*Sabtu, Minggu & Hari Libur Nasional Tutup</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 footer-info" data-aos="fade-up" data-aos-delay="100">
                    <h6>Kontak Kami</h6>
                    <p><i class="bi bi-geo-alt-fill text-warning"></i> Jl. Mahoni No.12, Padang Jati, Bengkulu 38222</p>
                    <p><i class="bi bi-telephone-fill text-warning"></i> (0736) 26095</p>
                    <p><i class="bi bi-envelope-fill text-warning"></i> perpusbengkulu@gmail.com</p>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <h6>Lokasi Kantor</h6>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.026410403328!2d102.2741!3d-3.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwNDgnMDAuMCJTIDEwMsKwMTYnMjYuOCJF!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="copyright-section">
        © 2026 <strong>DPK Provinsi Bengkulu</strong>. Seluruh Hak Cipta Dilindungi.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        const navLinks = document.querySelectorAll('.nav-link');
        const menuToggle = document.getElementById('navbarNav');
        const bsCollapse = new bootstrap.Collapse(menuToggle, {toggle:false});
        navLinks.forEach((l) => {
            l.addEventListener('click', () => { if(window.innerWidth < 992) { bsCollapse.hide(); } })
        });
    </script>
</body>
</html>