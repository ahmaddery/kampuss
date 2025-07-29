<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type === 'berita' ? 'Berita' : 'Pengumuman' }} Terbaru - Universitas Mercu Buana Yogyakarta</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.7;
            color: #2c3e50;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .email-wrapper {
            background-color: #f8f9fa;
            padding: 30px 0;
        }
        .container {
            max-width: 650px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        .university-name {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
            font-weight: 400;
        }
        .content {
            padding: 40px 30px;
        }
        .post-meta {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        .post-type {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .post-date {
            margin-left: auto;
            color: #6b7280;
            font-size: 14px;
        }
        .post-title {
            font-size: 26px;
            color: #1f2937;
            margin: 0 0 20px 0;
            font-weight: 700;
            line-height: 1.3;
        }
        .post-excerpt {
            margin-bottom: 30px;
            color: #4b5563;
            font-size: 16px;
            line-height: 1.6;
        }
        .cta-section {
            text-align: center;
            margin: 35px 0;
        }
        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
            margin: 30px 0;
        }
        .additional-info {
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            margin-top: 25px;
        }
        .additional-info h3 {
            margin: 0 0 10px 0;
            color: #1f2937;
            font-size: 16px;
            font-weight: 600;
        }
        .additional-info p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-content {
            max-width: 500px;
            margin: 0 auto;
        }
        .footer p {
            margin: 8px 0;
            font-size: 13px;
            color: #6b7280;
            line-height: 1.5;
        }
        .unsubscribe {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }
        .unsubscribe:hover {
            text-decoration: underline;
        }
        .social-links {
            margin: 20px 0 10px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 8px;
            padding: 8px 12px;
            background-color: #e5e7eb;
            color: #4b5563;
            text-decoration: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }
        .contact-info {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }
        
        /* Responsive Design */
        @media (max-width: 600px) {
            .email-wrapper {
                padding: 15px;
            }
            .container {
                margin: 0 15px;
            }
            .header, .content, .footer {
                padding: 25px 20px;
            }
            .header h1 {
                font-size: 24px;
            }
            .post-title {
                font-size: 22px;
            }
            .post-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .post-date {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="container">
            <div class="header">
                <h1>{{ $type === 'berita' ? 'Berita Terbaru' : 'Pengumuman Penting' }}</h1>
                <p class="university-name">Universitas Mercu Buana Yogyakarta</p>
            </div>
            
            <div class="content">
                <div class="post-meta">
                    <span class="post-type">{{ $type === 'berita' ? 'Berita' : 'Pengumuman' }}</span>
                    <span class="post-date">{{ date('d F Y') }}</span>
                </div>
                
                <h2 class="post-title">{{ $post->title }}</h2>
                
                <div class="post-excerpt">
                    {!! Str::limit(strip_tags($post->description), 300, '...') !!}
                </div>
                
                <div class="cta-section">
                    <a href="{{ $type === 'berita' ? route('berita.show', $post->slug) : route('pengumuman.show', $post->slug) }}" class="btn">
                        Baca Selengkapnya
                    </a>
                </div>
                
                <div class="divider"></div>
                
                @if($type === 'pengumuman')
                <div class="additional-info">
                    <h3>Informasi Penting</h3>
                    <p>Pastikan Anda membaca pengumuman ini dengan seksama. Jika ada pertanyaan, silakan hubungi bagian akademik atau administrasi universitas.</p>
                </div>
                @endif
                
                @if($type === 'berita')
                <div class="additional-info">
                    <h3>Tetap Terhubung</h3>
                    <p>Ikuti terus perkembangan terbaru dari Universitas Mercu Buana Yogyakarta melalui website resmi dan media sosial kami.</p>
                </div>
                @endif
            </div>
            
            <div class="footer">
                <div class="footer-content">
                    <div class="social-links">
                        <a href="#">Website</a>
                        <a href="#">Facebook</a>
                        <a href="#">Instagram</a>
                        <a href="#">YouTube</a>
                    </div>
                    
                    <p>Email ini dikirim karena Anda terdaftar sebagai subscriber {{ $type === 'berita' ? 'berita' : 'pengumuman' }} dari Universitas Mercu Buana Yogyakarta.</p>
                    
                    <p>Jika Anda tidak ingin menerima email ini lagi, <a href="{{ $unsubscribeLink }}" class="unsubscribe">klik di sini untuk berhenti berlangganan</a>.</p>
                    
                    <div class="contact-info">
                        <p><strong>Universitas Mercu Buana Yogyakarta</strong></p>
                        <p>Jl. Wates Km. 10, Yogyakarta 55753</p>
                        <p>Telp: (0274) 6498212 | Email: info@mercubuana-yogya.ac.id</p>
                        <p>&copy; {{ date('Y') }} Universitas Mercu Buana Yogyakarta. Hak cipta dilindungi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>