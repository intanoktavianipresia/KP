@extends('layouts.admin')

@section('content')

<style>
    .pagination svg {
        display: none !important;
    }

    .pagination .page-link {
        font-size: 14px;
        padding: 6px 12px;
    }

    .pagination .active .page-link {
        background-color: #0f5d3f;
        border-color: #0f5d3f;
    }
</style>

<div class="container">

    <h3 class="mb-3">Kelola Permohonan Peminjaman Arsip</h3>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.kelola') }}" class="card p-3 mb-4">
        <div class="row g-2">

            <div class="col-md-3">
                <input type="text" name="nomor_permohonan"
                       value="{{ request('nomor_permohonan') }}"
                       class="form-control"
                       placeholder="Nomor Permohonan">
            </div>

            <div class="col-md-3">
                <input type="text" name="nama_pemohon"
                       value="{{ request('nama_pemohon') }}"
                       class="form-control"
                       placeholder="Nama Pemohon">
            </div>

            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="semua">Semua Status</option>
                    <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>

            <div class="col-md-2">
                <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
            </div>

        </div>

        <div class="mt-3 text-end">
            <button class="btn btn-success">Tampilkan</button>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th style="width:120px;">Tanggal</th>
                        <th>Arsip</th>
                        <th style="width:130px;">Status</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($data as $key => $row)
                    <tr>
                        <td class="text-center">{{ $data->firstItem() + $key }}</td>

                        <td>
                            <span class="badge bg-success">
                                {{ $row->nomor_permohonan }}
                            </span>
                        </td>

                        <td>{{ $row->nama_pemohon }}</td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}
                        </td>

                        <td>{{ $row->arsip_dimohon ?? '-' }}</td>

                        <td class="text-center">
                            @if($row->status == 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($row->status == 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($row->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>

                        <td class="text-center">

                            {{-- DETAIL --}}
                            <a href="{{ route('admin.detail',$row->id) }}"
                               class="btn btn-sm btn-primary mb-1">
                                Detail
                            </a>

                            {{-- HAPUS --}}
                            <a href="{{ route('admin.hapus', $row->id) }}"
                               onclick="return confirm('Yakin ingin menghapus data ini?')"
                               class="btn btn-sm btn-danger">
                                Hapus
                            </a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{-- PAGINATION --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $data->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

@endsection