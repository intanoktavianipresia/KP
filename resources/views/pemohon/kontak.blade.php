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
        --bg-soft: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg-soft);
        color: var(--text-dark);
    }

    /* ===== HERO SECTION ===== */
    .hero-page {
        position: relative;
        background: linear-gradient(135deg, var(--pine-green), var(--pine-light));
        padding: 100px 20px;
        text-align: center;
        color: white;
        overflow: hidden;
    }

    .hero-page::after {
        content: "";
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 50px;
        background: var(--bg-soft);
        clip-path: polygon(0 100%, 100% 100%, 100% 0);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        data-aos: "zoom-in";
    }

    .hero-page h1 {
        font-size: 3rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 10px;
    }

    /* ===== CONTACT CARDS ===== */
    .contact-card {
        background: white;
        border-radius: 24px;
        border: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        overflow: hidden;
    }

    .contact-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        background: rgba(6, 78, 59, 0.1);
        color: var(--pine-green);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    /* ===== FORM STYLING ===== */
    .form-label {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--pine-green);
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 18px;
        border: 2px solid #eef2f6;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: var(--pine-light);
        box-shadow: 0 0 0 4px rgba(10, 107, 81, 0.1);
    }

    .btn-send {
        background: var(--pine-green);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .btn-send:hover {
        background: var(--pine-light);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(6, 78, 59, 0.2);
    }

    /* ===== MAP OVERLAY ===== */
    .map-container {
        border-radius: 24px;
        overflow: hidden;
        border: 8px solid white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

</style>

<div class="hero-page">
    <div class="hero-content" data-aos="fade-up">
        <span class="badge px-3 py-2 mb-3" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3);">BANTUAN & DUKUNGAN</span>
        <h1>Hubungi Kami</h1>
        <p class="opacity-75">Kami siap membantu kebutuhan informasi kearsipan Anda</p>
    </div>
</div>

<div class="container" style="margin-top: -50px; position: relative; z-index: 10;">
    <div class="row g-4">
        <div class="col-lg-5" data-aos="fade-right">
            <div class="contact-card shadow-sm p-4 p-md-5">
                <h4 class="fw-800 mb-4" style="color: var(--pine-green);">Detail Kontak</h4>
                
                <div class="d-flex gap-3 mb-4">
                    <div class="icon-box flex-shrink-0"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat Kantor</h6>
                        <p class="text-muted small mb-0">Jl. Mahoni No.12, Padang Jati, Kota Bengkulu</p>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-4">
                    <div class="icon-box flex-shrink-0"><i class="bi bi-telephone"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon Resmi</h6>
                        <p class="text-muted small mb-0">(0736) 26095</p>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-4">
                    <div class="icon-box flex-shrink-0"><i class="bi bi-envelope-at"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Email Layanan</h6>
                        <p class="text-muted small mb-0">perpusbengkulu@gmail.com</p>
                    </div>
                </div>

                <hr class="my-4 opacity-50">

                <h6 class="fw-800 mb-3" style="color: var(--pine-green);">Jam Operasional</h6>
                <div class="d-flex justify-content-between small mb-2">
                    <span>Senin - Kamis</span>
                    <span class="fw-bold">08:00 - 16:00 WIB</span>
                </div>
                <div class="d-flex justify-content-between small">
                    <span>Jumat</span>
                    <span class="fw-bold">08:00 - 16:30 WIB</span>
                </div>
            </div>
        </div>

        <div class="col-lg-7" data-aos="fade-left">
            <div class="map-container h-100">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.012586071424!2d102.26922247502283!3d-3.796537796177531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e36b01f3706e23d%3A0x673c683832d7335e!2sDinas%20Perpustakaan%20dan%20Kearsipan%20Provinsi%20Bengkulu!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0; min-height:450px;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-12" data-aos="fade-up">
            <div class="contact-card shadow-sm p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h3 class="fw-800" style="color: var(--pine-green);">Kirim Pesan Langsung</h3>
                        <p class="text-muted">Punya pertanyaan khusus mengenai kearsipan? Tim kami akan merespons melalui email Anda.</p>
                        <div class="mt-4 d-none d-md-block">
                            <i class="bi bi-chat-dots-fill" style="font-size: 5rem; color: rgba(6, 78, 59, 0.05);"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
                                <i class="bi bi-check-circle-fill me-2"></i> Pesan Anda telah berhasil terkirim ke sistem kami.
                            </div>
                        @endif

                        <form action="{{ route('pemohon.kontak.kirim') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subjek / Keperluan</label>
                                    <input type="text" name="subjek" class="form-control" placeholder="Contoh: Menanyakan status arsip">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Isi Pesan</label>
                                    <textarea name="pesan" class="form-control" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-send px-5">
                                        Kirim Sekarang <i class="bi bi-send-fill ms-2"></i>
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
        duration: 1000,
        once: true,
    });
</script>

@endsection