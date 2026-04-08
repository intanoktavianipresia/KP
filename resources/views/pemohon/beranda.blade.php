@extends('layouts.pemohon')

@section('content')

<!-- HERO -->
<section class="hero">
<div class="container">
<div class="hero-content" data-aos="fade-right">
<h1>Sistem Peminjaman Arsip Fisik</h1>
<p>
Layanan resmi pengajuan peminjaman arsip secara daring yang diselenggarakan oleh Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu guna meningkatkan efektivitas pelayanan, transparansi proses verifikasi, serta akuntabilitas tata kelola kearsipan daerah.
</p>
<a href="{{ url('/pemohon/peminjaman') }}" class="btn btn-success">
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

@endsection