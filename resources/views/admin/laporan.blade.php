@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --pine-green: #064e3b;
        --pine-hover: #032f24;
        --slate-900: #0f172a;
        --slate-600: #475569;
        --slate-500: #64748b;
        --slate-200: #e2e8f0;
        --pdf-red: #dc2626;
        --excel-green: #15803d;
        --modern-blue: #3b82f6;
    }

    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; color: var(--slate-900); }

    .page-title { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        font-weight: 800; 
        font-size: clamp(22px, 4vw, 28px); 
        letter-spacing: -1px; 
    }

    .bento-card {
        background: white;
        border: 1px solid var(--slate-200);
        border-radius: 24px;
        padding: clamp(15px, 3vw, 30px);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    .export-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        background: white;
        padding: 8px 12px;
        border-radius: 16px;
        border: 1px solid var(--slate-200);
        width: fit-content;
    }

    .btn-export {
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 700;
        font-size: 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        text-decoration: none !important;
        border: 1.5px solid transparent;
    }

    .btn-pdf-modern { background-color: #fef2f2; color: var(--pdf-red); border-color: #fee2e2; }
    .btn-pdf-modern:hover { background-color: var(--pdf-red); color: white; transform: translateY(-2px); }

    .btn-excel-modern { background-color: #f0fdf4; color: var(--excel-green); border-color: #dcfce7; }
    .btn-excel-modern:hover { background-color: var(--excel-green); color: white; transform: translateY(-2px); }

    /* Responsive Filter Section */
    .filter-section { background: white; border-radius: 20px; padding: 25px; border: 1px solid var(--slate-200); }
    
    /* Table Styling for Large Screen */
    @media (min-width: 992px) {
        .table thead th {
            background: var(--slate-900);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
            padding: 18px 20px;
            border: none;
        }
        .table-pine thead th { background: var(--pine-green); }
    }

    /* Responsive Table (Card View on Mobile/Tablet) */
    @media (max-width: 991px) {
        .table-responsive { border: none; }
        .table thead { display: none; }
        .table tbody tr { 
            display: block; 
            background: #fff; 
            border: 1px solid var(--slate-200); 
            border-radius: 16px; 
            margin-bottom: 15px; 
            padding: 15px;
        }
        .table tbody td { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border: none !important; 
            padding: 8px 0 !important;
            text-align: right !important;
            font-size: 13px;
        }
        .table tbody td::before {
            content: attr(data-label);
            font-weight: 800;
            text-transform: uppercase;
            font-size: 10px;
            color: var(--slate-500);
            text-align: left;
        }
        .btn-delete-modern { margin-left: auto; }
    }

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

    .btn-delete-modern {
        width: 38px; height: 38px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        background: #fef2f2; color: #ef4444; border: 1px solid #fecaca;
    }
</style>

<div class="container-fluid py-4 px-3 px-md-5">

    {{-- HEADER SECTION --}}
    <div class="row align-items-center mb-4">
        <div class="col-xl-7">
            <h1 class="page-title mb-1">Pusat Laporan & Pesan.</h1>
            <p class="text-muted fw-500 mb-0">Monitor aktivitas arsip dan respon feedback dalam satu layar.</p>
        </div>
        <div class="col-xl-5 mt-3 mt-xl-0 d-flex justify-content-xl-end">
            <div class="export-container shadow-sm">
                <span class="my-auto small fw-bold text-muted me-2 border-end pe-3 d-none d-sm-inline">EXPORT</span>
                <a href="{{ route('admin.laporan.pdf', request()->all()) }}" class="btn-export btn-pdf-modern">
                    <i class="fa-solid fa-file-pdf"></i> PDF
                </a>
                <a href="{{ route('admin.laporan.excel', request()->all()) }}" class="btn-export btn-excel-modern">
                    <i class="fa-solid fa-file-excel"></i> EXCEL
                </a>
            </div>
        </div>
    </div>

    {{-- FILTER SECTION --}}
    <div class="filter-section mb-4 shadow-sm">
        <form method="GET" action="{{ route('admin.laporan') }}" class="row g-3">
            <div class="col-sm-6 col-md-3">
                <label class="form-label fw-800 text-muted small text-uppercase">Mulai Tanggal</label>
                <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control" style="border-radius:12px;">
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="form-label fw-800 text-muted small text-uppercase">Akhir Tanggal</label>
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control" style="border-radius:12px;">
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="form-label fw-800 text-muted small text-uppercase">Status Berkas</label>
                <select name="status" class="form-select" style="border-radius: 12px; padding: 10px;">
                    <option value="semua">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn-premium btn-pine w-100 justify-content-center">
                    <i class="fa-solid fa-filter"></i> Terapkan
                </button>
                <a href="{{ route('admin.laporan') }}" class="btn btn-light border d-flex align-items-center justify-content-center" style="border-radius:12px; min-width: 48px; height: 48px;">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </a>
            </div>
        </form>
    </div>

    {{-- LOG PERMOHONAN TABLE --}}
    <div class="bento-card">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <h4 class="fw-800 mb-0"><i class="fa-solid fa-clock-rotate-left text-success me-2"></i> Log Aktivitas</h4>
            <span class="badge bg-light text-dark border p-2 px-3 fw-bold align-self-start" style="border-radius:10px;">{{ count($data) }} Entri ditemukan</span>
        </div>
        <div class="table-responsive">
            <table class="table table-pine mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Pemohon</th>
                        <th>Objek Arsip</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tgl Input</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($data as $key => $d)
                    <tr>
                        <td class="text-md-center text-muted fw-bold" data-label="No">{{ $key+1 }}</td>
                        <td data-label="Pemohon">
                            <div class="fw-700 text-dark">{{ $d->nama_pemohon }}</div>
                            <div class="small text-muted">ID: #{{ $d->id }}</div>
                        </td>
                        <td data-label="Objek Arsip">
                            <span class="small bg-light p-1 px-2 rounded fw-600 text-slate-600 border">
                                <i class="fa-solid fa-box-archive me-1"></i> {{ $d->arsip_dimohon }}
                            </span>
                        </td>
                        <td class="text-md-center" data-label="Status">
                            @php
                                $statusLower = strtolower($d->status);
                                $bgClass = match($statusLower) {
                                    'selesai' => 'bg-selesai',
                                    'disetujui' => 'bg-disetujui',
                                    'menunggu' => 'bg-warning text-dark',
                                    default => 'bg-danger',
                                };
                            @endphp
                            <span class="badge-premium {{ $bgClass }}">{{ $d->status }}</span>
                        </td>
                        <td class="text-md-center text-muted small fw-700" data-label="Tanggal">
                            {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- KOTAK MASUK TABLE --}}
    <div class="bento-card">
        <h4 class="fw-800 mb-4"><i class="fa-solid fa-envelope-open-text text-primary me-2"></i> Feedback Masuk</h4>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="70">No</th>
                        <th>Kontak</th>
                        <th>Isi Pesan</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse($kontak as $k => $c)
                    <tr>
                        <td class="text-md-center text-muted fw-bold" data-label="No">{{ $k+1 }}</td>
                        <td data-label="Kontak">
                            <div class="fw-800 text-dark text-truncate" style="max-width: 150px;">{{ $c->nama }}</div>
                            <div class="small text-muted fw-500">{{ $c->email }}</div>
                        </td>
                        <td data-label="Isi Pesan">
                            <div class="p-2 rounded-3 bg-light border-start border-4 border-primary small">
                                "{{ Str::limit($c->pesan, 80) }}"
                            </div>
                        </td>
                        <td class="text-md-center" data-label="Aksi">
                            <div class="d-flex justify-content-md-center align-items-center gap-2">
                                @if(!$c->balasan)
                                    <button class="btn btn-sm btn-dark fw-bold btn-balas px-3" style="border-radius:10px; height: 38px;" data-id="{{ $c->id }}" data-email="{{ $c->email }}">
                                        <i class="fa-solid fa-reply"></i> <span class="d-none d-md-inline ms-1">Balas</span>
                                    </button>
                                @else
                                    <span class="badge bg-success-subtle text-success fw-bold p-2 border border-success rounded-pill">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                @endif
                                <form action="{{ route('admin.kontak.destroy', $c->id) }}" method="POST" class="form-hapus" data-nama="{{ $c->nama }}">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-delete-modern btn-confirm-delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada feedback.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL BALAS --}}
