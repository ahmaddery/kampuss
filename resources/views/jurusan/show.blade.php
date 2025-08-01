@extends('layouts.app')

@section('title', $jurusan->seo_title ?: $jurusan->jurusan)

@section('meta')
    <meta name="description" content="{{ $jurusan->seo_description ?: $jurusan->deskripsi }}">
    <meta name="keywords" content="{{ $jurusan->jurusan }}, program studi, universitas">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $jurusan->seo_title ?: $jurusan->jurusan }}">
    <meta property="og:description" content="{{ $jurusan->seo_description ?: $jurusan->deskripsi }}">
    @if($jurusan->icon)
        <meta property="og:image" content="{{ asset('storage/' . $jurusan->icon) }}">
    @endif

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $jurusan->seo_title ?: $jurusan->jurusan }}">
    <meta property="twitter:description" content="{{ $jurusan->seo_description ?: $jurusan->deskripsi }}">
    @if($jurusan->icon)
        <meta property="twitter:image" content="{{ asset('storage/' . $jurusan->icon) }}">
    @endif
@endsection

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <i class="fas fa-home mr-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('jurusan.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Program Studi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $jurusan->jurusan }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <!-- Icon -->
                @if($jurusan->icon)
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 bg-white rounded-full p-6 shadow-lg">
                            <img src="{{ asset('storage/' . $jurusan->icon) }}" 
                                 alt="{{ $jurusan->jurusan }}" 
                                 class="w-full h-full object-contain">
                        </div>
                    </div>
                @endif
                
                <!-- Content -->
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $jurusan->jurusan }}</h1>
                    <p class="text-xl text-blue-100 mb-6">{{ $jurusan->deskripsi }}</p>
                    
                    <!-- Quick Info -->
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        @if($jurusan->informasiProgram)
                        <span class="bg-blue-800 bg-opacity-50 px-4 py-2 rounded-full text-sm">
                            <i class="fas fa-graduation-cap mr-2"></i>{{ $jurusan->informasiProgram->jenjang }}
                        </span>
                        <span class="bg-blue-800 bg-opacity-50 px-4 py-2 rounded-full text-sm">
                            <i class="fas fa-clock mr-2"></i>{{ $jurusan->informasiProgram->durasi }}
                        </span>
                        @if($jurusan->informasiProgram->akreditasi)
                        <span class="bg-blue-800 bg-opacity-50 px-4 py-2 rounded-full text-sm">
                            <i class="fas fa-certificate mr-2"></i>Akreditasi {{ $jurusan->informasiProgram->akreditasi }}
                        </span>
                        @endif
                        @else
                        <span class="bg-blue-800 bg-opacity-50 px-4 py-2 rounded-full text-sm">
                            <i class="fas fa-graduation-cap mr-2"></i>Program Sarjana
                        </span>
                        <span class="bg-blue-800 bg-opacity-50 px-4 py-2 rounded-full text-sm">
                            <i class="fas fa-clock mr-2"></i>4 Tahun
                        </span>
                        <span class="bg-blue-800 bg-opacity-50 px-4 py-2 rounded-full text-sm">
                            <i class="fas fa-certificate mr-2"></i>Terakreditasi
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Overview -->
                <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                        Tentang Program Studi
                    </h2>
                    
                    @if($jurusan->deskripsi_lengkap)
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($jurusan->deskripsi_lengkap)) !!}
                        </div>
                    @else
                        <p class="text-gray-700 leading-relaxed">{{ $jurusan->deskripsi }}</p>
                    @endif
                </div>

                <!-- Curriculum -->
                <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-book text-blue-600 mr-3"></i>
                        Kurikulum & Mata Kuliah
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Semester 1-2 (Dasar)</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Matematika Dasar</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Bahasa Indonesia</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Bahasa Inggris</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Pendidikan Kewarganegaraan</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Semester 3-4 (Inti)</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Mata Kuliah Kejuruan</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Praktikum Laboratorium</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Metodologi Penelitian</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Statistika</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Career Prospects -->
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-briefcase text-blue-600 mr-3"></i>
                        Prospek Karir
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Sektor Pemerintah</h4>
                            <p class="text-gray-600 text-sm">Instansi pemerintah, BUMN, dan lembaga negara</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Sektor Swasta</h4>
                            <p class="text-gray-600 text-sm">Perusahaan multinasional dan nasional</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Wirausaha</h4>
                            <p class="text-gray-600 text-sm">Membangun bisnis dan startup sendiri</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Akademisi</h4>
                            <p class="text-gray-600 text-sm">Dosen, peneliti, dan konsultan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Info -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Program</h3>
                    
                    <div class="space-y-4">
                        @if($jurusan->informasiProgram)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Jenjang</span>
                            <span class="font-medium">{{ $jurusan->informasiProgram->jenjang }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-medium">{{ $jurusan->informasiProgram->durasi }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">SKS</span>
                            <span class="font-medium">{{ $jurusan->informasiProgram->sks }}</span>
                        </div>
                        @if($jurusan->informasiProgram->akreditasi)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Akreditasi</span>
                            <span class="font-medium text-green-600">{{ $jurusan->informasiProgram->akreditasi }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-600">Gelar</span>
                            <span class="font-medium">{{ $jurusan->informasiProgram->gelar }}</span>
                        </div>
                        @else
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Jenjang</span>
                            <span class="font-medium">S1 (Sarjana)</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-medium">8 Semester</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">SKS</span>
                            <span class="font-medium">144 SKS</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Akreditasi</span>
                            <span class="font-medium text-green-600">B</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-600">Gelar</span>
                            <span class="font-medium">S.Kom</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Hubungi Kami</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 mr-3"></i>
                            <span class="text-gray-700">prodi@university.ac.id</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-600 mr-3"></i>
                            <span class="text-gray-700">+62 274 123456</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                            <span class="text-gray-700">Kampus Universitas</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-6 text-white text-center">
                    <h3 class="text-lg font-bold mb-2">Tertarik dengan Program Ini?</h3>
                    <p class="text-blue-100 mb-4">Daftar sekarang dan wujudkan impian akademik Anda!</p>
                    <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors inline-block">
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Related Programs -->
                <div class="bg-white rounded-lg shadow-sm p-6 mt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Program Terkait</h3>
                    
                    <div class="space-y-3">
                        <!-- You can add dynamic related programs here -->
                        <a href="#" class="block p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <h4 class="font-medium text-gray-800">Sistem Informasi</h4>
                            <p class="text-sm text-gray-600">Program studi yang berfokus pada...</p>
                        </a>
                        <a href="#" class="block p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <h4 class="font-medium text-gray-800">Teknik Elektro</h4>
                            <p class="text-sm text-gray-600">Program studi yang mempelajari...</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JSON-LD Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Course",
        "name": "{{ $jurusan->jurusan }}",
        "description": "{{ $jurusan->seo_description ?: $jurusan->deskripsi }}",
        "provider": {
            "@type": "EducationalOrganization",
            "name": "Universitas Mercu Buana Yogyakarta"
        },
        @if($jurusan->icon)
        "image": "{{ asset('storage/' . $jurusan->icon) }}",
        @endif
        "educationalLevel": "Undergraduate",
        "timeRequired": "P4Y",
        "url": "{{ url()->current() }}"
    }
    </script>
</div>
@endsection
