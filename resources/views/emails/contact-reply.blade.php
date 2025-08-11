<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balasan dari Universitas Mercu Buana Yogyakarta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #1e40af;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
        }
        .university-name {
            color: #666;
            font-size: 14px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .original-message {
            background-color: #f8fafc;
            border-left: 4px solid #e5e7eb;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .original-message h4 {
            margin-top: 0;
            color: #374151;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .admin-reply {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 20px;
            margin: 25px 0;
            border-radius: 5px;
        }
        .admin-reply h4 {
            margin-top: 0;
            color: #1e40af;
            font-size: 16px;
        }
        .contact-info {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        .contact-info h4 {
            margin-top: 0;
            color: #1e40af;
        }
        .contact-item {
            margin: 8px 0;
            display: flex;
            align-items: center;
        }
        .contact-item i {
            width: 20px;
            margin-right: 10px;
            color: #3b82f6;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 15px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">UMBY</div>
            <div class="university-name">Universitas Mercu Buana Yogyakarta</div>
        </div>

        <!-- Greeting -->
        <div class="greeting">
            <p>Yth. {{ $contactMessage->nama_lengkap }},</p>
            <p>Terima kasih telah menghubungi Universitas Mercu Buana Yogyakarta. Berikut adalah balasan dari tim kami mengenai pesan Anda.</p>
        </div>

        <!-- Original Message -->
        <div class="original-message">
            <h4>📩 Pesan Anda</h4>
            <p><strong>Subjek:</strong> {{ $contactMessage->subjek }}</p>
            <p><strong>Tanggal:</strong> {{ $contactMessage->created_at->format('d M Y, H:i') }} WIB</p>
            <p><strong>Pesan:</strong></p>
            <p style="margin-top: 10px; font-style: italic;">"{{ $contactMessage->pesan }}"</p>
        </div>

        <!-- Admin Reply -->
        <div class="admin-reply">
            <h4>💬 Balasan dari Tim Kami</h4>
            <p>{!! nl2br(e($adminReply)) !!}</p>
            <hr style="margin: 15px 0; border: none; border-top: 1px solid #cbd5e1;">
            <p style="font-size: 12px; color: #64748b; margin: 0;">
                <strong>Dibalas oleh:</strong> {{ $contactMessage->repliedBy->name ?? 'Tim Admin' }}<br>
                <strong>Waktu:</strong> {{ $contactMessage->replied_at->format('d M Y, H:i') }} WIB
            </p>
        </div>

        <!-- Call to Action -->
        <div style="text-align: center; margin: 25px 0;">
            <a href="mailto:{{ config('mail.from.address', 'info@mercubuana-yogya.ac.id') }}" class="button">
                Balas Email Ini
            </a>
        </div>

        <!-- Contact Information -->
        <div class="contact-info">
            <h4>📞 Informasi Kontak</h4>
            <div class="contact-item">
                <span>📍</span>
                <span>Jl. Wates Km. 10, Argomulyo, Sedayu, Bantul, Yogyakarta 55753</span>
            </div>
            <div class="contact-item">
                <span>☎️</span>
                <span>(0274) 4462800</span>
            </div>
            <div class="contact-item">
                <span>✉️</span>
                <span>info@mercubuana-yogya.ac.id</span>
            </div>
            <div class="contact-item">
                <span>🌐</span>
                <span>www.mercubuana-yogya.ac.id</span>
            </div>
        </div>

        <!-- Additional Information -->
        <div style="background-color: #fef3c7; border: 1px solid #fbbf24; border-radius: 6px; padding: 15px; margin-top: 20px;">
            <h4 style="margin-top: 0; color: #92400e;">ℹ️ Informasi Penting</h4>
            <ul style="margin: 0; padding-left: 20px; color: #92400e;">
                <li>Jam operasional: Senin - Jumat (08:00 - 16:00 WIB)</li>
                <li>Untuk informasi urgent, silakan hubungi nomor telepon di atas</li>
                <li>Email ini dikirim otomatis, mohon jangan membalas ke alamat ini</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Universitas Mercu Buana Yogyakarta. All rights reserved.</p>
            <p>Email ini dikirim karena Anda telah mengirim pesan melalui website resmi kami.</p>
            <p style="margin-top: 10px;">
                <a href="#" style="color: #3b82f6; text-decoration: none;">Website</a> |
                <a href="#" style="color: #3b82f6; text-decoration: none;">Facebook</a> |
                <a href="#" style="color: #3b82f6; text-decoration: none;">Instagram</a>
            </p>
        </div>
    </div>
</body>
</html>