<div class="modal fade" id="modalBalas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 28px;">
            <form id="formBalas" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <h5 class="fw-800 mb-0">Tanggapi Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 bg-primary-subtle rounded-4 mb-3">
                        <label class="small fw-800 text-primary d-block text-uppercase mb-1" style="font-size: 10px;">Tujuan:</label>
                        <span id="emailTujuan" class="fw-800 text-dark"></span>
                    </div>
                    <textarea name="balasan" class="form-control border-2" rows="5" placeholder="Tulis balasan..." required style="border-radius: 18px;"></textarea>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn-premium btn-pine w-100 justify-content-center">Kirim Balasan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Balas
    document.querySelectorAll('.btn-balas').forEach(btn => {
        btn.addEventListener('click', function(){
            document.getElementById('emailTujuan').innerText = this.dataset.email;
            document.getElementById('formBalas').action = "/admin/balas/" + this.dataset.id;
            new bootstrap.Modal(document.getElementById('modalBalas')).show();
        });
    });

    // Delete
    document.querySelectorAll('.btn-confirm-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.form-hapus');
            const nama = form.getAttribute('data-nama');
            Swal.fire({
                title: 'Hapus?',
                text: `Pesan dari "${nama}" akan dihapus.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                borderRadius: '1.5rem'
            }).then((result) => { if (result.isConfirmed) form.submit(); });
        });
    });
</script>

@endsection