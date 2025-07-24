@extends('layouts.app')

@section('content')
<body class="bg-gradient-to-br from-gray-50 to-blue-50 font-sans leading-normal tracking-normal">
    <!-- Tambahkan CSS kustom untuk animasi dan efek -->
    <style>
        /* Shine/Sweep hover effect for main image */
        .berita-detail-image-wrapper {
            position: relative;
            overflow: hidden;
        }
        .berita-detail-image-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(120deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
            transform: skewX(-25deg);
            transition: left 0.6s cubic-bezier(0.4,0,0.2,1);
            pointer-events: none;
            z-index: 20;
        }
        .berita-detail-image-wrapper:hover::before {
            left: 120%;
            transition: left 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        /* Animasi fade-in */
        .animate-fade-in {
            animation: fadeIn 0.8s ease-in-out forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        

        
        /* Removed card-hover effect as requested */
        
        /* Gradient background */
        .bg-gradient-soft {
            background: linear-gradient(135deg, #f0f4f8 0%, #eef1f5 100%);
        }
        
        /* Social share buttons */
        .social-share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }
        
        /* Styling untuk konten artikel */
        .prose h2 {
            color: #1e40af;
            font-weight: 700;
            margin-top: 1.5em;
            margin-bottom: 0.8em;
            font-size: 1.5em;
        }
        
        .prose h3 {
            color: #2563eb;
            font-weight: 600;
            margin-top: 1.3em;
            margin-bottom: 0.6em;
            font-size: 1.25em;
        }
        
        .prose p {
            margin-bottom: 1.25em;
            line-height: 1.8;
        }
        
        .prose ul {
            list-style-type: disc;
            padding-left: 1.5em;
            margin-bottom: 1.25em;
        }
        
        .prose ol {
            list-style-type: decimal;
            padding-left: 1.5em;
            margin-bottom: 1.25em;
        }
        
        .prose li {
            margin-bottom: 0.5em;
        }
        
        .prose blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1em;
            font-style: italic;
            color: #4b5563;
            margin: 1.5em 0;
            background-color: #f3f4f6;
            padding: 1em;
            border-radius: 0 0.5em 0.5em 0;
        }
        
        .prose a {
            color: #2563eb;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px dotted #2563eb;
        }
        
        .prose a:hover {
            color: #1d4ed8;
            border-bottom: 1px solid #1d4ed8;
        }
        
        .prose table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5em 0;
        }
        
        .prose th {
            background-color: #f3f4f6;
            font-weight: 600;
            text-align: left;
            padding: 0.75em;
            border: 1px solid #e5e7eb;
        }
        
        .prose td {
            padding: 0.75em;
            border: 1px solid #e5e7eb;
        }
        
        .prose code {
            background-color: #f3f4f6;
            padding: 0.2em 0.4em;
            border-radius: 0.25em;
            font-family: monospace;
            font-size: 0.9em;
        }
    </style>
    <!-- Elemen dekoratif di background -->
    <div class="fixed top-0 right-0 w-1/3 h-screen bg-blue-50 opacity-50 -z-10 transform -skew-x-12"></div>
    <div class="fixed bottom-0 left-0 w-1/4 h-screen bg-purple-50 opacity-50 -z-10 transform skew-x-12"></div>
    
    <div class="container mx-auto px-4 py-12 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main content -->
        <div class="lg:col-span-8 animate-fade-in" style="animation-delay: 0.1s;">
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300">
                <div class="berita-detail-image-wrapper relative overflow-hidden rounded-t-2xl">
                    <img src="{{ asset('storage/' . $berita->image_path) }}" 
                         alt="{{ $berita->title }}" 
                         class="w-full h-[400px] object-cover transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-md">
                        <i class="fas fa-newspaper mr-1"></i> Berita
                    </div>
                    <!-- Overlay gradient pada gambar -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-60"></div>
                    <!-- Judul artikel di atas gambar -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium">{{ \Carbon\Carbon::parse($berita->publish_date)->isoFormat('D MMMM YYYY') }}</span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium">{{ $berita->count_views }} Views</span>
                        </div>
                        <h2 class="text-3xl font-bold text-white drop-shadow-md">{{ $berita->title }}</h2>
                    </div>
                </div>
                <div class="p-8 relative">
                    <!-- Elemen dekoratif di sudut konten -->
                    <div class="absolute top-0 right-0 w-24 h-24 opacity-5">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#0066FF" d="M39.9,-68.5C51.1,-62.8,59.5,-51.6,67.7,-39.7C75.9,-27.9,83.8,-14,85.8,1.2C87.8,16.3,83.8,32.6,74.6,44.9C65.4,57.2,51,65.5,36.3,70.7C21.7,75.9,6.8,78,-8.9,77.8C-24.6,77.6,-41.1,75.1,-53.8,66.8C-66.5,58.5,-75.4,44.4,-79.6,29.5C-83.8,14.6,-83.3,-1.1,-79.4,-15.8C-75.5,-30.5,-68.2,-44.2,-57.3,-51.5C-46.4,-58.8,-32,-59.7,-19.7,-65.2C-7.4,-70.7,3,-80.8,14.4,-81.1C25.8,-81.4,38.3,-71.9,39.9,-68.5Z" transform="translate(100 100)" />
                        </svg>
                    </div>
                    <div class="mb-6 flex justify-between items-center">
                        <a href="{{ route('berita.index') }}" class="text-sm text-blue-600 font-medium inline-flex items-center transition-colors duration-300 px-4 py-2 rounded-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Berita
                        </a>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-eye mr-1"></i>
                                <span>{{ $berita->count_views ?? 0 }} views</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-1"></i>
                                <span>{{ ceil(str_word_count(strip_tags($berita->description)) / 200) }} min read</span>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 leading-tight hidden">{{ $berita->title }}</h1>
                    <div class="flex flex-wrap items-center text-base text-gray-600 mb-8 space-x-6 animate-fade-in" style="animation-delay: 0.3s;">
                        <div class="flex items-center bg-blue-50 px-3 py-1 rounded-lg">
                            <i class="fas fa-tag mr-2 text-blue-500"></i>
                            <span>Pengumuman</span>
                        </div>
                        <div class="flex items-center bg-blue-50 px-3 py-1 rounded-lg">
                            <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                            <span>{{ \Carbon\Carbon::parse($berita->publish_date)->isoFormat('D MMMM YYYY') }}</span>
                        </div>
                        <div class="flex items-center bg-blue-50 px-3 py-1 rounded-lg">
                            <i class="fas fa-user mr-2 text-blue-500"></i>
                            <span>{{ $berita->author ?? 'Admin' }}</span>
                        </div>
                    </div>
                    <div class="prose lg:prose-xl max-w-none text-gray-700 leading-relaxed border-t border-b border-gray-100 py-8 my-6 animate-fade-in" style="animation-delay: 0.5s;">
                        <!-- Elemen dekoratif di awal artikel -->
                        <div class="not-prose mb-6 text-xl text-gray-500 font-serif italic border-l-4 border-blue-500 pl-4 py-2 bg-blue-50/50 rounded-r-lg">
                            {{ Str::words(strip_tags($berita->description), 20) }}
                        </div>
                        {!! $berita->description !!}
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mb-6">
                        @if(!empty($berita->tags))
                            @foreach(explode(',', $berita->tags) as $tag)
                                @if(!empty(trim($tag)))
                                    <a href="{{ route('berita.index', ['search' => trim($tag)]) }}" class="bg-gray-100 text-gray-800 px-3 py-1 rounded-md text-sm font-medium transition-colors duration-300">#{{ trim($tag) }}</a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    

                    
                    <!-- Tambahkan tombol berbagi sosial media yang lebih interaktif -->
                    <div class="mt-6 border-t border-gray-100 pt-6 animate-fade-in" style="animation-delay: 0.8s;">
                        <p class="text-sm font-medium text-gray-700 mb-3">Bagikan artikel ini:</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-full transition-colors duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $berita->title }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-400 rounded-full transition-colors duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ $berita->title }} {{ url()->current() }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-green-100 text-green-600 rounded-full transition-colors duration-300">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $berita->title }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-700 rounded-full transition-colors duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="mailto:?subject={{ $berita->title }}&body={{ url()->current() }}" class="flex items-center justify-center w-10 h-10 bg-red-100 text-red-600 rounded-full transition-colors duration-300">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            
            <!-- Navigasi antar artikel -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 animate-fade-in" style="animation-delay: 0.6s;">
                @if(isset($recentPosts) && $recentPosts->count() > 0)
                    @php
                        $prevPost = $recentPosts->where('publish_date', '<', $berita->publish_date)->sortByDesc('publish_date')->first();
                        $nextPost = $recentPosts->where('publish_date', '>', $berita->publish_date)->sortBy('publish_date')->first();
                        
                        // Jika tidak ada post sebelumnya/berikutnya, gunakan post terakhir/pertama sebagai fallback
                        if (!$prevPost && $recentPosts->count() > 1) {
                            $prevPost = $recentPosts->where('id', '!=', $berita->id)->sortByDesc('publish_date')->first();
                        }
                        
                        if (!$nextPost && $recentPosts->count() > 1) {
                            $nextPost = $recentPosts->where('id', '!=', $berita->id)->sortBy('publish_date')->first();
                        }
                    @endphp
                    
                    @if($prevPost)
                    <a href="{{ route('berita.show', $prevPost->slug) }}" class="p-4 bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300 flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-3 transition-colors duration-300">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-xs text-gray-500 mb-1">Artikel Sebelumnya</div>
                            <div class="font-medium text-gray-800 truncate">{{ $prevPost->title }}</div>
                        </div>
                    </a>
                    @else
                    <div></div>
                    @endif
                    
                    @if($nextPost)
                    <a href="{{ route('berita.show', $nextPost->slug) }}" class="p-4 bg-white rounded-xl shadow-sm border border-gray-100 transition-all duration-300 flex items-center justify-end text-right">
                        <div class="overflow-hidden">
                            <div class="text-xs text-gray-500 mb-1">Artikel Berikutnya</div>
                            <div class="font-medium text-gray-800 truncate">{{ $nextPost->title }}</div>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full ml-3 transition-colors duration-300">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                    @else
                    <div></div>
                    @endif
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="lg:col-span-4 animate-fade-in" style="animation-delay: 0.3s;">
            <div class="sticky top-4 space-y-6">
                <!-- Kotak pencarian -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-blue-500 pb-3 flex items-center">
                        <i class="fas fa-search text-blue-500 mr-3"></i>
                        Cari Berita
                    </h3>
                    <div class="relative">
                        <form action="{{ route('berita.index') }}" method="GET">
                            <div class="relative group">
                                <input type="text" name="search" placeholder="Cari berita..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                                <button type="submit" class="absolute right-3 top-3 text-gray-400 transition-colors duration-300">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 text-xs text-gray-500 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                        <span>Cari berdasarkan judul, isi, atau tag</span>
                    </div>
                </div>

                <!-- Artikel terbaru -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-green-500 pb-3 flex items-center">
                        <i class="fas fa-newspaper text-green-500 mr-3"></i>
                        <span>Berita Terbaru</span>
                    </h3>
                    <div class="space-y-4">
                        @if(isset($recentPosts) && $recentPosts->count() > 0)
                            @foreach($recentPosts->take(5) as $post)
                                <a href="{{ route('berita.show', $post->slug) }}" class="block">
                                    <div class="flex items-start space-x-3 p-3 rounded-lg transition-all duration-300">
                                        <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-300">
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900 line-clamp-2 transition-colors duration-300">{{ $post->title }}</h4>
                                            <div class="mt-1 text-xs text-gray-500 flex items-center">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                <span>{{ \Carbon\Carbon::parse($post->publish_date)->isoFormat('D MMM YYYY') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-center py-4">Tidak ada berita terbaru</p>
                        @endif
                    </div>
                </div>

                <!-- Tag populer -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-purple-500 pb-3 flex items-center">
                        <i class="fas fa-tags text-purple-500 mr-3"></i>
                        <span>Tag Populer</span>
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @if(isset($allTags) && count($allTags) > 0)
                            @foreach($allTags as $tag)
                                <a href="{{ route('berita.index', ['search' => $tag]) }}" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm transition-colors duration-300">
                                    #{{ $tag }}
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-center py-4 w-full">Tidak ada tag</p>
                        @endif
                    </div>
                </div>
                
                <!-- Newsletter subscription -->
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-envelope-open-text mr-2"></i> Berlangganan Newsletter
                    </h3>
                    <p class="text-white/80 mb-4 text-sm">Dapatkan update artikel terbaru langsung ke email Anda. Kami tidak akan mengirimkan spam.</p>
                    @if(session('newsletter_success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <span class="block sm:inline">{{ session('newsletter_success') }}</span>
                        </div>
                    @endif
                    @if(session('newsletter_error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <span class="block sm:inline">{{ session('newsletter_error') }}</span>
                        </div>
                    @endif
                    <form action="{{ route('newsletter.subscribe') }}" method="post" class="space-y-3">
                        @csrf
                        <input type="hidden" name="type" value="berita">
                        <div>
                            <input type="email" name="email" placeholder="Email Anda" class="w-full px-4 py-3 rounded-lg bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300" required>
                        </div>
                        <button type="submit" class="w-full py-3 bg-white text-blue-600 font-medium rounded-lg transition-colors duration-300 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Berlangganan
                        </button>
                    </form>
                </div>
                
                <!-- Statistik artikel 
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-chart-bar text-blue-500 mr-2"></i> Statistik Artikel
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Dilihat</span>
                            <span class="font-medium text-gray-800">{{ $berita->count_views ?? 0 }} kali</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Komentar</span>
                            <span class="font-medium text-gray-800">3</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Dibagikan</span>
                            <span class="font-medium text-gray-800">12 kali</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Waktu baca</span>
                            <span class="font-medium text-gray-800">{{ ceil(str_word_count(strip_tags($berita->description)) / 200) }} menit</span>
                        </div>
                    </div>
                </div>   -->

                  <!-- Menampilkan section jika is_active bernilai true -->
    @if($setting && $setting->is_active)
        <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-center text-center">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Pendaftaran Mahasiswa Baru 2025/2026</h2>
                    <p class="mt-4 text-blue-200 text-lg max-w-3xl mx-auto mb-8">Daftarkan diri Anda sekarang dan jadilah bagian dari keluarga besar Universitas Mercu Buana Yogyakarta!</p>
                    <div class="mt-6">
                        <a href="#" class="bg-white text-blue-800 hover:bg-blue-50 font-bold px-10 py-4 rounded-full inline-flex items-center text-lg transition-all shadow-lg transform hover:scale-105">
                            <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- Menampilkan pesan jika section PMB tidak aktif -->
        <section class="py-20 bg-gray-500 text-white w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-center text-center">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Pendaftaran Mahasiswa Baru 2025/2026</h2>
                    <p class="mt-4 text-blue-200 text-lg max-w-3xl mx-auto">Saat ini, pendaftaran mahasiswa baru tidak tersedia.</p>
                </div>
            </div>
        </section>
    @endif









            </div>
        </aside>
    </div>
</div>
</body>
@endsection
