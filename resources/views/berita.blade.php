@extends('layouts.app')

@section('title', 'Berita Kampus')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    
    body {
        font-family: 'Inter', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
        
        /* Efek pulse untuk badge */
        .pulse-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        
        /* Efek shimmer untuk highlight */
        .shimmer {
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.8) 50%, rgba(255,255,255,0) 100%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -100% 0; }
            100% { background-position: 100% 0; }
        }
        
        /* Efek untuk card berita */
        .berita-card {
            box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.1);
        }
        .berita-card-shadow {
            box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.1);
        }
        .berita-card-image {
        }
        .berita-image-wrapper {
            position: relative;
            overflow: hidden;
        }
        .berita-image-wrapper::before {
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
        .berita-image-wrapper:hover::before {
            left: 120%;
            transition: left 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        }
        
        /* Efek hover untuk tombol */
        .btn-hover-effect {
            position: relative;
            overflow: hidden;
        }
        
        .btn-hover-effect:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease-out;
            z-index: 0;
        }
        
        .btn-hover-effect:hover:after {
            transform: scaleX(1);
            transform-origin: left;
        }
</style>
@endpush

@section('content')
    <!-- Elemen dekoratif di background -->
    <div class="fixed top-0 right-0 w-1/3 h-screen bg-blue-50 opacity-30 -z-10 transform -skew-x-12"></div>
    <div class="fixed bottom-0 left-0 w-1/4 h-screen bg-purple-50 opacity-30 -z-10 transform skew-x-12"></div>
    
    <div class="container mx-auto px-4 py-12 relative z-10">
        
        <!-- Header Section dengan tampilan modern -->
        <div class="text-center mb-16 relative">
            <div class="inline-block mb-3 bg-blue-100 text-blue-800 px-4 py-1 rounded-full text-sm font-semibold tracking-wide relative overflow-hidden">
                <span class="absolute inset-0 bg-gradient-to-r from-blue-50/0 via-blue-50/80 to-blue-50/0 -translate-x-full animate-[shimmer_2s_infinite]"></span>
                <i class="fas fa-newspaper mr-2"></i> PORTAL BERITA KAMPUS
            </div>
            <h1 class="text-5xl lg:text-6xl font-extrabold tracking-tight mb-4">
                <span class="text-gray-900">Berita & </span>
                <span class="gradient-text">Informasi</span>
            </h1>
            <p class="text-xl text-gray-600 mt-4 max-w-3xl mx-auto leading-relaxed">
                Tetap terinformasi dengan berita dan pengumuman terbaru dari kami. 
                <span class="text-blue-600 font-medium">Jangan lewatkan update penting!</span>
            </p>
        </div>

        <!-- Search Bar dengan efek lebih menarik -->
        <div class="mb-12 max-w-3xl mx-auto relative">
            <form action="{{ route('berita.index') }}" method="GET">
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full blur opacity-30 group-hover:opacity-70 transition duration-500"></div>
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari berita berdasarkan judul atau tag..." 
                               class="w-full py-4 pl-12 pr-12 text-lg text-gray-700 bg-white rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                               value="{{ request('search') }}">
                        <div class="absolute top-0 left-0 mt-4 ml-4 text-blue-500">
                            <i class="fas fa-search fa-lg"></i>
                        </div>
                        <button type="submit" class="absolute top-0 right-0 mt-2 mr-2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-all duration-300 shadow-md">
                            <i class="fas fa-arrow-right fa-lg px-1"></i>
                        </button>
                    </div>
                </div>
                <div class="mt-3 flex justify-center flex-wrap gap-2 text-sm text-gray-600">
                    <span class="bg-blue-50 px-3 py-1 rounded-full hover:bg-blue-100 cursor-pointer transition-colors duration-300 border border-blue-100/50 hover:border-blue-200">#Akademik</span>
                    <span class="bg-blue-50 px-3 py-1 rounded-full hover:bg-blue-100 cursor-pointer transition-colors duration-300 border border-blue-100/50 hover:border-blue-200">#Beasiswa</span>
                    <span class="bg-blue-50 px-3 py-1 rounded-full hover:bg-blue-100 cursor-pointer transition-colors duration-300 border border-blue-100/50 hover:border-blue-200">#Kegiatan</span>
                    <span class="bg-blue-50 px-3 py-1 rounded-full hover:bg-blue-100 cursor-pointer transition-colors duration-300 border border-blue-100/50 hover:border-blue-200">#Prestasi</span>
                    <span class="bg-purple-50 px-3 py-1 rounded-full hover:bg-purple-100 cursor-pointer transition-colors duration-300 border border-purple-100/50 hover:border-purple-200">#Terbaru</span>
                </div>
            </form>
        </div>

        <!-- News Grid dengan tampilan modern -->
        <div id="berita-terbaru" class="scroll-mt-16"></div>
        @if($beritas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($beritas as $berita)
                    <div class="berita-card bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col border border-gray-100 relative berita-card-shadow group" style="cursor:pointer;">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="absolute inset-0 z-10" aria-label="Baca detail {{ $berita->title }}" tabindex="0" style="display:block;"></a>
                        <!-- Ribbon untuk berita terbaru jika publish date < 7 hari -->
                        @if(\Carbon\Carbon::parse($berita->publish_date)->diffInDays(now()) < 7)
                            <div class="absolute top-0 right-0 z-10 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-1 text-xs font-bold shadow-lg">
                                <i class="fas fa-bolt mr-1"></i> BARU
                            </div>
                        @endif
                        
                        <div class="relative overflow-hidden berita-image-wrapper">
                            <img src="{{ asset('storage/' . $berita->image_path) }}" 
                                 alt="{{ $berita->title }}" 
                                 class="w-full h-56 object-cover berita-card-image">
                            <!-- Overlay gradient pada gambar -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-80"></div>
                            <div class="absolute top-4 left-4 bg-blue-500 text-white px-4 py-1.5 rounded-full text-sm font-semibold shadow-md backdrop-blur-sm bg-opacity-90 capitalize">
                                @if(!empty($berita->tags))
                                    <i class="fas fa-tag mr-1"></i> {{ trim(explode(',', $berita->tags)[0]) }}
                                @else
                                    <i class="fas fa-bullhorn mr-1"></i> Pengumuman
                                @endif
                            </div>
                            <!-- Tanggal di atas gambar -->
                            <div class="absolute bottom-4 left-4 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-white flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <span>{{ \Carbon\Carbon::parse($berita->publish_date)->isoFormat('D MMMM YYYY') }}</span>
                            </div>
                            <!-- Views counter -->
                            <div class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-white flex items-center">
                                <i class="fas fa-eye mr-1"></i>
                                <span>{{ $berita->count_views ?? 0 }} views</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-2xl font-bold text-gray-900 mb-3 leading-tight hover:text-blue-600 transition-colors duration-300 line-clamp-2">{{ $berita->title }}</h2>
                            
                            <!-- Tags -->
                            @if(!empty($berita->tags))
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(explode(',', $berita->tags) as $tag)
                                        @if(!empty(trim($tag)))
                                            <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded-md text-xs font-medium">#{{ trim($tag) }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            
                            <p class="text-gray-700 flex-grow leading-relaxed line-clamp-3">{{ Str::limit(strip_tags($berita->description), 130) }}</p>
                            
                            <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center bg-gradient-to-b from-white/0 to-gray-50/50 -mx-6 px-6">
                                <div class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-clock mr-1 text-blue-500"></i>
                                    <span>{{ ceil(str_word_count(strip_tags($berita->description)) / 200) }} min read</span>
                                </div>
                                <a href="{{ route('berita.show', $berita->slug) }}" class="font-semibold text-blue-600 hover:text-blue-800 inline-flex items-center group bg-blue-50 px-4 py-2 rounded-lg transition-all duration-300 hover:bg-blue-100 relative btn-hover-effect">
                                    <span class="relative z-10">Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1 relative z-10"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination dengan styling yang lebih menarik -->
            <div class="mt-16">
                <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100">
                    {{ $beritas->links('vendor.pagination.tailwind') }}
                </div>
                <div class="text-center mt-4 text-sm text-gray-500">
                    Menampilkan {{ $beritas->firstItem() ?? 0 }} - {{ $beritas->lastItem() ?? 0 }} dari {{ $beritas->total() ?? 0 }} berita
                </div>
            </div>
        @else
            <div class="mt-8">
                <div class="bg-white rounded-2xl shadow-md p-10 text-center max-w-2xl mx-auto border border-gray-100 card-shadow">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-blue-500 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Tidak ada berita yang ditemukan</h3>
                    <p class="text-gray-600 mb-6">Maaf, kami tidak dapat menemukan berita yang sesuai dengan kriteria pencarian Anda.</p>
                    <div class="space-y-4">
                        <a href="{{ route('berita.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg transition-all duration-300">
                            <i class="fas fa-home mr-2"></i> Kembali ke Halaman Utama
                        </a>
                        <div class="text-sm text-gray-500">atau coba kata kunci pencarian lainnya</div>
                        <div class="flex flex-wrap justify-center gap-2 mt-2">
                            <a href="{{ route('berita.index', ['search' => 'terbaru']) }}" class="px-4 py-2 bg-gray-100 rounded-full text-gray-700 text-sm">#terbaru</a>
                            <a href="{{ route('berita.index', ['search' => 'kampus']) }}" class="px-4 py-2 bg-gray-100 rounded-full text-gray-700 text-sm">#kampus</a>
                            <a href="{{ route('berita.index', ['search' => 'mahasiswa']) }}" class="px-4 py-2 bg-gray-100 rounded-full text-gray-700 text-sm">#mahasiswa</a>
                            <a href="{{ route('berita.index', ['search' => 'kegiatan']) }}" class="px-4 py-2 bg-gray-100 rounded-full text-gray-700 text-sm">#kegiatan</a>
                        </div>
                    </div>
                </div>
                
                <!-- Dekoratif elemen untuk halaman kosong -->
                <div class="relative mt-16 max-w-4xl mx-auto">
                    <div class="absolute -top-10 -left-10 w-20 h-20 bg-blue-100 rounded-full opacity-50"></div>
                    <div class="absolute -bottom-10 -right-10 w-20 h-20 bg-purple-100 rounded-full opacity-50"></div>
                    <div class="bg-white rounded-2xl shadow-md p-6 text-center border border-gray-100 card-shadow">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Berita Akan Datang</h3>
                        <p class="text-gray-600 mb-4">Kami sedang menyiapkan berita-berita menarik untuk Anda. Kunjungi kembali halaman ini dalam beberapa hari.</p>
                        <div class="flex justify-center space-x-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-lg"></div>
                            <div class="w-16 h-16 bg-blue-100 rounded-lg"></div>
                            <div class="w-16 h-16 bg-purple-100 rounded-lg"></div>
                            <div class="w-16 h-16 bg-gray-200 rounded-lg"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
