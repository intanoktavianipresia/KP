<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Status Permohonan Arsip</title>
    <style>
        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; border-radius: 0 !important; }
            .content { padding: 30px 20px !important; }
            .reason-box { padding: 15px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #334155;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;" align="center">
                
                <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    
                    <tr>
                        <td align="center" style="background-color: #0f5f3a; padding: 35px 20px;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 18px; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">Informasi Permohonan</h2>
                            <p style="color: #d1fae5; margin: 8px 0 0 0; font-size: 12px; font-weight: 500;">Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="content" style="padding: 40px 35px;">
                            <p style="font-size: 16px; margin: 0 0 20px 0;">Yth. <strong>{{ $data->nama_pemohon }}</strong>,</p>
                            
                            <p style="line-height: 1.6; margin: 0 0 25px 0; font-size: 15px;">
                                Terima kasih telah menggunakan layanan kami. Berkenaan dengan permohonan peminjaman arsip fisik nomor <span style="background-color: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-weight: bold;">{{ $data->nomor_permohonan }}</span>, kami menginformasikan bahwa permohonan Anda <span style="color: #ef4444; font-weight: bold;">BELUM DAPAT DISETUJUI</span>.
                            </p>

                            <div class="reason-box" style="background-color: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px; padding: 25px; margin-bottom: 30px;">
                                <h4 style="color: #991b1b; margin: 0 0 10px 0; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Alasan Penolakan:</h4>
                                <p style="color: #b91c1c; margin: 0; font-size: 15px; line-height: 1.6; font-weight: 500; font-style: italic;">
                                    "{{ request('alasan') }}"
                                </p>
                            </div>

                            <table width="100%" style="font-size: 14px; border-collapse: collapse;">
                                <tr>
                                    <td colspan="2" style="padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; font-weight: 700; color: #0f5f3a; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Ringkasan Permohonan</td>
                                </tr>
                                <tr>
                                    <td width="40%" style="padding: 15px 0 10px 0; color: #64748b;">Arsip Dimohon</td>
                                    <td style="padding: 15px 0 10px 0; font-weight: 600; color: #1e293b;">{{ $data->arsip_dimohon }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; color: #64748b;">Tanggal Pengajuan</td>
                                    <td style="padding: 10px 0; font-weight: 600; color: #1e293b;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 35px; font-size: 14px; color: #64748b; line-height: 1.6; padding: 15px; background-color: #f8fafc; border-radius: 8px;">
                                <strong>Saran:</strong> Anda dapat mengajukan permohonan kembali setelah melengkapi persyaratan atau memperbaiki data sesuai dengan alasan penolakan di atas melalui portal resmi kami.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; border-top: 1px solid #f1f5f9; text-align: center;">
                            <p style="font-size: 14px; color: #475569; margin: 0; line-height: 1.5;">
                                Hormat Kami,<br>
                                <strong style="color: #0f5f3a;">Tim Layanan Kearsipan</strong><br>
                                DPK Provinsi Bengkulu
                            </p>
                            <div style="margin-top: 25px; font-size: 11px; color: #94a3b8; line-height: 1.4;">
                                <em>Email ini dikirim secara otomatis oleh sistem. Mohon tidak membalas email ini secara langsung.</em>
                            </div>
                        </td>
                    </tr>
                </table>
                </td>
        </tr>
    </table>
</body>
</html>