@extends('layouts.app')

@section('title', 'Daftar Biro - Universitas Mercu Buana Yogyakarta')

@section('meta')
<meta name="description" content="Daftar lengkap biro di Universitas Mercu Buana Yogyakarta yang melayani berbagai kebutuhan akademik dan administratif mahasiswa.">
<meta name="keywords" content="biro, administrasi, akademik, kemahasiswaan, universitas mercu buana yogyakarta">
<meta property="og:title" content="Daftar Biro - Universitas Mercu Buana Yogyakarta">
<meta property="og:description" content="Daftar lengkap biro di Universitas Mercu Buana Yogyakarta yang melayani berbagai kebutuhan akademik dan administratif mahasiswa.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ request()->fullUrl() }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Daftar Biro</h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Berbagai biro yang melayani kebutuhan akademik dan administratif di Universitas Mercu Buana Yogyakarta
            </p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-900 font-medium">Biro</li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($biros->count() > 0)
            <!-- Biro Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($biros as $biro)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Logo Section -->
                        <div class="h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center p-6">
                            @if($biro->logo)
                                <img src="{{ asset('storage/' . $biro->logo) }}" 
                                     alt="{{ $biro->nama_biro }}" 
                                     class="max-h-32 max-w-full object-contain">
                            @else
                                <div class="text-center">
                                    <i class="fas fa-building text-blue-400 text-6xl mb-4"></i>
                                    <p class="text-blue-600 font-medium">{{ $biro->nama_biro }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                {{ $biro->nama_biro }}
                            </h3>
                            
                            @if($biro->deskripsi)
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ Str::limit($biro->deskripsi, 120) }}
                                </p>
                            @endif

                            <div class="flex justify-between items-center">
                                <a href="{{ route('biro.show', $biro->slug) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                                    Selengkapnya
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                                
                                @if($biro->gambar && count($biro->gambar) > 0)
                                    <span class="text-sm text-gray-500 flex items-center">
                                        <i class="fas fa-images mr-1"></i>
                                        {{ count($biro->gambar) }} foto
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($biros->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $biros->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <i class="fas fa-building text-gray-300 text-6xl mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Biro</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Saat ini belum ada informasi biro yang tersedia. Silakan kembali lagi nanti.
                </p>
            </div>
        @endif
    </div>
</section>

<!-- Additional Info Section -->
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Informasi Tambahan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Untuk informasi lebih lanjut mengenai layanan biro, silakan hubungi bagian terkait atau kunjungi langsung kantor biro yang bersangkutan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Jam Operasional</h3>
                <p class="text-gray-600">Senin - Jumat<br>08:00 - 16:00 WIB</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Kontak</h3>
                <p class="text-gray-600">{{ $contactInfo['phone'] ?? '(0274) 123456' }}<br>{{ $contactInfo['email'] ?? 'info@mercubuana-yogya.ac.id' }}</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Lokasi</h3>
                <p class="text-gray-600">Kampus Universitas<br>Mercu Buana Yogyakarta</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
