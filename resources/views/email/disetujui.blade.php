<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f6; font-family: 'Segoe UI', Arial, sans-serif; color: #333;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td align="center" style="background-color: #064e3b; padding: 30px 0;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 20px; letter-spacing: 1px;">KONFIRMASI PERSETUJUAN</h2>
                            <p style="color: #ecfdf5; margin: 5px 0 0 0; font-size: 13px;">Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="font-size: 16px; margin: 0 0 20px 0;">Yth. <strong>{{ $data->nama_pemohon }}</strong>,</p>
                            <p style="line-height: 1.6; margin: 0 0 25px 0;">
                                Kami menginformasikan bahwa permohonan peminjaman arsip fisik Anda dengan nomor tiket <strong>{{ $data->nomor_permohonan }}</strong> telah kami tinjau dan dinyatakan <span style="color: #059669; font-weight: bold;">DISETUJUI</span>.
                            </p>

                            <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px; margin-bottom: 30px; text-align: center;">
                                <h4 style="color: #166534; margin: 0 0 10px 0; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Jadwal Kedatangan</h4>
                                <table width="100%">
                                    <tr>
                                        <td align="center">
                                            <div style="font-size: 22px; font-weight: 800; color: #064e3b;">{{ date('d F Y', strtotime(request('tgl'))) }}</div>
                                            <div style="font-size: 16px; color: #166534; margin-top: 5px;">Pukul: {{ request('waktu') }} WIB</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <h4 style="border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; color: #064e3b;">Ringkasan Data</h4>
                            <table width="100%" style="font-size: 14px; line-height: 2;">
                                <tr>
                                    <td width="35%" style="color: #64748b;">Nama Pemohon</td>
                                    <td style="font-weight: 600;">: {{ $data->nama_pemohon }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b;">Arsip Dimohon</td>
                                    <td style="font-weight: 600;">: {{ $data->arsip_dimohon }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b;">Tujuan</td>
                                    <td style="font-weight: 600;">: {{ $data->tujuan }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 30px; font-size: 14px; background-color: #fffbeb; padding: 15px; border-radius: 8px; border-left: 4px solid #f59e0b; color: #92400e;">
                                <strong>Catatan:</strong> Mohon membawa identitas diri (KTP) dan hadir 15 menit sebelum waktu yang ditentukan. Patuhi tata tertib ruang baca.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; text-align: center;">
                            <p style="font-size: 14px; color: #64748b; margin: 0;">
                                Hormat Kami,<br>
                                <strong>Tim Layanan Kearsipan</strong><br>
                                Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu
                            </p>
                            <div style="margin-top: 20px; font-size: 11px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                                Email ini dibuat secara otomatis oleh sistem. Harap tidak membalas email ini.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>