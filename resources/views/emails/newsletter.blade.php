<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type === 'berita' ? 'Berita' : 'Pengumuman' }} Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eaeaea;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 20px 0;
        }
        .post-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .post-title {
            font-size: 24px;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .post-excerpt {
            margin-bottom: 20px;
            color: #4b5563;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }
        .btn:hover {
            background-color: #1d4ed8;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
            font-size: 12px;
            color: #6b7280;
        }
        .footer p {
            margin: 5px 0;
        }
        .unsubscribe {
            color: #6b7280;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $type === 'berita' ? 'Berita' : 'Pengumuman' }} Baru</h1>
        </div>
        
        <div class="content">
            <img src="{{ url('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="post-image">
            
            <h2 class="post-title">{{ $post->title }}</h2>
            
            <div class="post-excerpt">
                {!! Str::limit(strip_tags($post->description), 200) !!}
            </div>
            
            <a href="{{ $type === 'berita' ? route('berita.show', $post->slug) : route('pengumuman.show', $post->slug) }}" class="btn">Baca Selengkapnya</a>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim karena Anda berlangganan newsletter {{ $type === 'berita' ? 'berita' : 'pengumuman' }} dari Universitas Mercu Buana Yogyakarta.</p>
            <p>Jika Anda tidak ingin menerima email seperti ini di masa mendatang, <a href="{{ $unsubscribeLink }}" class="unsubscribe">klik di sini untuk berhenti berlangganan</a>.</p>
            <p>&copy; {{ date('Y') }} Universitas Mercu Buana Yogyakarta. All rights reserved.</p>
        </div>
    </div>
</body>
</html>