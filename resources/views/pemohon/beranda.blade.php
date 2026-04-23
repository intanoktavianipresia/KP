@extends('layouts.pemohon')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --pine-green: #064e3b;
        --pine-light: #0a6b51;
        --emerald: #10b981;
        --accent-gold: #d4af37;
        --text-dark: #0f172a;
        --text-muted: #64748b;
        --bg-soft: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-dark);
        background-color: #ffffff;
        overflow-x: hidden;
    }

    /* =========================================
       HERO SECTION (ULTRA RESPONSIVE)
       ========================================= */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 100px 0;
        background: linear-gradient(135deg, rgba(6, 78, 59, 0.92), rgba(10, 107, 81, 0.8)), 
                    url('https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=2000&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
    }

    /* Fix background-attachment for mobile devices */
    @media (max-width: 991px) {
        .hero { background-attachment: scroll; padding: 120px 0 80px; }
    }

    .hero-content {
        position: relative;
        z-index: 10;
    }

    .hero-content h1 {
        font-size: clamp(2.2rem, 5vw, 4.2rem);
        font-weight: 800;
        letter-spacing: -2px;
        line-height: 1.1;
        margin-bottom: 25px;
    }

    .hero-content h1 span {
        color: var(--accent-gold);
        display: block;
    }

    .btn-cta {
        padding: clamp(12px, 2vw, 18px) clamp(25px, 4vw, 45px);
        font-weight: 800;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 14px;
        background: var(--accent-gold);
        border: none;
        color: #fff;
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
    }

    .btn-cta:hover {
        transform: scale(1.05) translateY(-5px);
        background: #fff;
        color: var(--pine-green);
    }

    .hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        line-height: 0;
        fill: #ffffff;
    }

    /* =========================================
       SECTION GENERAL STYLES
       ========================================= */
    .section-title {
        font-weight: 800;
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        letter-spacing: -1.5px;
        color: var(--pine-green);
        margin-bottom: 20px;
    }

    .title-underline {
        width: 80px;
        height: 6px;
        background: var(--accent-gold);
        border-radius: 10px;
        margin-bottom: 40px;
    }

    /* =========================================
       CARDS & BOXES (FIXED)
       ========================================= */
    .card-modern {
        background: white;
        padding: 40px 30px;
        border-radius: 30px;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.5s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-modern:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(6, 78, 59, 0.12);
        border-color: var(--pine-light);
    }

    .card-icon {
        width: 80px;
        height: 80px;
        background: var(--bg-soft);
        color: var(--pine-green);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        font-size: 2.2rem;
        margin-bottom: 25px;
        transition: 0.5s;
    }

    .card-modern:hover .card-icon {
        background: var(--pine-green);
        color: white;
    }

    .vm-box {
        background: var(--bg-soft);
        padding: clamp(20px, 5vw, 40px);
        border-radius: 32px;
        height: 100%;
        transition: 0.4s;
        border: 1px solid transparent;
    }

    .vm-box:hover {
        background: white;
        border-color: var(--accent-gold);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }

    /* =========================================
       HISTORY TIMELINE (OPTIMIZED)
       ========================================= */
    .history-timeline {
        position: relative;
        padding-left: 20px;
        margin-top: 20px;
    }

    .history-timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 2px;
        background: var(--accent-gold);
        opacity: 0.3;
    }

    .history-item {
        position: relative;
        padding-bottom: 25px;
        padding-left: 20px;
    }

    .history-item::before {
        content: '';
        position: absolute;
        left: -24px;
        top: 6px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--accent-gold);
        border: 2px solid #fff;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    .img-wrapper {
        position: relative;
        border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
    }

    /* =========================================
       UTILITIES
       ========================================= */
    .text-justify { text-align: justify; }
    
    @media (max-width: 991px) {
        .text-justify { text-align: left; }
        .section-title, .title-underline { text-align: center; margin-left: auto; margin-right: auto; }
        .hero-content { text-align: center; }
        .hero-content .d-flex { justify-content: center; }
    }

    .list-custom { list-style: none; padding-left: 0; }
    .list-custom li {
        padding-left: 35px;
        position: relative;
        margin-bottom: 15px;
        font-weight: 500;
        line-height: 1.4;
    }
    .list-custom li::before {
        content: "\F272";
        font-family: "bootstrap-icons";
        position: absolute;
        left: 0;
        color: var(--emerald);
        font-weight: 900;
    }

    .float-anim { animation: floating 3s ease-in-out infinite; }
    @keyframes floating {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
</style>

<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 hero-content">
                <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                    <span class="badge rounded-pill px-4 py-2" style="background: rgba(212, 175, 55, 0.2); border: 1px solid var(--accent-gold); color: var(--accent-gold);">
                        <i class="bi bi-shield-check me-2"></i>Sistem Terverifikasi
                    </span>
                    <div class="vr d-none d-md-block" style="background: white; width: 2px; opacity: 0.3;"></div>
                    <span class="text-white-50 fw-bold">DPK PROVINSI BENGKULU</span>
                </div>
                <h1 data-aos="fade-right">Layanan Digital,<span>Peminjaman Arsip Daerah.</span></h1>
                <p class="mb-5 text-white-50 fs-5 col-xl-10" data-aos="fade-right" data-aos-delay="100">
                    Sistem Digital Peminjaman Arsip Fisik hadir sebagai solusi modern untuk 
                    aksesibilitas dokumen daerah secara aman, cepat, dan transparan. 
                    Mendukung riset kolektif dan akuntabilitas tata kelola pemerintahan.
                </p>
                <div class="d-flex flex-wrap gap-4" data-aos="zoom-in" data-aos-delay="200">
                    <a href="{{ url('/pemohon/peminjaman') }}" class="btn btn-cta">
                        Mulai Pengajuan <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="hero-wave">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.43,147.3,126,211.36,111.37,252.62,101.9,285.65,70.74,321.39,56.44Z"></path>
        </svg>
    </div>
</section>

<section id="profil" class="py-5 mt-lg-5">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="img-wrapper">
                    <img src="{{ asset('images/gedung.png') }}" class="w-100" alt="Gedung DPK">
                    <div class="position-absolute top-0 end-0 p-3 p-md-4">
                        <div class="bg-white p-3 p-md-4 rounded-4 shadow-lg float-anim text-center">
                            <h2 class="fw-bold text-success mb-0">37+</h2>
                            <p class="small text-muted mb-0">Tahun Berdiri</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h3 class="section-title">Dedikasi Untuk Negeri</h3>
                <div class="title-underline"></div>
                <p class="lead fw-bold text-success mb-4">Garda Terdepan Pelestarian Memori Kolektif Bangsa di Bumi Rafflesia.</p>
                <p class="text-muted lh-lg mb-4 text-justify">
                    Kami tidak sekadar menyimpan kertas tua. Kami menjaga integritas sejarah dan administrasi. 
                    Melalui digitalisasi prosedur, kami memastikan setiap warga negara dan akademisi 
                    mendapatkan akses informasi publik dengan standar keamanan kelas dunia.
                </p>
                <div class="row g-4">
                    <div class="col-6 col-sm-4">
                        <h5 class="fw-bold mb-1 text-dark">Modernitas</h5>
                        <p class="small text-muted">Sistem Terintegrasi</p>
                    </div>
                    <div class="col-6 col-sm-4">
                        <h5 class="fw-bold mb-1 text-dark">Keamanan</h5>
                        <p class="small text-muted">Proteksi Fisik & Digital</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12" data-aos="fade-up">
                <div class="p-4 p-md-5 rounded-5 shadow-sm" style="background: var(--bg-soft); border-left: 10px solid var(--pine-green);">
                    <div class="row g-4">
                        <div class="col-lg-7">
                            <h4 class="fw-bold text-success mb-4"><i class="bi bi-clock-history me-2"></i> Sejarah Lengkap Instansi</h4>
                            <div class="text-muted lh-lg text-justify">
                                <p>Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu didirikan pada <strong>2 September 1980</strong> berdasarkan SK Kemendikbud Nomor 0221/O/1980 dengan nama Perpustakaan Wilayah Provinsi Bengkulu. Awalnya, kami merupakan Unit Pelaksana Teknis (UPT) dari Pusat Pembinaan Perpustakaan Departemen Pendidikan dan Kebudayaan RI.</p>
                                <p>Seiring berjalannya waktu dan tuntutan zaman, kami telah mengalami <strong>6 kali pergantian nama dan 11 kali pergantian pimpinan</strong>. Puncaknya pada tahun 2016, kami resmi bertransformasi menjadi <strong>Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</strong> untuk memperkuat peran strategis kearsipan daerah.</p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="history-timeline">
                                <div class="history-item">
                                    <span class="fw-bold text-success">1980</span>
                                    <p class="small text-muted mb-0">Perpustakaan Wilayah Provinsi Bengkulu</p>
                                </div>
                                <div class="history-item">
                                    <span class="fw-bold text-success">1989 - 1997</span>
                                    <p class="small text-muted mb-0">Perpustakaan Daerah & Perpustakaan Nasional Prov. Bengkulu</p>
                                </div>
                                <div class="history-item">
                                    <span class="fw-bold text-success">2001 - 2009</span>
                                    <p class="small text-muted mb-0">Badan Perpustakaan, Arsip dan Dokumentasi</p>
                                </div>
                                <div class="history-item">
                                    <span class="fw-bold text-success">2016 - SEKARANG</span>
                                    <p class="small text-muted mb-0">Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-soft">
    <div class="container py-lg-5">
        <div class="row g-4">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="vm-box shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="card-icon" style="width:60px; height:60px; font-size: 1.5rem; margin:0;">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h4 class="fw-bold mb-0">Visi Kami</h4>
                    </div>
                    <p class="fs-4 fw-bold text-dark lh-base">
                        "Terwujudnya kearsipan yang handal sebagai pilar akuntabilitas dan memori kolektif daerah."
                    </p>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="vm-box shadow-sm">
                    <h4 class="fw-bold mb-4">Misi Strategis</h4>
                    <ul class="list-custom">
                        <li>Transformasi tata kelola arsip berbasis teknologi informasi (E-Government) yang inklusif.</li>
                        <li>Menjamin keselamatan aset informasi daerah sebagai bukti pertanggungjawaban nasional.</li>
                        <li>Peningkatan standar kompetensi SDM dalam pelayanan publik yang modern dan cepat.</li>
                        <li>Penyediaan akses arsip yang transparan bagi riset, pendidikan, dan ilmu pengetahuan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 mb-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="section-title">Fasilitas Unggulan</h3>
            <div class="title-underline"></div>
            <p class="text-muted">Kemudahan akses arsip dalam satu genggaman digital</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-modern shadow-sm">
                    <div class="card-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <h5 class="fw-bold">Katalog Cerdas</h5>
                    <p class="text-muted small lh-lg">Pencarian arsip fisik menggunakan metadata akurat untuk memudahkan penemuan lokasi dokumen secara presisi di depo arsip.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-modern shadow-sm">
                    <div class="card-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h5 class="fw-bold">Verifikasi Aman</h5>
                    <p class="text-muted small lh-lg">Protokol keamanan berlapis menggunakan validasi identitas resmi untuk menjamin kerahasiaan dokumen negara.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-modern shadow-sm">
                    <div class="card-icon">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h5 class="fw-bold">Monitoring Sistem</h5>
                    <p class="text-muted small lh-lg">Lacak setiap tahapan pengajuan Anda secara real-time, mulai dari verifikasi admin hingga jadwal pengambilan dokumen.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        easing: 'ease-out-cubic'
    });
</script>

@endsection