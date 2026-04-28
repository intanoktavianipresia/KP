@extends('layouts.pemohon')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --pine-green: #064e3b;
        --pine-light: #0a6b51;
        --accent-gold: #d4af37;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --bg-soft: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg-soft);
        color: var(--text-dark);
        overflow-x: hidden;
    }

    .hero-page {
        position: relative;
        background: linear-gradient(135deg, var(--pine-green), var(--pine-light));
        padding: clamp(80px, 10vw, 120px) 20px;
        text-align: center;
        color: white;
        overflow: hidden;
    }

    .hero-page::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 60px;
        background: var(--bg-soft);
        clip-path: polygon(0 100%, 100% 100%, 100% 0);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-page h1 {
        font-size: clamp(2.2rem, 5vw, 3.5rem);
        font-weight: 800;
        letter-spacing: -1.5px;
        margin-bottom: 15px;
        line-height: 1.1;
    }

    .contact-card {
        background: white;
        border-radius: 32px;
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
    }

    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(6, 78, 59, 0.1) !important;
    }

    .icon-box {
        width: 60px;
        height: 60px;
        background: rgba(6, 78, 59, 0.05);
        color: var(--pine-green);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 25px;
        transition: 0.3s;
    }

    .contact-card:hover .icon-box {
        background: var(--pine-green);
        color: white;
        transform: rotate(-10deg);
    }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--pine-green);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 16px;
        padding: 14px 20px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus {
        background: white;
        border-color: var(--pine-light);
        box-shadow: 0 10px 20px rgba(10, 107, 81, 0.05);
        outline: none;
    }

    .btn-send {
        background: var(--pine-green);
        color: white;
        border: none;
        border-radius: 16px;
        padding: 18px 35px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: 0.4s;
        width: 100%;
    }

    .btn-send:hover {
        background: var(--pine-light);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(6, 78, 59, 0.25);
        color: white;
    }

    .map-container {
        border-radius: 32px;
        overflow: hidden;
        border: 10px solid white;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        height: 100%;
        min-height: 500px; /* Map di konten tetap besar sesuai keinginanmu */
    }

    iframe {
        filter: grayscale(0.2) contrast(1.1);
    }

    @media (max-width: 991px) {
        .map-container { min-height: 350px; margin-top: 30px; }
        .hero-page { padding: 100px 20px 140px; }
    }

    footer .map-container {
        min-height: 200px !important; /* Memaksa map di footer untuk tetap kecil */
        height: 200px !important;
        border: 2px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 15px !important;
    }
</style>

<div class="hero-page">
    <div class="hero-content" data-aos="fade-down">
        <span class="badge px-4 py-2 mb-3" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); font-weight: 700; letter-spacing: 2px;">HUBUNGI KAMI</span>
        <h1>Bantuan & Layanan <br> Pengaduan Masyarakat</h1>
        <p class="opacity-75 fs-5">Tim kami siap melayani kebutuhan data dan informasi kearsipan Anda.</p>
    </div>
</div>

<div class="container" style="margin-top: -70px; position: relative; z-index: 10;">
    <div class="row g-4">
        <div class="col-lg-5" data-aos="fade-right">
            <div class="contact-card shadow-sm p-4 p-md-5">
                <h4 class="fw-800 mb-5" style="color: var(--pine-green); letter-spacing: -1px;">Informasi Kantor</h4>
                
                <div class="d-flex gap-4 mb-4">
                    <div class="icon-box flex-shrink-0"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <h6 class="fw-800 mb-1">Alamat Utama</h6>
                        <p class="text-muted mb-0 lh-base">Jl. Mahoni No.12, Padang Jati, Kec. Ratu Samban, Kota Bengkulu, Bengkulu 38222</p>
                    </div>
                </div>

                <div class="d-flex gap-4 mb-4">
                    <div class="icon-box flex-shrink-0"><i class="bi bi-telephone-inbound-fill"></i></div>
                    <div>
                        <h6 class="fw-800 mb-1">Saluran Telepon</h6>
                        <p class="text-muted mb-0">(0736) 26095</p>
                        <p class="small text-success fw-bold mt-1"><i class="bi bi-check-circle me-1"></i> Tersedia di Jam Kerja</p>
                    </div>
                </div>

                <div class="d-flex gap-4 mb-4">
                    <div class="icon-box flex-shrink-0"><i class="bi bi-envelope-paper-heart-fill"></i></div>
                    <div>
                        <h6 class="fw-800 mb-1">Email Korespondensi</h6>
                        <p class="text-muted mb-0">perpusbengkulu@gmail.com</p>
                    </div>
                </div>

                <div class="mt-5 p-4 rounded-4" style="background: var(--bg-soft); border: 1px dashed #cbd5e1;">
                    <h6 class="fw-800 mb-3" style="color: var(--pine-green);"><i class="bi bi-clock-history me-2"></i> Jam Pelayanan</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Senin - Kamis</span>
                        <span class="fw-bold">08:00 - 16:00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Jumat</span>
                        <span class="fw-bold">08:00 - 16:30</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7" data-aos="fade-left">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.9575994247545!2d102.2711013749743!3d-3.8016489438992144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e36b0193132626d%3A0x7d6f51f964047805!2sDinas%20Perpustakaan%20dan%20Kearsipan%20Provinsi%20Bengkulu!5e0!3m2!1sid!2sid!4v1711234567890!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-5 pt-3">
        <div class="col-12" data-aos="fade-up">
            <div class="contact-card shadow-sm p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="pe-lg-4">
                            <h2 class="fw-800 mb-4" style="color: var(--pine-green); letter-spacing: -1.5px;">Tinggalkan Pesan</h2>
                            <p class="text-muted lh-lg">Jika Anda memerlukan bantuan teknis mengenai sistem peminjaman atau pertanyaan seputar koleksi arsip, silakan isi formulir di samping. Kami akan membalas melalui email dalam 1x24 jam kerja.</p>
                            
                            <div class="d-flex align-items-center gap-3 mt-4">
                                <div class="p-3 bg-light rounded-circle"><i class="bi bi-shield-lock text-success fs-4"></i></div>
                                <p class="small text-muted mb-0">Data Anda terlindungi oleh sistem enkripsi kearsipan kami.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-8">
                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-0">Berhasil Terkirim!</h6>
                                        <p class="small mb-0">Pesan Anda telah kami terima dan sedang dalam antrean tindak lanjut.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('pemohon.kontak.kirim') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Budi Santoso" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Aktif</label>
                                    <input type="email" name="email" class="form-control" placeholder="alamat@email.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subjek Pesan</label>
                                    <input type="text" name="subjek" class="form-control" placeholder="Apa yang ingin Anda tanyakan?" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Isi Pesan / Pertanyaan</label>
                                    <textarea name="pesan" class="form-control" rows="6" placeholder="Tuliskan detail pertanyaan Anda secara lengkap..." required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-send">
                                        Kirim Pesan Sekarang <i class="bi bi-paper-plane-fill ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1200,
        once: true,
        easing: 'ease-in-out-cubic'
    });
</script>

@endsection