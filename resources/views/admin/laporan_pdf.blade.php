<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Resmi Permohonan Arsip</title>
    <style>
        /* CSS RESET & SETUP */
        @page {
            margin: 1.5cm 2cm;
            size: A4;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a1a1a; /* Dark charcoal untuk keterbacaan tinggi */
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* ===== KOP SURAT (PREMIUM FORMAL) ===== */
        .kop-container {
            width: 100%;
            border-bottom: 4px solid #000; /* Garis tebal */
            padding-bottom: 2px;
            margin-bottom: 1px;
        }
        .kop-inner {
            width: 100%;
            border-bottom: 1.5px solid #000; /* Garis tipis (Garis Ganda Khas Surat Dinas) */
            padding-bottom: 8px;
        }
        .logo-provinsi {
            width: 85px; /* Sedikit lebih besar agar detail terlihat */
            height: auto;
        }
        .text-kop {
            text-align: center;
            padding-right: 85px; /* Offset balancing logo */
        }
        .header-pemprov {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1.5px;
            color: #000;
        }
        .header-dinas {
            font-size: 19pt;
            font-weight: 900;
            margin: 0;
            line-height: 1.2;
            color: #000;
            text-transform: uppercase;
        }
        .header-kontak {
            font-size: 8.5pt;
            font-style: italic;
            margin-top: 4px;
            color: #333;
        }

        /* ===== JUDUL & NOMOR SURAT ===== */
        .title-section {
            text-align: center;
            margin: 30px 0 20px 0;
        }
        .main-title {
            font-size: 13.5pt; 
            font-weight: 800;
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
        }
        .sub-title {
            font-size: 10pt;
            color: #444;
            margin-top: 5px;
            font-weight: 500;
        }

        /* ===== DATA METADATA ===== */
        .meta-container {
            width: 100%;
            margin-bottom: 20px;
        }
        .meta-table {
            font-size: 10pt;
            border-collapse: collapse;
        }
        .meta-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .meta-label { width: 110px; color: #555; }
        .meta-sep { width: 20px; text-align: center; }
        .meta-value { font-weight: 700; color: #000; }

        /* ===== TABEL DATA (MODERN PROFESSIONAL) ===== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            table-layout: fixed; /* Mencegah kolom berantakan */
        }
        .data-table thead th {
            background-color: #064e3b; /* Brand Pine Green */
            color: #ffffff;
            border: 1px solid #053f30;
            padding: 14px 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: bold;
        }
        .data-table tbody td {
            border: 1px solid #d1d5db;
            padding: 12px 10px;
            vertical-align: middle;
            word-wrap: break-word; /* Menangani teks panjang */
        }
        /* Zebra Striping Soft */
        .data-table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        /* Highlight Kolom Utama */
        .col-id { font-weight: 700; color: #064e3b; text-align: center; }
        .status-pill {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 800;
            font-size: 8pt;
            text-align: center;
        }

        /* ===== SIGNATURE AREA ===== */
        .sig-container {
            margin-top: 40px;
            width: 100%;
            page-break-inside: avoid; /* Mencegah TTD terpotong halaman */
        }
        .sig-box {
            float: right;
            width: 280px;
            text-align: center;
        }
        .sig-date { margin-bottom: 5px; font-size: 10.5pt; }
        .sig-title { font-weight: bold; margin-bottom: 80px; font-size: 10.5pt; }
        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            text-transform: uppercase;
        }
        .sig-nip { font-size: 10pt; margin-top: 2px; }

        /* ===== SYSTEM FOOTER ===== */
        #page-footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            font-size: 8pt;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
        .page-number:after { content: counter(page); }
    </style>
</head>
<body>

    <div class="kop-container">
        <div class="kop-inner">
            <table width="100%" border="0">
                <tr>
                    <td width="15%" align="left">
                        <img src="{{ public_path('images/logo.png') }}" class="logo-provinsi">
                    </td>
                    <td class="text-kop">
                        <div class="header-pemprov">PEMERINTAH PROVINSI BENGKULU</div>
                        <div class="header-dinas">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
                        <div class="header-kontak">
                            Jalan Mahoni Raya No. 12 Kota Bengkulu Telp. (0736) 26095<br>
                            Website: perpusda.bengkuluprov.go.id | Email: perpusbengkulu@gmail.com
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="title-section">
        <h1 class="main-title">LAPORAN REKAPITULASI KUNJUNGAN ARSIP</h1>
        <div class="sub-title">Periode Laporan: {{ request('tanggal_awal') ?? 'Awal' }} s/d {{ request('tanggal_akhir') ?? 'Akhir' }}</div>
    </div>

    <div class="meta-container">
        <table class="meta-table">
            <tr>
                <td class="meta-label">Status Arsip</td>
                <td class="meta-sep">:</td>
                <td class="meta-value">{{ request('status') ? strtoupper(request('status')) : 'SELURUH DATA' }}</td>
            </tr>
            <tr>
                <td class="meta-label">Tanggal Cetak</td>
                <td class="meta-sep">:</td>
                <td class="meta-value">{{ $tanggal }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="18%">ID Permohonan</th>
                <th width="22%">Nama Pemohon</th>
                <th>Klasifikasi Arsip / Dokumen</th>
                <th width="12%">Status</th>
                <th width="14%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
            <tr>
                <td align="center">{{ $index + 1 }}</td>
                <td class="col-id">#{{ $row->nomor_permohonan }}</td>
                <td style="font-weight: 500;">{{ $row->nama_pemohon }}</td>
                <td style="color: #444; font-style: italic;">{{ $row->arsip_dimohon }}</td>
                <td align="center">
                    <span class="status-badge">{{ strtoupper($row->status) }}</span>
                </td>
                <td align="center">{{ date('d M Y', strtotime($row->created_at)) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" align="center" style="padding: 40px; color: #999;">
                    -- Tidak terdapat rekaman data permohonan pada periode yang dipilih --
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="sig-container">
        <div class="sig-box">
            <div class="sig-date">Bengkulu, {{ $tanggal }}</div>
            <div class="sig-title">Kepala Dinas,</div>
            
            <div class="sig-name">( Dr. H. Meri Sasdi, M.Pd )</div>
            <div class="sig-nip">NIP. 197211151994091001</div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div id="page-footer">
        <table width="100%">
            <tr>
                <td align="left">E-Arsip Bengkulu Management System | Dokumen Sah Hasil Cetakan Komputer</td>
                <td align="right">Halaman <span class="page-number"></span></td>
            </tr>
        </table>
    </div>

</body>
</html>