<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body style="font-family: Arial;">

<h3 style="color:#0f5f3a;">
DINAS PERPUSTAKAAN DAN KEARSIPAN
</h3>

<p>Yth. {{ $data->nama_pemohon }},</p>

<p>
Dengan hormat,<br><br>
Permohonan peminjaman arsip Anda <b style="color:red;">BELUM DAPAT DISETUJUI</b>.
</p>

<h4>A. Data Pemohon</h4>
<table border="1" cellpadding="8" cellspacing="0">
<tr><td>Nama</td><td>{{ $data->nama_pemohon }}</td></tr>
<tr><td>Alamat</td><td>{{ $data->alamat }}</td></tr>
<tr><td>Jenis Kelamin</td><td>{{ $data->jenis_kelamin }}</td></tr>
<tr><td>No HP</td><td>{{ $data->telepon }}</td></tr>
<tr><td>Email</td><td>{{ $data->email }}</td></tr>
</table>

<br>

<h4>B. Detail Permohonan</h4>
<table border="1" cellpadding="8" cellspacing="0">
<tr><td>Nomor</td><td>{{ $data->nomor_permohonan }}</td></tr>
<tr><td>Arsip</td><td>{{ $data->arsip_dimohon }}</td></tr>
<tr><td>Tujuan</td><td>{{ $data->tujuan }}</td></tr>
<tr><td>Tanggal</td><td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td></tr>
</table>

<br>

<h4>C. Keputusan</h4>
<table border="1" cellpadding="8" cellspacing="0">
<tr>
<td>Status</td>
<td style="color:red;"><b>DITOLAK</b></td>
</tr>

<tr>
<td>Alasan</td>
<td>{{ request('alasan') }}</td>
</tr>
</table>

<br>

<p>
Demikian informasi ini kami sampaikan.<br>
Terima kasih atas perhatian dan pengertiannya.<br><br>

Hormat kami,<br>
Dinas Perpustakaan dan Kearsipan
</p>

</body>
</html>