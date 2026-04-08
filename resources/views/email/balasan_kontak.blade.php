<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>

<body style="font-family: Arial; line-height:1.6;">

<p>Yth. Bapak/Ibu <b>{{ $nama }}</b>,</p>

<p>
Terima kasih telah menghubungi <b>Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</b>.
Berikut kami sampaikan tanggapan atas pesan yang telah Anda kirimkan:
</p>

<hr>

<p><b>Pesan Anda:</b></p>
<p style="background:#f4f4f4; padding:10px;">
{{ $pesan }}
</p>

<p><b>Tanggapan dari Admin:</b></p>
<p style="background:#e8f5e9; padding:10px;">
{{ $balasan }}
</p>

<hr>

<p>
Demikian tanggapan yang dapat kami sampaikan.  
Apabila masih terdapat pertanyaan lebih lanjut, silakan menghubungi kami kembali.
</p>

<p>Atas perhatian dan kerja sama Anda, kami ucapkan terima kasih.</p>

<br>

<p>
Hormat kami,<br><br>

<b>Dinas Perpustakaan dan Kearsipan<br>
Provinsi Bengkulu</b>
</p>

<hr>

<small>
Email ini dikirim secara otomatis pada {{ $tanggal }} WIB.  
Mohon tidak membalas email ini secara langsung.
</small>

</body>
</html>