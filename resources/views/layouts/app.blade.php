<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas Mercu Buana Yogyakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                    <span class="text-sm">info@mercubuana-yogya.ac.id</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone-alt mr-2 text-blue-200"></i>
                    <span class="text-sm">(0274) 123456</span>
                </div>
            </div>
            <div class="flex space-x-5">
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Youtube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>
        
        <!-- Mobile version - two rows layout -->
        <div class="flex flex-col md:hidden">
            <!-- Email and phone row -->
            <div class="flex justify-center items-center mb-2">
                <div class="flex items-center">
                    <i class="fas fa-envelope mr-2 text-blue-200"></i>
                    <span class="text-sm">info@mercubuana-yogya.ac.id</span>
                </div>
            </div>
            
            <!-- Social media row -->
            <div class="flex justify-center space-x-6">
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="Youtube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="text-white hover:text-blue-200 transition-all" aria-label="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
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
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Profil <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                     <a href="{{ route('sambutan-rektor.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Sambutan Rektor</a>
                                    <a href="{{ route('sejarah.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Sejarah</a>
                                    <a href="{{ route('visi-misi.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Visi & Misi</a>
                                    <a href="{{ route('organization-structure.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Struktur Organisasi</a>
                                </div>
                            </div>
                        </div>
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Fakultas <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Ekonomi</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Teknik</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Psikologi</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Agroindustri</a>
                                </div>
                            </div>
                        </div>
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Fasilitas <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Perpustakaan</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Laboratorium</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Asrama</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Sport Center</a>
                                </div>
                            </div>
                        </div>
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Biro <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Akademik</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Kemahasiswaan</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Keuangan</a>
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
                        <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all">Kontak</a>
                        <div class="group relative px-1">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-all flex items-center">
                                Tracer Study <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            <div class="dropdown-menu absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Alumni</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Pengguna Lulusan</a>
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
            <a href="index.html" class="text-gray-700 hover:text-blue-700 block px-3 py-2 rounded-md text-base font-medium transition-all">Home</a>
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Profil
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="{{ route('sambutan-rektor.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Sambutan Rektor</a>
                    <a href="{{ route('sejarah.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Sejarah</a>
                    <a href="{{ route('visi-misi.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Visi & Misi</a>
                    <a href="{{ route('organization-structure.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Struktur Organisasi</a>
                </div>
            </div>
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Fakultas
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Ekonomi</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Teknik</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Psikologi</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Agroindustri</a>
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
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Akademik</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Kemahasiswaan</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Keuangan</a>
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
            <a href="#" class="text-gray-700 hover:text-blue-700 block px-3 py-2 rounded-md text-base font-medium transition-all">Kontak</a>
            <div class="mobile-dropdown">
                <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-700 px-3 py-2 rounded-md text-base font-medium transition-all">
                    Tracer Study
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4 py-2 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Alumni</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-md">Pengguna Lulusan</a>
                </div>
            </div>
        </div>
    </div>
</nav>

 @yield('content')

    <footer>
        @include('layouts.footer') <!-- Menyertakan footer -->
    </footer>