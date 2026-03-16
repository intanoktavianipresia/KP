@extends('layouts.pemohon')

@section('content')

<style>

/* ===== JUDUL HALAMAN ===== */

.judul-informasi{
background:linear-gradient(90deg,#4fa46a,#e7e7e7);
padding:40px;
text-align:center;
font-weight:700;
letter-spacing:3px;
font-size:28px;
}

/* ===== PARAGRAF ===== */

.info-text{
padding:30px;
font-size:17px;
line-height:1.8;
}

/* ===== JENIS ARSIP ===== */

.jenis-box{
text-align:center;
margin:30px 0;
}

.jenis-btn{
padding:10px 40px;
border-radius:8px;
font-weight:600;
background:white;
}

.video{border:2px solid #2c5cff;}
.tekstual{border:2px solid #ff2cab;}
.peta{border:2px solid #20c933;}
.foto{border:2px solid #ff2c2c;}

.jenis-title{
background:#9bc2d9;
padding:10px 35px;
border-radius:30px;
display:inline-block;
margin:20px;
font-weight:600;
}

/* ===== TATA TERTIB ===== */

.tata-box{
border:2px solid #3dbd67;
padding:25px;
border-radius:8px;
margin-top:20px;
}

.tata-box ol{
line-height:1.7;
}

/* ===== ALUR ===== */

.alur-section{
text-align:center;
margin-top:40px;
}

.alur-title{
border:2px solid #333;
display:inline-block;
padding:8px 30px;
border-radius:30px;
margin:20px;
}

.alur-btn{
padding:8px 20px;
border-radius:6px;
margin:10px;
font-weight:600;
display:inline-block;
}

.form{background:#f4b2b2;}
.verifikasi{background:#e7e68d;}
.jadwal{background:#f3a6df;}
.layanan{background:#9fdb8a;}
.selesai{background:#9cc2df;}
<div id="alur-peminjaman">

<h2 class="section-title">
ALUR PEMINJAMAN ARSIP
</h2>

</div>

</style>


<!-- ===== JUDUL ===== -->

<div class="judul-informasi">
INFORMASI LAYANAN PEMINJAMAN ARSIP FISIK
</div>


<!-- ===== DESKRIPSI ===== -->

<div class="container info-text">

<p>
Layanan peminjaman arsip fisik merupakan layanan yang disediakan untuk mendukung kegiatan pendidikan, penelitian, dan administrasi. Pelaksanaan peminjaman arsip dilakukan sesuai ketentuan yang berlaku dan berada dalam pengawasan petugas arsip.
</p>

<p>
Layanan ini diselenggarakan untuk mendukung kebutuhan informasi penelitian dan administrasi dengan tetap memperhatikan ketentuan kearsipan, keamanan arsip, serta tata tertib penggunaan arsip sesuai peraturan yang berlaku.
</p>


<!-- ===== JENIS ARSIP ===== -->

<div class="jenis-box">

<button class="jenis-btn video">Video</button>

<span class="jenis-title">Jenis Arsip</span>

<button class="jenis-btn tekstual">Tekstual</button>

<br><br>

<button class="jenis-btn peta">Peta</button>

<button class="jenis-btn foto">Foto</button>

</div>


<!-- ===== TATA TERTIB ===== -->

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

<p class="mt-5">
Alur peminjaman arsip fisik dilaksanakan melalui tahapan sebagai berikut:
</p>

<div class="alur-btn form">Mengisi Form</div>

<span style="font-size:24px">→</span>

<div class="alur-btn verifikasi">Verifikasi Oleh Petugas</div>

<span style="font-size:24px">→</span>

<div class="alur-btn jadwal">Penjadwalan Kunjungan</div>

<br><br>

<div class="alur-btn layanan">Pelayanan Arsip di Ruang Layanan</div>

<br>

<div class="alur-title">Alur Peminjaman</div>

<br>

<div class="alur-btn selesai">Selesai</div>

</div>

</div>

@endsection