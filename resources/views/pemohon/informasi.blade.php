@extends('layouts.pemohon')

@section('content')

<style>

/* ===== BACKGROUND HALUS ===== */
body{
background:linear-gradient(180deg,#f6f9f8,#ffffff);
}

/* HERO INFORMASI PREMIUM */
.hero-informasi{
position:relative;
background:linear-gradient(135deg,#0b3d2e,#1f9b74);
padding:80px 20px;
text-align:center;
color:white;
overflow:hidden;
}

/* efek layer transparan */
.hero-informasi::before{
content:'';
position:absolute;
width:200%;
height:200%;
top:-50%;
left:-50%;
background:radial-gradient(circle, rgba(255,255,255,0.1), transparent 70%);
animation:rotateBg 12s linear infinite;
}

/* container isi */
.hero-content{
position:relative;
z-index:2;
max-width:900px;
margin:auto;
}

/* JUDUL */
.hero-informasi h1{
font-size:46px;
font-weight:900;
letter-spacing:4px;
line-height:1.3;
text-transform:uppercase;

background:linear-gradient(to bottom,#ffffff,#cfe9df);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

text-shadow:0 5px 25px rgba(0,0,0,0.4);

animation:fadeUp 1s ease;
}

/* SUBTITLE */
.hero-informasi p{
margin-top:15px;
font-size:20px;
opacity:.9;
animation:fadeUp 1.2s ease;
}

/* garis bawah elegan */
.hero-informasi h1::after{
content:'';
display:block;
width:120px;
height:5px;
background:white;
margin:18px auto 0;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

/* animasi */
@keyframes fadeUp{
from{
opacity:0;
transform:translateY(30px);
}
to{
opacity:1;
transform:translateY(0);
}
}

@keyframes rotateBg{
from{transform:rotate(0deg);}
to{transform:rotate(360deg);}
}

/* ===== DESKRIPSI ===== */
.info-box{
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 10px 30px rgba(0,0,0,0.06);
margin-top:30px;
transition:.4s;
animation:fadeUp 1s ease;
}

.info-box:hover{
transform:translateY(-5px);
box-shadow:0 15px 40px rgba(0,0,0,0.1);
}

.info-box p{
font-size:17px;
line-height:1.9;
text-align:justify;
}

/* ===== JENIS ===== */
.jenis-box{
display:flex;
flex-direction:column;
align-items:center;
margin:50px 0;
animation:fadeUp 1.2s ease;
}

.jenis-row{
display:flex;
gap:40px;
margin:10px 0;
}

.jenis-btn{
padding:12px 45px;
border-radius:10px;
font-weight:600;
background:white;
transition:.3s;
cursor:pointer;
}

.jenis-btn:hover{
transform:translateY(-6px) scale(1.05);
box-shadow:0 12px 25px rgba(0,0,0,0.12);
}

/* WARNA LEBIH HIDUP */
.video{border:2px solid #2563eb;}
.tekstual{border:2px solid #ec4899;}
.peta{border:2px solid #22c55e;}
.foto{border:2px solid #ef4444;}

.jenis-title{
background:linear-gradient(45deg,#7db7d8,#bcdff5);
padding:12px 40px;
border-radius:30px;
font-weight:600;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* ===== TATA ===== */
.tata-box{
border:2px solid #3dbd67;
padding:25px;
border-radius:10px;
margin-top:20px;
background:white;
box-shadow:0 8px 25px rgba(0,0,0,0.05);
animation:fadeUp 1.3s ease;
}

/* ===== ALUR ===== */
.alur-section{
margin-top:70px;
text-align:center;
animation:fadeUp 1.4s ease;
}

.alur-judul{
font-size:28px;
font-weight:700;
margin-bottom:10px;
color:#0f5d3f;
}

.alur-sub{
margin-bottom:35px;
}

/* GRID */
.alur-grid{
display:grid;
grid-template-columns: repeat(5, auto);
gap:15px;
justify-content:center;
align-items:center;
}

/* BOX */
.box{
padding:12px 25px;
border-radius:10px;
font-weight:600;
transition:.3s;
}

/* WARNA GRADIENT */
.form{background:linear-gradient(45deg,#fca5a5,#fecaca);}
.verifikasi{background:linear-gradient(45deg,#fde68a,#fef3c7);}
.jadwal{background:linear-gradient(45deg,#f9a8d4,#fbcfe8);}
.layanan{background:linear-gradient(45deg,#86efac,#bbf7d0);}
.selesai{background:linear-gradient(45deg,#93c5fd,#bfdbfe);}

/* HOVER */
.box:hover{
transform:scale(1.08);
box-shadow:0 12px 30px rgba(0,0,0,0.15);
}

/* PANAH */
.arrow{
font-size:26px;
font-weight:bold;
color:#166534;
animation:blink 1.5s infinite;
}

/* POSISI */
.form{grid-column:1;}
.arrow1{grid-column:2;}
.verifikasi{grid-column:3;}
.arrow2{grid-column:4;}
.jadwal{grid-column:5;}

.arrow3{grid-column:5; grid-row:2;}
.layanan{grid-column:5; grid-row:3;}

.arrow4{grid-column:5; grid-row:4;}
.selesai{grid-column:5; grid-row:5;}

/* ===== ANIMASI ===== */
@keyframes fadeUp{
from{opacity:0; transform:translateY(30px);}
to{opacity:1; transform:translateY(0);}
}

@keyframes fadeDown{
from{opacity:0; transform:translateY(-30px);}
to{opacity:1; transform:translateY(0);}
}

@keyframes blink{
0%,100%{opacity:1;}
50%{opacity:.4;}
}

</style>


<!-- ===== JUDUL ===== -->
<div class="hero-informasi">
    <div class="hero-content">
        <h1>Informasi Layanan Peminjaman Arsip Fisik</h1>
        <p>
            Layanan resmi untuk mendukung kebutuhan informasi, penelitian,
            dan administrasi secara profesional dan terintegrasi
        </p>
    </div>
</div>


<div class="container">

<!-- ===== DESKRIPSI ===== -->
<div class="info-box">

<p>
Layanan peminjaman arsip fisik merupakan layanan yang disediakan untuk mendukung kegiatan pendidikan, penelitian, dan administrasi. Pelaksanaan peminjaman arsip dilakukan sesuai ketentuan yang berlaku dan berada dalam pengawasan petugas arsip.
</p>

<p>
Layanan ini diselenggarakan untuk mendukung kebutuhan informasi penelitian dan administrasi dengan tetap memperhatikan ketentuan kearsipan, keamanan arsip, serta tata tertib penggunaan arsip sesuai peraturan yang berlaku.
</p>

</div>


<!-- ===== JENIS ===== -->
<div class="jenis-box">

<div class="jenis-row">
<button class="jenis-btn video">Video</button>
<span class="jenis-title">Jenis Arsip</span>
<button class="jenis-btn tekstual">Tekstual</button>
</div>

<div class="jenis-row">
<button class="jenis-btn peta">Peta</button>
<button class="jenis-btn foto">Foto</button>
</div>

</div>


<!-- ===== TATA ===== -->
<h5 class="text-center mt-4">
TATA TERTIB DI RUANG LAYANAN ARSIP / RUANG BACA
</h5>

<div class="tata-box">
<ol>
<li>Ruang baca khusus untuk membaca arsip atau referensi lainnya.</li>
<li>Pengguna dilarang membawa arsip keluar ruang baca.</li>
<li>Untuk menjaga kelestarian arsip, pengguna wajib memperlakukan arsip dengan hati-hati.</li>
<li>Pengguna bertanggung jawab atas bahan arsip yang sedang digunakan.</li>
<li>Pengguna tidak diperkenankan melakukan tindakan yang dapat merusak arsip.</li>
<li>Pengguna hanya diperkenankan membawa alat tulis di ruang baca.</li>
<li>Barang seperti tas dan map disimpan di tempat yang disediakan.</li>
<li>Pengguna tidak diperkenankan makan, minum, atau merokok di ruang baca.</li>
<li>Pengguna tidak diperkenankan membuat kegaduhan di ruang baca.</li>
</ol>
</div>


<!-- ===== ALUR ===== -->
<div class="alur-section">

<div class="alur-judul">
ALUR PEMINJAMAN
</div>

<div class="alur-sub">
Alur peminjaman arsip fisik dilaksanakan melalui tahapan sebagai berikut:
</div>

<div class="alur-grid">

<div class="box form">Mengisi Form</div>
<div class="arrow arrow1">→</div>
<div class="box verifikasi">Verifikasi Oleh Petugas</div>
<div class="arrow arrow2">→</div>
<div class="box jadwal">Penjadwalan Kunjungan</div>

<div class="arrow arrow3">↓</div>

<div class="box layanan">Pelayanan Arsip di Ruang Layanan</div>

<div class="arrow arrow4">↓</div>

<div class="box selesai">Selesai</div>

</div>

</div>

</div>

@endsection