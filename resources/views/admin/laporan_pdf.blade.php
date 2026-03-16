<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; }
        .kop { text-align: center; }
        .kop h2 { margin:0; }
        .kop p { margin:2px; font-size:12px; }
        hr { margin:10px 0; }

        table {
            width:100%;
            border-collapse: collapse;
            font-size:12px;
        }

        table, th, td {
            border:1px solid black;
        }

        th, td {
            padding:6px;
            text-align:center;
        }

        .ttd {
            margin-top:40px;
            text-align:right;
            font-size:12px;
        }
    </style>
</head>
<body>

<div class="kop">
    <h2>DINAS PERPUSTAKAAN DAN KEARSIPAN</h2>
    <h3>PROVINSI BENGKULU</h3>
    <p>Jl. Pembangunan No. 01 Kota Bengkulu</p>
</div>

<hr>

<h3 style="text-align:center;">LAPORAN PERMOHONAN KUNJUNGAN</h3>

<br>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Arsip Yang Dimohon</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $d)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $d->nama_pemohon }}</td>
            <td>{{ $d->arsip_dimohon }}</td>
            <td>{{ strtoupper($d->status) }}</td>
            <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="ttd">
    Bengkulu, {{ $tanggal }}<br><br>
    Kepala Dinas<br><br><br><br>
    ___________________________
</div>

</body>
</html>