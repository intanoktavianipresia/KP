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
        padding: 100px 20px;
        text-align: center;
        color: white;
        clip-path: ellipse(150% 100% at 50% 0%);
    }

    .banner h1 {
        font-size: 2.8rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* ===== CARD BOXES ===== */
    .cek-box, .status-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
    }

    .input-group-custom {
        position: relative;
        margin-top: 20px;
    }

    .input-group-custom input {
        width: 100%;
        padding: 15px 20px 15px 50px;
        border-radius: 15px;
        border: 2px solid #e2e8f0;
        transition: 0.3s;
        font-weight: 600;
    }

    .input-group-custom input:focus {
        border-color: var(--pine-light);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        outline: none;
    }

    .input-group-custom i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--pine-light);
        font-size: 1.2rem;
    }

    .btn-cek {
        background: var(--pine-green);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 15px;
        width: 100%;
        font-weight: 800;
        margin-top: 15px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-cek:hover {
        background: var(--pine-light);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(6, 78, 59, 0.2);
    }

    /* ===== STATUS BADGES ===== */
    .badge-status {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .bg-menunggu { background: #fff7ed; color: #c2410c; }
    .bg-setuju { background: #ecfdf5; color: #047857; }
    .bg-tolak { background: #fef2f2; color: #b91c1c; }
    .bg-selesai { background: #eff6ff; color: #1d4ed8; }

    /* ===== TIMELINE TRACKER ===== */
    .timeline {
        position: relative;
        padding-left: 30px;
        border-left: 2px dashed #e2e8f0;
        margin-left: 10px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 30px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -39px;
        top: 0;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: white;
        border: 3px solid var(--pine-light);
    }

    .timeline-item.active::before {
        background: var(--pine-light);
        box-shadow: 0 0 0 5px rgba(5, 150, 105, 0.2);
    }

    .timeline-date {
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
    }

    .timeline-content {
        font-weight: 600;
        font-size: 0.95rem;
    }

</style>

<div class="banner">
    <div class="container">
        <h1>Lacak Permohonan</h1>
        <p>Pantau transparansi layanan peminjaman arsip Anda secara langsung</p>
    </div>
</div>

<div class="container" style="margin-top: -60px; position: relative; z-index: 100;">
    <div class="row g-4 justify-content-center">
        
        <div class="col-lg-4">
            <div class="cek-box">
                <h5 class="fw-800 mb-2">Cari Nomor Antrean</h5>
                <p class="small text-muted">Masukkan nomor permohonan yang diberikan saat pendaftaran.</p>
                
                <form method="POST" action="/pemohon/status/cek">
                    @csrf
                    <div class="input-group-custom">
                        <i class="bi bi-ticket-perforated"></i>
                        <input type="text" name="nomor" placeholder="PNM-2026-XXXX" required>
                    </div>
                    <button class="btn-cek">
                        <i class="bi bi-search"></i> Periksa Sekarang
                    </button>
                </form>

                @if(session('warning'))
                    <div class="alert mt-3 py-2 small d-flex align-items-center gap-2" style="background: #fff1f2; color: #9f1239; border-radius: 12px; border: none;">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ session('warning') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="status-card">
                @if(!empty($data))
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h6 class="text-muted fw-bold small text-uppercase mb-1">Informasi Terkini</h6>
                            <h4 class="fw-800 m-0">{{ $data->nomor_permohonan }}</h4>
                        </div>
                        
                        @php
                            $status_class = [
                                'menunggu' => 'bg-menunggu',
                                'disetujui' => 'bg-setuju',
                                'ditolak' => 'bg-tolak',
                                'selesai' => 'bg-selesai'
                            ][$data->status] ?? 'bg-menunggu';
                            
                            $status_icon = [
                                'menunggu' => 'bi-clock-history',
                                'disetujui' => 'bi-check-circle',
                                'ditolak' => 'bi-x-circle',
                                'selesai' => 'bi-flag'
                            ][$data->status] ?? 'bi-info-circle';
                        @endphp

                        <span class="badge-status {{ $status_class }}">
                            <i class="bi {{ $status_icon }}"></i> {{ ucfirst($data->status) }}
                        </span>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label class="small text-muted d-block">Nama Pemohon</label>
                            <span class="fw-bold">{{ $data->nama_pemohon }}</span>
                        </div>
                        <div class="col-6 text-end">
                            <label class="small text-muted d-block">Tanggal Pengajuan</label>
                            <span class="fw-bold">{{ date('d M Y', strtotime($data->created_at)) }}</span>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <h6 class="fw-800 mb-4"><i class="bi bi-list-stars me-2"></i> Log Perkembangan</h6>
                    
                    @if(!empty($riwayat) && count($riwayat) > 0)
                        <div class="timeline">
                            @foreach($riwayat as $index => $r)
                                <div class="timeline-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="timeline-date">{{ date('d M Y, H:i', strtotime($r->created_at)) }}</div>
                                    <div class="timeline-content">{{ $r->catatan }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 bg-light rounded-4">
                            <i class="bi bi-hourglass-split text-muted display-6"></i>
                            <p class="text-muted small mt-2">Belum ada pembaruan log untuk permohonan ini.</p>
                        </div>
                    @endif

                @else
                    <div class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/10515/10515159.png" style="width: 120px; opacity: 0.3;" class="mb-3">
                        <h5 class="fw-bold text-muted">Belum Ada Data</h5>
                        <p class="text-muted small px-lg-5">Silakan masukkan nomor permohonan Anda di kolom sebelah kiri untuk melihat status terbaru.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection