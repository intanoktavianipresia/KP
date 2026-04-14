@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --pine-green: #064e3b; /* Hijau Utama Bengkulu */
        --pine-hover: #032f24;
        --slate-900: #0f172a;
        --slate-600: #475569;
        --slate-400: #94a3b8;
        --border-color: #e2e8f0;
    }

    body { 
        background-color: #f8fafc; 
        font-family: 'Inter', sans-serif; 
        color: var(--slate-900); 
    }

    .main-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 30px;
        letter-spacing: -1.2px;
        color: var(--slate-900);
    }

    /* Bento Grid System */
    .bento-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        align-items: stretch;
    }

    .card-detail {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 32px;
        height: 100%;
        transition: all 0.3s ease;
    }

    .card-detail:hover {
        border-color: var(--pine-green);
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }

    .span-2 { grid-column: span 2; }
    .span-3 { grid-column: span 3; }

    /* Heading Section */
    .section-label {
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 13px;
        color: var(--pine-green);
        margin-bottom: 28px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    /* Information Styling */
    .info-item { 
        margin-bottom: 24px; 
    }
    
    .info-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--slate-400);
        text-transform: uppercase;
        margin-bottom: 6px;
        display: block;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 16px;
        font-weight: 700;
        color: var(--slate-900);
        display: block;
    }

    /* Status Pill - Solid & Bold */
    .status-pill {
        padding: 8px 20px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
    }
    .waiting { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
    .approved { background: #ecfdf5; color: #047857; border: 1px solid #d1fae5; }
    .rejected { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }

    /* Arsip Highlight Box */
    .arsip-box {
        padding: 30px;
        border-radius: 20px;
        background: #f8fafc;
        border: 2px dashed var(--border-color);
        text-align: center;
        transition: 0.3s;
    }
    .arsip-box:hover {
        border-color: var(--pine-green);
        background: #f0fdf4;
    }

    /* Action Footer */
    .action-bar {
        margin-top: 40px;
        padding: 24px 32px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-custom {
        height: 52px;
        padding: 0 28px;
        border-radius: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
        border: none;
        text-decoration: none !important;
    }

    .btn-back { background: white; color: var(--slate-600); border: 1px solid var(--border-color); }
    .btn-back:hover { background: #f8fafc; color: var(--slate-900); transform: translateX(-5px); }

    .btn-approve { background: var(--pine-green); color: white !important; }
    .btn-approve:hover { background: var(--pine-hover); transform: translateY(-3px); box-shadow: 0 8px 20px rgba(6, 78, 59, 0.2); }

    .btn-reject { background: #fef2f2; color: #b91c1c !important; }
    .btn-reject:hover { background: #b91c1c; color: white !important; }

    /* Modal Styling */
    .modal-content { border-radius: 28px; border: none; padding: 10px; }
    .form-control { border-radius: 12px; padding: 12px; border: 2px solid var(--border-color); font-weight: 600; }
    .form-control:focus { border-color: var(--pine-green); box-shadow: none; }
</style>

<div class="container py-5">
    @if($data)
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('admin.kelola') }}" class="text-decoration-none text-muted fw-bold small">Permohonan</a></li>
                    <li class="breadcrumb-item active small fw-bold text-success" aria-current="page">Detail Data</li>
                </ol>
            </nav>
            <h1 class="main-title text-uppercase">{{ $data->nomor_permohonan }}</h1>
        </div>
        
        <div class="status-pill {{ $data->status == 'disetujui' ? 'approved' : ($data->status == 'ditolak' ? 'rejected' : 'waiting') }}">
            <i class="fas fa-shield-halved"></i>
            Status: {{ $data->status }}
        </div>
    </div>

    <div class="bento-container">
        <div class="card-detail span-2">
            <div class="section-label">
                <i class="fas fa-id-card-alt"></i> Identitas Lengkap Pemohon
            </div>
            <div class="row">
                <div class="col-md-6 info-item">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $data->nama_pemohon }}</span>
                </div>
                <div class="col-md-6 info-item">
                    <span class="info-label">Email Aktif</span>
                    <span class="info-value">{{ $data->email }}</span>
                </div>
                <div class="col-md-6 info-item">
                    <span class="info-label">No. WhatsApp / Telepon</span>
                    <span class="info-value text-success"><i class="fab fa-whatsapp me-1"></i> {{ $data->telepon }}</span>
                </div>
                <div class="col-md-6 info-item">
                    <span class="info-label">Jenis Kelamin</span>
                    <span class="info-value">{{ $data->jenis_kelamin }}</span>
                </div>
                <div class="col-12 info-item mb-0">
                    <span class="info-label">Alamat Lengkap Sesuai Identitas</span>
                    <span class="info-value">{{ $data->alamat }}</span>
                </div>
            </div>
        </div>

        <div class="card-detail">
            <div class="section-label">
                <i class="fas fa-calendar-check"></i> Timeline & Jadwal
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Registrasi</span>
                <span class="info-value"><i class="far fa-clock me-2 text-muted"></i>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</span>
            </div>
            <div class="info-item mb-0">
                <span class="info-label">Rencana Kunjungan</span>
                <span class="info-value">
                    <i class="far fa-calendar-alt me-2 text-muted"></i>
                    {{ $data->tanggal_kunjungan ? \Carbon\Carbon::parse($data->tanggal_kunjungan)->format('d M Y') : 'Belum Ada Jadwal' }}
                </span>
            </div>
        </div>

        <div class="card-detail span-3">
            <div class="section-label">
                <i class="fas fa-box-archive"></i> Objek & Tujuan Peminjaman
            </div>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="arsip-box">
                        <i class="fas fa-file-invoice fa-3x mb-3" style="color: var(--pine-green);"></i>
                        <h6 class="info-label">Arsip Yang Dimohon:</h6>
                        <span class="info-value text-uppercase" style="color: var(--pine-green);">{{ $data->arsip_dimohon }}</span>
                    </div>
                </div>
                <div class="col-md-8 ps-md-5">
                    <span class="info-label">Tujuan Penggunaan Arsip</span>
                    <div class="p-4 rounded-4" style="background: #f1f5f9; border-left: 5px solid var(--pine-green);">
                        <p class="fw-600 mb-0" style="line-height: 1.7; font-size: 15px; color: var(--slate-600);">
                            "{{ $data->tujuan }}"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="action-bar shadow-sm">
        @php
            $back = request('from') == 'jadwal' ? route('admin.jadwal') : route('admin.kelola');
        @endphp
        <a href="{{ $back }}" class="btn-custom btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke List
        </a>

        @if($data->status == 'menunggu')
        <div class="d-flex gap-3">
            <button class="btn-custom btn-reject" data-bs-toggle="modal" data-bs-target="#modalTolak">
                <i class="fas fa-ban"></i> Tolak Berkas
            </button>
            <button class="btn-custom btn-approve" data-bs-toggle="modal" data-bs-target="#modalSetujui">
                <i class="fas fa-check-double"></i> Verifikasi & Setujui
            </button>
        </div>
        @endif
    </div>

    @else
    <div class="text-center py-5">
        <i class="fas fa-search fa-4x mb-3 text-muted opacity-25"></i>
        <h4 class="fw-800 text-muted">Data permohonan tidak ditemukan</h4>
    </div>
    @endif
</div>

<div class="modal fade" id="modalSetujui" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-body p-5">
                <div class="text-center mb-4">
                    <div class="bg-success bg-opacity-10 p-3 d-inline-block rounded-circle mb-3">
                        <i class="fas fa-calendar-check fa-2x text-success"></i>
                    </div>
                    <h5 class="fw-800 mb-1">Setujui Permohonan</h5>
                    <p class="text-muted small">Silahkan tentukan jadwal kedatangan final.</p>
                </div>
                
                <div class="mb-3">
                    <label class="info-label">Tanggal Kunjungan</label>
                    <input type="date" id="tgl" class="form-control">
                </div>
                <div class="mb-4">
                    <label class="info-label">Waktu Operasional</label>
                    <input type="text" id="waktu" class="form-control" placeholder="Contoh: 09:00 - 11:30 WIB">
                </div>

                <div class="d-grid gap-2">
                    <button id="btnSetujui" class="btn-custom btn-approve justify-content-center">Simpan & Beri Notifikasi</button>
                    <button class="btn-custom btn-back justify-content-center" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-body p-5">
                <div class="text-center mb-4">
                    <div class="bg-danger bg-opacity-10 p-3 d-inline-block rounded-circle mb-3">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                    </div>
                    <h5 class="fw-800 mb-1 text-danger">Tolak Permohonan</h5>
                    <p class="text-muted small">Berikan alasan penolakan yang objektif.</p>
                </div>
                
                <div class="mb-4">
                    <label class="info-label">Alasan Penolakan</label>
                    <textarea id="alasan" class="form-control" rows="4" placeholder="Contoh: Berkas identitas tidak terbaca..."></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button id="btnTolak" class="btn-custom btn-reject justify-content-center">Ya, Tolak Sekarang</button>
                    <button class="btn-custom btn-back justify-content-center" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('btnSetujui').onclick = function() {
    let tgl = document.getElementById('tgl').value;
    let waktu = document.getElementById('waktu').value;
    if(!tgl) return alert('Pilih tanggal kunjungan!');
    window.location.href = "/admin/setujui/{{ $data->id ?? '' }}?tgl="+tgl+"&waktu="+waktu;
}

document.getElementById('btnTolak').onclick = function() {
    let alasan = document.getElementById('alasan').value;
    if(!alasan) return alert('Alasan wajib diisi!');
    window.location.href = "/admin/tolak/{{ $data->id ?? '' }}?alasan=" + encodeURIComponent(alasan);
}
</script>

@endsection