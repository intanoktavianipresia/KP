@extends('layouts.admin')

@section('content')

<div class="container">

<h3 class="mb-4">Detail Permohonan</h3>

<div class="card">
<div class="card-body">

@if($data)

<table class="table table-bordered">

<tr>
<th width="30%">Nomor Permohonan</th>
<td>{{ $data->nomor_permohonan }}</td>
</tr>

<tr>
<th>Nama Pemohon</th>
<td>{{ $data->nama_pemohon }}</td>
</tr>

<tr>
<th>Alamat</th>
<td>{{ $data->alamat }}</td>
</tr>

<tr>
<th>Jenis Kelamin</th>
<td>{{ $data->jenis_kelamin }}</td>
</tr>

<tr>
<th>Telepon</th>
<td>{{ $data->telepon }}</td>
</tr>

<tr>
<th>Email</th>
<td>{{ $data->email }}</td>
</tr>

<tr>
<th>Tujuan</th>
<td>{{ $data->tujuan }}</td>
</tr>

<tr>
<th>Arsip Dimohon</th>
<td>{{ $data->arsip_dimohon }}</td>
</tr>

<tr>
<th>Tanggal Pengajuan</th>
<td>{{ \Carbon\Carbon::parse($data->created_at)->format('d F Y') }}</td>
</tr>

<tr>
<th>Tanggal Kunjungan</th>
<td>
    {{ $data->tanggal_kunjungan 
        ? \Carbon\Carbon::parse($data->tanggal_kunjungan)->format('d F Y') 
        : '-' 
    }}
</td>
</tr>

<tr>
<th>Status</th>
<td>

@if($data->status == 'menunggu')
<span class="badge bg-warning text-dark">Menunggu</span>

@elseif($data->status == 'disetujui')
<span class="badge bg-success">Disetujui</span>

@elseif($data->status == 'ditolak')
<span class="badge bg-danger">Ditolak</span>

@else
<span class="badge bg-info">Selesai</span>
@endif

</td>
</tr>

</table>

<div class="mt-3">

@php
    $back = request('from') == 'jadwal' 
        ? route('admin.jadwal') 
        : route('admin.kelola');
@endphp

<a href="{{ $back }}" class="btn btn-secondary">
    Kembali
</a>

@if($data->status == 'menunggu')

<!-- SETUJUI -->
<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSetujui">
Setujui
</button>

<!-- TOLAK -->
<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak">
Tolak
</button>

@endif

</div>

@else
<div class="alert alert-danger">Data tidak ditemukan</div>
@endif

</div>
</div>

</div>

<!-- MODAL SETUJUI -->
<div class="modal fade" id="modalSetujui">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5>Setujui Permohonan</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<label>Tanggal Kunjungan Final</label>
<input type="date" id="tgl" class="form-control mb-2">

<label>Waktu</label>
<input type="text" id="waktu" class="form-control" placeholder="09:00 - 12:00">

</div>

<div class="modal-footer">

<button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

<a id="btnSetujui" class="btn btn-success">
Konfirmasi
</a>

</div>

</div>
</div>
</div>

<!-- MODAL TOLAK -->
<div class="modal fade" id="modalTolak">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5>Tolak Permohonan</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<label>Alasan</label>
<textarea id="alasan" class="form-control"></textarea>

</div>

<div class="modal-footer">

<button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

<a id="btnTolak" class="btn btn-danger">
Konfirmasi
</a>

</div>

</div>
</div>
</div>

<script>
document.getElementById('btnSetujui').onclick = function() {
    let tgl = document.getElementById('tgl').value;
    let waktu = document.getElementById('waktu').value;

    window.location.href = "/admin/setujui/{{ $data->id }}?tgl="+tgl+"&waktu="+waktu;
}

document.getElementById('btnTolak').onclick = function() {
    let alasan = document.getElementById('alasan').value;

    window.location.href = "/admin/tolak/{{ $data->id }}?alasan="+alasan;
}
</script>

@endsection