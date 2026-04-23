@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --pine-green: #064e3b;
        --pine-light: #ecfdf5;
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
        font-size: clamp(24px, 4vw, 32px);
        color: var(--slate-900);
        letter-spacing: -1px;
    }

    .sub-title {
        color: var(--slate-500);
        font-size: 14px;
        margin-bottom: 30px;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .form-label-bold {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 11px;
        color: var(--slate-600);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 11px 15px;
        font-size: 14px;
        border: 1.5px solid var(--border-color);
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: var(--pine-green);
        box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.1);
    }

    /* Table & Mobile Responsive Layout */
    .table-container {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        overflow: hidden;
    }

    @media (max-width: 991px) {
        .table thead { display: none; }
        .table tbody tr { 
            display: block; 
            padding: 20px; 
            border-bottom: 8px solid #f1f5f9;
        }
        .table tbody td { 
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%; 
            padding: 8px 0 !important; 
            border: none !important;
        }
        .table tbody td:before {
            content: attr(data-label);
            font-size: 10px;
            text-transform: uppercase;
            color: var(--slate-500);
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .arsip-icon-wrapper { display: none; }
        .btn-action-group { width: 100%; margin-top: 15px; border-top: 1px solid #f1f5f9; padding-top: 15px; }
    }

    @media (min-width: 992px) {
        .table thead th {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 11px;
            color: var(--slate-500);
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        .table tbody td { padding: 22px 20px; vertical-align: middle; }
    }

    /* Status Badges */
    .badge-status {
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 10px;
        text-transform: uppercase;
        display: inline-flex; align-items: center; gap: 6px;
    }
    .status-waiting { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .status-approved { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .status-rejected { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    /* Action Buttons */
    .btn-action {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: inline-flex; align-items: center; justify-content: center;
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
        background: white;
    }
    .btn-detail { color: var(--pine-green); }
    .btn-detail:hover { background: var(--pine-green); color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(6, 78, 59, 0.2); }
    .btn-delete { color: #ef4444; }
    .btn-delete:hover { background: #ef4444; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2); }

    /* Tags */
    .id-tag {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 10px; font-weight: 800;
        background: var(--slate-900); padding: 3px 8px;
        border-radius: 6px; color: white;
    }

    .arsip-icon-wrapper {
        width: 36px; height: 36px;
        background: var(--pine-light);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: var(--pine-green);
    }
</style>

<div class="container-fluid py-4 px-3 px-md-5">
    <div class="header-section">
        <h1 class="main-title">Kelola Permohonan.</h1>
        <p class="sub-title">Verifikasi antrean dan manajemen akses dokumen arsip.</p>
    </div>

    {{-- FILTER SECTION --}}
    <form method="GET" action="{{ route('admin.kelola') }}" class="filter-card">
        <div class="row g-3">
            <div class="col-12 col-md-3">
                <label class="form-label-bold">Cari Keyword</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fas fa-search"></i></span>
                    <input type="text" name="nama_pemohon" value="{{ request('nama_pemohon') }}" class="form-control border-start-0 ps-0" placeholder="Nama / Nomor...">
                </div>
            </div>
            <div class="col-12 col-md-2">
                <label class="form-label-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="semua">Semua Status</option>
                    <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-12 col-md-5">
                <label class="form-label-bold">Periode Masuk</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
                    <span class="text-muted fw-bold small">s/d</span>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
                </div>
            </div>
            <div class="col-12 col-md-2 d-flex align-items-end">
                <button type="submit" class="btn w-100 fw-800 text-white" style="height: 48px; border-radius: 12px; background: var(--pine-green); border: none;">
                    Terapkan <i class="fas fa-chevron-right ms-2 small"></i>
                </button>
            </div>
        </div>
    </form>

    {{-- TABLE SECTION --}}
    <div class="table-container shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="70">NO</th>
                        <th>IDENTITAS</th>
                        <th>NAMA PEMOHON</th>
                        <th>DOKUMEN ARSIP</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-end">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $row)
                    <tr>
                        <td class="text-md-center text-muted fw-bold" data-label="No">{{ $data->firstItem() + $key }}</td>
                        <td data-label="ID / Tanggal">
                            <span class="id-tag mb-1 d-inline-block">{{ $row->nomor_permohonan }}</span>
                            <div class="small text-muted fw-500"><i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</div>
                        </td>
                        <td data-label="Pemohon">
                            <div class="fw-bold text-dark">{{ $row->nama_pemohon }}</div>
                            <div class="small text-muted opacity-75">ID Transaksi: #{{ $row->id }}</div>
                        </td>
                        <td data-label="Arsip">
                            <div class="d-flex align-items-center gap-2">
                                <div class="arsip-icon-wrapper">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <div class="fw-bold text-truncate" style="max-width: 180px;">{{ $row->arsip_dimohon ?? 'Tidak spesifik' }}</div>
                            </div>
                        </td>
                        <td class="text-md-center" data-label="Verifikasi">
                            @if($row->status == 'menunggu')
                                <span class="badge-status status-waiting"><i class="fas fa-spinner fa-spin"></i> Pending</span>
                            @elseif($row->status == 'disetujui')
                                <span class="badge-status status-approved"><i class="fas fa-check-circle"></i> Approved</span>
                            @elseif($row->status == 'ditolak')
                                <span class="badge-status status-rejected"><i class="fas fa-times-circle"></i> Rejected</span>
                            @endif
                        </td>
                        <td class="text-end" data-label="Aksi">
                            <div class="d-flex btn-action-group justify-content-end gap-2">
                                <a href="{{ route('admin.detail', $row->id) }}" class="btn-action btn-detail" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn-action btn-delete" data-id="{{ $row->id }}" onclick="openDeleteModal(this)" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25 mb-3">
                                <i class="fas fa-folder-open fa-4x text-muted"></i>
                            </div>
                            <h6 class="fw-bold text-muted">Data permohonan tidak ditemukan.</h6>
                            <p class="text-muted small">Coba ubah kata kunci atau filter pencarian Anda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($data->hasPages())
        <div class="p-4 d-flex justify-content-center border-top bg-light">
            {{ $data->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
        <div class="modal-content border-0" style="border-radius: 28px; overflow: hidden;">
            <div class="modal-body text-center p-5">
                <div class="delete-icon-circle mx-auto mb-4" style="width: 70px; height: 70px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 28px;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h4 class="fw-800 mb-2" style="color: var(--slate-900);">Konfirmasi Hapus</h4>
                <p class="text-muted small mb-4 px-2">Apakah Anda yakin? Tindakan ini bersifat permanen dan data tidak dapat dipulihkan kembali.</p>
                
                <div class="d-grid gap-2">
                    <a id="confirmDelete" href="#" class="btn btn-danger py-2 fw-800 shadow-sm" style="border-radius: 12px;">Ya, Hapus Sekarang</a>
                    <button type="button" class="btn btn-link text-decoration-none text-muted fw-bold" data-bs-dismiss="modal">Batalkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openDeleteModal(el){
    const id = el.getAttribute('data-id');
    const deleteUrl = "{{ url('admin/hapus') }}/" + id; 
    document.getElementById('confirmDelete').setAttribute('href', deleteUrl);
    const myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    myModal.show();
}
</script>

@endsection