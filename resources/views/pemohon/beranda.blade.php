<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Beranda Pemohon</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>

/* ================= FONT RESMI INSTANSI ================= */
@import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&display=swap');

body{
    margin:0;
    font-family:'Source Sans 3', sans-serif;
    background:#f5f7f9;
    color:#222;
}

/* ================= HEADER ================= */
.top-header{
    background:#0b3d2e;
    color:#fff;
    padding:20px 0;
}
.top-header strong{
    font-size:21px;
    letter-spacing:0.5px;
}

/* ================= NAVBAR ================= */
.navbar-custom{
    background:#ffffff;
    border-bottom:1px solid #e0e0e0;
}
.navbar-custom .nav-link{
    font-size:18px;
    font-weight:600;
    margin-right:25px;
    color:#222 !important;
}
.navbar-custom .nav-link:hover{
    color:#0b3d2e !important;
}

/* ================= HERO ================= */
.hero{
    position:relative;
    height:85vh;
    z-index:1;
    background:url('{{ asset("images/gedung.png") }}') center/cover no-repeat;
    display:flex;
    align-items:center;
}
.hero::before{
    content:'';
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.65);
    pointer-events:none;
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

/* ================= SECTION ================= */
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

/* ================= PARAGRAF ================= */
.section p{
    font-size:21px;
    line-height:2;
    text-align:justify;
}

/* ================= VISI MISI ================= */
.vm-box{
    background:#ffffff;
    padding:45px;
    border:1px solid #e0e0e0;
    border-radius:8px;
}
.vm-box h5{
    font-size:25px;
    font-weight:700;
    margin-bottom:20px;
}
.vm-box ul{
    font-size:20px;
    line-height:1.9;
}

/* ================= CARD LAYANAN ================= */
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

/* ================= FAQ ================= */
.accordion-button{
    font-size:20px;
    font-weight:600;
}
.accordion-body{
    font-size:19px;
    line-height:1.9;
}

/* ================= FOOTER ================= */
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
<div class="navbar-nav">

<a class="nav-link" href="{{ route('pemohon.beranda') }}">Beranda</a>

<a class="nav-link" href="{{ route('pemohon.informasi') }}">Informasi</a>

<a class="nav-link" href="{{ route('pemohon.peminjaman') }}">Peminjaman</a>

<a class="nav-link" href="{{ route('pemohon.status') }}">Status</a>

<a class="nav-link" href="{{ route('pemohon.kontak') }}">Kontak</a>

</div>
</div>
</nav>

<!-- HERO -->
<section class="hero">
<div class="container">
<div class="hero-content" data-aos="fade-right">
<h1>Sistem Peminjaman Arsip Fisik</h1>
<p>
Layanan resmi pengajuan peminjaman arsip secara daring yang diselenggarakan oleh Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu guna meningkatkan efektivitas pelayanan, transparansi proses verifikasi, serta akuntabilitas tata kelola kearsipan daerah.
</p>
<a href="#" class="btn btn-success">
Ajukan Permohonan <i class="bi bi-arrow-right"></i>
</a>
</div>
</div>
</section>

<!-- PROFIL -->
<section class="section bg-light" data-aos="fade-up">
<div class="container">
<h3 class="section-title">Profil Instansi</h3>
<p>
Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu merupakan perangkat daerah yang menyelenggarakan urusan pemerintahan di bidang perpustakaan dan kearsipan sesuai dengan ketentuan peraturan perundang-undangan.
</p>
<p style="margin-top:25px;">
Pengembangan Sistem Peminjaman Arsip Fisik ini merupakan bagian dari transformasi pelayanan publik berbasis teknologi informasi.
</p>
</div>
</section>

<!-- VISI MISI -->
<section class="section" data-aos="fade-up">
<div class="container">
<h3 class="section-title">Visi dan Misi</h3>
<div class="row g-4">
<div class="col-md-6">
<div class="vm-box">
<h5>Visi</h5>
<p>Mewujudkan penyelenggaraan layanan kearsipan yang profesional, modern, dan berintegritas.</p>
</div>
</div>
<div class="col-md-6">
<div class="vm-box">
<h5>Misi</h5>
<ul>
<li>Meningkatkan kualitas pelayanan arsip kepada masyarakat.</li>
<li>Mengembangkan sistem digital dalam pengelolaan kearsipan.</li>
<li>Mewujudkan tata kelola arsip yang transparan dan akuntabel.</li>
</ul>
</div>
</div>
</div>
</div>
</section>

<!-- LAYANAN -->
<section class="section bg-light" data-aos="zoom-in">
<div class="container">
<h3 class="section-title">Layanan Utama</h3>
<div class="row g-4">

<div class="col-md-4">
<div class="card-modern text-center">
<i class="bi bi-folder2-open"></i>
<h5>Informasi Arsip</h5>
<p>Penyediaan informasi mengenai daftar arsip fisik yang tersedia untuk layanan peminjaman.</p>
</div>
</div>

<div class="col-md-4">
<div class="card-modern text-center">
<i class="bi bi-journal-check"></i>
<h5>Prosedur Resmi</h5>
<p>Panduan dan tahapan pengajuan permohonan sesuai ketentuan yang berlaku.</p>
</div>
</div>

<div class="col-md-4">
<div class="card-modern text-center">
<i class="bi bi-laptop"></i>
<h5>Pengajuan Online</h5>
<p>Fasilitas pengajuan permohonan secara daring untuk kemudahan akses layanan.</p>
</div>
</div>

</div>
</div>
</section>

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