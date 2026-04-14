@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --pine-green: #064e3b;
        --pine-hover: #032f24;
        --slate-900: #0f172a;
        --slate-600: #475569;
        --slate-200: #e2e8f0;
        --pdf-red: #dc2626;
        --excel-green: #15803d;
        --modern-blue: #3b82f6; /* Warna biru untuk Selesai */
    }

    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; color: var(--slate-900); }

    .page-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 28px; letter-spacing: -1px; }

    /* Bento Card Style */
    .bento-card {
        background: white;
        border: 1px solid var(--slate-200);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    /* Modern Print Buttons */
    .export-container {
        display: flex;
        gap: 12px;
        background: white;
        padding: 10px 15px;
        border-radius: 16px;
        border: 1px solid var(--slate-200);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .btn-export {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 700;
        font-size: 13px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease;
        text-decoration: none !important;
        border: 1.5px solid transparent;
    }

    .btn-pdf-modern {
        background-color: #fef2f2;
        color: var(--pdf-red);
        border-color: #fee2e2;
    }
    .btn-pdf-modern:hover {
        background-color: var(--pdf-red);
        color: white;
        transform: translateY(-2px);
    }

    .btn-excel-modern {
        background-color: #f0fdf4;
        color: var(--excel-green);
        border-color: #dcfce7;
    }
    .btn-excel-modern:hover {
        background-color: var(--excel-green);
        color: white;
        transform: translateY(-2px);
    }

    /* Table & Filter Styles */
    .filter-section { background: white; border-radius: 20px; padding: 25px; border: 1px solid var(--slate-200); }
    .table-responsive { border-radius: 16px; overflow: hidden; border: 1px solid var(--slate-200); }
    .table thead th {
        background: var(--pine-green);
        color: white;
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        padding: 18px 20px;
        border: none;
    }

    /* Custom Badge Colors */
    .badge-premium {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
    }
    
    .bg-selesai { background-color: var(--modern-blue) !important; color: white !important; }
    .bg-disetujui { background-color: #10b981 !important; color: white !important; }

    .btn-premium {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-pine { background: var(--pine-green); color: white; border: none; }
    .btn-pine:hover { background: var(--pine-hover); color: white; transform: translateY(-2px); }

</style>

<div class="container py-4">

    {{-- HEADER SECTION --}}
    <div class="row align-items-center mb-4">
        <div class="col-lg-7">
            <h1 class="page-title mb-1">Pusat Laporan & Pesan</h1>
            <p class="text-muted fw-500 mb-0">Manajemen data arsip dan komunikasi pengguna secara terpadu.</p>
        </div>
        <div class="col-lg-5 mt-3 mt-lg-0">
            <div class="d-flex justify-content-lg-end">
                <div class="export-container">
                    <span class="my-auto small fw-bold text-muted me-2 border-end pe-3">CETAK</span>
                    <a href="{{ route('admin.laporan.pdf', request()->all()) }}" class="btn-export btn-pdf-modern">
                        <i class="fa-solid fa-file-pdf fs-5"></i> PDF
                    </a>
                    <a href="{{ route('admin.laporan.excel', request()->all()) }}" class="btn-export btn-excel-modern">
                        <i class="fa-solid fa-file-excel fs-5"></i> EXCEL
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER SECTION --}}
    <div class="filter-section mb-5 shadow-sm">
        <form method="GET" action="{{ route('admin.laporan') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-700 text-muted small text-uppercase">Dari Tanggal</label>
                <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-700 text-muted small text-uppercase">Sampai Tanggal</label>
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-700 text-muted small text-uppercase">Status</label>
                <select name="status" class="form-select" style="border-radius: 12px; padding: 12px;">
                    <option value="semua">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn-premium btn-pine w-100 justify-content-center">
                    <i class="fa-solid fa-magnifying-glass"></i> Filter Laporan
                </button>
                <a href="{{ route('admin.laporan') }}" class="btn btn-light d-flex align-items-center justify-content-center" style="border-radius:12px; width: 48px; height: 48px; border:1px solid #e2e8f0;">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </form>
    </div>

    {{-- LOG PERMOHONAN TABLE --}}
    <div class="bento-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-800 mb-0"><i class="fa-solid fa-list-check text-success me-2"></i> Log Aktivitas Permohonan</h4>
            <span class="badge bg-light text-dark border p-2 px-3 fw-bold" style="border-radius:10px;">{{ count($data) }} Total Data</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Pemohon</th>
                        <th>Arsip Dimohon</th>
                        <th class="text-center">Status Berkas</th>
                        <th class="text-center">Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $d)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $key+1 }}</td>
                        <td class="fw-700 text-dark">{{ $d->nama_pemohon }}</td>
                        <td class="text-muted"><span class="small bg-light p-1 px-2 rounded">{{ $d->arsip_dimohon }}</span></td>
                        <td class="text-center">
                            @php
                                $statusLower = strtolower($d->status);
                                if ($statusLower == 'selesai') {
                                    $bgClass = 'bg-selesai text-white';
                                } elseif ($statusLower == 'disetujui') {
                                    $bgClass = 'bg-disetujui text-white';
                                } elseif ($statusLower == 'menunggu') {
                                    $bgClass = 'bg-warning text-dark';
                                } else {
                                    $bgClass = 'bg-danger text-white';
                                }
                            @endphp
                            
                            <span class="badge-premium {{ $bgClass }} text-uppercase">
                                {{ $d->status }}
                            </span>
                        </td>
                        <td class="text-center text-muted small fw-600">{{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- KOTAK MASUK TABLE --}}
    <div class="bento-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-800 mb-0"><i class="fa-solid fa-paper-plane text-primary me-2"></i> Feedback & Pesan Masuk</h4>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead style="background: var(--slate-900) !important;">
                    <tr>
                        <th class="text-center" width="70">No</th>
                        <th>Informasi Kontak</th>
                        <th>Pesan Pengguna</th>
                        <th class="text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kontak as $k => $c)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $k+1 }}</td>
                        <td>
                            <div class="fw-800">{{ $c->nama }}</div>
                            <div class="small text-muted">{{ $c->email }}</div>
                        </td>
                        <td class="text-slate-600 italic small" style="max-width: 400px;">"{{ Str::limit($c->pesan, 150) }}"</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                @if(!$c->balasan)
                                    <button class="btn btn-sm btn-dark fw-bold btn-balas px-3 shadow-sm" 
                                            style="border-radius:10px; height: 38px;"
                                            data-id="{{ $c->id }}" 
                                            data-email="{{ $c->email }}">
                                        Balas Pesan
                                    </button>
                                @else
                                    <span class="text-success fw-bold small my-auto"><i class="fas fa-check-double"></i> Terbalas</span>
                                @endif

                                <form action="{{ route('admin.kontak.destroy', $c->id) }}" method="POST" class="form-hapus" data-nama="{{ $c->nama }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-modern btn-confirm-delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada feedback yang masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL BALAS --}}
