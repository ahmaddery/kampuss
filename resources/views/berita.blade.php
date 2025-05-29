@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .news-card {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 1px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .news-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            border-color: rgba(59, 130, 246, 0.3);
        }
        
        .image-container {
            position: relative;
            overflow: hidden;
        }
        
        .image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }
        
        .news-card:hover .image-container::before {
            opacity: 1;
        }
        
        .news-image {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .news-card:hover .news-image {
            transform: scale(1.1);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .read-more-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .read-more-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .read-more-btn:hover::before {
            left: 100%;
        }
        
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .8;
            }
        }
        
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-elements::before {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .floating-elements::after {
            top: 60%;
            right: 10%;
            animation-delay: 3s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 2rem 0;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 relative">
        <div class="floating-elements"></div>
        
        <!-- Header Section -->
        <div class="text-center mb-12 relative">
            <div class="inline-block">
                <h1 class="text-5xl font-bold gradient-text mb-4 relative">
                    <span class="relative z-10">Berita Kampus</span>
                    <div class="absolute -inset-2 bg-gradient-to-r from-blue-200 to-purple-200 rounded-lg opacity-20 blur-lg"></div>
                </h1>
            </div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Ikuti perkembangan terbaru dan informasi penting seputar kehidupan kampus
            </p>
            <div class="section-divider"></div>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-16">




<!-- Sample News Card 1 -->
@foreach($berita as $item)
<article class="news-card rounded-2xl overflow-hidden group">
    <div class="image-container relative">
        <img src="{{ asset('storage/' . $item->image_path) }}" 
             alt="{{ $item->title }}" 
             class="news-image w-full h-56 object-cover">
        <div class="absolute top-4 left-4">
            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                <i class="fas fa-graduation-cap mr-1"></i>
                {{ $item->category }}  <!-- Misalnya 'Akademik' -->
            </span>
        </div>
        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2 text-xs text-gray-700 font-medium">
            <i class="fas fa-calendar-alt mr-1"></i>
            {{ \Carbon\Carbon::parse($item->publish_date)->format('d M Y') }}
        </div>
    </div>
    <div class="p-7">
        <h3 class="font-bold text-xl text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-700 transition-colors duration-300">
            {{ $item->title }}
        </h3>
        <p class="text-gray-600 text-sm mb-5 leading-relaxed line-clamp-3">
            {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 150) }}  <!-- Menampilkan 150 karakter pertama -->
        </p>
        <div class="flex items-center justify-between">
            <a href="{{ route('berita.show', $item->slug) }}" class="read-more-btn inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-lg transition-all duration-300">
                <span>SELENGKAPNYA</span>
                <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
            <div class="flex items-center space-x-3 text-gray-400">
                <button class="hover:text-red-500 transition-colors duration-300">
                    <i class="far fa-heart"></i>
                </button>
                <button class="hover:text-blue-500 transition-colors duration-300">
                    <i class="far fa-share-alt"></i>
                </button>
            </div>
        </div>
    </div>
</article>
@endforeach

        </div>

        <!-- Enhanced Pagination -->
        <div class="flex justify-center items-center space-x-3 mt-16">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50">
                <div class="flex items-center space-x-2">
                    <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    
                    <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600 text-white font-semibold shadow-lg">
                        1
                    </button>
                    <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                        2
                    </button>
                    <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                        3
                    </button>
                    <span class="px-3 py-2 text-gray-400">...</span>
                    <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                        10
                    </button>
                    
                    <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
