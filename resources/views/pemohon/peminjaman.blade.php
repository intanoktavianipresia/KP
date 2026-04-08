@extends('layouts.pemohon')

@section('content')

<style>

/* ===== HERO PREMIUM ===== */
.hero-peminjaman{
position:relative;
background:linear-gradient(135deg,#0b3d2e,#1f9b74);
padding:80px 20px;
text-align:center;
color:white;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.2);
animation:fadeDown .8s ease;
}

.hero-peminjaman::before{
content:'';
position:absolute;
width:200%;
height:200%;
top:-50%;
left:-50%;
background:radial-gradient(circle, rgba(255,255,255,0.1), transparent 70%);
animation:rotateBg 12s linear infinite;
}

.hero-peminjaman h2{
font-size:40px;
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

.hero-peminjaman p{
font-size:18px;
margin-top:10px;
opacity:.9;
position:relative;
z-index:2;
}

/* ===== FORM ===== */
.form-wrapper{
margin-top:50px;
position:relative;
animation:fadeUp .8s ease;
}

.form-header{
position:absolute;
top:-18px;
left:25px;
background:#1f9b74;
color:white;
padding:8px 25px;
border-radius:12px;
font-weight:600;
letter-spacing:2px;
}

.form-box{
background:#ffffff;
border:5px solid #1f9b74;
border-radius:15px;
padding:35px;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* INPUT */
.form-control{
border-radius:20px;
height:45px;
}

textarea.form-control{
height:90px;
}

/* BUTTON */
.btn-next{
background:#0d5e43;
color:white;
border:none;
padding:10px 35px;
border-radius:25px;
font-weight:600;
}

.btn-back{
background:#777;
color:white;
border:none;
padding:10px 30px;
border-radius:25px;
font-weight:600;
}

/* STEP */
.step-indicator{
display:flex;
justify-content:center;
margin-bottom:25px;
gap:15px;
}

.step{
width:35px;
height:35px;
border-radius:50%;
background:#ccc;
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
color:white;
}

.step.active{
background:#1f9b74;
}

/* ALERT */
.alert-success{
background:#e7f7ef;
border-left:6px solid #1f9b74;
padding:15px;
font-weight:600;
}

/* ANIMASI */
@keyframes fadeUp{
from{opacity:0; transform:translateY(20px);}
to{opacity:1; transform:translateY(0);}
}

@keyframes fadeDown{
from{opacity:0; transform:translateY(-20px);}
to{opacity:1; transform:translateY(0);}
}

@keyframes rotateBg{
from{transform:rotate(0deg);}
to{transform:rotate(360deg);}
}

.slide{
animation:fadeUp .4s ease;
}

</style>


<!-- HERO -->
<div class="hero-peminjaman">
<h2>PEMINJAMAN ARSIP FISIK</h2>
<p>Layanan Peminjaman Arsip Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>
</div>


<div class="container">

@if(session('success'))
<div class="alert alert-success mt-4">

<h5>✅ Permohonan Berhasil Dikirim!</h5>

<p>{{ session('success') }}</p>

<hr>

<div style="color:#842029;font-weight:600;">
⚠️ Harap simpan <b>Nomor Permohonan</b> ini dengan baik!
</div>

<small>Nomor hanya muncul sekali dan digunakan untuk cek status.</small>

</div>
@endif


@if ($errors->any())
<div class="alert alert-danger mt-3">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif


<form action="{{ url('/pemohon/peminjaman/simpan') }}" method="POST">
@csrf

<div class="form-wrapper">

<div class="form-header">
FORM PEMINJAMAN ARSIP
</div>

<div class="form-box">

<div class="step-indicator">
<div class="step active" id="step1">1</div>
<div class="step" id="step2">2</div>
</div>


<!-- SLIDE 1 -->
<div id="slide1" class="slide">

<h5 class="mb-4">A. Data Pemohon</h5>

<input type="text" name="nama" class="form-control mb-3" placeholder="Nama Lengkap" required>
<input type="text" name="alamat" class="form-control mb-3" placeholder="Alamat" required>

<select name="jenis_kelamin" class="form-control mb-3" required>
<option value="">-- Jenis Kelamin --</option>
<option value="Laki-laki">Laki-laki</option>
<option value="Perempuan">Perempuan</option>
</select>

<input type="text" name="telepon" class="form-control mb-3" placeholder="No HP / WA" required>
<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<div class="text-center mt-4">
<button type="button" onclick="nextSlide()" class="btn-next">
Selanjutnya
</button>
</div>

</div>


<!-- SLIDE 2 -->
<div id="slide2" style="display:none" class="slide">

<h5 class="mb-4">B. Data Peminjaman</h5>

<input type="text" name="arsip" class="form-control mb-3" placeholder="Arsip" required>

<textarea name="tujuan" class="form-control mb-3" placeholder="Tujuan" required></textarea>

<!-- 🔥 BAGIAN YANG DIPERBAIKI -->
<div class="mb-3">

<label style="font-weight:600;color:#0b5d3b;">
Tanggal Kunjungan yang Diinginkan
</label>

<input type="date"
name="tanggal_kunjungan"
class="form-control"
min="{{ date('Y-m-d') }}"
required>

<small style="color:#6c757d;">
Silakan pilih tanggal kedatangan Anda ke Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu.
Permohonan akan diproses sesuai ketersediaan jadwal layanan.
</small>

</div>

<div class="text-center mt-4">
<button type="button" onclick="prevSlide()" class="btn-back">
Kembali
</button>

<button type="submit" class="btn-next">
Kirim Permohonan
</button>
</div>

</div>

</div>
</div>

</form>

</div>


<script>
function nextSlide(){
document.getElementById("slide1").style.display="none";
document.getElementById("slide2").style.display="block";

document.getElementById("step1").classList.remove("active");
document.getElementById("step2").classList.add("active");

window.scrollTo({top:0,behavior:'smooth'});
}

function prevSlide(){
document.getElementById("slide1").style.display="block";
document.getElementById("slide2").style.display="none";

document.getElementById("step1").classList.add("active");
document.getElementById("step2").classList.remove("active");

window.scrollTo({top:0,behavior:'smooth'});
}
</script>

@endsection