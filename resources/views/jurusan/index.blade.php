@extends('layouts.app')

@section('title', 'Program Studi - Universitas Mercu Buana Yogyakarta')

@section('meta')
    <meta name="description" content="Pilihan program studi terbaik di Universitas Mercu Buana Yogyakarta. Temukan program yang sesuai dengan minat dan bakat Anda.">
    <meta name="keywords" content="program studi, jurusan, universitas, pendidikan tinggi">
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Program Studi</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Program Studi</h1>
            <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Pilih program studi terbaik sesuai dengan minat dan bakat untuk masa depan karir yang cemerlang
            </p>
            <div class="flex justify-center">
                <div class="bg-blue-800 bg-opacity-50 px-6 py-3 rounded-full">
                    <span class="text-lg font-semibold">{{ $jurusans->count() }} Program Studi Tersedia</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-lg font-semibold text-gray-900">Semua Program Studi</h2>
                    <p class="text-gray-600">Temukan program yang tepat untuk masa depan Anda</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative">
                        <input type="text" id="searchProgram" placeholder="Cari program studi..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <select id="sortProgram" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="name">Urutkan: A-Z</option>
                        <option value="name-desc">Urutkan: Z-A</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Programs Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div id="programsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($jurusans as $jurusan)
                <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:transform hover:scale-105 hover:shadow-xl" 
                     data-name="{{ strtolower($jurusan->jurusan) }}">
                    <!-- Program Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 h-2"></div>
                    
                    <!-- Program Icon -->
                    <div class="relative p-6 pb-0">
                        @if($jurusan->icon)
                            <div class="w-20 h-20 mx-auto bg-blue-50 rounded-full p-4 mb-4">
                                <img src="{{ asset('storage/' . $jurusan->icon) }}" 
                                     alt="{{ $jurusan->jurusan }}" 
                                     class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-20 h-20 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-graduation-cap text-2xl text-blue-600"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Program Content -->
                    <div class="p-6 pt-0">
                        <h3 class="font-bold text-xl text-gray-900 mb-3 text-center">{{ $jurusan->jurusan }}</h3>
                        <p class="text-gray-600 mb-6 text-center leading-relaxed">{{ $jurusan->deskripsi }}</p>
                        
                        <!-- Program Features -->
                        <div class="space-y-2 mb-6">
                            @if($jurusan->informasiProgram)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-graduation-cap text-blue-600 mr-2"></i>
                                <span>{{ $jurusan->informasiProgram->jenjang }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-clock text-blue-600 mr-2"></i>
                                <span>{{ $jurusan->informasiProgram->durasi }}</span>
                            </div>
                            @if($jurusan->informasiProgram->akreditasi)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-certificate text-blue-600 mr-2"></i>
                                <span>Akreditasi {{ $jurusan->informasiProgram->akreditasi }}</span>
                            </div>
                            @endif
                            @else
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-graduation-cap text-blue-600 mr-2"></i>
                                <span>Jenjang S1 (Sarjana)</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-clock text-blue-600 mr-2"></i>
                                <span>4 Tahun (8 Semester)</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-certificate text-blue-600 mr-2"></i>
                                <span>Terakreditasi</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Action Button -->
                        <div class="text-center">
                            <a href="{{ route('jurusan.show', $jurusan->slug) }}" 
                               class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition-colors duration-200 group">
                                Selengkapnya 
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-search text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Program tidak ditemukan</h3>
            <p class="text-gray-500">Coba ubah kata kunci pencarian Anda</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Butuh Bantuan Memilih Program?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Tim konselor akademik kami siap membantu Anda menemukan program studi yang tepat
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors inline-flex items-center justify-center">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Konselor
                </a>
                <a href="#" class="bg-blue-800 bg-opacity-50 text-white px-8 py-3 rounded-full font-semibold hover:bg-opacity-70 transition-colors inline-flex items-center justify-center">
                    <i class="fas fa-calendar mr-2"></i>
                    Jadwalkan Konsultasi
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Search and Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchProgram');
    const sortSelect = document.getElementById('sortProgram');
    const programsGrid = document.getElementById('programsGrid');
    const noResults = document.getElementById('noResults');
    
    function filterAndSortPrograms() {
        const searchTerm = searchInput.value.toLowerCase();
        const sortOption = sortSelect.value;
        const programCards = Array.from(document.querySelectorAll('.program-card'));
        
        // Filter programs
        let visibleCards = programCards.filter(card => {
            const programName = card.dataset.name;
            const isVisible = programName.includes(searchTerm);
            card.style.display = isVisible ? 'block' : 'none';
            return isVisible;
        });
        
        // Sort programs
        visibleCards.sort((a, b) => {
            const nameA = a.dataset.name;
            const nameB = b.dataset.name;
            
            if (sortOption === 'name') {
                return nameA.localeCompare(nameB);
            } else if (sortOption === 'name-desc') {
                return nameB.localeCompare(nameA);
            }
            return 0;
        });
        
        // Reorder DOM elements
        visibleCards.forEach(card => {
            programsGrid.appendChild(card);
        });
        
        // Show/hide no results message
        if (visibleCards.length === 0) {
            noResults.classList.remove('hidden');
            programsGrid.classList.add('hidden');
        } else {
            noResults.classList.add('hidden');
            programsGrid.classList.remove('hidden');
        }
    }
    
    searchInput.addEventListener('input', filterAndSortPrograms);
    sortSelect.addEventListener('change', filterAndSortPrograms);
});
</script>
@endsection
