<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Universitas Mercu Buana Yogyakarta')</title>
    
    <!-- SEO Meta Tags -->
    @yield('meta')
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Custom Styles -->
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Top bar with email and social media -->
<div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Desktop version - horizontal layout -->
        <div class="hidden md:flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <i class="fas fa-envelope mr-2 text-blue-200"></i>
                    <span class="text-sm">{{ $contactInfo['email'] ?? 'info@mercubuana-yogya.ac.id' }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone-alt mr-2 text-blue-200"></i>
                    <span class="text-sm">{{ $contactInfo['phone'] ?? '(0274) 123456' }}</span>
                </div>
            </div>
            <div class="flex space-x-5">
                @foreach($socialMedia as $social)
                <a href="{{ $social['url'] }}" target="_blank" class="text-white hover:text-blue-200 transition-all" aria-label="{{ $social['name'] }}">
                    <i class="{{ $social['icon_class'] }}"></i>
                </a>
                @endforeach
            </div>
        </div>
        
        <!-- Mobile version - two rows layout -->
        <div class="flex flex-col md:hidden">
            <!-- Email and phone row -->
            <div class="flex justify-center items-center mb-2">
                <div class="flex items-center">
                    <i class="fas fa-envelope mr-2 text-blue-200"></i>
                    <span class="text-sm">{{ $contactInfo['email'] ?? 'info@mercubuana-yogya.ac.id' }}</span>
                </div>
            </div>
            
            <!-- Social media row -->
            <div class="flex justify-center space-x-6">
                @foreach($socialMedia as $social)
                <a href="{{ $social['url'] }}" target="_blank" class="text-white hover:text-blue-200 transition-all" aria-label="{{ $social['name'] }}">
                    <i class="{{ $social['icon_class'] }}"></i>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

   <!-- Main Navbar -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-20">
            <!-- Logo Section - Now left-aligned on mobile -->
            <div class="flex-1 flex items-center sm:items-stretch sm:justify-start">
                <a href="/" class="flex-shrink-0 flex items-center">
                    <img class="h-12 w-auto" src="{{ asset('assets/image.jpeg') }}" alt="Mercu Buana Yogyakarta">
                </a>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-1 items-center h-full ml-10">
                        <a href="/" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all">Home</a>
                        @php
                            $hasActiveProfilePages = (isset($pageSettings['sambutan-rektor']) && $pageSettings['sambutan-rektor']) ||
                                                   (isset($pageSettings['sejarah']) && $pageSettings['sejarah']) ||
                                                   (isset($pageSettings['visi-misi']) && $pageSettings['visi-misi']) ||
                                                   (isset($pageSettings['struktur-organisasi']) && $pageSettings['struktur-organisasi']);
                        @endphp
                        @if($hasActiveProfilePages)
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Profil <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    @if(isset($pageSettings['sambutan-rektor']) && $pageSettings['sambutan-rektor'])
                                        <a href="{{ route('sambutan-rektor.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Sambutan Rektor</a>
                                    @endif
                                    @if(isset($pageSettings['sejarah']) && $pageSettings['sejarah'])
                                        <a href="{{ route('sejarah.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Sejarah</a>
                                    @endif
                                    @if(isset($pageSettings['visi-misi']) && $pageSettings['visi-misi'])
                                        <a href="{{ route('visi-misi.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Visi & Misi</a>
                                    @endif
                                    @if(isset($pageSettings['struktur-organisasi']) && $pageSettings['struktur-organisasi'])
                                        <a href="{{ route('organization-structure.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Struktur Organisasi</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="group relative px-1">
                            <a href="{{ route('jurusan.index') }}" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Program Studi <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="{{ route('jurusan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 font-medium border-b border-gray-100">
                                        <i class="fas fa-list mr-2"></i>Lihat Semua Program Studi
                                    </a>
                                    @php
                                        $jurusans = \App\Models\Jurusan::limit(6)->get();
                                    @endphp
                                    @foreach($jurusans as $jurusan)
                                        <a href="{{ route('jurusan.show', $jurusan->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                                            {{ $jurusan->jurusan }}
                                        </a>
                                    @endforeach
                                    @if($jurusans->count() >= 6)
                                        <div class="border-t border-gray-100 mt-1 pt-1">
                                            <a href="{{ route('jurusan.index') }}" class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 font-medium">
                                                <i class="fas fa-arrow-right mr-2"></i>Lihat Semua
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="group relative px-1">
                            <a href="{{ route('fasilitas.index') }}" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Fasilitas <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="{{ route('fasilitas.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 font-medium border-b border-gray-100">
                                        <i class="fas fa-list mr-2"></i>Lihat Semua Fasilitas
                                    </a>
                                    @php
                                        $topFasilitas = \App\Models\Fasilitas::aktif()->limit(5)->get();
                                    @endphp
                                    @foreach($topFasilitas as $fasilitas)
                                        <a href="{{ route('fasilitas.show', $fasilitas->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                                            {{ $fasilitas->nama_fasilitas }}
                                        </a>
                                    @endforeach
                                    @if($topFasilitas->count() >= 5)
                                        <div class="border-t border-gray-100 mt-1 pt-1">
                                            <a href="{{ route('fasilitas.index') }}" class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 font-medium">
                                                <i class="fas fa-arrow-right mr-2"></i>Lihat Semua
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="group relative px-1">
                            <a href="{{ route('biro.index') }}" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Biro <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="{{ route('biro.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 font-medium border-b border-gray-100">
                                        <i class="fas fa-list mr-2"></i>Lihat Semua Biro
                                    </a>
                                    @php
                                        $topBiros = \App\Models\Biro::aktif()->limit(5)->get();
                                    @endphp
                                    @foreach($topBiros as $biro)
                                        <a href="{{ route('biro.show', $biro->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                                            {{ $biro->nama_biro }}
                                        </a>
                                    @endforeach
                                    @if($topBiros->count() >= 5)
                                        <div class="border-t border-gray-100">
                                            <a href="{{ route('biro.index') }}" class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 font-medium">
                                                <i class="fas fa-arrow-right mr-2"></i>Lihat Semua
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Info PMB <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Jalur Masuk</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Biaya Kuliah</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Pendaftaran Online</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Beasiswa</a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('contact.index') }}" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all">Kontak</a>
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Informasi <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="{{ route('pengumuman.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Pengumuman</a>
                                    <a href="{{ route('berita.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Berita</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu button moved to the right side with improved clickability -->
            <div class="sm:hidden">
                <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-blue-800 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all cursor-pointer">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Language Toggle - Hidden on mobile, now moved to mobile menu -->
            <div class="hidden sm:flex items-center">
                <div class="lang-toggle flex text-sm border border-blue-300 rounded-full overflow-hidden shadow-sm">
                    <a href="#" class="bg-blue-800 text-white px-4 py-1 font-medium">Id</a>
                    <a href="#" class="bg-white text-gray-800 hover:text-blue-600 px-4 py-1 font-medium transition-all">En</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="sm:hidden hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Language selector added here as the first item -->
            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                <span class="text-sm font-medium text-gray-600">Language</span>
                <div class="lang-toggle flex text-sm border border-blue-300 rounded-full overflow-hidden shadow-sm">
                    <a href="#" class="bg-blue-800 text-white px-4 py-1 font-medium">Id</a>
                    <a href="#" class="bg-white text-gray-800 hover:text-blue-600 px-4 py-1 font-medium transition-all">En</a>
                </div>
            </div>
            <a href="/" class="text-gray-700 hover:text-blue-700 block px-3 py-2 rounded-md text-base font-medium transition-all">Home</a>
            @php
                $hasActiveProfilePages = (isset($pageSettings['sambutan-rektor']) && $pageSettings['sambutan-rektor']) ||
                                       (isset($pageSettings['sejarah']) && $pageSettings['sejarah']) ||
                                       (isset($pageSettings['visi-misi']) && $pageSettings['visi-misi']) ||
                                       (isset($pageSettings['struktur-organisasi']) && $pageSettings['struktur-organisasi']);
            @endphp
            @if($hasActiveProfilePages)
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Profil
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    @if(isset($pageSettings['sambutan-rektor']) && $pageSettings['sambutan-rektor'])
                        <a href="{{ route('sambutan-rektor.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Sambutan Rektor</a>
                    @endif
                    @if(isset($pageSettings['sejarah']) && $pageSettings['sejarah'])
                        <a href="{{ route('sejarah.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Sejarah</a>
                    @endif
                    @if(isset($pageSettings['visi-misi']) && $pageSettings['visi-misi'])
                        <a href="{{ route('visi-misi.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Visi & Misi</a>
                    @endif
                    @if(isset($pageSettings['struktur-organisasi']) && $pageSettings['struktur-organisasi'])
                        <a href="{{ route('organization-structure.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Struktur Organisasi</a>
                    @endif
                </div>
            </div>
            @endif
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Program Studi
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="{{ route('jurusan.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md font-medium">
                        <i class="fas fa-list mr-2"></i>Lihat Semua Program Studi
                    </a>
                    @php
                        $jurusans = \App\Models\Jurusan::limit(6)->get();
                    @endphp
                    @foreach($jurusans as $jurusan)
                        <a href="{{ route('jurusan.show', $jurusan->slug) }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">
                            {{ $jurusan->jurusan }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Fasilitas
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Perpustakaan</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Laboratorium</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Asrama</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Sport Center</a>
                </div>
            </div>
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Biro
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="{{ route('biro.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md font-medium">
                        <i class="fas fa-list mr-2"></i>Lihat Semua Biro
                    </a>
                    @php
                        $mobileBiros = \App\Models\Biro::aktif()->limit(5)->get();
                    @endphp
                    @foreach($mobileBiros as $biro)
                        <a href="{{ route('biro.show', $biro->slug) }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">
                            {{ $biro->nama_biro }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Info PMB
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Jalur Masuk</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Biaya Kuliah</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Pendaftaran Online</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Beasiswa</a>
                </div>
            </div>
            <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-blue-700 block px-3 py-2 rounded-md text-base font-medium transition-all">Kontak</a>
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Informasi
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="{{ route('pengumuman.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Pengumuman</a>
                    <a href="{{ route('berita.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Berita</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Flash Messages 
@if(session('info'))
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mx-auto max-w-7xl mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm">{{ session('info') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex bg-blue-100 rounded-md p-1.5 text-blue-500 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-100 focus:ring-blue-500" onclick="this.parentElement.parentElement.parentElement.parentElement.style.display='none'">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-auto max-w-7xl mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex bg-green-100 rounded-md p-1.5 text-green-500 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-100 focus:ring-green-500" onclick="this.parentElement.parentElement.parentElement.parentElement.style.display='none'">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-auto max-w-7xl mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex bg-red-100 rounded-md p-1.5 text-red-500 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-100 focus:ring-red-500" onclick="this.parentElement.parentElement.parentElement.parentElement.style.display='none'">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif   -->

 @yield('content')

    <footer>
        @include('layouts.footer') <!-- Menyertakan footer -->
    </footer>

    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Basic dropdown functionality 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle mobile menu toggle
            const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
            const mobileMenu = document.querySelector('[data-mobile-menu]');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Handle dropdown menus (if any specific dropdown scripts are needed)
            const dropdowns = document.querySelectorAll('.dropdown, .mobile-dropdown');
            dropdowns.forEach(dropdown => {
                const button = dropdown.querySelector('button');
                const menu = dropdown.querySelector('.dropdown-menu, div.hidden');
                
                if (button && menu) {
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();
                        // Close other dropdowns
                        dropdowns.forEach(otherDropdown => {
                            if (otherDropdown !== dropdown) {
                                const otherMenu = otherDropdown.querySelector('.dropdown-menu, div.hidden');
                                if (otherMenu) {
                                    otherMenu.classList.add('hidden');
                                }
                            }
                        });
                        // Toggle current dropdown
                        menu.classList.toggle('hidden');
                    });
                }
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                dropdowns.forEach(dropdown => {
                    const menu = dropdown.querySelector('.dropdown-menu, div.hidden');
                    if (menu && !menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                    }
                });
            });
        });
    </script>  -->

    
</body>
</html>