<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Layanan Kearsipan</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: 'Segoe UI', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                    
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #064e3b, #059669); padding: 40px 0;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px; text-transform: uppercase;">Layanan Informasi</h2>
                            <p style="color: #ecfdf5; margin: 10px 0 0 0; font-size: 14px; opacity: 0.9;">Provinsi Bengkulu</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #1e293b; font-size: 16px; line-height: 1.6;">
                                        <p style="margin: 0 0 20px 0;">Yth. Bapak/Ibu <strong>{{ $nama }}</strong>,</p>
                                        <p style="margin: 0 0 20px 0;">Terima kasih telah menghubungi <strong>Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</strong>. Berikut adalah tanggapan atas pertanyaan/pesan yang Anda sampaikan:</p>
                                        
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 25px;">
                                            <tr>
                                                <td style="background-color: #f1f5f9; border-left: 4px solid #94a3b8; padding: 20px; border-radius: 4px 12px 12px 4px;">
                                                    <div style="font-size: 12px; font-weight: bold; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">Pesan Anda:</div>
                                                    <div style="color: #475569; font-style: italic;">"{{ $pesan }}"</div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 30px;">
                                            <tr>
                                                <td style="background-color: #ecfdf5; border-left: 4px solid #059669; padding: 20px; border-radius: 4px 12px 12px 4px;">
                                                    <div style="font-size: 12px; font-weight: bold; color: #059669; margin-bottom: 8px; text-transform: uppercase;">Tanggapan Kami:</div>
                                                    <div style="color: #064e3b; font-weight: 500;">{{ $balasan }}</div>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin: 0 0 10px 0;">Apabila masih terdapat pertanyaan lebih lanjut, silakan hubungi kami kembali melalui portal layanan kami.</p>
                                        <p style="margin: 0;">Terima kasih atas perhatian dan kerja sama Anda.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; border-top: 1px solid #f1f5f9;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #64748b; font-size: 14px; line-height: 1.5;">
                                        <strong>Dinas Perpustakaan dan Kearsipan</strong><br>
                                        Provinsi Bengkulu<br>
                                        <span style="font-size: 12px;">Jl. Mahoni No.12, Padang Jati, Kota Bengkulu</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 25px; color: #94a3b8; font-size: 11px; text-align: center;">
                                        Email ini dikirim otomatis pada {{ $tanggal }} WIB.<br>
                                        Harap tidak membalas email ini secara langsung.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>