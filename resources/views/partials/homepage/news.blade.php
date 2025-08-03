    <!-- Berita Section -->
    <div class="py-14 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2 flex items-center justify-center gap-2">
                    <i class="fas fa-newspaper text-yellow-500"></i> Berita
                </h2>
                <div class="w-16 h-1 bg-yellow-500 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                @foreach($berita as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 hover:shadow-xl transition-all duration-300 relative animate-fadeInUp">
                        <div class="relative shine-image-wrapper">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-40 object-cover">
                            <div class="absolute top-3 right-3">
                                <span class="bg-yellow-500 text-white px-2 py-0.5 rounded-full text-xs font-bold shadow">
                                    {{ \Carbon\Carbon::parse($item->publish_date)->format('d M') }}
                                </span>
                                @if(isset($item->count_views) && $item->count_views > 100)
                                    <span class="absolute -top-3 -right-3 bg-red-500 text-white px-2 py-0.5 rounded-full text-xs font-bold shadow animate-pulse">Populer</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-base text-gray-900 mb-1 line-clamp-2">{{ $item->title }}</h3>
                            <p class="text-gray-500 text-sm mb-2 italic line-clamp-3">
                                {!! \Illuminate\Support\Str::limit(strip_tags($item->description), 60) !!}
                            </p>
                            <a href="{{ route('berita.show', $item->slug) }}" class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-semibold text-xs mt-1 transition">
                                Detail <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-2">
                <a href="{{ route('berita.index') }}" class="bg-yellow-500 text-white py-2 px-6 rounded-full text-sm font-bold shadow transition-all duration-300 hover:bg-yellow-600 hover:scale-105">
                    Semua Berita
                </a>
            </div>
        </div>
    </div>

    <style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translate3d(0, 30px, 0);}
        to { opacity: 1; transform: none;}
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.7s cubic-bezier(0.4,0,0.2,1) both;
    }
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>