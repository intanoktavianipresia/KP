<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Perubahan Jadwal Kunjungan</title>
    <style>
        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; border-radius: 0 !important; }
            .content { padding: 30px 20px !important; }
            .schedule-title { font-size: 13px !important; }
            .schedule-date { font-size: 20px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f6; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #334155;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;" align="center">
                
                <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td align="center" style="background-color: #d97706; padding: 35px 20px;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 18px; letter-spacing: 2px; text-transform: uppercase; font-weight: 700;">PERUBAHAN JADWAL</h2>
                            <p style="color: #fef3c7; margin: 8px 0 0 0; font-size: 12px; font-weight: 500;">Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="content" style="padding: 40px 35px;">
                            <p style="font-size: 16px; margin: 0 0 20px 0; color: #1e293b;">Yth. <strong>{{ $data->nama_pemohon }}</strong>,</p>
                            
                            <p style="line-height: 1.6; margin: 0 0 25px 0; font-size: 15px;">
                                Kami menginformasikan bahwa jadwal kunjungan untuk permohonan nomor tiket <span style="background-color: #fff7ed; color: #9a3412; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-weight: bold;">{{ $data->nomor_permohonan }}</span> telah mengalami <strong>perubahan</strong>.
                            </p>

                            <div style="background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 25px; margin-bottom: 30px; text-align: center;">
                                <h4 class="schedule-title" style="color: #92400e; margin: 0 0 12px 0; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Jadwal Terbaru</h4>
                                <div class="schedule-date" style="font-size: 24px; font-weight: 800; color: #78350f;">
                                    {{ \Carbon\Carbon::parse($data->tanggal_kunjungan)->format('d F Y') }}
                                </div>
                                <div style="font-size: 16px; color: #92400e; margin-top: 8px; font-weight: 600;">
                                    Pukul {{ $data->waktu_kunjungan }} WIB
                                </div>
                            </div>

                            <h4 style="border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; color: #78350f; font-size: 15px; margin-bottom: 15px;">Alasan Perubahan</h4>
                            <div style="font-size: 14px; line-height: 1.6; color: #475569; font-style: italic; background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #d97706; margin-bottom: 30px;">
                                "{{ $data->alasan_perubahan }}"
                            </div>

                            <h4 style="border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; color: #78350f; font-size: 15px; margin-bottom: 15px;">Detail Permohonan</h4>
                            <table width="100%" style="font-size: 14px; border-collapse: collapse;">
                                <tr>
                                    <td width="35%" style="padding: 8px 0; color: #64748b;">Arsip Dimohon</td>
                                    <td style="padding: 8px 0; font-weight: 600; color: #1e293b;">: {{ $data->arsip_dimohon }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #64748b;">Lokasi</td>
                                    <td style="padding: 8px 0; font-weight: 600; color: #1e293b;">: Gedung Layanan Kearsipan</td>
                                </tr>
                            </table>

                            <p style="margin-top: 35px; font-size: 13px; color: #64748b; line-height: 1.6;">
                                <strong>Mohon Perhatian:</strong> Kami memohon maaf atas ketidaknyamanan yang ditimbulkan dari perubahan ini. Harap konfirmasi kehadiran Anda melalui portal atau datang tepat waktu sesuai jadwal baru di atas.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; text-align: center; border-top: 1px solid #f1f5f9;">
                            <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.6;">
                                Hormat Kami,<br>
                                <strong style="color: #78350f;">Tim Layanan Kearsipan</strong><br>
                                DPK Provinsi Bengkulu
                            </p>
                            <div style="margin-top: 25px; font-size: 11px; color: #94a3b8; line-height: 1.4;">
                                <em>Email otomatis - Mohon tidak membalas email ini secara langsung.</em>
                            </div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>