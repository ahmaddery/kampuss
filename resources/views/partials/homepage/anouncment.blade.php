    <!-- Pengumuman Section -->
    <div class="py-14 bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold text-blue-900 mb-2 flex items-center justify-center gap-2">
                    <i class="fas fa-bullhorn text-blue-600"></i> Pengumuman
                </h2>
                <div class="w-16 h-1 bg-blue-500 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                @foreach($pengumuman as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 hover:shadow-xl transition-all duration-300 relative animate-fadeInUp">
                        <div class="relative shine-image-wrapper">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-40 object-cover">
                            <div class="absolute top-3 right-3">
                                <span class="bg-blue-600 text-white px-2 py-0.5 rounded-full text-xs font-bold shadow">
                                    {{ \Carbon\Carbon::parse($item->publish_date)->format('d M') }}
                                </span>
                                @if($loop->first)
                                    <span class="absolute -top-3 -right-3 bg-red-500 text-white px-2 py-0.5 rounded-full text-xs font-bold shadow animate-bounce">Baru</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-base text-blue-900 mb-1 line-clamp-2">{{ $item->title }}</h3>
                            <p class="text-gray-500 text-sm mb-2 italic line-clamp-3">
                                {!! \Illuminate\Support\Str::limit(strip_tags($item->description), 60) !!}
                            </p>
                            <a href="{{ route('pengumuman.show', $item->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-xs mt-1 transition">
                                Detail <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-2">
                <a href="{{ route('pengumuman.index') }}" class="bg-blue-600 text-white py-2 px-6 rounded-full text-sm font-bold shadow transition-all duration-300 hover:bg-blue-700 hover:scale-105">
                    Semua Pengumuman
                </a>
            </div>
        </div>
    </div>