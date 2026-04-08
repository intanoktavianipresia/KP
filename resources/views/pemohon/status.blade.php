@extends('layouts.pemohon')

@section('content')

<style>

/* ===== HERO PREMIUM ===== */
.banner{
position:relative;
background:linear-gradient(135deg,#0b3d2e,#1f9b74);
padding:80px 20px;
text-align:center;
color:white;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.banner::before{
content:'';
position:absolute;
width:200%;
height:200%;
top:-50%;
left:-50%;
background:radial-gradient(circle, rgba(255,255,255,0.1), transparent 70%);
animation:rotateBg 12s linear infinite;
}

.banner h1{
font-size:42px;
font-weight:900;
letter-spacing:4px;
text-transform:uppercase;

background:linear-gradient(to bottom,#ffffff,#cfe9df);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

text-shadow:0 5px 25px rgba(0,0,0,0.4);
position:relative;
z-index:2;
}

.banner p{
opacity:.9;
margin-top:10px;
font-size:18px;
position:relative;
z-index:2;
}

/* ===== CONTAINER ===== */
.container-status{
display:flex;
gap:30px;
padding:50px 0;
flex-wrap:wrap;
justify-content:center;
}

/* ===== FORM ===== */
.cek-box{
background:#ffffff;
padding:25px;
border-radius:15px;
width:320px;
box-shadow:0 10px 25px rgba(0,0,0,0.08);
transition:.3s;
}

.cek-box:hover{
transform:translateY(-5px);
}

.cek-box input{
width:100%;
padding:12px;
margin-bottom:12px;
border-radius:10px;
border:1px solid #ccc;
}

/* ===== BUTTON ===== */
.btn{
background:#0b3d2e;
color:white;
padding:12px;
border:none;
border-radius:25px;
cursor:pointer;
width:100%;
font-weight:600;
transition:.3s;
}

.btn:hover{
background:#198754;
transform:translateY(-2px);
}

/* ===== STATUS BOX ===== */
.status-box{
background:white;
padding:25px;
border-radius:15px;
border:1px solid #eee;
width:350px;
box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* ===== STATUS BADGE ===== */
.status-menunggu{color:#ff9800;font-weight:bold;}
.status-approve{color:#198754;font-weight:bold;}
.status-tolak{color:#dc3545;font-weight:bold;}
.status-selesai{color:#0d6efd;font-weight:bold;}

/* ===== ALERT ===== */
.alert{
padding:12px;
border-radius:8px;
margin-top:10px;
}
.alert-error{
background:#f8d7da;
color:#721c24;
}

/* ===== RIWAYAT ===== */
.history{
padding:20px 0 50px;
}

.history h3{
margin-bottom:20px;
text-align:center;
}

.history-item{
background:white;
padding:15px;
margin-bottom:12px;
border-left:5px solid #1f9b74;
border-radius:8px;
box-shadow:0 5px 15px rgba(0,0,0,0.05);
transition:.3s;
}

.history-item:hover{
transform:translateX(5px);
}

/* ===== ANIMASI ===== */
@keyframes rotateBg{
from{transform:rotate(0deg);}
to{transform:rotate(360deg);}
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
.container-status{
flex-direction:column;
align-items:center;
}
}

</style>


<!-- HERO -->
<div class="banner">
<h1>STATUS PEMINJAMAN ARSIP</h1>
<p>Cek perkembangan permohonan Anda secara real-time</p>
</div>


<div class="container">

<div class="container-status">

<!-- FORM -->
<div class="cek-box">

<h4 class="fw-bold">Cek Status</h4>

<p style="font-size:13px;color:#0f5f3a;">
Gunakan nomor permohonan yang Anda terima
</p>

<form method="POST" action="/pemohon/status/cek">
@csrf

<input type="text" name="nomor" placeholder="Contoh: PNM-JK-001/03/2026" required>

<button class="btn">Cek Status</button>

</form>

@if(session('warning'))
<div class="alert alert-error">
{{ session('warning') }}
</div>
@endif

</div>


<!-- HASIL -->
<div class="status-box">

@if(!empty($data))

<h4 class="fw-bold mb-3">Status Permohonan</h4>

<p><b>Nomor:</b> {{ $data->nomor_permohonan }}</p>
<p><b>Nama:</b> {{ $data->nama_pemohon }}</p>
<p><b>Tanggal:</b> {{ date('d-m-Y', strtotime($data->created_at)) }}</p>

<hr>

@if($data->status == 'menunggu')
<p class="status-menunggu">⏳ Menunggu Persetujuan</p>
@endif

@if($data->status == 'disetujui')
<p class="status-approve">✔ Disetujui</p>
@endif

@if($data->status == 'ditolak')
<p class="status-tolak">✖ Ditolak</p>
@endif

@if($data->status == 'selesai')
<p class="status-selesai">✔ Selesai</p>
@endif

@else
<p class="text-muted">Silakan masukkan nomor permohonan.</p>
@endif

</div>

</div>

</div>


<!-- RIWAYAT -->
@if(!empty($riwayat) && count($riwayat) > 0)

<div class="container history">

<h3 class="fw-bold">Riwayat Permohonan</h3>

@foreach($riwayat as $r)

<div class="history-item">

<b>{{ strtoupper($r->status) }}</b><br>

{{ $r->catatan }}<br>

<small>{{ date('d-m-Y H:i', strtotime($r->created_at)) }}</small>

</div>

@endforeach

</div>

@endif

@endsection