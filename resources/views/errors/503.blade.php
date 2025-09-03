@extends('layouts.app')

@section('title', 'Maintenance Mode - 503')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-indigo-50 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- 503 Illustration -->
        <div class="relative mb-8">
            <!-- Large 503 Text -->
            <div class="text-8xl sm:text-9xl lg:text-[12rem] font-bold text-indigo-100 select-none">
                503
            </div>
            
            <!-- Maintenance Icon Overlay -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="bg-white rounded-full p-6 shadow-lg border-4 border-indigo-200 animate-pulse">
                    <svg class="w-16 h-16 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.71 9.29l-2-2a1 1 0 0 0-.33-.21 1 1 0 0 0-.76 0 1 1 0 0 0-.33.21l-3 3a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0L18 10.42V17a1 1 0 0 0 2 0v-6.58l1.29 1.29a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM12 2a1 1 0 0 0-1 1v8.58L9.71 10.29a1 1 0 0 0-1.42 1.42l3 3a1 1 0 0 0 .33.21.94.94 0 0 0 .76 0 1 1 0 0 0 .33-.21l3-3a1 1 0 0 0-1.42-1.42L13 11.58V3a1 1 0 0 0-1-1z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Maintenance Message -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                Website Sedang Dalam Pemeliharaan
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-6 max-w-2xl mx-auto leading-relaxed">
                Kami sedang melakukan pemeliharaan sistem untuk meningkatkan kualitas layanan. Mohon maaf atas ketidaknyamanan ini.
            </p>
            
            <!-- University Quote -->
            <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 mb-8 max-w-2xl mx-auto">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-cogs text-indigo-400 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-indigo-800 italic">
                            "Pemeliharaan yang baik adalah investasi untuk masa depan yang lebih baik."
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-3xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-tasks mr-2 text-indigo-600"></i>
                Progress Pemeliharaan
            </h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">Backup Database</span>
                        <span class="text-sm text-green-600 font-semibold">
                            <i class="fas fa-check mr-1"></i>Selesai
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">Update Sistem</span>
                        <span class="text-sm text-indigo-600 font-semibold">
                            <i class="fas fa-spinner fa-spin mr-1"></i>Dalam Progress
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-500 h-2 rounded-full animate-pulse" style="width: 75%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">Testing Fitur</span>
                        <span class="text-sm text-gray-500 font-semibold">Menunggu</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gray-400 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estimated Time -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-clock mr-2 text-yellow-600"></i>
                Estimasi Waktu
            </h3>
            <div class="grid grid-cols-2 gap-4 text-center">
                <div class="p-4 bg-indigo-50 rounded-lg">
                    <div class="text-2xl font-bold text-indigo-600 mb-1" id="countdown-time">45:30</div>
                    <div class="text-sm text-gray-600">Sisa Waktu</div>
                </div>
                <div class="p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600 mb-1">14:30</div>
                    <div class="text-sm text-gray-600">Waktu Mulai</div>
                </div>
            </div>
        </div>

        <!-- What's New -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-3xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-star mr-2 text-yellow-600"></i>
                Yang Baru Setelah Pemeliharaan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start p-3 bg-blue-50 rounded-lg">
                    <i class="fas fa-rocket text-blue-600 text-lg mr-3 mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-gray-800 text-sm">Performa Lebih Cepat</h4>
                        <p class="text-xs text-gray-600">Website akan lebih responsif dan cepat</p>
                    </div>
                </div>
                
                <div class="flex items-start p-3 bg-green-50 rounded-lg">
                    <i class="fas fa-shield-alt text-green-600 text-lg mr-3 mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-gray-800 text-sm">Keamanan Ditingkatkan</h4>
                        <p class="text-xs text-gray-600">Update keamanan dan proteksi data</p>
                    </div>
                </div>
                
                <div class="flex items-start p-3 bg-purple-50 rounded-lg">
                    <i class="fas fa-mobile-alt text-purple-600 text-lg mr-3 mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-gray-800 text-sm">Mobile Experience</h4>
                        <p class="text-xs text-gray-600">Tampilan mobile yang lebih baik</p>
                    </div>
                </div>
                
                <div class="flex items-start p-3 bg-yellow-50 rounded-lg">
                    <i class="fas fa-plus text-yellow-600 text-lg mr-3 mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-gray-800 text-sm">Fitur Baru</h4>
                        <p class="text-xs text-gray-600">Beberapa fitur baru yang menarik</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stay Connected -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-center">
                <i class="fas fa-share-alt mr-2 text-blue-600"></i>
                Tetap Terhubung
            </h3>
            <p class="text-gray-600 mb-4 text-sm">Ikuti media sosial kami untuk update terbaru:</p>
            <div class="flex justify-center space-x-4">
                @foreach($socialMedia as $social)
                <a href="{{ $social['url'] }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-blue-600 rounded-full transition-all duration-300 transform hover:scale-110">
                    <i class="{{ $social['icon_class'] }}"></i>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Contact Info -->
        <div class="text-center text-gray-600">
            <p class="mb-2">Untuk informasi darurat, hubungi:</p>
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
            <p class="text-xs mt-4 text-gray-500">Maintenance ID: MNT{{ date('Ymd') }}{{ Str::random(4) }} - {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</div>

<!-- Floating Elements Animation -->
<div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
    <!-- Floating Maintenance Icons -->
    <div class="absolute top-20 left-10 text-indigo-200 text-2xl animate-spin-slow">
        <i class="fas fa-cog"></i>
    </div>
    <div class="absolute top-40 right-20 text-indigo-200 text-xl animate-spin-reverse">
        <i class="fas fa-cogs"></i>
    </div>
    <div class="absolute bottom-40 left-20 text-indigo-200 text-lg animate-spin-slow">
        <i class="fas fa-wrench"></i>
    </div>
    <div class="absolute bottom-20 right-10 text-indigo-200 text-xl animate-spin-reverse">
        <i class="fas fa-tools"></i>
    </div>
</div>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes spin-reverse {
        from { transform: rotate(360deg); }
        to { transform: rotate(0deg); }
    }
    
    .animate-spin-slow {
        animation: spin-slow 8s linear infinite;
    }
    
    .animate-spin-reverse {
        animation: spin-reverse 6s linear infinite;
    }
</style>

<script>
// Countdown timer
let timeLeft = 45 * 60 + 30; // 45 minutes 30 seconds in seconds

function updateCountdown() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    
    document.getElementById('countdown-time').textContent = 
        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    
    if (timeLeft > 0) {
        timeLeft--;
    } else {
        // Refresh page when countdown reaches 0
        location.reload();
    }
}

// Update countdown every second
setInterval(updateCountdown, 1000);
updateCountdown(); // Initial call
</script>

@endsection
