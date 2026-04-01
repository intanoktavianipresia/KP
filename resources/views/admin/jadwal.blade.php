@extends('layouts.admin')

@section('content')

<style>
.badge-hari-ini{
    background:#16a34a;
    color:white;
    padding:4px 8px;
    border-radius:6px;
    font-size:12px;
}

.badge-minggu{
    background:#f59e0b;
    color:white;
    padding:4px 8px;
    border-radius:6px;
    font-size:12px;
}

.row-hari-ini{
    background:#ecfdf5 !important;
}

.filter-btn a{
    margin-right:8px;
}
</style>

<div class="container">

    <h3 class="mb-3">Jadwal Kunjungan</h3>

    {{-- FILTER --}}
    <div class="mb-3 filter-btn">
        <a href="{{ route('admin.jadwal') }}" class="btn btn-secondary btn-sm">Semua</a>
        <a href="{{ route('admin.jadwal') }}?filter=hari_ini" class="btn btn-success btn-sm">Hari Ini</a>
        <a href="{{ route('admin.jadwal') }}?filter=minggu_ini" class="btn btn-warning btn-sm">Minggu Ini</a>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status Waktu</th>
                        <th>Aksi</th>
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

                    <tr class="{{ $isToday ? 'row-hari-ini' : '' }}">
                        <td class="text-center">{{ $data->firstItem() + $key }}</td>

                        <td>
                            <span class="badge bg-success">
                                {{ $row->nomor_permohonan }}
                            </span>
                        </td>

                        <td>{{ $row->nama_pemohon }}</td>

                        <td class="text-center">
                            {{ $tgl->format('d F Y') }}
                        </td>

                        <td class="text-center">
                            @if($isToday)
                                <span class="badge-hari-ini">Hari Ini</span>
                            @elseif($isWeek)
                                <span class="badge-minggu">Minggu Ini</span>
                            @else
                                <span class="badge bg-secondary">Akan Datang</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.detail',$row->id) }}?from=jadwal"
                               class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada jadwal</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                {{ $data->links() }}
            </div>

        </div>
    </div>

</div>

@endsection