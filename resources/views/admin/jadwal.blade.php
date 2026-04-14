@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --pine-green: #064e3b; /* Solid Pine Green */
        --pine-light: #f0fdf4;
        --slate-900: #0f172a;
        --slate-500: #64748b;
        --slate-200: #e2e8f0;
    }

    body { 
        background-color: #f8fafc; 
        font-family: 'Inter', sans-serif; 
    }

    /* Bento Filter Style - Floating outside the card for depth */
    .filter-wrapper {
        display: flex;
        justify-content: flex-start;
        gap: 12px;
        margin-bottom: 30px;
    }

    .btn-filter {
        padding: 24px 24px;
        border-radius: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none !important;
        transition: all 0.3s ease;
        background: white;
        color: var(--slate-500);
        border: 1px solid var(--slate-200);
    }

    .btn-filter.active {
        background: var(--pine-green);
        color: white !important;
        border-color: var(--pine-green);
        box-shadow: 0 10px 15px -3px rgba(6, 78, 59, 0.25);
    }

    /* THE ULTIMATE CONTAINER */
    .premium-card {
        background: white;
        border-radius: 32px;
        border: 1px solid var(--slate-200);
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
    }

    /* HEADER INSIDE CARD */
    .card-header-premium {
        padding: 45px 50px;
        background: white;
        border-bottom: 1px solid #f1f5f9;
    }

    .card-header-premium h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 32px;
        color: var(--slate-900);
        letter-spacing: -1.5px;
        margin: 0;
    }

    .card-header-premium p {
        color: var(--slate-500);
        font-weight: 500;
        margin-top: 8px;
        margin-bottom: 0;
        font-size: 15px;
    }

    /* TABLE SYSTEM */
    .table-premium {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-premium thead th {
        background-color: var(--pine-green); /* HIJAU SOLID */
        color: white !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 22px 50px;
        border: none;
    }

    .table-premium tbody td {
        padding: 24px 50px;
        vertical-align: middle;
        font-weight: 600;
        color: var(--slate-900);
        border-bottom: 1px solid #f8fafc;
        font-size: 14.5px;
        transition: 0.2s;
    }

    /* HARI INI HIGHLIGHT - SUPER SHARP */
    .row-today {
        background-color: var(--pine-light) !important;
    }

    .row-today td:first-child {
        box-shadow: inset 8px 0 0 #10b981; /* Garis samping tebal */
    }

    /* PILL STATUS */
    .pill-status {
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .pill-today { background: #10b981; color: white; }
    .pill-week { background: #f59e0b; color: white; }
    .pill-next { background: #f1f5f9; color: var(--slate-500); border: 1px solid var(--slate-200); }

    /* ACTION BUTTON */
    .btn-action {
        background: var(--slate-900);
        color: white !important;
        padding: 10px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 12px;
        text-decoration: none !important;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action:hover {
        background: var(--pine-green);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(6, 78, 59, 0.3);
    }

    /* PAGINATION OVERRIDE */
    .pagination-container {
        padding:0 30px 30px 30px;
        background: #fdfdfd;
        border-top: 1px solid #f1f5f9;
    }

</style>

<div class="container py-3">

    <div class="filter-wrapper">
        <a href="{{ route('admin.jadwal') }}" class="btn-filter {{ !request('filter') ? 'active' : '' }}">
            <i class="fas fa-list-ul me-1"></i> Semua
        </a>
        <a href="{{ route('admin.jadwal') }}?filter=hari_ini" class="btn-filter {{ request('filter') == 'hari_ini' ? 'active' : '' }}">
            <i class="fas fa-bolt me-1"></i> Hari Ini
        </a>
        <a href="{{ route('admin.jadwal') }}?filter=minggu_ini" class="btn-filter {{ request('filter') == 'minggu_ini' ? 'active' : '' }}">
            <i class="fas fa-calendar-alt me-1"></i> Minggu Ini
        </a>
    </div>

    <div class="premium-card">
        <div class="card-header-premium d-flex justify-content-between align-items-end">
            <div>
                <h1>Jadwal Kunjungan.</h1>
                <p>Kelola agenda kehadiran dan verifikasi fisik pemohon arsip.</p>
            </div>
            <div class="text-end">
                <div class="fw-800 text-uppercase text-muted" style="font-size: 11px; letter-spacing: 2px;">Data Terupdate</div>
                <div class="fw-800" style="font-size: 18px; color: var(--pine-green);">{{ $data->total() }} Total Antrean</div>
            </div>
        </div>

        <table class="table-premium">
            <thead>
                <tr>
                    <th width="80" class="text-center">No</th>
                    <th>Nomor Permohonan</th>
                    <th>Nama Lengkap Pemohon</th>
                    <th class="text-center">Tanggal Kunjungan</th>
                    <th class="text-center">Status Waktu</th>
                    <th class="text-end">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $key => $row)
                    @php
                        $today = \Carbon\Carbon::today();
                        $tgl = \Carbon\Carbon::parse($row->tanggal_kunjungan);
                        $isToday = $tgl->isSameDay($today);
                        $isWeek = $tgl->between($today, $today->copy()->endOfWeek());
                    @endphp

                    <tr class="{{ $isToday ? 'row-today' : '' }}">
                        <td class="text-center text-muted fw-bold">{{ $data->firstItem() + $key }}</td>
                        <td>
                            <span style="color: var(--pine-green); font-weight: 800; font-family: 'Plus Jakarta Sans';">
                                #{{ $row->nomor_permohonan }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-700 text-dark" style="font-size: 16px;">{{ $row->nama_pemohon }}</div>
                        </td>
                        <td class="text-center">
                            <span class="text-muted fw-bold">
                                <i class="far fa-calendar-check me-2"></i>{{ $tgl->format('d M Y') }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($isToday)
                                <span class="pill-status pill-today"><i class="fas fa-circle-dot"></i> Hari Ini</span>
                            @elseif($isWeek)
                                <span class="pill-status pill-week"><i class="fas fa-clock"></i> Minggu Ini</span>
                            @else
                                <span class="pill-status pill-next"><i class="fas fa-calendar-plus"></i> Mendatang</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.detail',$row->id) }}?from=jadwal" class="btn-action">
                                Detail Akses <i class="fas fa-arrow-right small"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-5">
                                <i class="fas fa-inbox fa-3x mb-3 text-muted opacity-25"></i>
                                <p class="fw-bold text-muted">Belum ada data jadwal kunjungan untuk kategori ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($data->hasPages())
        <div class="pagination-container d-flex justify-content-center">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@endsection