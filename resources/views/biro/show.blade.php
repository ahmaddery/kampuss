@extends('layouts.app')

@section('title', ($biro->seo_title ?? $biro->nama_biro) . ' - Universitas Mercu Buana Yogyakarta')

@section('meta')
<meta name="description" content="{{ $biro->seo_description ?? $biro->deskripsi ?? 'Informasi lengkap tentang ' . $biro->nama_biro . ' di Universitas Mercu Buana Yogyakarta.' }}">
<meta name="keywords" content="{{ strtolower($biro->nama_biro) }}, biro, administrasi, universitas mercu buana yogyakarta">
<meta property="og:title" content="{{ $biro->seo_title ?? $biro->nama_biro }} - Universitas Mercu Buana Yogyakarta">
<meta property="og:description" content="{{ $biro->seo_description ?? $biro->deskripsi ?? 'Informasi lengkap tentang ' . $biro->nama_biro . ' di Universitas Mercu Buana Yogyakarta.' }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ request()->fullUrl() }}">
@if($biro->logo)
<meta property="og:image" content="{{ asset('storage/' . $biro->logo) }}">
@endif
@endsection

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-2/3 lg:pr-12">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $biro->nama_biro }}</h1>
                @if($biro->deskripsi)
                    <p class="text-xl text-blue-100 mb-8">{{ $biro->deskripsi }}</p>
                @endif
            </div>
            
            @if($biro->logo)
                <div class="lg:w-1/3 mt-8 lg:mt-0">
                    <div class="bg-white rounded-lg p-8 shadow-xl">
                        <img src="{{ asset('storage/' . $biro->logo) }}" 
                             alt="{{ $biro->nama_biro }}" 
                             class="max-w-full h-auto mx-auto"
                             style="max-height: 200px;">
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('biro.index') }}" class="hover:text-blue-600">Biro</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-900 font-medium">{{ $biro->nama_biro }}</li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if($biro->deskripsi_lengkap)
                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang {{ $biro->nama_biro }}</h2>
                        <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $biro->deskripsi_lengkap }}</div>
                    </div>
                @endif

                <!-- Gallery Section -->
                @if($biro->gambar && count($biro->gambar) > 0)
                    <div class="mt-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Galeri Dokumentasi</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($biro->gambar as $index => $gambar)
                                <div class="group cursor-pointer">
                                    <a href="{{ asset('storage/' . $gambar) }}" 
                                       data-lightbox="biro-gallery" 
                                       data-title="Dokumentasi {{ $biro->nama_biro }} - {{ $index + 1 }}">
                                        <div class="relative overflow-hidden rounded-lg shadow-md group-hover:shadow-xl transition-shadow duration-300">
                                            <img src="{{ asset('storage/' . $gambar) }}" 
                                                 alt="Dokumentasi {{ $biro->nama_biro }} - {{ $index + 1 }}" 
                                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300 flex items-center justify-center">
                                                <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Info -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Informasi Singkat</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-building text-blue-600 w-5"></i>
                            <span class="ml-3 text-gray-700">{{ $biro->nama_biro }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-link text-blue-600 w-5"></i>
                            <span class="ml-3 text-gray-700 font-mono text-sm">{{ $biro->slug }}</span>
                        </div>
                        @if($biro->gambar && count($biro->gambar) > 0)
                            <div class="flex items-center">
                                <i class="fas fa-images text-blue-600 w-5"></i>
                                <span class="ml-3 text-gray-700">{{ count($biro->gambar) }} dokumentasi</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kontak Kami</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-600 w-5"></i>
                            <span class="ml-3 text-gray-700">{{ $contactInfo['phone'] ?? '(0274) 123456' }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 w-5"></i>
                            <span class="ml-3 text-gray-700">{{ $contactInfo['email'] ?? 'info@mercubuana-yogya.ac.id' }}</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-600 w-5 mt-1"></i>
                            <span class="ml-3 text-gray-700">Kampus Universitas Mercu Buana Yogyakarta</span>
                        </div>
                    </div>
                </div>

                <!-- Operating Hours -->
                <div class="bg-green-50 rounded-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Jam Operasional</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-700">Senin - Kamis</span>
                            <span class="font-medium text-gray-900">08:00 - 16:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Jumat</span>
                            <span class="font-medium text-gray-900">08:00 - 16:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Sabtu - Minggu</span>
                            <span class="font-medium text-red-600">Tutup</span>
                        </div>
                    </div>
                </div>

                <!-- Related Links -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Link Terkait</h3>
                    <div class="space-y-3">
                        <a href="{{ route('biro.index') }}" 
                           class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <i class="fas fa-list w-5"></i>
                            <span class="ml-3">Semua Biro</span>
                            <i class="fas fa-external-link-alt ml-auto text-xs"></i>
                        </a>
                        <a href="{{ route('contact.index') }}" 
                           class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <i class="fas fa-envelope w-5"></i>
                            <span class="ml-3">Hubungi Kami</span>
                            <i class="fas fa-external-link-alt ml-auto text-xs"></i>
                        </a>
                        <a href="{{ route('home') }}" 
                           class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <i class="fas fa-home w-5"></i>
                            <span class="ml-3">Beranda</span>
                            <i class="fas fa-external-link-alt ml-auto text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Other Biro Section -->
@php
    $otherBiros = \App\Models\Biro::aktif()->where('id', '!=', $biro->id)->limit(3)->get();
@endphp

@if($otherBiros->count() > 0)
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Biro Lainnya</h2>
            <p class="text-gray-600">Jelajahi biro lainnya di Universitas Mercu Buana Yogyakarta</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($otherBiros as $otherBiro)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="h-32 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center p-4">
                        @if($otherBiro->logo)
                            <img src="{{ asset('storage/' . $otherBiro->logo) }}" 
                                 alt="{{ $otherBiro->nama_biro }}" 
                                 class="max-h-20 max-w-full object-contain">
                        @else
                            <i class="fas fa-building text-blue-400 text-3xl"></i>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $otherBiro->nama_biro }}</h3>
                        @if($otherBiro->deskripsi)
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($otherBiro->deskripsi, 80) }}</p>
                        @endif
                        <a href="{{ route('biro.show', $otherBiro->slug) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Selengkapnya →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if(\App\Models\Biro::aktif()->count() > 4)
            <div class="text-center mt-8">
                <a href="{{ route('biro.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                    Lihat Semua Biro
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>
@endif
@endsection

@push('styles')
<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
    // Configure lightbox
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': 'Gambar %1 dari %2'
    });
</script>
@endpush
