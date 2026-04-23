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
        overflow-x: hidden;
    }

    /* ===== HERO MODERN ===== */
    .hero-peminjaman {
        position: relative;
        background: linear-gradient(135deg, var(--pine-green), var(--pine-light));
        padding: 120px 20px 140px;
        text-align: center;
        color: white;
        clip-path: ellipse(150% 100% at 50% 0%);
    }

    .hero-peminjaman h2 {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
        letter-spacing: -1.5px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* ===== STEPPER INDICATOR ===== */
    .stepper-wrapper {
        display: flex;
        justify-content: space-between;
        max-width: 500px;
        margin: -50px auto 50px;
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

    /* Garis antar step */
    .step-item:not(:last-child)::after {
        content: "";
        position: absolute;
        top: 25px;
        left: 50%;
        width: 100%;
        height: 3px;
        background: #e2e8f0;
        z-index: -1;
    }

    .step-circle {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: white;
        border: 4px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #94a3b8;
        transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }

    .step-item.active .step-circle {
        border-color: var(--accent-gold);
        color: var(--pine-green);
        transform: scale(1.15);
        box-shadow: 0 15px 30px rgba(212, 175, 55, 0.2);
    }

    .step-item.completed .step-circle {
        background: var(--accent-gold);
        border-color: var(--accent-gold);
        color: white;
    }

    .step-label {
        margin-top: 15px;
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
    }

    .step-item.active .step-label { color: var(--pine-green); }

    /* ===== FORM BOX ===== */
    .form-container {
        max-width: 850px;
        margin: 0 auto 100px;
    }

    .form-box {
        background: white;
        border-radius: 35px;
        padding: clamp(30px, 5vw, 55px);
        box-shadow: 0 30px 60px -12px rgba(6, 78, 59, 0.12);
        border: 1px solid rgba(255,255,255,0.8);
    }

    .form-label {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--pine-green);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-control {
        border-radius: 16px;
        padding: 14px 22px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: white;
        border-color: var(--pine-light);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.08);
        outline: none;
    }

    /* ===== TICKET / SUCCESS ALERT ===== */
    .alert-premium {
        background: white;
        border-radius: 30px;
        border-left: 10px solid #10b981;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        position: relative;
        overflow: hidden;
    }

    .ticket-number {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f0fdf4;
        padding: 15px 35px;
        border-radius: 20px;
        font-size: 2rem;
        font-weight: 900;
        color: #064e3b;
        display: inline-block;
        margin: 20px 0;
        border: 3px dashed #bbf7d0;
        letter-spacing: 2px;
    }

    .btn-action {
        padding: 16px 45px;
        border-radius: 50px;
        font-weight: 800;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-next {
        background: var(--pine-green);
        color: white;
        box-shadow: 0 15px 30px rgba(6, 78, 59, 0.25);
    }

    .btn-next:hover {
        background: var(--pine-light);
        transform: translateY(-5px);
        color: white;
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.3);
    }

    .btn-back {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-back:hover {
        background: #e2e8f0;
        transform: translateX(-5px);
    }

    .slide-in {
        animation: slideIn 0.5s ease-out forwards;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="hero-peminjaman">
    <div class="container" data-aos="fade-down">
        <h2>Peminjaman Arsip</h2>
        <p class="opacity-75">Satu akun permohonan untuk satu nomor tiket akses kearsipan.</p>
    </div>
</div>

<div class="container">
    @if(session('nomor_permohonan'))
    <div class="form-container mt-n5 slide-in" style="margin-top: -60px;">
        <div class="alert-premium text-center">
            <div class="mb-4">
                <i class="bi bi-patch-check-fill text-success" style="font-size: 4rem;"></i>
            </div>
            <h3 class="fw-800">Permohonan Berhasil Dikirim!</h3>
            <p class="text-muted px-md-5">Petugas kami akan segera memproses verifikasi berkas Anda. Gunakan kode unik di bawah ini untuk melacak status kunjungan melalui fitur "Cek Status".</p>
            
            <div class="ticket-number">{{ session('nomor_permohonan') }}</div>
            
            <div class="alert alert-warning border-0 mt-3 mx-auto" style="max-width: 500px; border-radius: 15px;">
                <p class="small mb-0 fw-bold"><i class="bi bi-camera me-2"></i> Silakan screenshot atau catat kode ini sekarang.</p>
            </div>
            <div class="mt-4">
                <a href="{{ url('/pemohon/beranda') }}" class="btn btn-outline-success px-4 py-2 rounded-pill fw-bold">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
    @else

    <div class="stepper-wrapper">
        <div class="step-item active" id="s1">
            <div class="step-circle">1</div>
            <span class="step-label">Identitas</span>
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
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="p-2 rounded-3 bg-success bg-opacity-10"><i class="bi bi-person-badge text-success fs-4"></i></div>
                        <h4 class="fw-800 mb-0" style="color: var(--pine-green)">Informasi Pemohon</h4>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label">Nama Lengkap Sesuai KTP</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Ahmad Subardjo" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat Lengkap Saat Ini</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Jl. Raya No. 123, Bengkulu" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor WhatsApp Aktif</label>
                            <input type="text" name="telepon" class="form-control" placeholder="08XXXXXXXXXX" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" placeholder="anda@email.com" required>
                        </div>
                    </div>

                    <div class="text-end mt-5 pt-3">
                        <button type="button" onclick="nextSlide()" class="btn-action btn-next">
                            Berikutnya: Data Arsip <i class="bi bi-chevron-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <div id="slide2" style="display:none">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="p-2 rounded-3 bg-warning bg-opacity-10"><i class="bi bi-journal-bookmark-fill text-warning fs-4"></i></div>
                        <h4 class="fw-800 mb-0" style="color: var(--pine-green)">Rincian Permohonan</h4>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label">Judul / Deskripsi Arsip</label>
                            <input type="text" name="arsip" class="form-control" placeholder="Contoh: Arsip Surat Perjanjian 1985" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Tujuan Peminjaman</label>
                            <textarea name="tujuan" class="form-control" rows="4" placeholder="Sebutkan alasan (Contoh: Referensi Skripsi / Keperluan Hukum)" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="p-4 rounded-4" style="background: #fffbeb; border: 2px dashed #fcd34d;">
                                <label class="form-label mb-2"><i class="bi bi-calendar-check me-2"></i> Estimasi Jadwal Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control" min="{{ date('Y-m-d') }}" required>
                                <div class="mt-3 d-flex gap-2">
                                    <i class="bi bi-info-circle-fill text-warning"></i>
                                    <p class="small text-muted mb-0">Petugas akan mencocokkan jadwal ini dengan ketersediaan ruang baca. Konfirmasi akan dikirim via Email/WA.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5 pt-3">
                        <button type="button" onclick="prevSlide()" class="btn-action btn-back">
                            <i class="bi bi-chevron-left me-2"></i> Kembali
                        </button>
                        <button type="submit" class="btn-action btn-next">
                            Proses Pengajuan <i class="bi bi-send-fill ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>

<script>
    function nextSlide(){
        const inputs = document.querySelectorAll('#slide1 [required]');
        let valid = true;
        
        inputs.forEach(input => {
            if(!input.value) {
                valid = false;
                input.style.borderColor = "#f87171";
            } else {
                input.style.borderColor = "#f1f5f9";
            }
        });
        
        if(!valid) {
            alert('Mohon lengkapi seluruh kolom identitas.');
            return;
        }

        document.getElementById("slide1").style.display="none";
        document.getElementById("slide2").style.display="block";
        document.getElementById("slide2").classList.add("slide-in");

        document.getElementById("s1").classList.add("completed");
        document.getElementById("s1").classList.remove("active");
        document.getElementById("s2").classList.add("active");
        window.scrollTo({ top: 250, behavior: 'smooth' });
    }

    function prevSlide(){
        document.getElementById("slide1").style.display="block";
        document.getElementById("slide2").style.display="none";

        document.getElementById("s1").classList.remove("completed");
        document.getElementById("s1").classList.add("active");
        document.getElementById("s2").classList.remove("active");
        window.scrollTo({ top: 250, behavior: 'smooth' });
    }
</script>

@endsection