@extends('layouts.pemohon')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --pine-green: #064e3b;
        --pine-light: #059669;
        --soft-bg: #f8fafc;
        --accent-orange: #f59e0b;
        --accent-blue: #3b82f6;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--soft-bg);
        color: #1e293b;
    }

    /* ===== HERO PREMIUM ===== */
    .banner {
        position: relative;
        background: linear-gradient(135deg, var(--pine-green), var(--pine-light));
        padding: 100px 20px 140px;
        text-align: center;
        color: white;
        clip-path: ellipse(150% 100% at 50% 0%);
    }

    .banner h1 {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
        letter-spacing: -1.5px;
        margin-bottom: 10px;
    }

    /* ===== CARD BOXES ===== */
    .cek-box, .status-card {
        background: white;
        border-radius: 30px;
        padding: clamp(25px, 5vw, 45px);
        box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.08);
        border: 1px solid rgba(255,255,255,0.8);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .input-group-custom {
        position: relative;
        margin-top: 20px;
    }

    .input-group-custom input {
        width: 100%;
        padding: 18px 20px 18px 55px;
        border-radius: 18px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        transition: 0.3s;
        font-weight: 700;
        color: var(--pine-green);
        letter-spacing: 1px;
    }

    .input-group-custom input:focus {
        background: white;
        border-color: var(--pine-light);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.05);
        outline: none;
    }

    .input-group-custom i {
        position: absolute;
        left: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--pine-light);
        font-size: 1.4rem;
    }

    .btn-cek {
        background: var(--pine-green);
        color: white;
        border: none;
        padding: 18px;
        border-radius: 18px;
        width: 100%;
        font-weight: 800;
        margin-top: 20px;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-cek:hover {
        background: var(--pine-light);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(6, 78, 59, 0.2);
        color: white;
    }

    /* ===== STATUS BADGES ===== */
    .badge-status {
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .bg-menunggu { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
    .bg-setuju { background: #ecfdf5; color: #047857; border: 1px solid #d1fae5; }
    .bg-tolak { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
    .bg-selesai { background: #eff6ff; color: #1d4ed8; border: 1px solid #dbeafe; }

    /* ===== TIMELINE TRACKER ===== */
    .timeline {
        position: relative;
        padding-left: 30px;
        border-left: 3px solid #f1f5f9;
        margin-left: 15px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 35px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -41.5px;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: white;
        border: 4px solid #e2e8f0;
        z-index: 2;
        transition: 0.3s;
    }

    .timeline-item.active::before {
        border-color: var(--pine-light);
        background: var(--pine-light);
        box-shadow: 0 0 0 6px rgba(5, 150, 105, 0.15);
    }

    .timeline-date {
        font-size: 0.75rem;
        font-weight: 800;
        color: #94a3b8;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .timeline-content {
        font-weight: 600;
        font-size: 0.95rem;
        color: #334155;
        line-height: 1.5;
        background: #f8fafc;
        padding: 12px 18px;
        border-radius: 15px;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .banner { padding: 80px 20px 120px; }
        .cek-box, .status-card { border-radius: 24px; }
    }
</style>

<div class="banner">
    <div class="container">
        <h1 data-aos="fade-down">Lacak Permohonan</h1>
        <p class="opacity-75 fs-5">Pantau proses verifikasi dan status peminjaman arsip Anda secara real-time.</p>
    </div>
</div>

<div class="container" style="margin-top: -70px; position: relative; z-index: 100; margin-bottom: 100px;">
    <div class="row g-4 justify-content-center">
        
        <div class="col-lg-4 col-md-5" data-aos="fade-right">
            <div class="cek-box">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="p-2 rounded-3 bg-success bg-opacity-10"><i class="bi bi-search text-success fs-4"></i></div>
                    <h5 class="fw-800 mb-0">Cek Tiket</h5>
                </div>
                <p class="small text-muted">Masukkan nomor permohonan unik yang Anda dapatkan setelah melakukan registrasi peminjaman.</p>
                
                <form method="POST" action="{{ url('/pemohon/status/cek') }}">
                    @csrf
                    <div class="input-group-custom">
                        <i class="bi bi-qr-code-scan"></i>
                        <input type="text" name="nomor" placeholder="PNM-2026-XXXX" required value="{{ old('nomor') }}">
                    </div>
                    <button class="btn-cek">
                        Cari Data Permohonan <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                @if(session('warning'))
                    <div class="alert mt-4 py-3 small d-flex align-items-center gap-3" style="background: #fff1f2; color: #9f1239; border-radius: 15px; border: 1px solid #ffe4e6;">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i> 
                        <div><b>Maaf!</b> {{ session('warning') }}</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-7 col-md-7" data-aos="fade-left">
            <div class="status-card">
                @if(!empty($data))
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-3 mb-5">
                        <div>
                            <h6 class="text-muted fw-bold small text-uppercase mb-1" style="letter-spacing: 1px;">Kode Permohonan</h6>
                            <h3 class="fw-900 m-0 text-success" style="letter-spacing: -1px;">{{ $data->nomor_permohonan }}</h3>
                        </div>
                        
                        @php
                            $status_map = [
                                'menunggu' => ['class' => 'bg-menunggu', 'icon' => 'bi-clock-history', 'label' => 'Menunggu Verifikasi'],
                                'disetujui' => ['class' => 'bg-setuju', 'icon' => 'bi-check-all', 'label' => 'Permohonan Disetujui'],
                                'ditolak' => ['class' => 'bg-tolak', 'icon' => 'bi-x-lg', 'label' => 'Permohonan Ditolak'],
                                'selesai' => ['class' => 'bg-selesai', 'icon' => 'bi-archive-fill', 'label' => 'Selesai / Diarsipkan']
                            ];
                            $curr = $status_map[$data->status] ?? ['class' => 'bg-menunggu', 'icon' => 'bi-info-circle', 'label' => $data->status];
                        @endphp

                        <span class="badge-status {{ $curr['class'] }}">
                            <i class="bi {{ $curr['icon'] }}"></i> {{ $curr['label'] }}
                        </span>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 rounded-4 border">
                                <label class="small text-muted d-block mb-1">Nama Pemohon</label>
                                <span class="fw-800 fs-5">{{ $data->nama_pemohon }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded-4 border">
                                <label class="small text-muted d-block mb-1">Tanggal Kunjungan</label>
                                <span class="fw-800 fs-5 text-primary"><i class="bi bi-calendar3 me-2"></i>{{ date('d M Y', strtotime($data->tanggal_kunjungan)) }}</span>
                            </div>
                        </div>
                    </div>

                    @if(!empty($data->alasan_perubahan))
                        <div class="p-3 mb-4 d-flex gap-3" style="background:#fff7ed; border-radius:18px; border:1px solid #ffedd5;">
                            <i class="bi bi-info-circle-fill text-warning fs-4"></i>
                            <div>
                                <b class="d-block text-warning mb-1">Catatan Khusus Petugas:</b>
                                <span class="text-muted small">{{ $data->alasan_perubahan }}</span>
                            </div>
                        </div>
                    @endif

                    <hr class="my-5 opacity-25">

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="p-2 rounded-circle bg-light"><i class="bi bi-activity text-primary"></i></div>
                        <h6 class="fw-800 m-0">Riwayat & Log Aktivitas</h6>
                    </div>
                    
                    @if(!empty($riwayat) && count($riwayat) > 0)
                        <div class="timeline">
                            @foreach($riwayat as $index => $r)
                                <div class="timeline-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="timeline-date">{{ date('d F Y', strtotime($r->created_at)) }} • {{ date('H:i', strtotime($r->created_at)) }} WIB</div>
                                    <div class="timeline-content">{{ $r->catatan }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 bg-light rounded-4 border border-dashed">
                            <i class="bi bi-hourglass-top text-muted display-6"></i>
                            <p class="text-muted small mt-2 mb-0">Permohonan Anda baru saja didaftarkan.<br>Belum ada aktivitas log terbaru.</p>
                        </div>
                    @endif

                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-clipboard2-x text-light-emphasis" style="font-size: 5rem;"></i>
                        </div>
                        <h4 class="fw-800 text-muted">Belum Ada Data</h4>
                        <p class="text-muted small px-lg-5">Silakan gunakan kolom pencarian di sebelah kiri untuk melihat detail status permohonan peminjaman arsip Anda.</p>
                        <div class="mt-4">
                            <span class="badge rounded-pill bg-light text-muted p-2 px-3">Status: Siap Melayani</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });
</script>

@endsection