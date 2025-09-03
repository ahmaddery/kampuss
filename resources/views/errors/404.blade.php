@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - 404')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- 404 Illustration -->
        <div class="relative mb-8">
            <!-- Large 404 Text -->
            <div class="text-8xl sm:text-9xl lg:text-[12rem] font-bold text-blue-100 select-none">
                404
            </div>
            
            <!-- University Building Icon Overlay -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="bg-white rounded-full p-6 shadow-lg border-4 border-blue-200">
                    <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm0 2.2l7 6.3v8.5h-2v-6h-6v6H9v-8.5l7-6.3z"/>
                        <path d="M12 1L2 9v12h8v-6h4v6h8V9L12 1zm8 18h-4v-6h-8v6H4V10l8-7 8 7v9z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                Oops! Halaman Tidak Ditemukan
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-6 max-w-2xl mx-auto leading-relaxed">
                Sepertinya Anda tersesat di kampus digital kami. Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada.
            </p>
            
            <!-- University Quote -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-8 max-w-2xl mx-auto">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-quote-left text-blue-400 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-blue-800 italic">
                            "Pendidikan adalah jalan menuju kesuksesan, meskipun terkadang kita harus berbelok untuk menemukan arah yang tepat."
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
            </a>
            
            <button onclick="history.back()" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 border border-gray-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Halaman Sebelumnya
            </button>
        </div>

        <!-- Quick Navigation -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-3xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-compass mr-2 text-blue-600"></i>
                Navigasi Cepat
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="{{ route('jurusan.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors duration-300 group">
                    <i class="fas fa-graduation-cap text-2xl text-blue-600 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-sm font-medium text-gray-800">Program Studi</span>
                </a>
                
                <a href="{{ route('fasilitas.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-green-50 hover:bg-green-100 transition-colors duration-300 group">
                    <i class="fas fa-building text-2xl text-green-600 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-sm font-medium text-gray-800">Fasilitas</span>
                </a>
                
                <a href="{{ route('berita.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition-colors duration-300 group">
                    <i class="fas fa-newspaper text-2xl text-yellow-600 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-sm font-medium text-gray-800">Berita</span>
                </a>
                
                <a href="{{ route('contact.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors duration-300 group">
                    <i class="fas fa-phone text-2xl text-purple-600 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-sm font-medium text-gray-800">Kontak</span>
                </a>
            </div>
        </div>

        <!-- Search Box -->
        <div class="max-w-md mx-auto mb-8">
            <div class="relative">
                <form action="{{ url('/') }}" method="GET" class="flex">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari informasi di website..." 
                           class="w-full px-4 py-3 pr-12 rounded-l-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-r-lg transition-colors duration-300">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="text-center text-gray-600">
            <p class="mb-2">Masih butuh bantuan? Hubungi kami:</p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 text-sm">
                <a href="mailto:{{ $contactInfo['email'] ?? 'info@mercubuana-yogya.ac.id' }}" class="flex items-center hover:text-blue-600 transition-colors">
                    <i class="fas fa-envelope mr-2"></i>
                    {{ $contactInfo['email'] ?? 'info@mercubuana-yogya.ac.id' }}
                </a>
                <a href="tel:{{ $contactInfo['phone'] ?? '(0274) 123456' }}" class="flex items-center hover:text-blue-600 transition-colors">
                    <i class="fas fa-phone mr-2"></i>
                    {{ $contactInfo['phone'] ?? '(0274) 123456' }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Floating Elements Animation -->
<div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
    <!-- Floating Books -->
    <div class="absolute top-20 left-10 text-blue-200 text-2xl animate-float-slow">
        <i class="fas fa-book"></i>
    </div>
    <div class="absolute top-40 right-20 text-blue-200 text-xl animate-float-medium">
        <i class="fas fa-graduation-cap"></i>
    </div>
    <div class="absolute bottom-40 left-20 text-blue-200 text-lg animate-float-fast">
        <i class="fas fa-microscope"></i>
    </div>
    <div class="absolute bottom-20 right-10 text-blue-200 text-xl animate-float-slow">
        <i class="fas fa-flask"></i>
    </div>
</div>

<style>
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes float-medium {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    
    @keyframes float-fast {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float-slow {
        animation: float-slow 4s ease-in-out infinite;
    }
    
    .animate-float-medium {
        animation: float-medium 3s ease-in-out infinite;
    }
    
    .animate-float-fast {
        animation: float-fast 2s ease-in-out infinite;
    }
    
    /* Additional hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
</style>

@endsection
