@extends('layouts.pemohon')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --primary-dark: #064e3b;
        --primary-main: #059669;
        --primary-gradient: linear-gradient(135deg, #064e3b 0%, #059669 100%);
        --accent-gold: #d4af37;
        --text-main: #1e293b;
        --bg-soft: #f8fafc;
    }

    body {
        background-color: var(--bg-soft);
        color: var(--text-main);
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow-x: hidden;
    }

    /* ===== HERO SECTION WITH ANIMATED OVERLAY ===== */
    .hero-informasi {
        position: relative;
        background: var(--primary-gradient);
        padding: 120px 20px 160px;
        text-align: center;
        color: white;
        overflow: hidden;
    }

    .hero-informasi::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: auto;
    }

    .hero-informasi h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        letter-spacing: -1px;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    /* Decorative Curve */
    .hero-curve {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 80px;
        background: var(--bg-soft);
        clip-path: ellipse(60% 100% at 50% 100%);
    }

    /* ===== MAIN CONTENT CARD ===== */
    .content-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid white;
        border-radius: 30px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        padding: 50px;
        margin-top: -100px;
        position: relative;
        z-index: 10;
    }

    .info-text p {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #475569;
    }

    /* ===== CATEGORY BADGES (INTERACTIVE) ===== */
    .badge-jenis {
        padding: 12px 28px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: white;
        border: 1px solid #e2e8f0;
        cursor: default;
    }

    .badge-jenis:hover {
        transform: translateY(-8px) scale(1.05);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: var(--primary-main);
    }

    /* ===== TATA TERTIB SECTIONS ===== */
    .tata-box {
        background: white;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
    }

    .tata-box::after {
        content: "RULES";
        position: absolute;
        top: -10px;
        right: -10px;
        font-size: 5rem;
        font-weight: 900;
        color: rgba(0,0,0,0.03);
        pointer-events: none;
    }

    .tata-box li {
        margin-bottom: 15px;
        padding-left: 10px;
        transition: 0.3s;
    }

    .tata-box li:hover {
        color: var(--primary-main);
        transform: translateX(5px);
    }

    /* ===== MODERN STEPS (ALUR) ===== */
    .step-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-top: 50px;
    }

    .step-item {
        flex: 1;
        text-align: center;
        position: relative;
    }

    .step-icon {
        width: 70px;
        height: 70px;
        background: white;
        border: 2px solid #e2e8f0;
        color: var(--primary-main);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.5rem;
        font-weight: 800;
        transition: 0.4s;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .step-item:hover .step-icon {
        background: var(--primary-main);
        color: white;
        border-color: var(--primary-main);
        transform: rotate(10deg);
    }

    .step-label {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--primary-dark);
    }

    /* Tombol Katalog Modern */
    .btn-katalog {
        background: var(--primary-gradient);
        color: white;
        padding: 16px 40px;
        border-radius: 50px;
        text-decoration: none !important;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: 0.4s;
        box-shadow: 0 15px 35px rgba(5, 150, 105, 0.3);
    }

    .btn-katalog:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 45px rgba(5, 150, 105, 0.4);
        color: white;
    }

    @media (max-width: 992px) {
        .step-container { flex-direction: column; align-items: center; }
        .step-item { width: 100%; max-width: 300px; margin-bottom: 30px; }
    }
</style>

<div class="hero-informasi">
    <div class="hero-content" data-aos="fade-up">
        <span class="badge mb-3" style="background: rgba(255,255,255,0.2); letter-spacing: 2px;">INFORMASI PUBLIK</span>
        <h1>Layanan Peminjaman <br> Arsip Fisik Nasional</h1>
        <p class="opacity-75">Akses sumber sejarah dan administrasi secara transparan, aman, dan profesional untuk masa depan yang lebih akuntabel.</p>
    </div>
    <div class="hero-curve"></div>
</div>

<div class="container mb-5">
    <div class="content-card" data-aos="fade-up" data-aos-delay="200">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="info-text text-center">
                    <p>Kami menyediakan akses terhadap sumber informasi autentik guna mendukung kegiatan <strong>pendidikan, penelitian,</strong> dan <strong>administrasi kenegaraan</strong>. Setiap prosedur dijalankan dengan standar keamanan tinggi demi menjaga kelestarian aset sejarah bangsa.</p>
                </div>

                <div class="mt-5">
                    <h6 class="text-center text-uppercase fw-bold text-muted mb-4" style="letter-spacing: 2px; font-size: 0.8rem;">Kategori Koleksi Arsip</h6>
                    <div class="jenis-container d-flex justify-content-center flex-wrap gap-3">
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="300">🎥 <span style="color:#2563eb">Arsip Video</span></div>
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="400">📄 <span style="color:#db2777">Arsip Tekstual</span></div>
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="500">🗺️ <span style="color:#059669">Arsip Peta</span></div>
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="600">🖼️ <span style="color:#d97706">Arsip Foto</span></div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="https://link-web-temanmu.com" target="_blank" class="btn-katalog">
                        <i class="bi bi-search"></i> Telusuri Katalog Arsip Digital
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-4">
        <div class="col-12" data-aos="fade-right">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="width: 50px; height: 3px; background: var(--accent-gold);"></div>
                <h4 class="fw-800 mb-0" style="color: var(--primary-dark)">Tata Tertib Layanan</h4>
            </div>
            <div class="tata-box border-top border-4 border-success">
                <div class="row">
                    <div class="col-md-6">
                        <ol class="fw-500">
                            <li>Ruang baca khusus untuk akses arsip dan referensi resmi.</li>
                            <li>Arsip dilarang keras dibawa keluar dari area ruang baca.</li>
                            <li>Wajib menjaga kebersihan dan memperlakukan arsip dengan hati-hati.</li>
                            <li>Pengguna bertanggung jawab penuh atas fisik arsip yang dipinjam.</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol start="5" class="fw-500">
                            <li>Dilarang melipat, mencoret, atau merusak fisik arsip.</li>
                            <li>Hanya diperbolehkan membawa alat tulis (pensil disarankan).</li>
                            <li>Tas, jaket, dan makanan wajib disimpan di loker.</li>
                            <li>Wajib menjaga ketenangan demi kenyamanan bersama.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alur-wrapper mt-5 pt-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h4 class="fw-800" style="color: var(--primary-dark)">Alur Prosedur Peminjaman</h4>
            <p class="text-muted">Proses transparan untuk akses yang lebih mudah</p>
        </div>
        
        <div class="step-container">
            <div class="step-item" data-aos="fade-up" data-aos-delay="100">
                <div class="step-icon">01</div>
                <div class="step-label">Registrasi & <br> Formulir Digital</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="200">
                <div class="step-icon">02</div>
                <div class="step-label">Verifikasi & <br> Validasi Petugas</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="300">
                <div class="step-icon">03</div>
                <div class="step-label">Penjadwalan <br> Kunjungan</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="400">
                <div class="step-icon">04</div>
                <div class="step-label">Akses Arsip di <br> Ruang Layanan</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="500">
                <div class="step-icon">05</div>
                <div class="step-label">Penyerahan <br> Kembali & Selesai</div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>

@endsection