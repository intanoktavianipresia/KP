<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan Permohonan Arsip</title>

<style>
    body{
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 11px;
        margin: 0;
    }

    /* ===== HEADER / KOP ===== */
    .header{
        text-align: center;
        line-height: 1.2;
    }
    .header h2{
        margin: 0;
        font-size: 16px;
        font-weight: bold;
    }
    .header h3{
        margin: 0;
        font-size: 14px;
    }
    .header p{
        margin: 2px 0;
        font-size: 11px;
    }

    .line{
        border-top: 3px solid black;
        margin-top: 6px;
    }
    .line2{
        border-top: 1px solid black;
        margin-top: 2px;
        margin-bottom: 10px;
    }

    /* ===== JUDUL ===== */
    .judul{
        text-align: center;
        font-weight: bold;
        font-size: 13px;
        margin: 10px 0;
        text-transform: uppercase;
    }

    /* ===== INFO FILTER ===== */
    .info{
        margin-bottom: 10px;
        font-size: 11px;
    }

    /* ===== TABEL ===== */
    table{
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    th{
        background: #f2f2f2;
        border: 1px solid black;
        padding: 6px;
        font-size: 11px;
    }

    td{
        border: 1px solid black;
        padding: 5px;
        font-size: 11px;
    }

    .text-center{
        text-align: center;
    }

    /* ===== FOOTER ===== */
    .footer{
        margin-top: 40px;
        width: 100%;
    }

    .ttd{
        width: 250px;
        float: right;
        text-align: center;
        font-size: 11px;
    }

    .nama{
        margin-top: 60px;
        font-weight: bold;
        text-decoration: underline;
    }

    /* ===== PAGE NUMBER ===== */
    .page-number{
        position: fixed;
        bottom: 10px;
        right: 20px;
        font-size: 10px;
    }
</style>

</head>
<body>

<!-- ===== HEADER ===== -->
<div class="header">
    <h2>DINAS PERPUSTAKAAN DAN KEARSIPAN</h2>
    <h3>PROVINSI BENGKULU</h3>
    <p>Jl. Pembangunan No. 01 Kota Bengkulu</p>
</div>

<div class="line"></div>
<div class="line2"></div>

<!-- ===== JUDUL ===== -->
<div class="judul">
    LAPORAN PERMOHONAN KUNJUNGAN ARSIP
</div>

<!-- ===== INFO FILTER ===== -->
<div class="info">
    <strong>Status:</strong> {{ request('status') ?? 'Semua' }} <br>
    <strong>Periode:</strong>
    {{ request('tanggal_awal') ?? '-' }} s/d {{ request('tanggal_akhir') ?? '-' }}
</div>

<!-- ===== TABEL ===== -->
<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Nomor</th>
            <th width="20%">Nama</th>
            <th width="25%">Arsip</th>
            <th width="15%">Status</th>
            <th width="20%">Tanggal</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $key => $d)
        <tr>
            <td class="text-center">{{ $key+1 }}</td>
            <td>{{ $d->nomor_permohonan }}</td>
            <td>{{ $d->nama_pemohon }}</td>
            <td>{{ $d->arsip_dimohon }}</td>
            <td class="text-center">{{ strtoupper($d->status) }}</td>
            <td class="text-center">
                {{ date('d-m-Y', strtotime($d->created_at)) }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">
                Tidak ada data
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- ===== FOOTER ===== -->
<div class="footer">
    <div class="ttd">
        Bengkulu, {{ $tanggal }}<br>
        Kepala Dinas<br><br><br><br>

        <div class="nama">
            ( Nama Kepala Dinas )
        </div>
    </div>
</div>

<!-- ===== PAGE NUMBER ===== -->
<div class="page-number">
    Halaman <span class="pagenum"></span>
</div>

</body>
</html>