<div class="modal fade" id="modalBalas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg" style="border-radius: 24px;">
            <form id="formBalas" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-800 mb-0">Tanggapi Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 bg-light rounded-4 mb-3">
                        <label class="small fw-700 text-muted d-block text-uppercase" style="font-size: 10px;">Mengirim Email ke:</label>
                        <span id="emailTujuan" class="fw-800 text-dark"></span>
                    </div>
                    <textarea name="balasan" class="form-control" rows="5" placeholder="Tuliskan pesan balasan resmi..." required style="border-radius: 16px;"></textarea>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn-premium btn-pine w-100 justify-content-center py-3">
                        Kirim Sekarang <i class="fa-solid fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-balas').forEach(btn => {
        btn.addEventListener('click', function(){
            document.getElementById('emailTujuan').innerText = this.dataset.email;
            document.getElementById('formBalas').action = "/admin/balas/" + this.dataset.id;
            new bootstrap.Modal(document.getElementById('modalBalas')).show();
        });
    });

    document.querySelectorAll('.btn-confirm-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.form-hapus');
            const nama = form.getAttribute('data-nama');
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Hapus pesan dari ${nama}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus Data',
                borderRadius: '1.2rem'
            }).then((result) => { if (result.isConfirmed) form.submit(); });
        });
    });
</script>

@endsection