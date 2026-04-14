@extends('layouts.pemohon')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --pine-green: #064e3b;
        --pine-light: #059669;
        --accent-gold: #d4af37;
        --soft-bg: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--soft-bg);
    }

    /* ===== HERO MODERN ===== */
    .hero-peminjaman {
        position: relative;
        background: linear-gradient(135deg, var(--pine-green), var(--pine-light));
        padding: 100px 20px;
        text-align: center;
        color: white;
        clip-path: ellipse(150% 100% at 50% 0%);
    }

    .hero-peminjaman h2 {
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: -1px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* ===== STEPPER INDICATOR ===== */
    .stepper-wrapper {
        display: flex;
        justify-content: space-between;
        max-width: 400px;
        margin: -40px auto 40px;
        position: relative;
        z-index: 10;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: white;
        border: 4px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #94a3b8;
        transition: 0.4s;
        box-shadow: 0 10px 15px rgba(0,0,0,0.05);
    }

    .step-item.active .step-circle {
        border-color: var(--accent-gold);
        color: var(--pine-green);
        transform: scale(1.1);
    }

    .step-item.completed .step-circle {
        background: var(--accent-gold);
        border-color: var(--accent-gold);
        color: white;
    }

    .step-label {
        margin-top: 10px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
    }

    /* ===== FORM BOX ===== */
    .form-container {
        max-width: 800px;
        margin: 0 auto 100px;
    }

    .form-box {
        background: white;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.02);
    }

    .form-label {
        font-weight: 700;
        color: var(--pine-green);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 20px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        transition: 0.3s;
    }

    .form-control:focus {
        background: white;
        border-color: var(--pine-light);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    /* ===== BUTTONS ===== */
    .btn-action {
        padding: 14px 40px;
        border-radius: 50px;
        font-weight: 800;
        transition: 0.3s;
        border: none;
    }

    .btn-next {
        background: var(--pine-green);
        color: white;
        box-shadow: 0 10px 20px rgba(6, 78, 59, 0.2);
    }

    .btn-next:hover {
        background: var(--pine-light);
        transform: translateY(-3px);
    }

    .btn-back {
        background: #f1f5f9;
        color: #64748b;
    }

    /* ===== SUCCESS ALERT ===== */
    .alert-premium {
        background: white;
        border-radius: 20px;
        border-left: 8px solid #10b981;
        padding: 30px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }

    .ticket-number {
        font-family: 'Courier New', Courier, monospace;
        background: #f1f5f9;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 1.5rem;
        font-weight: 900;
        color: #064e3b;
        display: inline-block;
        margin: 15px 0;
        border: 2px dashed #cbd5e1;
    }

    /* Animations */
    .slide-in {
        animation: slideIn 0.5s ease forwards;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>

<div class="hero-peminjaman">
    <div class="container">
        <h2>Peminjaman Arsip</h2>
        <p>Lengkapi formulir di bawah untuk mengajukan peminjaman arsip fisik.</p>
    </div>
</div>

<div class="container">
    @if(session('nomor_permohonan'))
    <div class="form-container mt-4 slide-in">
        <div class="alert-premium">
            <div class="d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 2.5rem;"></i>
                <div>
                    <h4 class="fw-800 mb-0">Permohonan Terkirim!</h4>
                    <p class="text-muted mb-0">Silakan catat kode di bawah untuk memantau status.</p>
                </div>
            </div>
            <div class="text-center">
                <div class="ticket-number">{{ session('nomor_permohonan') }}</div>
                <p class="text-danger small fw-bold"><i class="bi bi-exclamation-triangle-fill"></i> Penting: Kode ini hanya muncul satu kali.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="stepper-wrapper">
        <div class="step-item active" id="s1">
            <div class="step-circle">1</div>
            <span class="step-label">Data Diri</span>
        </div>
        <div class="step-item" id="s2">
            <div class="step-circle">2</div>
            <span class="step-label">Arsip</span>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ url('/pemohon/peminjaman/simpan') }}" method="POST">
            @csrf
            <div class="form-box">
                
                <div id="slide1" class="slide-in">
                    <h4 class="fw-800 mb-4" style="color: var(--pine-green)">Informasi Pemohon</h4>
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-person"></i> Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Sesuai KTP" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-geo-alt"></i> Alamat Domisili</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-gender-ambiguous"></i> Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">Pilih...</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-whatsapp"></i> WhatsApp</label>
                            <input type="text" name="telepon" class="form-control" placeholder="0812..." required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-envelope"></i> Email Aktif</label>
                            <input type="email" name="email" class="form-control" placeholder="email@anda.com" required>
                        </div>
                    </div>

                    <div class="text-end mt-5">
                        <button type="button" onclick="nextSlide()" class="btn-action btn-next">
                            Lanjut ke Data Arsip <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <div id="slide2" style="display:none">
                    <h4 class="fw-800 mb-4" style="color: var(--pine-green)">Detail Peminjaman</h4>
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-archive"></i> Judul/Nama Arsip</label>
                            <input type="text" name="arsip" class="form-control" placeholder="Contoh: Arsip Surat Tanah 1990" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-question-circle"></i> Tujuan Peminjaman</label>
                            <textarea name="tujuan" class="form-control" placeholder="Jelaskan alasan peminjaman untuk memudahkan verifikasi" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="p-4 rounded-4" style="background: #fffbeb; border: 1px solid #fef3c7;">
                                <label class="form-label mb-1"><i class="bi bi-calendar-event text-warning"></i> Rencana Kedatangan</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control mt-2" min="{{ date('Y-m-d') }}" required>
                                <p class="small text-muted mt-2 mb-0">
                                    <i class="bi bi-info-circle"></i> Tanggal ini akan divalidasi oleh petugas sesuai dengan kuota layanan di depo arsip.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <button type="button" onclick="prevSlide()" class="btn-action btn-back">
                            <i class="bi bi-arrow-left me-2"></i> Kembali
                        </button>
                        <button type="submit" class="btn-action btn-next">
                            Kirim Permohonan <i class="bi bi-send-check ms-2"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    function nextSlide(){
        document.getElementById("slide1").style.display="none";
        document.getElementById("slide2").style.display="block";
        document.getElementById("slide2").classList.add("slide-in");

        document.getElementById("s1").classList.add("completed");
        document.getElementById("s2").classList.add("active");
    }

    function prevSlide(){
        document.getElementById("slide1").style.display="block";
        document.getElementById("slide2").style.display="none";

        document.getElementById("s1").classList.remove("completed");
        document.getElementById("s2").classList.remove("active");
    }
</script>

@endsection