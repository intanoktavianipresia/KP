@extends('layouts.pemohon')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --primary-dark: #064e3b;
        --primary-main: #059669;
        --primary-gradient: linear-gradient(135deg, #064e3b 0%, #059669 100%);
        --accent-gold: #d4af37;
        --text-main: #1e293b;
        --text-muted: #64748b;
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
        padding: clamp(100px, 15vw, 150px) 20px clamp(140px, 20vw, 180px);
        text-align: center;
        color: white;
        overflow: hidden;
    }

    .hero-informasi::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.15;
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: auto;
    }

    .hero-informasi h1 {
        font-size: clamp(2rem, 6vw, 3.8rem);
        font-weight: 800;
        letter-spacing: -1.5px;
        line-height: 1.1;
        margin-bottom: 25px;
        text-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* Decorative Curve */
    .hero-curve {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 100px;
        background: var(--bg-soft);
        clip-path: ellipse(60% 100% at 50% 100%);
        z-index: 3;
    }

    /* ===== MAIN CONTENT CARD ===== */
    .content-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 40px;
        box-shadow: 0 40px 100px -20px rgba(6, 78, 59, 0.15);
        padding: clamp(30px, 6vw, 60px);
        margin-top: -110px;
        position: relative;
        z-index: 10;
    }

    .info-text p {
        font-size: clamp(1.05rem, 2vw, 1.25rem);
        line-height: 1.8;
        color: var(--text-muted);
        font-weight: 400;
    }

    /* ===== CATEGORY BADGES ===== */
    .badge-jenis {
        padding: 15px 30px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: white;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .badge-jenis:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: var(--primary-main);
    }

    /* ===== TATA TERTIB BOX ===== */
    .tata-box {
        background: white;
        padding: clamp(25px, 5vw, 45px);
        border-radius: 35px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.03);
        position: relative;
        overflow: hidden;
        border: 1px solid #f1f5f9;
    }

    .tata-box::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 8px; height: 100%;
        background: var(--primary-main);
    }

    .tata-box ol li {
        margin-bottom: 18px;
        padding-left: 10px;
        font-weight: 500;
        transition: 0.3s;
        color: #475569;
    }

    .tata-box ol li:hover {
        color: var(--primary-main);
        transform: translateX(8px);
    }

    /* ===== ALUR PROSEDUR ===== */
    .step-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-top: 60px;
        position: relative;
    }

    @media (min-width: 992px) {
        .step-container::before {
            content: "";
            position: absolute;
            top: 40px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: dashed #e2e8f0;
            z-index: 1;
        }
    }

    .step-item {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .step-icon {
        width: 80px;
        height: 80px;
        background: white;
        border: 3px solid #f1f5f9;
        color: var(--primary-main);
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 1.8rem;
        font-weight: 800;
        transition: 0.5s;
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }

    .step-item:hover .step-icon {
        background: var(--primary-main);
        color: white;
        border-color: var(--primary-main);
        transform: translateY(-10px) rotate(8deg);
        box-shadow: 0 20px 40px rgba(5, 150, 105, 0.2);
    }

    .step-label {
        font-weight: 800;
        font-size: 0.95rem;
        color: var(--primary-dark);
        line-height: 1.4;
    }

    /* Tombol Katalog */
    .btn-katalog {
        background: var(--primary-gradient);
        color: white !important;
        padding: 20px 45px;
        border-radius: 50px;
        text-decoration: none !important;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 15px;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 15px 35px rgba(5, 150, 105, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-katalog:hover {
        transform: scale(1.05) translateY(-5px);
        box-shadow: 0 25px 50px rgba(5, 150, 105, 0.4);
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .hero-informasi h1 { margin-bottom: 20px; }
        .step-container { flex-direction: column; align-items: center; gap: 50px; }
        .step-item { width: 100%; max-width: 320px; }
        .step-item:not(:last-child)::after {
            content: "\F128";
            font-family: "bootstrap-icons";
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2rem;
            color: var(--primary-main);
            opacity: 0.3;
        }
    }
</style>

<section class="hero-informasi">
    <div class="hero-content" data-aos="fade-down">
        <span class="badge mb-4 px-3 py-2" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); letter-spacing: 3px; font-weight: 700;">INFORMASI LAYANAN</span>
        <h1>Akses Peminjaman <br> Arsip Fisik & Dokumen</h1>
        <p class="opacity-75 fs-5">Mendukung transparansi informasi publik untuk keperluan riset, <br class="d-none d-md-block"> pendidikan, dan administrasi kenegaraan.</p>
    </div>
    <div class="hero-curve"></div>
</section>

<div class="container pb-5">
    <div class="content-card" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-11 text-center">
                <div class="info-text mb-5">
                    <p>Layanan Peminjaman Arsip DPK Provinsi Bengkulu hadir untuk menjembatani masyarakat dengan sumber informasi autentik. Kami menerapkan <strong>Prosedur Operasi Standar (SOP)</strong> yang ketat guna memastikan setiap lembar sejarah tetap terjaga fisiknya sekaligus tetap dapat dimanfaatkan oleh publik secara bertanggung jawab.</p>
                </div>

                <div class="mt-5">
                    <h6 class="text-center text-uppercase fw-800 text-muted mb-4" style="letter-spacing: 3px; font-size: 0.85rem;">Koleksi Yang Dapat Diakses</h6>
                    <div class="d-flex justify-content-center flex-wrap gap-3 gap-md-4">
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="100">
                            <span class="fs-4">🎥</span> <span style="color:#2563eb">Arsip Audiovisual</span>
                        </div>
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="200">
                            <span class="fs-4">📄</span> <span style="color:#db2777">Dokumen Tekstual</span>
                        </div>
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="300">
                            <span class="fs-4">🗺️</span> <span style="color:#059669">Kartografi & Peta</span>
                        </div>
                        <div class="badge-jenis" data-aos="zoom-in" data-aos-delay="400">
                            <span class="fs-4">🖼️</span> <span style="color:#d97706">Koleksi Foto Histori</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5 pt-4">
                    <a href="https://link-web-katalog-anda.com" target="_blank" class="btn-katalog">
                        <i class="bi bi-search"></i> Telusuri Katalog Digital
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-4">
        <div class="col-12" data-aos="fade-up">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="width: 60px; height: 4px; background: var(--accent-gold); border-radius: 10px;"></div>
                <h3 class="fw-800 mb-0" style="color: var(--primary-dark)">Tata Tertib Layanan</h3>
            </div>
            <div class="tata-box">
                <div class="row g-4">
                    <div class="col-md-6">
                        <ol class="ps-3 mb-0">
                            <li>Akses fisik arsip hanya dilakukan di ruang baca yang telah disediakan petugas.</li>
                            <li>Arsip bersifat dokumen negara, dilarang keras membawa keluar area ruang baca tanpa izin resmi.</li>
                            <li>Wajib menggunakan sarung tangan (tersedia) saat menangani arsip tertentu yang rentan.</li>
                            <li>Peminjam bertanggung jawab penuh atas keutuhan fisik arsip selama masa penggunaan.</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="ps-3 mb-0" start="5">
                            <li>Dilarang melakukan penggandaan (foto/scan) tanpa izin tertulis dari pihak kearsipan.</li>
                            <li>Hanya diperbolehkan membawa catatan (buku/laptop) dan alat tulis ke dalam ruang baca.</li>
                            <li>Tas, makanan, dan minuman wajib dititipkan di loker keamanan yang tersedia.</li>
                            <li>Menjaga ketenangan dan suasana kondusif demi kenyamanan peneliti dan staf lainnya.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alur-wrapper mt-5 pt-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="fw-800" style="color: var(--primary-dark)">Alur Peminjaman Arsip</h3>
            <div class="mx-auto" style="width: 50px; height: 3px; background: var(--accent-gold); margin-top: 15px;"></div>
        </div>
        
        <div class="step-container">
            <div class="step-item" data-aos="fade-up" data-aos-delay="100">
                <div class="step-icon">01</div>
                <div class="step-label">Pengajuan <br> Formulir Digital</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="200">
                <div class="step-icon">02</div>
                <div class="step-label">Verifikasi & <br> Persetujuan Admin</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="300">
                <div class="step-icon">03</div>
                <div class="step-label">Penetapan <br> Jadwal Layanan</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="400">
                <div class="step-icon">04</div>
                <div class="step-label">Akses Arsip di <br> Depo / Ruang Baca</div>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="500">
                <div class="step-icon">05</div>
                <div class="step-label">Pengembalian <br> & Validasi Akhir</div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 120,
        easing: 'ease-out-quart'
    });
</script>

@endsection