<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: 'Segoe UI', Arial, sans-serif; color: #334155;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td align="center" style="background-color: #0f5f3a; padding: 35px 0;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 20px; letter-spacing: 1px; text-transform: uppercase;">Informasi Permohonan</h2>
                            <p style="color: #d1fae5; margin: 5px 0 0 0; font-size: 13px;">Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="font-size: 16px; margin: 0 0 20px 0;">Yth. <strong>{{ $data->nama_pemohon }}</strong>,</p>
                            
                            <p style="line-height: 1.6; margin: 0 0 25px 0;">
                                Terima kasih telah menggunakan layanan kami. Berkenaan dengan permohonan peminjaman arsip fisik nomor <strong>{{ $data->nomor_permohonan }}</strong>, kami menginformasikan bahwa permohonan Anda <span style="color: #ef4444; font-weight: bold;">BELUM DAPAT DISETUJUI</span>.
                            </p>

                            <div style="background-color: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                                <h4 style="color: #991b1b; margin: 0 0 8px 0; font-size: 14px; text-transform: uppercase;">Alasan Penolakan:</h4>
                                <p style="color: #b91c1c; margin: 0; font-size: 15px; line-height: 1.5; font-weight: 500;">
                                    "{{ request('alasan') }}"
                                </p>
                            </div>

                            <table width="100%" style="font-size: 14px; border-collapse: collapse;">
                                <tr>
                                    <td colspan="2" style="padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; font-weight: 700; color: #0f5f3a;">Ringkasan Permohonan</td>
                                </tr>
                                <tr>
                                    <td width="40%" style="padding: 12px 0; color: #64748b;">Arsip Dimohon</td>
                                    <td style="padding: 12px 0; font-weight: 600;">{{ $data->arsip_dimohon }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; color: #64748b;">Tanggal Pengajuan</td>
                                    <td style="padding: 12px 0; font-weight: 600;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 30px; font-size: 14px; color: #64748b; line-height: 1.6;">
                                Jika Anda memiliki pertanyaan lebih lanjut atau ingin melengkapi persyaratan yang diperlukan, silakan ajukan kembali permohonan melalui portal atau hubungi unit layanan kami.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; border-top: 1px solid #f1f5f9; text-align: center;">
                            <p style="font-size: 14px; color: #475569; margin: 0;">
                                Hormat Kami,<br>
                                <strong>Dinas Perpustakaan dan Kearsipan</strong><br>
                                Provinsi Bengkulu
                            </p>
                            <div style="margin-top: 20px; font-size: 11px; color: #94a3b8;">
                                Email ini dikirim secara otomatis oleh sistem kearsipan. Mohon tidak membalas email ini secara langsung.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>