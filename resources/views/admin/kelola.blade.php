@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-3">Kelola Permohonan Peminjaman Arsip</h3>

    {{-- SEARCH & FILTER --}}
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

            <table class="table table-bordered">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Arsip</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($data as $key => $row)
                    <tr>
                        <td>{{ $data->firstItem() + $key }}</td>
                        <td><strong>{{ $row->nomor_permohonan ?? '-' }}</strong></td>
                        <td>{{ $row->nama_pemohon }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $row->arsip ?? '-' }}</td>
                        <td>
                            @if($row->status == 'menunggu')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($row->status == 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.detail',$row->nomor_permohonan) }}"
                               class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $data->links() }}

        </div>
    </div>

    {{-- RIWAYAT --}}
    <div class="card mt-4">
        <div class="card-body">
            <h5>Riwayat Permohonan</h5>

            @foreach($riwayat as $r)
                <div class="border rounded p-2 mb-2">
                    {{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y') }}
                    - Permohonan diajukan oleh {{ $r->nama_pemohon }}
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection