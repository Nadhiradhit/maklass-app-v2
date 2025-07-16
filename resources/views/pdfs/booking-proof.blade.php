<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Peminjaman Disetujui</title>
    <style>
        @media print {
            body { margin: 0; }
            .container { box-shadow: none !important; margin: 0; }
            @page { margin: 0.5in; }
        }
    </style>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f5f5; margin: 0; padding: 10px; line-height: 1.4; color: #333; font-size: 14px;">
    <div class="container" style="max-width: 800px; margin: 0 auto; background-color: white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 6px; overflow: hidden; min-height: calc(100vh - 20px);">

        <!-- Compact Header Section -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center;">
            <h1 style="margin: 0 0 5px 0; font-size: 22px; font-weight: 700; letter-spacing: 0.5px;">BUKTI PEMINJAMAN DISETUJUI</h1>
            <p style="margin: 0; font-size: 14px; opacity: 0.9; font-weight: 300;">Konfirmasi Resmi Peminjaman Laboratorium/Ruangan</p>
        </div>

        <!-- Compact Content Section -->
        <div style="padding: 25px;">

            <!-- Greeting -->
            <div style="margin-bottom: 20px;">
                <p style="margin: 0 0 8px 0; font-size: 15px;">
                    Yth. <span style="font-weight: 700; color: #667eea;">{{ $booking->user->name ?? 'User Testing' }}</span>,
                </p>
                <p style="margin: 0 0 8px 0; font-size: 15px;">
                    Peminjaman Anda untuk <span style="font-weight: 700; color: #667eea;">{{ $booking->room->name ?? 'Lab 2' }}</span> telah <span style="font-weight: 700; color: #28a745;">DISETUJUI</span>.
                </p>
                <p style="margin: 0; font-size: 15px;">
                    Berikut adalah detail lengkap peminjaman Anda:
                </p>
            </div>

            <!-- Compact Details Section -->
            <div style="margin-bottom: 20px;">
                <h2 style="color: #667eea; font-size: 18px; font-weight: 600; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 2px solid #667eea;">Detail Peminjaman</h2>

                <table style="width: 100%; border-collapse: collapse; background-color: #f8f9fa; border-radius: 6px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); font-size: 14px;">
                    <tr style="background-color: #e9ecef;">
                        <td style="padding: 10px 12px; font-weight: 600; color: #495057; border-bottom: 1px solid #dee2e6; width: 40%;">ID Peminjaman:</td>
                        <td style="padding: 10px 12px; border-bottom: 1px solid #dee2e6; font-weight: 500;">{{ $booking->id ?? '19' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 12px; font-weight: 600; color: #495057; border-bottom: 1px solid #dee2e6;">Ruangan/Laboratorium:</td>
                        <td style="padding: 10px 12px; border-bottom: 1px solid #dee2e6; font-weight: 500;">{{ $booking->room->name ?? 'Lab 2' }}</td>
                    </tr>
                    <tr style="background-color: #e9ecef;">
                        <td style="padding: 10px 12px; font-weight: 600; color: #495057; border-bottom: 1px solid #dee2e6;">Tanggal Peminjaman:</td>
                        <td style="padding: 10px 12px; border-bottom: 1px solid #dee2e6; font-weight: 500;">{{ \Carbon\Carbon::parse($booking->booking_start_datetime)->translatedFormat('d F Y') ?? '18 Juli 2025' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 12px; font-weight: 600; color: #495057; border-bottom: 1px solid #dee2e6;">Waktu Mulai:</td>
                        <td style="padding: 10px 12px; border-bottom: 1px solid #dee2e6; font-weight: 500;">{{ \Carbon\Carbon::parse($booking->booking_start_datetime)->translatedFormat('H:i') ?? '14:34' }} WIB</td>
                    </tr>
                    <tr style="background-color: #e9ecef;">
                        <td style="padding: 10px 12px; font-weight: 600; color: #495057; border-bottom: 1px solid #dee2e6;">Waktu Selesai:</td>
                        <td style="padding: 10px 12px; border-bottom: 1px solid #dee2e6; font-weight: 500;">{{ \Carbon\Carbon::parse($booking->booking_end_datetime)->translatedFormat('H:i') ?? '16:34' }} WIB</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 12px; font-weight: 600; color: #495057; border-bottom: 1px solid #dee2e6;">Tujuan Peminjaman:</td>
                        <td style="padding: 10px 12px; border-bottom: 1px solid #dee2e6; font-weight: 500;">{{ $booking->purpose ?? 'awdawda' }}</td>
                    </tr>
                    <tr style="background-color: #e9ecef;">
                        <td style="padding: 10px 12px; font-weight: 600; color: #495057;">Disetujui Pada:</td>
                        <td style="padding: 10px 12px; font-weight: 500; color: #28a745;">{{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') ?? '16 Juli 2025, 14:34' }} WIB</td>
                    </tr>
                </table>
            </div>

            <!-- Compact Important Note -->
            <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 6px; padding: 15px; margin-bottom: 20px;">
                <div style="display: flex; align-items: flex-start;">
                    <div style="background-color: #f39c12; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0; font-weight: bold; font-size: 12px;">!</div>
                    <div>
                        <h3 style="margin: 0 0 8px 0; color: #856404; font-size: 14px; font-weight: 600;">Penting</h3>
                        <p style="margin: 0; color: #856404; font-size: 13px; line-height: 1.4;">
                            Harap tunjukkan dokumen ini (cetak atau digital) saat Anda menggunakan fasilitas yang telah disetujui. Pastikan Anda mematuhi semua peraturan dan ketentuan yang berlaku.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Compact Approval Badge -->
            <div style="text-align: center; margin-bottom: 20px;">
                <div style="display: inline-block; background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 10px 25px; border-radius: 25px; font-weight: 700; font-size: 16px; letter-spacing: 0.5px; box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);">
                    ✓ DISETUJUI
                </div>
            </div>
        </div>

        <!-- Compact Footer Section -->
        <div style="background-color: #f8f9fa; padding: 15px 25px; border-top: 1px solid #dee2e6; text-align: center; margin-top: auto;">
            <p style="margin: 0 0 5px 0; font-size: 12px; color: #6c757d; font-style: italic;">
                Ini adalah dokumen yang dibuat secara otomatis, tidak memerlukan tanda tangan.
            </p>
            <p style="margin: 0 0 5px 0; font-size: 12px; color: #6c757d;">
                Dicetak pada: <span style="font-weight: 500;">{{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') ?? '16 Juli 2025 14:34:00' }} WIB</span>
            </p>
            <p style="margin: 0; font-size: 11px; color: #adb5bd;">
                &copy; {{ date('Y') }} Maklas. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
</body>
</html>
