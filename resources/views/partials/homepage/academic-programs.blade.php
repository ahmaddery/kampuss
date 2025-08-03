<!-- Academic Programs Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">Program Akademik Unggulan</h2>
            <div class="mt-2 w-20 h-1 bg-blue-700 mx-auto"></div>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Pilih program studi terbaik sesuai dengan minat dan bakat untuk masa depan karir yang cemerlang</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($jurusans as $jurusan)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all">
                    <div class="bg-blue-700 h-2"></div>
                    <div class="relative shine-image-wrapper">
                        <img src="{{ asset('storage/' . $jurusan->icon) }}" alt="{{ $jurusan->jurusan }}" class="w-full h-48 object-cover object-center">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $jurusan->jurusan }}</h3>
                        <p class="text-gray-600 mb-4">{{ $jurusan->deskripsi }}</p>
                        <a href="{{ route('jurusan.show', $jurusan->slug) }}" class="text-blue-700 hover:text-blue-900 font-medium inline-flex items-center transition-all">
                            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('jurusan.index') }}" class="btn-primary text-white font-medium px-8 py-3 rounded-full inline-flex items-center">
                Lihat Semua Program <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<style>
/* Shine/Sweep hover effect for academic program images */
.shine-image-wrapper {
    position: relative;
    overflow: hidden;
}
.shine-image-wrapper::before {
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
.shine-image-wrapper:hover::before {
    left: 120%;
    transition: left 0.6s cubic-bezier(0.4,0,0.2,1);
}
</style>
