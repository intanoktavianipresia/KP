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
        --slate-500: #64748b;
        --border-color: #e2e8f0;
    }

    body { 
        background-color: #f8fafc; 
        font-family: 'Inter', sans-serif; 
    }

    /* Header Styling */
    .main-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 32px;
        color: var(--slate-900);
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .sub-title {
        color: var(--slate-500);
        font-weight: 500;
        font-size: 15px;
        margin-bottom: 35px;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 30px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .form-label-bold {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 11px;
        color: var(--slate-600);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 10px;
        display: block;
    }

    .form-control, .form-select {
        font-weight: 500;
        border: 1.5px solid var(--border-color);
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: var(--pine-green);
        box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.08);
    }

    /* Table System */
    .table-container {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
    }

    .table thead {
        background-color: #f8fafc;
    }

    .table thead th {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        color: var(--slate-500);
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        font-size: 14px;
        color: var(--slate-900);
        border-bottom: 1px solid #f1f5f9;
    }

    /* Icon Abstract Replacement (Ganti Gambar ke Icon Bulat) */
    .arsip-icon-wrapper {
        width: 42px;
        height: 42px;
        background-color: #ecfdf5;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pine-green);
        font-size: 18px;
        flex-shrink: 0;
    }

    /* Status Badges */
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .status-waiting { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .status-approved { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .status-rejected { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    /* Action Buttons */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        text-decoration: none !important;
        border: 1px solid var(--border-color);
    }

    .btn-detail { background: white; color: var(--pine-green); }
    .btn-detail:hover { background: var(--pine-green); color: white; border-color: var(--pine-green); }

    .btn-delete { background: white; color: #ef4444; }
    .btn-delete:hover { background: #ef4444; color: white; border-color: #ef4444; }

    .id-tag {
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 12px;
        background: #f1f5f9;
        padding: 2px 6px;
        border-radius: 4px;
        color: var(--slate-600);
    }
</style>

<div class="container py-4">
    <div class="header-section">
        <h1 class="main-title">Kelola Permohonan</h1>
        <p class="sub-title">Sistem Verifikasi Berkas Layanan Arsip Statis.</p>
    </div>

    {{-- FILTER SECTION --}}
    <form method="GET" action="{{ route('admin.kelola') }}" class="filter-card">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label-bold">Cari Keyword</label>
                <input type="text" name="nama_pemohon" value="{{ request('nama_pemohon') }}" class="form-control" placeholder="Nama / Nomor...">
            </div>

            <div class="col-md-3">
                <label class="form-label-bold">Status Verifikasi</label>
                <select name="status" class="form-select">
                    <option value="semua">Semua Status</option>
                    <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label-bold">Periode Tanggal</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
                    <span class="text-muted">s/d</span>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-dark w-100 fw-bold" style="height: 42px; border-radius: 10px; background: var(--pine-green);">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </div>
    </form>

    {{-- TABLE SECTION --}}
    <div class="table-container">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="60">#</th>
                        <th>Identitas Permohonan</th>
                        <th>Pemohon</th>
                        <th>Arsip Yang Dimohon</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $row)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $data->firstItem() + $key }}</td>

                        <td>
                            <div class="id-tag mb-1 d-inline-block">{{ $row->nomor_permohonan }}</div>
                            <div class="small text-muted"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</div>
                        </td>

                        <td>
                            <div class="fw-bold">{{ $row->nama_pemohon }}</div>
                            <div class="small text-muted">ID: #{{ $row->id }}</div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="arsip-icon-wrapper">
                                    <i class="fas fa-box-archive"></i>
                                </div>
                                <div style="line-height: 1.4">
                                    <div class="fw-bold text-truncate" style="max-width: 250px;">{{ $row->arsip_dimohon ?? 'Tidak ada data' }}</div>
                                    <span class="badge bg-light text-dark border p-1 px-2" style="font-size: 10px">ARSIP PROVINSI</span>
                                </div>
                            </div>
                        </td>

                        <td class="text-center">
                            @if($row->status == 'menunggu')
                                <span class="badge-status status-waiting"><i class="fas fa-circle-notch fa-spin"></i> Menunggu</span>
                            @elseif($row->status == 'disetujui')
                                <span class="badge-status status-approved"><i class="fas fa-check-circle"></i> Disetujui</span>
                            @elseif($row->status == 'ditolak')
                                <span class="badge-status status-rejected"><i class="fas fa-times-circle"></i> Ditolak</span>
                            @else
                                <span class="badge-status bg-secondary text-white">Selesai</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.detail',$row->id) }}" class="btn-action btn-detail" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.hapus', $row->id) }}" 
                                   onclick="return confirm('Hapus data ini secara permanen?')"
                                   class="btn-action btn-delete" title="Hapus Data">
                                    <i class="fas fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.3"></i>
                            <p class="fw-bold text-muted">Belum ada data permohonan masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 d-flex justify-content-center border-top bg-light">
            {{ $data->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection