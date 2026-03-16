<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Status Peminjaman Arsip</title>

<style>

body{
font-family: Arial;
margin:0;
background:#f4f4f4;
}

/* HEADER */

.header{
background:#0f5f3a;
color:white;
padding:15px;
}

.header h2{
margin:0;
font-size:18px;
}

/* NAVBAR */

.nav{
background:#f1f1f1;
padding:10px;
}

.nav a{
margin-right:20px;
text-decoration:none;
color:black;
font-size:14px;
}

.nav a.active{
font-weight:bold;
}

/* BANNER */

.banner{
background:#7fbf8f;
padding:30px;
text-align:center;
}

.banner h1{
font-size:20px;
margin-bottom:5px;
}

/* CONTAINER */

.container{
display:flex;
gap:30px;
padding:30px;
}

/* CEK STATUS */

.cek-box{
background:#e6e6e6;
padding:20px;
border-radius:10px;
width:320px;
border:4px solid #0f5f3a;
}

.cek-box input{
width:100%;
padding:8px;
margin-bottom:10px;
border-radius:5px;
border:1px solid #ccc;
}

.btn{
background:#0f5f3a;
color:white;
padding:8px 15px;
border:none;
border-radius:20px;
cursor:pointer;
}

/* STATUS */

.status-box{
background:white;
padding:20px;
border-radius:8px;
border:1px solid #ccc;
width:350px;
}

.status-box h3{
margin-top:0;
}

.status-info{
background:#e9f1e8;
padding:10px;
margin-bottom:15px;
font-size:14px;
}

.status-approve{
color:green;
font-weight:bold;
}

.status-tolak{
color:red;
font-weight:bold;
}

.status-menunggu{
color:orange;
font-weight:bold;
}

/* RIWAYAT */

.history{
padding:0 30px 30px;
}

table{
border-collapse:collapse;
width:500px;
}

th{
background:#5da56a;
color:white;
padding:10px;
}

td{
padding:10px;
border:1px solid #ccc;
font-size:14px;
}

.tag{
padding:4px 10px;
border-radius:5px;
font-size:12px;
}

.tag1{background:#e6e4a9;}
.tag2{background:#bde1e6;}
.tag3{background:#a7e3b4;}
.tag4{background:#b6d3f0;}
.tag5{background:#f2a7a7;}

/* FOOTER */

.footer{
background:#3f7755;
color:white;
padding:25px;
margin-top:30px;
font-size:13px;
}

</style>
</head>


<body>

<!-- HEADER -->

<div class="header">
<h2>DINAS PERPUSTAKAAN DAN KEARSIPAN PROVINSI BENGKULU</h2>
</div>

<!-- NAVBAR -->

<div class="nav">
<a href="/pemohon">Beranda</a>
<a href="/pemohon/informasi">Informasi</a>
<a href="/pemohon/peminjaman">Peminjaman</a>
<a href="/pemohon/status" class="active">Status</a>
<a href="/pemohon/kontak">Kontak</a>
</div>

<!-- BANNER -->

<div class="banner">
<h1>STATUS PEMINJAMAN ARSIP FISIK</h1>
<p>Informasi perkembangan permohonan peminjaman arsip fisik</p>
</div>


<!-- FORM + STATUS -->

<div class="container">

<!-- CEK STATUS -->

<div class="cek-box">

<h3>Cek Status Permohonan</h3>

<form method="POST" action="/pemohon/status/cek">
@csrf

<label>Nomor Permohonan</label>
<input type="text" name="nomor_permohonan" placeholder="PRM-123456">

<label>Alamat Email</label>
<input type="email" name="email" placeholder="email@gmail.com">

<button class="btn">Cek Status</button>

</form>

</div>



<!-- STATUS PERMOHONAN -->

<div class="status-box">

<h3>Status Permohonan</h3>

@if(isset($data))

<div class="status-info">

<p><b>Nomor Permohonan :</b> {{ $data->nomor_permohonan }}</p>
<p><b>Nama Pemohon :</b> {{ $data->nama_pemohon }}</p>
<p><b>Tanggal Pengajuan :</b> {{ date('d-m-Y', strtotime($data->created_at)) }}</p>
<p><b>Arsip Yang Dimohon :</b> {{ $data->arsip_dimohon }}</p>

</div>


@if($data->status == 'menunggu')

<p class="status-menunggu">⏳ Menunggu Persetujuan</p>

<p>
Permohonan sedang diperiksa oleh admin.<br>
Silakan cek kembali beberapa waktu lagi.
</p>

@endif


@if($data->status == 'disetujui')

<p class="status-approve">✔ Disetujui</p>

<p>Permohonan peminjaman arsip disetujui.</p>

<p>
<b>Jadwal Kunjungan :</b><br>
Tanggal : {{ $data->tanggal_kunjungan ?? '-' }}<br>
Waktu : {{ $data->waktu_kunjungan ?? '-' }}<br>
Tempat : Ruang Pelayanan Arsip
</p>

@endif



@if($data->status == 'ditolak')

<p class="status-tolak">✖ Ditolak</p>

<p>
Permohonan peminjaman arsip tidak dapat diproses.<br>
Alasan : {{ $data->alasan ?? 'Tidak memenuhi ketentuan' }}
</p>

@endif

@else

<p>Silakan masukkan nomor permohonan untuk melihat status.</p>

@endif

</div>

</div>


<!-- RIWAYAT STATUS -->

<div class="history">

<h3>Riwayat Status Permohonan</h3>

<table>

<tr>
<th>Tanggal</th>
<th>Status</th>
<th>Keterangan</th>
</tr>

<tr>
<td>10/01/2026</td>
<td><span class="tag tag1">Diajukan</span></td>
<td>Permohonan diterima oleh sistem</td>
</tr>

<tr>
<td>11/01/2026</td>
<td><span class="tag tag2">Diverifikasi</span></td>
<td>Admin memverifikasi permohonan</td>
</tr>

<tr>
<td>12/01/2026</td>
<td><span class="tag tag3">Disetujui</span></td>
<td>Permohonan disetujui</td>
</tr>

<tr>
<td>12/01/2026</td>
<td><span class="tag tag4">Selesai</span></td>
<td>Peminjaman arsip selesai</td>
</tr>

</table>

</div>


<!-- FOOTER -->

<div class="footer">

<b>DINAS PERPUSTAKAAN DAN KEARSIPAN PROVINSI BENGKULU</b>

<br><br>

Jam Operasional  
Senin - Kamis : 7.45 - 16.15  
Jumat : 7.45 - 16.45  

<br><br>

Jl. Mahoni No.12 Padang Jati Kota Bengkulu  
Telp : 0736 26095

</div>

</body>
</html>