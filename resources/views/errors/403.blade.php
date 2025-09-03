@extends('layouts.app')

@section('title', 'Akses Ditolak - 403')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-yellow-50 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- 403 Illustration -->
        <div class="relative mb-8">
            <!-- Large 403 Text -->
            <div class="text-8xl sm:text-9xl lg:text-[12rem] font-bold text-yellow-100 select-none">
                403
            </div>
            
            <!-- Lock Icon Overlay -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="bg-white rounded-full p-6 shadow-lg border-4 border-yellow-200">
                    <svg class="w-16 h-16 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                Akses Ditolak
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-6 max-w-2xl mx-auto leading-relaxed">
                Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Halaman ini mungkin memerlukan login atau tingkat akses khusus.
            </p>
            
            <!-- University Quote -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 max-w-2xl mx-auto">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shield-alt text-yellow-400 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-yellow-800 italic">
                            "Keamanan dan privasi adalah fondasi kepercayaan dalam dunia digital."
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
            
            @guest
            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                <i class="fas fa-sign-in-alt mr-2"></i>
                Login
            </a>
            @endguest
            
            <button onclick="history.back()" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 border border-gray-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Halaman Sebelumnya
            </button>
        </div>

        <!-- Access Information -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-3xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                Informasi Akses
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-graduate text-blue-600 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Mahasiswa</h4>
                    </div>
                    <p class="text-sm text-gray-600">Gunakan akun mahasiswa untuk mengakses portal akademik, e-learning, dan layanan mahasiswa.</p>
                </div>
                
                <div class="p-4 bg-green-50 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-chalkboard-teacher text-green-600 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Dosen</h4>
                    </div>
                    <p class="text-sm text-gray-600">Gunakan akun dosen untuk mengakses sistem perkuliahan, penilaian, dan manajemen kelas.</p>
                </div>
                
                <div class="p-4 bg-purple-50 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-tie text-purple-600 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Staff</h4>
                    </div>
                    <p class="text-sm text-gray-600">Gunakan akun staff untuk mengakses sistem administrasi dan manajemen kampus.</p>
                </div>
                
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-users text-yellow-600 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Umum</h4>
                    </div>
                    <p class="text-sm text-gray-600">Akses publik untuk informasi umum, berita, pengumuman, dan kontak kampus.</p>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-question-circle mr-2 text-orange-600"></i>
                Butuh Bantuan?
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Lupa Password?</span>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Reset Password</a>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Akun Belum Aktif?</span>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Aktivasi Akun</a>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Masalah Teknis?</span>
                    <a href="{{ route('contact.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">Hubungi IT Support</a>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="text-center text-gray-600">
            <p class="mb-2">Masih memerlukan bantuan? Hubungi kami:</p>
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
    <!-- Floating Security Icons -->
    <div class="absolute top-20 left-10 text-yellow-200 text-2xl animate-bounce-slow">
        <i class="fas fa-lock"></i>
    </div>
    <div class="absolute top-40 right-20 text-yellow-200 text-xl animate-bounce-medium">
        <i class="fas fa-shield-alt"></i>
    </div>
    <div class="absolute bottom-40 left-20 text-yellow-200 text-lg animate-bounce-fast">
        <i class="fas fa-key"></i>
    </div>
    <div class="absolute bottom-20 right-10 text-yellow-200 text-xl animate-bounce-slow">
        <i class="fas fa-user-lock"></i>
    </div>
</div>

<style>
    @keyframes bounce-slow {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        60% { transform: translateY(-10px); }
    }
    
    @keyframes bounce-medium {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-15px); }
        60% { transform: translateY(-8px); }
    }
    
    @keyframes bounce-fast {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 4s infinite;
    }
    
    .animate-bounce-medium {
        animation: bounce-medium 3s infinite;
    }
    
    .animate-bounce-fast {
        animation: bounce-fast 2s infinite;
    }
</style>

@endsection
