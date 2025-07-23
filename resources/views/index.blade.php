@extends('layouts.app') <!-- Menggunakan layout app -->

@section('title', 'Home Page') <!-- Menentukan judul halaman -->

@section('content')

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
<!-- Image Slider Section -->
<div class="relative w-full h-[500px] md:h-[600px] overflow-hidden rounded-lg shadow-lg">
    <!-- Slider Container -->
    <div id="slider" class="flex transition-transform duration-500 ease-in-out h-full">
        @foreach($banners as $banner)
        <div class="min-w-full h-full relative">
            <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-center text-white">
                    <h2 class="text-4xl font-bold mb-4">{{ $banner->title }}</h2>
                    <p class="text-xl">{{ $banner->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Previous Button -->
    <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
        <i class="fas fa-chevron-left text-lg"></i>
    </button>

    <!-- Next Button -->
    <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
        <i class="fas fa-chevron-right text-lg"></i>
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3">
        @foreach($banners as $index => $banner)
            <button class="dot w-3 h-3 rounded-full bg-white opacity-60 hover:opacity-100 transition-opacity duration-300" data-slide="{{ $index }}"></button>
        @endforeach
    </div>
</div>

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
                        <a href="" class="text-blue-700 hover:text-blue-900 font-medium inline-flex items-center transition-all">
                            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
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
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="" class="btn-primary text-white font-medium px-8 py-3 rounded-full inline-flex items-center">
                Lihat Semua Program <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>


  <!-- Menampilkan section jika is_active bernilai true -->
    @if($setting && $setting->is_active)
        <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-2/3 text-center md:text-left mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold">Pendaftaran Mahasiswa Baru 2025/2026</h2>
                        <p class="mt-4 text-blue-200 text-lg">Daftarkan diri Anda sekarang dan jadilah bagian dari keluarga besar Universitas Mercu Buana Yogyakarta!</p>
                    </div>
                    <div>
                        <a href="#" class="bg-white text-blue-800 hover:bg-blue-50 font-bold px-8 py-4 rounded-full inline-flex items-center text-lg transition-all shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- Menampilkan pesan jika section PMB tidak aktif -->
        <section class="py-20 bg-gray-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-2/3 text-center md:text-left mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold">Pendaftaran Mahasiswa Baru 2025/2026</h2>
                        <p class="mt-4 text-blue-200 text-lg">Saat ini, pendaftaran mahasiswa baru tidak tersedia.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

<!-- Pengumuman Section -->
<div class="py-16 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">PENGUMUMAN</h2>
            <div class="w-24 h-1 bg-yellow-500 mx-auto rounded-full"></div>
        </div>

        <div class="container">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Pengumuman Terbaru</h1>

            <!-- Pengumuman Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @foreach($berita as $item)
                    <!-- Pengumuman Item -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-shadow duration-300">
                        <div class="relative shine-image-wrapper">
                            <!-- Displaying Image -->
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-bold">
                                <div class="text-center">
                                    <div class="text-lg">{{ \Carbon\Carbon::parse($item->publish_date)->format('d') }}</div>
                                    <div class="text-xs">{{ \Carbon\Carbon::parse($item->publish_date)->format('M') }}</div>
                                    <div class="text-xs">{{ \Carbon\Carbon::parse($item->publish_date)->format('Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">Pengumuman • By {{ $item->author }}</p>
                            <p class="text-gray-600 text-sm mb-4">
                                <!-- Limiting the description to 100 characters while preserving HTML tags -->
                                {!! \Illuminate\Support\Str::limit(strip_tags($item->description), 100) !!}
                            </p>

                            <!-- Link to show all berita -->
                            <a href="{{ route('berita.show', $item->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm mt-4">
                                lihat Berita <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        </div>
                    </div>

    <style>
    /* Shine/Sweep hover effect for announcement images */
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
                @endforeach
            </div>

            <!-- Button to see more announcements -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('berita.index') }}" class="bg-blue-600 text-white py-2 px-6 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-blue-700 transform hover:scale-105">
                    Lihat Semua Pengumuman
                </a>
            </div>
        </div>
    </div>
</div>




     <!-- Dosen & Staff Section -->
    <div class="py-20 bg-gradient-to-r from-purple-900 via-blue-900 to-purple-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-32 h-32 bg-green-400 rounded-full transform -translate-x-16 -translate-y-16"></div>
            <div class="absolute top-20 right-20 w-24 h-24 bg-yellow-400 rounded-full"></div>
            <div class="absolute bottom-20 left-20 w-28 h-28 bg-red-400 rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-36 h-36 bg-blue-400 rounded-full transform translate-x-18 translate-y-18"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">DOSEN & STAF</h2>
                <p class="text-xl text-gray-200">Dosen & Staf profesional</p>
            </div>

            <!-- Staff Slider Container -->
            <div class="relative">
                <!-- Slider Wrapper -->
                <div class="overflow-hidden">
                    <div id="staffSlider" class="flex transition-transform duration-500 ease-in-out">
                        <!-- Slide 1 -->
                        <div class="min-w-full">
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                                <!-- Staff Card 1 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1494790108755-2616c274b5e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Iswahyuni" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Iswahyuni, S.P....</h3>
                                        <p class="text-sm text-gray-600 mb-3">Wakil Ketua II</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 2 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Dr. Sudarsono" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Dr. Sudarsono,......</h3>
                                        <p class="text-sm text-gray-600 mb-3">Wakil Ketua III</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 3 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Hj. Kusjuniati" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Hj. Kusjuniati, S.E....</h3>
                                        <p class="text-sm text-gray-600 mb-3">Ka. Prodi ES</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 4 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Haris Nursyah" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Haris Nursyah...</h3>
                                        <p class="text-sm text-gray-600 mb-3">Ka. Prodi PAI</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 5 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Nur Wahyudi" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Nur Wahyudi, S....</h3>
                                        <p class="text-sm text-gray-600 mb-3">Ka. Prodi MPI</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="min-w-full">
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                                <!-- Additional Staff Cards for slide 2 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Dr. Siti Aminah" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Dr. Siti Aminah...</h3>
                                        <p class="text-sm text-gray-600 mb-3">Dosen Senior</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Ahmad Fauzi" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Ahmad Fauzi, M.Pd</h3>
                                        <p class="text-sm text-gray-600 mb-3">Staf Akademik</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Rini Handayani" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Rini Handayani...</h3>
                                        <p class="text-sm text-gray-600 mb-3">Staf Keuangan</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Budi Santoso" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Budi Santoso, S.E</h3>
                                        <p class="text-sm text-gray-600 mb-3">Kepala TU</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Maya Sari" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Maya Sari, M.A</h3>
                                        <p class="text-sm text-gray-600 mb-3">Dosen Muda</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button id="staffPrevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 w-12 h-12 rounded-full shadow-lg transition-all duration-300 hover:scale-110 z-10">
                    <i class="fas fa-chevron-left text-lg"></i>
                </button>
                
                <button id="staffNextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 w-12 h-12 rounded-full shadow-lg transition-all duration-300 hover:scale-110 z-10">
                    <i class="fas fa-chevron-right text-lg"></i>
                </button>
            </div>

            <!-- Dots Indicator -->
            <div class="flex justify-center mt-12 space-x-3">
                <button class="staff-dot w-3 h-3 rounded-full bg-white opacity-60 hover:opacity-100 transition-opacity duration-300" data-slide="0"></button>
                <button class="staff-dot w-3 h-3 rounded-full bg-white opacity-60 hover:opacity-100 transition-opacity duration-300" data-slide="1"></button>
            </div>
        </div>
    </div>

     <script>
        class ImageSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 3;
                this.isPlaying = true;
                this.intervalId = null;
                this.autoSlideDelay = 4000; // 4 seconds
                
                this.slider = document.getElementById('slider');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                this.playPauseBtn = null;
                this.playPauseIcon = null;
                this.dots = document.querySelectorAll('.dot');
                
                this.init();
            }
            
            init() {
                // Set initial active dot
                this.updateDots();
                
                // Start auto slide
                this.startAutoSlide();
                
                // Event listeners
                this.prevBtn.addEventListener('click', () => this.prevSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                this.slider.parentElement.addEventListener('mouseenter', () => {
                    if (this.isPlaying) {
                        this.pauseAutoSlide();
                    }
                });
                
                this.slider.parentElement.addEventListener('mouseleave', () => {
                    if (this.isPlaying) {
                        this.startAutoSlide();
                    }
                });
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                this.slider.style.transform = `translateX(${translateX}%)`;
                this.updateDots();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            updateDots() {
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.remove('opacity-60');
                        dot.classList.add('opacity-100', 'bg-blue-500');
                    } else {
                        dot.classList.remove('opacity-100', 'bg-blue-500');
                        dot.classList.add('opacity-60');
                    }
                });
            }
            
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, this.autoSlideDelay);
            }
            
            pauseAutoSlide() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                }
            }
            
            addTouchSupport() {
                let startX = 0;
                let endX = 0;
                
                this.slider.parentElement.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                
                this.slider.parentElement.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                });
                
                this.slider.parentElement.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;
                    
                    if (Math.abs(diff) > 50) { // Minimum swipe distance
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                });
            }
        }

        // Staff Slider Class
        class StaffSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 2;
                this.intervalId = null;
                this.autoSlideDelay = 8000; // 8 seconds - slower for staff profiles
                
                this.slider = document.getElementById('staffSlider');
                this.prevBtn = document.getElementById('staffPrevBtn');
                this.nextBtn = document.getElementById('staffNextBtn');
                this.dots = document.querySelectorAll('.staff-dot');
                
                this.init();
            }
            
            init() {
                // Set initial active dot
                this.updateDots();
                
                // Start auto slide
                this.startAutoSlide();
                
                // Event listeners
                this.prevBtn.addEventListener('click', () => this.prevSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                this.slider.parentElement.addEventListener('mouseenter', () => {
                    this.pauseAutoSlide();
                });
                
                this.slider.parentElement.addEventListener('mouseleave', () => {
                    this.startAutoSlide();
                });
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                this.slider.style.transform = `translateX(${translateX}%)`;
                this.updateDots();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            updateDots() {
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.remove('opacity-60');
                        dot.classList.add('opacity-100');
                    } else {
                        dot.classList.remove('opacity-100');
                        dot.classList.add('opacity-60');
                    }
                });
            }
            
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, this.autoSlideDelay);
            }
            
            pauseAutoSlide() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                }
            }
            
            addTouchSupport() {
                let startX = 0;
                let endX = 0;
                
                this.slider.parentElement.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                
                this.slider.parentElement.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                });
                
                this.slider.parentElement.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;
                    
                    if (Math.abs(diff) > 50) { // Minimum swipe distance
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                });
            }
        }
        
        // Initialize slider when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ImageSlider();
            new ProdiSlider();
            new StaffSlider();
        });

        // Program Studi Slider Class
        class ProdiSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 3;
                this.intervalId = null;
                this.autoSlideDelay = 6000; // 6 seconds
                
                this.slider = document.getElementById('prodiSlider');
                this.prevBtn = document.getElementById('prodiPrevBtn');
                this.nextBtn = document.getElementById('prodiNextBtn');
                this.dots = document.querySelectorAll('.prodi-dot');
                
                this.init();
            }
            
            init() {
                // Set initial active dot
                this.updateDots();
                
                // Start auto slide
                this.startAutoSlide();
                
                // Event listeners
                this.prevBtn.addEventListener('click', () => this.prevSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                this.slider.parentElement.addEventListener('mouseenter', () => {
                    this.pauseAutoSlide();
                });
                
                this.slider.parentElement.addEventListener('mouseleave', () => {
                    this.startAutoSlide();
                });
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                this.slider.style.transform = `translateX(${translateX}%)`;
                this.updateDots();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            updateDots() {
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.remove('bg-gray-400');
                        dot.classList.add('bg-blue-500');
                    } else {
                        dot.classList.remove('bg-blue-500');
                        dot.classList.add('bg-gray-400');
                    }
                });
            }
            
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, this.autoSlideDelay);
            }
            
            pauseAutoSlide() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                }
            }
            
            addTouchSupport() {
                let startX = 0;
                let endX = 0;
                
                this.slider.parentElement.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                
                this.slider.parentElement.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                });
                
                this.slider.parentElement.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;
                    
                    if (Math.abs(diff) > 50) { // Minimum swipe distance
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                });
            }
        }
    </script>

@endsection