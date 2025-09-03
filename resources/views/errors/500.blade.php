@extends('layouts.app')

@section('title', 'Server Error - 500')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- 500 Illustration -->
        <div class="relative mb-8">
            <!-- Large 500 Text -->
            <div class="text-8xl sm:text-9xl lg:text-[12rem] font-bold text-red-100 select-none">
                500
            </div>
            
            <!-- Server Error Icon Overlay -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="bg-white rounded-full p-6 shadow-lg border-4 border-red-200">
                    <svg class="w-16 h-16 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                Server Sedang Bermasalah
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-6 max-w-2xl mx-auto leading-relaxed">
                Maaf, terjadi kesalahan pada server kami. Tim IT sedang bekerja keras untuk memperbaiki masalah ini. Silakan coba beberapa saat lagi.
            </p>
            
            <!-- University Quote -->
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-8 max-w-2xl mx-auto">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-tools text-red-400 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-red-800 italic">
                            "Dalam setiap masalah terdapat kesempatan untuk belajar dan berkembang."
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
            
            <button onclick="location.reload()" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 border border-gray-300">
                <i class="fas fa-refresh mr-2"></i>
                Coba Lagi
            </button>
        </div>

        <!-- Status Information -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                Informasi Status
            </h3>
            <div class="space-y-3 text-left">
                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                    <span class="text-gray-700">Status Server</span>
                    <span class="text-red-600 font-semibold flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Bermasalah
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                    <span class="text-gray-700">Tim IT</span>
                    <span class="text-yellow-600 font-semibold flex items-center">
                        <i class="fas fa-cog fa-spin mr-2"></i>
                        Sedang Memperbaiki
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <span class="text-gray-700">Estimasi Perbaikan</span>
                    <span class="text-blue-600 font-semibold">15-30 Menit</span>
                </div>
            </div>
        </div>

        <!-- Alternative Actions -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-3xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-lightbulb mr-2 text-yellow-600"></i>
                Sementara Waktu, Anda Bisa
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-center p-4 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors duration-300">
                    <i class="fas fa-phone text-2xl text-blue-600 mr-4"></i>
                    <div class="text-left">
                        <p class="font-medium text-gray-800">Hubungi Langsung</p>
                        <p class="text-sm text-gray-600">Telepon ke kantor administrasi</p>
                    </div>
                </div>
                
                <div class="flex items-center p-4 rounded-lg bg-green-50 hover:bg-green-100 transition-colors duration-300">
                    <i class="fas fa-envelope text-2xl text-green-600 mr-4"></i>
                    <div class="text-left">
                        <p class="font-medium text-gray-800">Kirim Email</p>
                        <p class="text-sm text-gray-600">Email pertanyaan Anda</p>
                    </div>
                </div>
                
                <div class="flex items-center p-4 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors duration-300">
                    <i class="fab fa-whatsapp text-2xl text-purple-600 mr-4"></i>
                    <div class="text-left">
                        <p class="font-medium text-gray-800">WhatsApp</p>
                        <p class="text-sm text-gray-600">Chat via WhatsApp</p>
                    </div>
                </div>
                
                <div class="flex items-center p-4 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition-colors duration-300">
                    <i class="fas fa-map-marker-alt text-2xl text-yellow-600 mr-4"></i>
                    <div class="text-left">
                        <p class="font-medium text-gray-800">Kunjungi Kampus</p>
                        <p class="text-sm text-gray-600">Datang langsung ke kampus</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="text-center text-gray-600">
            <p class="mb-2">Butuh bantuan segera? Hubungi kami:</p>
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
            <p class="text-xs mt-4 text-gray-500">Error ID: {{ Str::random(8) }} - {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</div>

<!-- Floating Elements Animation -->
<div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
    <!-- Floating Warning Icons -->
    <div class="absolute top-20 left-10 text-red-200 text-2xl animate-pulse-slow">
        <i class="fas fa-exclamation-triangle"></i>
    </div>
    <div class="absolute top-40 right-20 text-red-200 text-xl animate-pulse-medium">
        <i class="fas fa-cog"></i>
    </div>
    <div class="absolute bottom-40 left-20 text-red-200 text-lg animate-pulse-fast">
        <i class="fas fa-wrench"></i>
    </div>
    <div class="absolute bottom-20 right-10 text-red-200 text-xl animate-pulse-slow">
        <i class="fas fa-tools"></i>
    </div>
</div>

<style>
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.7; }
    }
    
    @keyframes pulse-medium {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 0.6; }
    }
    
    @keyframes pulse-fast {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 3s ease-in-out infinite;
    }
    
    .animate-pulse-medium {
        animation: pulse-medium 2s ease-in-out infinite;
    }
    
    .animate-pulse-fast {
        animation: pulse-fast 1.5s ease-in-out infinite;
    }
</style>

@endsection
