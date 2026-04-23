<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Persetujuan Peminjaman Arsip</title>
    <style>
        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; border-radius: 0 !important; }
            .content { padding: 30px 20px !important; }
            .schedule-text { font-size: 18px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f6; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #334155;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;" align="center">
                
                <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td align="center" style="background-color: #064e3b; padding: 35px 20px;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 18px; letter-spacing: 2px; text-transform: uppercase; font-weight: 700;">KONFIRMASI PERSETUJUAN</h2>
                            <p style="color: #a7f3d0; margin: 8px 0 0 0; font-size: 12px; font-weight: 500;">Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="content" style="padding: 40px 35px;">
                            <p style="font-size: 16px; margin: 0 0 20px 0; color: #1e293b;">Yth. <strong>{{ $data->nama_pemohon }}</strong>,</p>
                            <p style="line-height: 1.6; margin: 0 0 25px 0; font-size: 15px;">
                                Kami informasikan bahwa permohonan peminjaman arsip fisik Anda dengan nomor tiket <span style="background-color: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-weight: bold;">{{ $data->nomor_permohonan }}</span> telah disetujui.
                            </p>

                            <div style="background-color: #f0fdf4; border: 1px dashed #22c55e; border-radius: 12px; padding: 25px; margin-bottom: 30px; text-align: center;">
                                <h4 style="color: #166534; margin: 0 0 12px 0; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Jadwal Kedatangan</h4>
                                <div class="schedule-text" style="font-size: 24px; font-weight: 800; color: #064e3b;">
                                    {{ date('d F Y', strtotime(request('tgl'))) }}
                                </div>
                                <div style="font-size: 16px; color: #15803d; margin-top: 8px; font-weight: 600;">
                                    Pukul {{ request('waktu') }} WIB
                                </div>
                            </div>

                            <h4 style="border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; color: #064e3b; font-size: 15px; margin-bottom: 15px;">Ringkasan Data Peminjaman</h4>
                            <table width="100%" style="font-size: 14px; border-collapse: collapse;">
                                <tr>
                                    <td width="35%" style="padding: 8px 0; color: #64748b;">Nama Pemohon</td>
                                    <td style="padding: 8px 0; font-weight: 600; color: #1e293b;">: {{ $data->nama_pemohon }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #64748b;">Arsip Dimohon</td>
                                    <td style="padding: 8px 0; font-weight: 600; color: #1e293b;">: {{ $data->arsip_dimohon }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #64748b;">Tujuan</td>
                                    <td style="padding: 8px 0; font-weight: 600; color: #1e293b;">: {{ $data->tujuan }}</td>
                                </tr>
                            </table>

                            <table width="100%" style="margin-top: 30px;">
                                <tr>
                                    <td style="background-color: #fffbeb; padding: 15px 20px; border-radius: 8px; border-left: 5px solid #f59e0b;">
                                        <p style="margin: 0; font-size: 13px; color: #92400e; line-height: 1.5;">
                                            <strong>PENTING:</strong> Mohon membawa kartu identitas asli (KTP/SIM) dan hadir tepat waktu. Jika berhalangan hadir, silakan konfirmasi ulang melalui portal kearsipan.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; text-align: center; border-top: 1px solid #f1f5f9;">
                            <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.6;">
                                Hormat Kami,<br>
                                <strong style="color: #064e3b;">Tim Layanan Kearsipan</strong><br>
                                DPK Provinsi Bengkulu
                            </p>
                            <div style="margin-top: 25px; font-size: 11px; color: #94a3b8; line-height: 1.4;">
                                Jl. Mahoni No.12, Padang Jati, Kota Bengkulu<br>
                                <em>Email ini dihasilkan oleh sistem, mohon tidak membalas.</em>
                            </div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>