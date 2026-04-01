@extends('layouts.admin')

@section('content')

<div class="container">

<!-- ===== JUDUL ===== -->
<div class="mb-4">
    <h3 class="fw-bold">Laporan Data Permohonan</h3>
    <p class="text-muted">Data seluruh permohonan peminjaman arsip</p>
</div>


<!-- ===== DATA PERMOHONAN ===== -->
<div class="card shadow-sm mb-5">
<div class="card-body">

<h5 class="mb-3">Data Permohonan</h5>

<table class="table table-bordered table-hover">

<thead class="table-light text-center">
<tr>
<th style="width:60px;">No</th>
<th>Nama</th>
<th>Arsip</th>
<th>Status</th>
<th style="width:120px;">Tanggal</th>
</tr>
</thead>

<tbody>
@foreach($data as $key => $d)
<tr>
<td class="text-center">{{ $key+1 }}</td>
<td>{{ $d->nama_pemohon }}</td>
<td>{{ $d->arsip_dimohon }}</td>
<td class="text-center">

    @if($d->status == 'menunggu')
        <span class="badge bg-warning text-dark">Menunggu</span>
    @elseif($d->status == 'disetujui')
        <span class="badge bg-success">Disetujui</span>
    @elseif($d->status == 'ditolak')
        <span class="badge bg-danger">Ditolak</span>
    @else
        <span class="badge bg-secondary">Selesai</span>
    @endif

</td>
<td class="text-center">
    {{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y') }}
</td>
</tr>
@endforeach
</tbody>

</table>

</div>
</div>


<hr class="mb-5">


<!-- ===== PESAN MASUK ===== -->
<div class="mb-3">
    <h3 class="fw-bold">Pesan Masuk</h3>
    <p class="text-muted">Pesan dari halaman kontak pengguna</p>
</div>

<div class="card shadow-sm">
<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-success text-center">
<tr>
<th style="width:60px;">No</th>
<th style="width:150px;">Nama</th>
<th style="width:200px;">Email</th>
<th>Pesan</th>
<th style="width:150px;">Waktu</th>
<th style="width:120px;">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($kontak as $k => $c)
<tr>
<td class="text-center">{{ $k+1 }}</td>

<td>{{ $c->nama }}</td>

<td>{{ $c->email }}</td>

<td style="text-align:left; max-width:400px;">
    {{ $c->pesan }}
</td>

<td class="text-center">
    {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y H:i') }}
</td>

<td class="text-center">

@if(!$c->balasan)

    <!-- BELUM DIBALAS -->
    <button class="btn btn-sm btn-success btn-balas"
        data-id="{{ $c->id }}"
        data-email="{{ $c->email }}">
        Balas
    </button>

@else

    <!-- SUDAH DIBALAS -->
    <span class="badge bg-success">
        ✔ Sudah Dibalas
    </span>

@endif

</td>

</tr>

@empty
<tr>
<td colspan="6" class="text-center text-muted">
Belum ada pesan masuk
</td>
</tr>
@endforelse

</tbody>

</table>

</div>
</div>

</div>


<!-- ✅ MODAL (CUMA 1, FIX DUPLIKAT) -->
<div class="modal fade" id="modalBalas">
<div class="modal-dialog">
<div class="modal-content">

<form id="formBalas" method="POST">
@csrf

<div class="modal-header">
<h5 class="fw-bold">Balas Pesan</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<div class="mb-2">
<strong>Kepada:</strong><br>
<span id="emailTujuan" class="text-muted"></span>
</div>

<textarea name="balasan"
class="form-control"
rows="4"
placeholder="Tulis balasan..."
required></textarea>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
Batal
</button>

<button type="submit" class="btn btn-success">
Kirim Balasan
</button>

</div>

</form>

</div>
</div>
</div>


<!-- ✅ SCRIPT FIX ANTI KELAP-KELIP -->
<script>
document.querySelectorAll('.btn-balas').forEach(btn => {
    btn.addEventListener('click', function(){

        let id = this.dataset.id;
        let email = this.dataset.email;

        document.getElementById('emailTujuan').innerText = email;
        document.getElementById('formBalas').action = "/admin/balas/" + id;

        let modal = new bootstrap.Modal(document.getElementById('modalBalas'));
        modal.show();
    });
});
</script>

@endsection