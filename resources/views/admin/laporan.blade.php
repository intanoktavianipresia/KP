@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h3>
        <i class="fa-solid fa-file-lines"></i>
        Laporan Peminjaman Arsip
    </h3>

    {{-- ================= FILTER ================= --}}
    <div class="card p-3 mb-4">
        <form method="GET" action="{{ route('admin.laporan') }}" class="row g-3">

            <div class="col-md-3">
                <label>Tanggal Awal</label>
                <input type="date" 
                       name="tanggal_awal" 
                       value="{{ request('tanggal_awal') }}"
                       class="form-control">
            </div>

            <div class="col-md-3">
                <label>Tanggal Akhir</label>
                <input type="date" 
                       name="tanggal_akhir" 
                       value="{{ request('tanggal_akhir') }}"
                       class="form-control">
            </div>

            <div class="col-md-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="semua">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-success me-2">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>

                <a href="{{ route('admin.laporan') }}" class="btn btn-secondary">
                    Reset
                </a>
            </div>

        </form>

        <div class="mt-3">
            <a href="{{ route('admin.laporan.pdf', request()->all()) }}" 
               class="btn btn-danger me-2">
                <i class="fa-solid fa-file-pdf"></i> Cetak PDF
            </a>

            <a href="{{ route('admin.laporan.excel', request()->all()) }}" 
               class="btn btn-success">
                <i class="fa-solid fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>


    {{-- ================= TABEL ================= --}}
    <div class="card p-3">

        <h5>Laporan Peminjaman Arsip</h5>

        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nomor Permohonan</th>
                        <th>Nama Pemohon</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Arsip yang Dimohon</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $key => $row)
                    <tr>
                        <td class="text-center">
                            {{ $data->firstItem() + $key }}
                        </td>

                        <td>
                            <strong>{{ $row->nomor_permohonan ?? '-' }}</strong>
                        </td>

                        <td>{{ $row->nama_pemohon }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $row->arsip_dimohon ?? '-' }}
                        </td>

                        <td class="text-center">
                            @if($row->status == 'menunggu')
                                <span class="badge bg-warning text-dark">
                                    Menunggu Verifikasi
                                </span>
                            @elseif($row->status == 'disetujui')
                                <span class="badge bg-success">
                                    Disetujui
                                </span>
                            @elseif($row->status == 'ditolak')
                                <span class="badge bg-danger">
                                    Ditolak
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak ada data laporan
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-3">
            {{ $data->withQueryString()->links() }}
        </div>

    </div>

</div>
@endsection