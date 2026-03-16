<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sistem Peminjaman Arsip</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>

@import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&display=swap');

body{
margin:0;
font-family:'Source Sans 3', sans-serif;
background:#f5f7f9;
color:#222;
}

/* HEADER */

.top-header{
background:#0b3d2e;
color:white;
padding:10px 0;
}

.header-inner{
display:flex;
align-items:center;
padding-left:25px;
}

.logo{
width:55px;
margin-right:15px;
}

.header-text strong{
font-size:18px;
letter-spacing:0.5px;
}

/* NAVBAR */

.navbar-custom{
background:#ffffff;
border-bottom:1px solid #e0e0e0;
}

.nav-inner{
padding-left:25px;
}

.navbar-custom .nav-link{
font-size:17px;
font-weight:600;
margin-right:25px;
color:#222 !important;
transition:0.2s;
}

.navbar-custom .nav-link:hover{
color:#0b3d2e !important;
transform:scale(1.05);
}

/* HERO */
.hero{
position:relative;
height:85vh;
background:url('{{ asset("images/gedung.png") }}') center/cover no-repeat;
display:flex;
align-items:center;
z-index:1;
}

.hero::before{
content:'';
position:absolute;
inset:0;
background:rgba(0,0,0,0.65);
z-index:-1;
}

.hero-content{
position:relative;
color:white;
max-width:750px;
}

.hero h1{
font-size:56px;
font-weight:700;
line-height:1.2;
}

.hero p{
font-size:22px;
line-height:1.9;
margin-top:20px;
}

.hero .btn{
margin-top:30px;
font-size:19px;
padding:14px 45px;
}

/* SECTION */
.section{
padding:85px 0;
}

.section-title{
text-align:center;
font-size:38px;
font-weight:700;
margin-bottom:55px;
color:#0b3d2e;
}

/* PARAGRAF */
.section p{
font-size:21px;
line-height:2;
text-align:justify;
}

/* CARD */
.card-modern{
background:white;
padding:45px;
border:1px solid #e0e0e0;
border-radius:8px;
transition:0.3s;
}

.card-modern:hover{
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.card-modern i{
font-size:46px;
color:#0b3d2e;
}

.card-modern h5{
font-size:24px;
font-weight:700;
margin-top:15px;
}

.card-modern p{
font-size:20px;
}

/* FOOTER */
.footer{
background:#0b3d2e;
color:white;
padding:50px 0;
}

.footer h6{
font-weight:600;
margin-bottom:15px;
}

.footer iframe{
border-radius:20px;
box-shadow:0 8px 25px rgba(0,0,0,0.3);
}

.copyright{
background:#0f5c3a;
color:white;
text-align:center;
padding:12px;
font-size:14px;
}

</style>
</head>

<body>

<!-- HEADER -->
<div class="top-header">
<div class="container d-flex align-items-center">

<img src="{{ asset('images/logo.png') }}" width="65" class="me-3">

<div>
<strong>DINAS PERPUSTAKAAN DAN KEARSIPAN</strong><br>
PROVINSI BENGKULU
</div>

</div>
</div>


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom">
<div class="container">

<ul class="navbar-nav">

<li class="nav-item">
<a class="nav-link" href="{{ url('/pemohon') }}">Beranda</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ url('/pemohon/informasi') }}">Informasi</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ url('/pemohon/peminjaman') }}">Peminjaman</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ url('/pemohon/status') }}">Status</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ url('/pemohon/kontak') }}">Kontak</a>
</li>

</ul>

</div>
</nav>


<!-- CONTENT HALAMAN -->
@yield('content')


<!-- FOOTER -->
<footer class="footer">
<div class="container">
<div class="row">

<div class="col-md-4 mb-4">

<img src="{{ asset('images/logo.png') }}" width="90">

<p class="mt-3">
DINAS PERPUSTAKAAN DAN KEARSIPAN<br>
PROVINSI BENGKULU
</p>

<h6>Jam Operasional</h6>

<p>
Senin - Kamis : 07.45 - 16.15<br>
Jumat : 07.45 - 16.45<br>
Libur Nasional Tutup
</p>

</div>


<div class="col-md-4 mb-4">

<h6>Kontak</h6>

<p>
Jl. Mahoni No.12, Padang Jati,<br>
Kec. Ratu Samban, Kota Bengkulu<br>
Bengkulu 38222<br><br>

Telp: 0736 26095
</p>

</div>


<div class="col-md-4">

<h6>Lokasi</h6>

<iframe
src="https://www.google.com/maps?q=Dinas+Perpustakaan+dan+Kearsipan+Provinsi+Bengkulu&hl=id&z=16&output=embed"
width="100%"
height="230"
style="border:0;"
loading="lazy">
</iframe>

</div>

</div>
</div>
</footer>


<div class="copyright">
© 2026 Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init({
duration:1000,
once:true
});
</script>

</body>
</html>