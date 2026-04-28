@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --pine-green: #064e3b;
        --pine-hover: #032f24;
        --slate-900: #0f172a;
        --slate-600: #475569;
        --slate-400: #94a3b8;
        --border-color: #e2e8f0;
    }

    .dashboard-container {
        font-family: 'Inter', sans-serif;
        color: var(--slate-900);
        max-width: 1600px;
        margin: 0 auto;
        padding: clamp(10px, 3vw, 30px);
    }

    .main-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: clamp(18px, 4vw, 30px); /* Mengecil di mobile, membesar di desktop */
        letter-spacing: -0.04em;
        color: var(--slate-900);
        margin: 0;
        line-height: 1.2;
    }

    .bento-container {
        display: grid;
        grid-template-columns: 1fr; /* Default mobile 1 kolom */
        gap: clamp(12px, 2.5vw, 24px);
        align-items: stretch;
    }

    @media (min-width: 768px) {
        .bento-container {
            grid-template-columns: repeat(2, 1fr);
        }
        .span-2 { grid-column: span 2; }
    }

    @media (min-width: 1200px) {
        .bento-container {
            grid-template-columns: repeat(3, 1fr);
        }
        .span-3 { grid-column: span 3; }
    }

    .card-detail {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: clamp(16px, 3vw, 28px);
        padding: clamp(18px, 3vw, 32px);
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .card-detail:hover {
        border-color: var(--pine-green);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }

    .section-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: clamp(10px, 1.2vw, 12px);
        color: var(--pine-green);
        margin-bottom: clamp(16px, 3vw, 24px);
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .info-item { margin-bottom: clamp(12px, 2vw, 20px); }
    .info-label {
        font-size: clamp(9px, 1vw, 10px);
        font-weight: 700;
        color: var(--slate-400);
        text-transform: uppercase;
        margin-bottom: 4px;
        display: block;
    }
    .info-value { 
        font-size: clamp(13px, 1.8vw, 15px); 
        font-weight: 700; 
        color: var(--slate-900); 
        word-break: break-word; 
    }

    .status-pill {
        padding: clamp(6px, 1vw, 8px) clamp(12px, 2vw, 16px);
        border-radius: 10px;
        font-weight: 800;
        font-size: clamp(9px, 1.2vw, 11px);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        white-space: nowrap;
    }
    .waiting { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
    .approved { background: #ecfdf5; color: #047857; border: 1px solid #d1fae5; }
    .rejected { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }

    .arsip-box {
        padding: clamp(15px, 3vw, 25px);
        border-radius: 20px;
        background: #f8fafc;
        border: 2px dashed var(--border-color);
        text-align: center;
        margin-bottom: 15px;
    }
    @media (min-width: 992px) { .arsip-box { margin-bottom: 0; } }

    .action-bar {
        margin-top: 30px;
        padding: clamp(15px, 3vw, 24px);
        background: white;
        border: 1px solid var(--border-color);
        border-radius: clamp(16px, 3vw, 28px);
        display: flex;
        flex-direction: column;
        gap: clamp(10px, 2vw, 15px);
    }

    @media (min-width: 768px) {
        .action-bar { flex-direction: row; justify-content: space-between; align-items: center; }
    }

    .btn-custom {
        height: clamp(48px, 6vw, 52px);
        padding: 0 clamp(16px, 3vw, 24px);
        border-radius: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: clamp(12px, 1.5vw, 14px);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: 0.3s;
        border: none;
        text-decoration: none !important;
        width: 100%; /* Full width di mobile */
    }

    @media (min-width: 768px) { .btn-custom { width: auto; } }

    .btn-back { background: #f1f5f9; color: var(--slate-600); }
    .btn-approve { background: var(--pine-green); color: white !important; }
    .btn-reject { background: #fef2f2; color: #b91c1c !important; }

    /* Modal Scaling */
    .modal-content { border-radius: clamp(18px, 3vw, 24px); border: none; overflow: hidden; }
    .form-control { border-radius: 12px; padding: clamp(10px, 2vw, 14px); border: 2px solid #e2e8f0; font-weight: 600; font-size: 14px; }
</style>

<div class="container-fluid dashboard-container">
    @if($data)
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('admin.kelola') }}" class="text-decoration-none text-muted fw-bold small">Permohonan</a></li>
                    <li class="breadcrumb-item active small fw-bold text-success" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h1 class="main-title text-uppercase">{{ $data->nomor_permohonan }}</h1>
        </div>
        
        <div class="status-pill {{ $data->status == 'disetujui' ? 'approved' : ($data->status == 'ditolak' ? 'rejected' : 'waiting') }}">
            <i class="fas {{ $data->status == 'disetujui' ? 'fa-check-circle' : ($data->status == 'ditolak' ? 'fa-times-circle' : 'fa-clock') }}"></i>
            <span>Status: {{ strtoupper($data->status) }}</span>
        </div>
    </div>

    <div class="bento-container">
        <div class="card-detail span-2">
            <div class="section-label">
                <i class="fas fa-id-card"></i> Identitas Pemohon
            </div>
            <div class="row g-3">
                <div class="col-6 col-sm-6 info-item">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $data->nama_pemohon }}</span>
                </div>
                <div class="col-6 col-sm-6 info-item">
                    <span class="info-label">Email Aktif</span>
                    <span class="info-value">{{ $data->email }}</span>
                </div>
                <div class="col-6 col-sm-6 info-item">
                    <span class="info-label">WhatsApp</span>
                    <span class="info-value text-success"><i class="fab fa-whatsapp me-1"></i> {{ $data->telepon }}</span>
                </div>
                <div class="col-6 col-sm-6 info-item">
                    <span class="info-label">Jenis Kelamin</span>
                    <span class="info-value">{{ $data->jenis_kelamin }}</span>
                </div>
                <div class="col-12 info-item mb-0">
                    <span class="info-label">Alamat Lengkap</span>
                    <span class="info-value">{{ $data->alamat }}</span>
                </div>
            </div>
        </div>

        <div class="card-detail">
            <div class="section-label">
                <i class="fas fa-clock"></i> Timeline
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Registrasi</span>
                <span class="info-value"><i class="far fa-calendar me-2 text-muted"></i>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</span>
            </div>
            <div class="info-item mb-0">
                <span class="info-label">Rencana Kunjungan</span>
                <span class="info-value">
                    <i class="far fa-calendar-check me-2 text-success"></i>
                    {{ $data->tanggal_kunjungan ? \Carbon\Carbon::parse($data->tanggal_kunjungan)->format('d M Y') : 'Menunggu Verifikasi' }}
                </span>
            </div>
        </div>

        <div class="card-detail span-3">
            <div class="section-label">
                <i class="fas fa-folder-open"></i> Detail Permohonan Arsip
            </div>
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-4 text-center">
                    <div class="arsip-box">
                        <i class="fas fa-file-pdf fa-3x mb-3 text-success"></i>
                        <h6 class="info-label">Arsip Dimohon:</h6>
                        <span class="info-value text-uppercase">{{ $data->arsip_dimohon }}</span>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <span class="info-label">Tujuan Penggunaan Arsip</span>
                    <div class="p-3 p-md-4 rounded-4" style="background: #f1f5f9; border-left: 5px solid var(--pine-green);">
                        <p class="fw-bold mb-0" style="line-height: 1.7; font-size: clamp(13px, 1.5vw, 15px); color: var(--slate-600);">
                            "{{ $data->tujuan }}"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="action-bar shadow-sm">
        @php
            $backLink = request('from') == 'jadwal' ? route('admin.jadwal') : route('admin.kelola');
        @endphp
        <a href="{{ $backLink }}" class="btn-custom btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        @if($data->status == 'menunggu')
        <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto">
            <button class="btn-custom btn-reject" data-bs-toggle="modal" data-bs-target="#modalTolak">
                <i class="fas fa-times"></i> Tolak Berkas
            </button>
            <button class="btn-custom btn-approve" data-bs-toggle="modal" data-bs-target="#modalSetujui">
                <i class="fas fa-check"></i> Setujui & Beri Jadwal
            </button>
        </div>
        @endif

        @if($data->status == 'disetujui')
        <button class="btn-custom btn-approve" data-bs-toggle="modal" data-bs-target="#modalEdit">
            <i class="fas fa-edit"></i> Edit Jadwal Kunjungan
        </button>
        @endif
    </div>

    @else
    <div class="text-center py-5">
        <i class="fas fa-search fa-4x mb-3 text-muted opacity-25"></i>
        <h4 class="fw-bold text-muted">Data tidak ditemukan</h4>
    </div>
    @endif
</div>

<div class="modal fade" id="modalSetujui" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body text-center">
                <h5 class="fw-800 mb-3">Setujui Permohonan</h5>
                <div class="mb-3 text-start">
                    <label class="info-label">Pilih Tanggal</label>
                    <input type="date" id="tgl" class="form-control">
                </div>
                <div class="mb-4 text-start">
                    <label class="info-label">Waktu (Jam)</label>
                    <input type="text" id="waktu" class="form-control" placeholder="Contoh: 09:00 WIB">
                </div>
                <button id="btnSetujui" class="btn-custom btn-approve w-100">Konfirmasi & Kirim Email</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <h5 class="fw-800 mb-3 text-center">Tolak Permohonan</h5>
                <div class="mb-4">
                    <label class="info-label">Alasan Penolakan</label>
                    <textarea id="alasan" class="form-control" rows="4" placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
                <button id="btnTolak" class="btn-custom btn-reject w-100">Tolak Sekarang</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <h5 class="fw-800 mb-3 text-center">Update Jadwal</h5>
                <div class="mb-3">
                    <label class="info-label">Tanggal Baru</label>
                    <input type="date" id="edit_tgl" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="info-label">Waktu Baru</label>
                    <input type="text" id="edit_waktu" class="form-control" placeholder="Contoh: 10:00 WIB">
                </div>
                <div class="mb-4">
                    <label class="info-label">Alasan Perubahan</label>
                    <textarea id="edit_alasan" class="form-control" rows="3" placeholder="Alasan jadwal diubah..."></textarea>
                </div>
                <button id="btnEdit" class="btn-custom btn-approve w-100">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnSetujui').onclick = function() {
        let tgl = document.getElementById('tgl').value;
        let waktu = document.getElementById('waktu').value;
        if(!tgl) return alert('Tanggal harus dipilih!');
        window.location.href = "/admin/setujui/{{ $data->id ?? '' }}?tgl="+tgl+"&waktu="+waktu;
    };

    document.getElementById('btnTolak').onclick = function() {
        let alasan = document.getElementById('alasan').value;
        if(!alasan) return alert('Alasan wajib diisi!');
        window.location.href = "/admin/tolak/{{ $data->id ?? '' }}?alasan=" + encodeURIComponent(alasan);
    };

    document.getElementById('btnEdit').onclick = function() {
        let tgl = document.getElementById('edit_tgl').value;
        let waktu = document.getElementById('edit_waktu').value;
        let alasan = document.getElementById('edit_alasan').value;
        if(!tgl || !alasan) return alert('Tanggal dan Alasan wajib diisi!');
        window.location.href = "/admin/update-jadwal/{{ $data->id ?? '' }}?tgl="+tgl+"&waktu="+waktu+"&alasan="+encodeURIComponent(alasan);
    };
</script>

@endsection