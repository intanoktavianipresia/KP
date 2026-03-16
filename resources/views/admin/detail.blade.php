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
<th>Tanggal Kunjungan yang Diinginkan</th>
<td>{{ \Carbon\Carbon::parse($data->tanggal_kunjungan)->format('d F Y') }}</td>
</tr>

<tr>
<th>Status</th>
<td>

@if($data->status == 'menunggu')
<span class="badge bg-warning text-dark">Menunggu Verifikasi</span>

@elseif($data->status == 'disetujui')
<span class="badge bg-success">Disetujui</span>

@elseif($data->status == 'ditolak')
<span class="badge bg-danger">Ditolak</span>

@elseif($data->status == 'selesai')
<span class="badge bg-info text-dark">Selesai</span>
@endif

</td>
</tr>

</table>

<div class="mt-3">

<a href="{{ route('admin.kelola') }}" class="btn btn-secondary">
Kembali
</a>

@if($data->status == 'menunggu')

<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSetujui">
Setujui
</button>

<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak">
Tolak
</button>

@endif

</div>

@else

<div class="alert alert-danger">
Data tidak ditemukan
</div>

@endif

</div>
</div>

</div>


<!-- MODAL SETUJUI -->

<div class="modal fade" id="modalSetujui" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Penjadwalan Kunjungan Pemohon</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="{{ route('admin.setujui',$data->nomor_permohonan) }}" method="POST">
@csrf

<div class="modal-body">

<div class="mb-3">
<label>Tanggal Kunjungan Final</label>
<input type="date" name="tanggal_kunjungan_final" class="form-control" required>
</div>

<div class="mb-3">
<label>Waktu Kunjungan</label>
<input type="text" name="waktu_kunjungan" class="form-control" placeholder="09:00 - 12:00">
</div>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
Batal
</button>

<button type="submit" class="btn btn-success">
Konfirmasi
</button>

</div>

</form>

</div>
</div>
</div>



<!-- MODAL TOLAK -->

<div class="modal fade" id="modalTolak" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Konfirmasi Penolakan</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="{{ route('admin.tolak',$data->nomor_permohonan) }}" method="POST">
@csrf

<div class="modal-body">

<div class="mb-3">
<label>Alasan Penolakan</label>
<textarea name="alasan_penolakan" class="form-control" required></textarea>
</div>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
Batal
</button>

<button type="submit" class="btn btn-danger">
Konfirmasi
</button>

</div>

</form>

</div>
</div>
</div>

@endsection