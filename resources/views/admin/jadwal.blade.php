@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --pine-green: #064e3b;
        --pine-light: #f0fdf4;
        --slate-900: #0f172a;
        --slate-500: #64748b;
        --slate-200: #e2e8f0;
    }

    .dashboard-wrapper {
        font-family: 'Inter', sans-serif;
        max-width: 1600px;
        margin: 0 auto;
    }

    .filter-wrapper {
        display: flex;
        gap: clamp(8px, 2vw, 12px);
        margin-bottom: 25px;
        overflow-x: auto;
        padding: 5px 5px 15px 5px;
        scrollbar-width: none; /* Firefox */
    }

    .filter-wrapper::-webkit-scrollbar { display: none; }

    .btn-filter {
        padding: clamp(10px, 2vw, 12px) clamp(16px, 3vw, 20px);
        border-radius: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: clamp(12px, 1.2vw, 13px);
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        color: var(--slate-500);
        border: 1px solid var(--slate-200);
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-filter.active {
        background: var(--pine-green);
        color: white !important;
        border-color: var(--pine-green);
        box-shadow: 0 10px 20px rgba(6, 78, 59, 0.15);
        transform: translateY(-1px);
    }

    .premium-card {
        background: white;
        border-radius: clamp(20px, 4vw, 32px);
        border: 1px solid var(--slate-200);
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
    }

    .card-header-premium {
        padding: clamp(25px, 5vw, 45px) clamp(20px, 5vw, 50px);
        background: white;
        border-bottom: 1px solid #f1f5f9;
    }

    .card-header-premium h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: clamp(22px, 4vw, 32px);
        color: var(--slate-900);
        letter-spacing: -0.03em;
        margin: 0;
    }

    .header-subtitle {
        font-size: clamp(13px, 1.5vw, 15px);
        color: var(--slate-500);
        margin-top: 5px;
    }

    .table-premium { width: 100%; border-collapse: separate; border-spacing: 0; }

    @media (max-width: 991px) {
        .table-premium thead { display: none; }
        .table-premium tbody tr { 
            display: block; 
            padding: 20px; 
            border-bottom: 8px solid #f8fafc;
            position: relative;
        }
        .table-premium tbody td { 
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%; 
            padding: 8px 0 !important; 
            border: none !important;
            text-align: right !important;
            font-size: 14px;
        }
        .table-premium tbody td:before {
            content: attr(data-label);
            font-size: 10px;
            text-transform: uppercase;
            color: var(--slate-500);
            font-weight: 800;
            letter-spacing: 0.5px;
            text-align: left;
        }
        
        .table-premium tbody td[data-label="Tindakan"] {
            margin-top: 15px;
            border-top: 1px solid #f1f5f9 !important;
            padding-top: 15px !important;
        }
        .btn-action { width: 100%; justify-content: center; }
    }

    @media (min-width: 992px) {
        .table-premium thead th {
            background-color: #f8fafc;
            color: var(--slate-500);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 20px 40px;
            border-bottom: 1px solid var(--slate-200);
        }
        .table-premium tbody td {
            padding: 24px 40px;
            border-bottom: 1px solid #f8fafc;
            vertical-align: middle;
        }
        .table-premium tbody tr:hover { background-color: #fafbfb; }
    }

    .row-today { background-color: var(--pine-light) !important; }
    
    .pill-status {
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 10px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .pill-today { background: #10b981; color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2); }
    .pill-week { background: #f59e0b; color: white; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2); }
    .pill-next { background: #f1f5f9; color: var(--slate-500); border: 1px solid var(--slate-200); }

    .btn-action {
        background: var(--slate-900);
        color: white !important;
        padding: clamp(8px, 1.5vw, 10px) 20px;
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
        transform: translateX(3px);
    }
</style>

<div class="container-fluid py-4 px-3 px-md-5 dashboard-wrapper">

    <div class="filter-wrapper">
        <a href="{{ route('admin.jadwal') }}" class="btn-filter {{ !request('filter') ? 'active' : '' }}">
            <i class="fas fa-list-ul"></i> <span>Semua</span>
        </a>
        <a href="{{ route('admin.jadwal', ['filter' => 'hari_ini']) }}" class="btn-filter {{ request('filter') == 'hari_ini' ? 'active' : '' }}">
            <i class="fas fa-bolt"></i> <span>Hari Ini</span>
        </a>
        <a href="{{ route('admin.jadwal', ['filter' => 'minggu_ini']) }}" class="btn-filter {{ request('filter') == 'minggu_ini' ? 'active' : '' }}">
            <i class="fas fa-calendar-week"></i> <span>Minggu Ini</span>
        </a>
    </div>

    <div class="premium-card">
        <div class="card-header-premium d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-4">
            <div>
                <h1>Jadwal Kunjungan.</h1>
                <p class="header-subtitle mb-0">Kelola agenda verifikasi fisik pemohon arsip secara real-time.</p>
            </div>
            <div class="d-flex align-items-center gap-3 bg-light p-3 rounded-4 border w-100 w-md-auto">
                <div class="bg-white p-2 rounded-3 shadow-sm">
                    <i class="fas fa-users text-success"></i>
                </div>
                <div>
                    <div class="fw-800 text-uppercase text-muted" style="font-size: 9px; letter-spacing: 1px;">Total Antrean</div>
                    <div class="fw-800 h5 mb-0" style="color: var(--pine-green);">{{ $data->total() }} Data</div>
                </div>
            </div>
        </div>

        <div class="table-responsive-none"> 
            <table class="table-premium">
                <thead>
                    <tr>
                        <th width="100" class="text-center">No</th>
                        <th>Permohonan</th>
                        <th>Identitas Pemohon</th>
                        <th class="text-center">Jadwal Kedatangan</th>
                        <th class="text-center">Keterangan</th>
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
                            <td class="text-md-center text-muted fw-bold" data-label="Antrean No">
                                #{{ $data->firstItem() + $key }}
                            </td>
                            <td data-label="ID Permohonan">
                                <span style="color: var(--pine-green); font-weight: 800; font-family: 'Plus Jakarta Sans';">
                                    {{ $row->nomor_permohonan }}
                                </span>
                            </td>
                            <td data-label="Nama Pemohon">
                                <div class="fw-bold text-dark">{{ $row->nama_pemohon }}</div>
                            </td>
                            <td class="text-md-center" data-label="Tanggal">
                                <span class="text-muted fw-bold">
                                    <i class="far fa-calendar-check me-1 text-success"></i> {{ $tgl->format('d M Y') }}
                                </span>
                            </td>
                            <td class="text-md-center" data-label="Status Waktu">
                                @if($isToday)
                                    <span class="pill-status pill-today"><i class="fas fa-bolt"></i> Hari Ini</span>
                                @elseif($isWeek)
                                    <span class="pill-status pill-week"><i class="fas fa-clock"></i> Minggu Ini</span>
                                @else
                                    <span class="pill-status pill-next"><i class="fas fa-calendar"></i> Mendatang</span>
                                @endif
                            </td>
                            <td class="text-md-end" data-label="Tindakan">
                                <a href="{{ route('admin.detail',$row->id) }}?from=jadwal" class="btn-action">
                                    Detail Data <i class="fas fa-arrow-right small"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-5">
                                    <i class="fas fa-calendar-times fa-4x mb-3 text-muted opacity-20"></i>
                                    <h5 class="fw-bold text-muted">Belum Ada Jadwal</h5>
                                    <p class="text-muted small">Cek kembali filter Anda atau tunggu permohonan baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($data->hasPages())
        <div class="p-4 border-top d-flex justify-content-center bg-light bg-opacity-50">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@endsection