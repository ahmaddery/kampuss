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
        
        .search-container {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-input {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: rgba(255, 255, 255, 1);
        }
        
        .search-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
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
        
        .no-results {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 2px dashed rgba(156, 163, 175, 0.3);
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
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed mb-8">
                Ikuti perkembangan terbaru dan informasi penting seputar kehidupan kampus
            </p>
            
            <!-- Search Form -->
            <div class="search-container mb-8">
                <form method="GET" action="{{ route('berita.index') }}" class="flex gap-2">
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ $search ?? '' }}"
                            placeholder="Cari berita berdasarkan judul, konten, author, atau tags..." 
                            class="search-input w-full px-6 py-4 rounded-2xl text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0 text-lg"
                        >
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    <button 
                        type="submit" 
                        class="search-btn px-8 py-4 rounded-2xl text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300"
                    >
                        <i class="fas fa-search mr-2"></i>
                        CARI
                    </button>
                </form>
                
                @if($search)
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-gray-600">
                        <i class="fas fa-info-circle mr-2"></i>
                        Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                    </p>
                    <a href="{{ route('berita.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        <i class="fas fa-times mr-1"></i>
                        Hapus Filter
                    </a>
                </div>
                @endif
            </div>
            
            <div class="section-divider"></div>
        </div>

        @if($berita->count() > 0)
            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-16">
                @foreach($berita as $item)
                <article class="news-card rounded-2xl overflow-hidden group">
                    <div class="image-container relative">
                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                             alt="{{ $item->title }}" 
                             class="news-image w-full h-56 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                <i class="fas fa-graduation-cap mr-1"></i>
                                {{ $item->category ?? 'Akademik' }}
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
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 150) }}
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
            @if($berita->hasPages())
            <div class="flex justify-center items-center space-x-3 mt-16">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50">
                    <div class="flex items-center space-x-2">
                        @if ($berita->onFirstPage())
                            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 text-gray-400 font-medium cursor-not-allowed">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </span>
                        @else
                            <a href="{{ $berita->previousPageUrl() }}" class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </a>
                        @endif
                        
                        @foreach ($berita->getUrlRange(1, $berita->lastPage()) as $page => $url)
                            @if ($page == $berita->currentPage())
                                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600 text-white font-semibold shadow-lg">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                        
                        @if ($berita->hasMorePages())
                            <a href="{{ $berita->nextPageUrl() }}" class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600 font-medium">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </a>
                        @else
                            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 text-gray-400 font-medium cursor-not-allowed">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @else
            <!-- No Results Found -->
            <div class="no-results rounded-2xl p-16 text-center">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class="fas fa-search text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        Tidak Ada Berita Ditemukan
                    </h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        @if($search)
                            Maaf, tidak ada berita yang cocok dengan pencarian "<strong>{{ $search }}</strong>". 
                            Coba gunakan kata kunci yang berbeda atau hapus filter pencarian.
                        @else
                            Belum ada berita yang tersedia saat ini. Silakan kembali lagi nanti.
                        @endif
                    </p>
                    @if($search)
                    <a href="{{ route('berita.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold bg-blue-50 hover:bg-blue-100 px-6 py-3 rounded-lg transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Lihat Semua Berita
                    </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</body>
</html>
@endsection