<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Layanan Kearsipan</title>
    <style>
        
        @media only screen and (max-width: 620px) {
            .container-table {
                width: 100% !important;
                border-radius: 0 !important;
            }
            .content-padding {
                padding: 30px 20px !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: 'Segoe UI', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;" align="center">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" class="container-table" style="border-collapse: collapse; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                    
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #064e3b, #059669); padding: 40px 0;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 22px; letter-spacing: 1px; text-transform: uppercase; font-weight: 700;">Layanan Informasi</h2>
                            <p style="color: #ecfdf5; margin: 10px 0 0 0; font-size: 14px; opacity: 0.9;">DPK Provinsi Bengkulu</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="content-padding" style="padding: 40px 35px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #1e293b; font-size: 16px; line-height: 1.6;">
                                        <p style="margin: 0 0 20px 0;">Yth. Bapak/Ibu <strong>{{ $nama }}</strong>,</p>
                                        <p style="margin: 0 0 25px 0;">Terima kasih telah menghubungi <strong>Dinas Perpustakaan dan Kearsipan Provinsi Bengkulu</strong>. Berikut adalah tanggapan atas pesan Anda:</p>
                                        
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 25px;">
                                            <tr>
                                                <td style="background-color: #f1f5f9; border-left: 4px solid #94a3b8; padding: 20px; border-radius: 4px 12px 12px 4px;">
                                                    <div style="font-size: 11px; font-weight: bold; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Pesan Anda:</div>
                                                    <div style="color: #475569; font-style: italic; font-size: 15px;">"{{ $pesan }}"</div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 35px;">
                                            <tr>
                                                <td style="background-color: #ecfdf5; border-left: 4px solid #059669; padding: 20px; border-radius: 4px 12px 12px 4px;">
                                                    <div style="font-size: 11px; font-weight: bold; color: #059669; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Tanggapan Kami:</div>
                                                    <div style="color: #064e3b; font-weight: 500; font-size: 15px;">{{ $balasan }}</div>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin: 0 0 10px 0;">Apabila Anda masih memerlukan bantuan lebih lanjut, silakan kunjungi portal layanan kami.</p>
                                        <p style="margin: 0;">Salam hangat,<br><strong>Tim Admin DPK Bengkulu</strong></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; background-color: #f8fafc; border-top: 1px solid #f1f5f9;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #64748b; font-size: 13px; line-height: 1.5;">
                                        <strong style="color: #1e293b;">Dinas Perpustakaan dan Kearsipan</strong><br>
                                        Pemerintah Provinsi Bengkulu<br>
                                        <span style="color: #94a3b8; font-size: 12px;">Jl. Mahoni No.12, Padang Jati, Kota Bengkulu</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 25px; color: #cbd5e1; font-size: 11px; text-align: center; line-height: 1.4;">
                                        Email ini dikirim otomatis pada {{ $tanggal }} WIB.<br>
                                        Mohon untuk tidak membalas email ini secara langsung.
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