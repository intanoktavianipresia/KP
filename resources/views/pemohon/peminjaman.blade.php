@extends('layouts.pemohon')

@section('content')

<style>

/* HERO */

.hero-peminjaman{
background:linear-gradient(90deg,#5aa86a,#e7e7e7);
padding:45px;
text-align:center;
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
background:#eeeeee;
border:6px solid #1f9b74;
border-radius:10px;
padding:35px;
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


/* NOTIFIKASI */

.alert-success{
background:#e7f7ef;
border-left:6px solid #1f9b74;
padding:15px;
font-weight:600;
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

{{-- NOTIFIKASI BERHASIL --}}
@if(session('success'))

<div class="alert alert-success mt-4">
{{ session('success') }}
</div>

@endif


{{-- ERROR VALIDASI --}}
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
penelitian, dan administrasi. Peminjaman arsip dilaksanakan sesuai ketentuan
yang berlaku dan digunakan di ruang layanan arsip yang telah ditetapkan.
</p>

<p style="font-weight:600;color:#0b5d3b">
Ingin melihat alur peminjaman arsip? 
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

<!-- SLIDE 1 -->

<div id="slide1">

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
<option value="">-- Pilih Jenis Kelamin --</option>
<option value="Laki-laki">Laki-laki</option>
<option value="Perempuan">Perempuan</option>
</select>

</div>


<div class="mb-3">
<label>Nomor Telepon / WhatsApp</label>
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

<div id="slide2" style="display:none">

<h5 class="mb-4">B. Data Peminjaman Arsip</h5>


<div class="mb-3">
<label>Arsip yang dipinjam</label>
<input type="text" name="arsip" class="form-control" required>
</div>


<div class="mb-3">
<label>Tujuan Peminjaman</label>
<textarea name="tujuan" class="form-control" required></textarea>
</div>


<div class="mb-3">
<label>Tanggal kunjungan yang diinginkan</label>
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
window.scrollTo(0,0);
}

function prevSlide(){
document.getElementById("slide1").style.display="block";
document.getElementById("slide2").style.display="none";
window.scrollTo(0,0);
}

</script>

@endsection