@extends('layouts.app')

@section('title', 'Terjadi Kesalahan - ' . $__env->yieldContent('code', ''))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Error Code Illustration -->
        <div class="relative mb-8">
            <!-- Large Error Code Text -->
            <div class="text-8xl sm:text-9xl lg:text-[12rem] font-bold text-gray-100 select-none">
                @yield('code', 'Error')
            </div>
            
            <!-- Generic Error Icon Overlay -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="bg-white rounded-full p-6 shadow-lg border-4 border-gray-200">
                    <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                @yield('title', 'Terjadi Kesalahan')
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-6 max-w-2xl mx-auto leading-relaxed">
                @yield('message', 'Maaf, terjadi kesalahan yang tidak terduga. Tim teknis kami akan segera menangani masalah ini.')
            </p>
            
            <!-- University Quote -->
            <div class="bg-gray-50 border-l-4 border-gray-400 p-4 mb-8 max-w-2xl mx-auto">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-graduation-cap text-gray-400 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-gray-800 italic">
                            "Dari setiap masalah, kita belajar untuk menjadi lebih baik."
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
            
            <button onclick="location.reload()" class="inline-flex items-center px-6 py-3 bg-green-100 hover:bg-green-200 text-green-800 font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 border border-green-300">
                <i class="fas fa-refresh mr-2"></i>
                Coba Lagi
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

        <!-- Error Details (for debugging in development) -->
        @if(config('app.debug') && isset($exception))
        <div class="bg-red-50 rounded-lg shadow-lg p-6 mb-8 max-w-4xl mx-auto text-left">
            <h3 class="text-lg font-semibold text-red-800 mb-4 flex items-center">
                <i class="fas fa-bug mr-2"></i>
                Debug Information (Development Mode)
            </h3>
            <div class="bg-red-100 p-4 rounded-lg overflow-auto">
                <p class="text-sm text-red-800 font-mono">
                    <strong>File:</strong> {{ $exception->getFile() ?? 'Unknown' }}<br>
                    <strong>Line:</strong> {{ $exception->getLine() ?? 'Unknown' }}<br>
                    <strong>Message:</strong> {{ $exception->getMessage() ?? 'No message' }}
                </p>
            </div>
        </div>
        @endif

        <!-- Contact Info -->
        <div class="text-center text-gray-600">
            <p class="mb-2">Butuh bantuan lebih lanjut? Hubungi kami:</p>
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
            <p class="text-xs mt-4 text-gray-500">
                Error ID: {{ Str::random(8) }} - {{ now()->format('Y-m-d H:i:s') }}
                @if(isset($exception))
                - {{ get_class($exception) }}
                @endif
            </p>
        </div>
    </div>
</div>

<!-- Floating Elements Animation -->
<div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
    <!-- Floating Generic Icons -->
    <div class="absolute top-20 left-10 text-gray-200 text-2xl animate-drift-1">
        <i class="fas fa-question-circle"></i>
    </div>
    <div class="absolute top-40 right-20 text-gray-200 text-xl animate-drift-2">
        <i class="fas fa-exclamation-triangle"></i>
    </div>
    <div class="absolute bottom-40 left-20 text-gray-200 text-lg animate-drift-3">
        <i class="fas fa-info-circle"></i>
    </div>
    <div class="absolute bottom-20 right-10 text-gray-200 text-xl animate-drift-4">
        <i class="fas fa-cog"></i>
    </div>
</div>

<style>
    @keyframes drift-1 {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(10px, -10px) rotate(90deg); }
        50% { transform: translate(0, -20px) rotate(180deg); }
        75% { transform: translate(-10px, -10px) rotate(270deg); }
    }
    
    @keyframes drift-2 {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(-15px, 10px) rotate(-90deg); }
        50% { transform: translate(0, 20px) rotate(-180deg); }
        75% { transform: translate(15px, 10px) rotate(-270deg); }
    }
    
    @keyframes drift-3 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(20px, -15px) scale(1.1); }
    }
    
    @keyframes drift-4 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-20px, 15px) scale(0.9); }
    }
    
    .animate-drift-1 {
        animation: drift-1 8s ease-in-out infinite;
    }
    
    .animate-drift-2 {
        animation: drift-2 10s ease-in-out infinite;
    }
    
    .animate-drift-3 {
        animation: drift-3 6s ease-in-out infinite;
    }
    
    .animate-drift-4 {
        animation: drift-4 7s ease-in-out infinite;
    }
</style>

@endsection
