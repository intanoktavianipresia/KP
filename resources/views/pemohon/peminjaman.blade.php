@extends('layouts.pemohon')

@section('content')

<style>

/* HERO */
.hero-peminjaman{
background:linear-gradient(90deg,#5aa86a,#e7e7e7);
padding:45px;
text-align:center;
animation:fadeDown .8s ease;
}

.hero-peminjaman h2{
font-weight:700;
letter-spacing:4px;
}

.hero-peminjaman p{
font-size:18px;
}


/* FORM WRAPPER */
.form-wrapper{
margin-top:40px;
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
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-box{
background:#eeeeee;
border:6px solid #1f9b74;
border-radius:10px;
padding:35px;
transition:0.3s;
}


/* INPUT */
.form-control{
border-radius:20px;
height:45px;
transition:0.25s;
}

.form-control:focus{
border-color:#1f9b74;
box-shadow:0 0 0 0.2rem rgba(31,155,116,0.2);
transform:scale(1.01);
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
transition:0.3s;
}

.btn-next:hover{
transform:translateY(-2px);
box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

.btn-back{
background:#777;
color:white;
border:none;
padding:10px 30px;
border-radius:25px;
font-weight:600;
transition:0.3s;
}

.btn-back:hover{
transform:translateY(-2px);
}


/* PROGRESS STEP */
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
box-shadow:0 0 10px rgba(31,155,116,0.6);
}


/* NOTIFIKASI */
.alert-success{
background:#e7f7ef;
border-left:6px solid #1f9b74;
padding:15px;
font-weight:600;
animation:fadeUp .5s ease;
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

.slide{
animation:fadeUp .4s ease;
}

</style>


<!-- HERO -->
<div class="hero-peminjaman">
<h2>PEMINJAMAN ARSIP FISIK</h2>
<p>
Layanan Peminjaman Arsip Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu
</p>
</div>


<div class="container">

@if(session('success'))

<div class="alert alert-success mt-4" style="border-left:6px solid #198754;">

    <h5 class="mb-2">✅ Permohonan Berhasil Dikirim!</h5>

    <p class="mb-2">
        {{ session('success') }}
    </p>

    <hr>

    <!-- ⚠️ WARNING -->
    <div style="color:#842029; font-weight:600;">
        ⚠️ Harap simpan <b>Nomor Permohonan</b> ini dengan baik!
    </div>

    <small class="text-muted">
        Nomor ini hanya ditampilkan sekali dan digunakan untuk mengecek status permohonan Anda.
    </small>

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


<p class="mt-4">
Layanan peminjaman arsip fisik disediakan untuk mendukung kebutuhan informasi,
penelitian, dan administrasi.
</p>

<p style="font-weight:600;color:#0b5d3b">
<a href="{{ url('/pemohon/informasi#alur-peminjaman') }}">
Klik di sini untuk melihat alur peminjaman
</a>
</p>


<form action="{{ url('/pemohon/peminjaman/simpan') }}" method="POST">
@csrf

<div class="form-wrapper">

<div class="form-header">
FORM PEMINJAMAN ARSIP
</div>

<div class="form-box">

<!-- STEP INDICATOR -->
<div class="step-indicator">
<div class="step active" id="step1">1</div>
<div class="step" id="step2">2</div>
</div>


<!-- SLIDE 1 -->
<div id="slide1" class="slide">

<h5 class="mb-4">A. Data Pemohon</h5>

<div class="mb-3">
<label>Nama Lengkap</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>Alamat</label>
<input type="text" name="alamat" class="form-control" required>
</div>

<div class="mb-3">
<label>Jenis Kelamin</label>
<select name="jenis_kelamin" class="form-control" required>
<option value="">-- Pilih --</option>
<option value="Laki-laki">Laki-laki</option>
<option value="Perempuan">Perempuan</option>
</select>
</div>

<div class="mb-3">
<label>No HP / WA</label>
<input type="text" name="telepon" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="text-center mt-4">
<button type="button" onclick="nextSlide()" class="btn-next">
Selanjutnya
</button>
</div>

</div>


<!-- SLIDE 2 -->
<div id="slide2" style="display:none" class="slide">

<h5 class="mb-4">B. Data Peminjaman</h5>

<div class="mb-3">
<label>Arsip</label>
<input type="text" name="arsip" class="form-control" required>
</div>

<div class="mb-3">
<label>Tujuan</label>
<textarea name="tujuan" class="form-control" required></textarea>
</div>

<div class="mb-3">
<label>Tanggal Kunjungan</label>
<input type="date" name="tanggal_kunjungan" class="form-control" required>
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