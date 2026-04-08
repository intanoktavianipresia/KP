@extends('layouts.pemohon')

@section('content')

<style>

/* ===== HERO GLOBAL ===== */
.hero-page{
position:relative;
background:linear-gradient(135deg,#0b3d2e,#1f9b74);
padding:70px 20px;
text-align:center;
color:white;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.hero-page::before{
content:'';
position:absolute;
width:200%;
height:200%;
top:-50%;
left:-50%;
background:radial-gradient(circle, rgba(255,255,255,0.1), transparent 70%);
animation:heroGlow 12s linear infinite;
}

.hero-content{
position:relative;
z-index:2;
max-width:900px;
margin:auto;
}

.hero-page h1{
font-size:42px;
font-weight:900;
letter-spacing:4px;
text-transform:uppercase;

background:linear-gradient(to bottom,#ffffff,#cfe9df);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

text-shadow:0 5px 25px rgba(0,0,0,0.4);
}

.hero-page p{
margin-top:12px;
font-size:18px;
opacity:.9;
}

.hero-page h1::after{
content:'';
display:block;
width:100px;
height:4px;
background:white;
margin:15px auto 0;
border-radius:10px;
}

@keyframes heroGlow{
from{transform:rotate(0deg);}
to{transform:rotate(360deg);}
}

/* ===== CARD ===== */
.card{
transition:.3s;
border-radius:15px;
}
.card:hover{
transform:translateY(-5px);
box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

/* ===== FORM ===== */
.form-control{
border-radius:10px;
padding:12px;
}

.btn-success{
border-radius:30px;
padding:12px;
font-weight:600;
transition:.3s;
}

.btn-success:hover{
transform:translateY(-2px);
}

</style>


<!-- HERO -->
<div class="hero-page">
    <div class="hero-content">
        <h1>Kontak Layanan</h1>
        <p>Hubungi kami untuk informasi dan bantuan layanan</p>
    </div>
</div>


<div class="container mt-5 mb-5">

    <div class="row">

        <!-- KIRI -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 p-4 h-100">

                <h5 class="fw-bold mb-4">Informasi Layanan</h5>

                <p><strong>Layanan :</strong> Peminjaman Arsip Fisik</p>
                <p><strong>Unit :</strong> Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>

                <p><strong>Telepon :</strong> 0736 26095</p>
                <p><strong>Email :</strong> perpusbengkulu@gmail.com</p>

                <p>
                    <strong>Alamat :</strong><br>
                    Jl. Mahoni No.12, Padang Jati, Kota Bengkulu
                </p>

            </div>
        </div>

        <!-- MAP -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-0">

                    <iframe 
                        src="https://www.google.com/maps?q=Padang+Jati+Bengkulu&output=embed"
                        width="100%" 
                        height="100%" 
                        style="border:0; min-height:350px;">
                    </iframe>

                </div>
            </div>
        </div>

    </div>

    <!-- NOTIF -->
    @if(session('success'))
        <div class="alert alert-success mt-3 text-center">
            ✅ Pesan berhasil dikirim!
        </div>
    @endif

    <!-- FORM -->
    <div class="card shadow-sm border-0 p-4 mt-4">

        <h5 class="fw-bold mb-4">Kirim Pesan</h5>

        <form action="{{ route('pemohon.kontak.kirim') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Pesan</label>
                    <textarea name="pesan" class="form-control" rows="4" required></textarea>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-success w-100">
                        Kirim Pesan
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

@endsection