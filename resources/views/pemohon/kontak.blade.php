@extends('layouts.pemohon')

@section('content')

<style>

/* ANIMASI HALUS */
.card{
transition:.3s;
}
.card:hover{
transform:translateY(-5px);
box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

</style>

<div class="container mt-5 mb-5">

    <!-- JUDUL -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">
            KONTAK <span class="text-success">LAYANAN</span>
        </h2>
        <p class="text-muted">
            Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu
        </p>
    </div>

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
        <div class="alert alert-success mt-3">
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