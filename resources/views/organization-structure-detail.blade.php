@extends('layouts.app')

@section('title', $structure->unit_name . ' - Struktur Organisasi')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-10">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="flex flex-wrap gap-2 text-white/80 text-sm">
                        <li><a href="{{ route('organization-structure.index') }}" class="hover:underline">Struktur Organisasi</a></li>
                        <li>/</li>
                        <li class="text-white">{{ $structure->unit_name }}</li>
                    </ol>
                </nav>
                <h1 class="text-3xl md:text-5xl font-bold mb-2">{{ $structure->unit_name }}</h1>
                @if($structure->position_title && $structure->person_name)
                    <p class="text-lg md:text-xl opacity-90">{{ $structure->position_title }}: {{ $structure->person_name }}</p>
                @endif
            </div>
            <div class="flex justify-center md:justify-end items-center">
                @if($structure->image_path)
                    <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->unit_name }}" class="max-h-36 rounded-2xl border-4 border-indigo-200 shadow-lg">
                @else
                    <i class="fas fa-building text-white/70 text-7xl md:text-8xl"></i>
                @endif
            </div>
        </div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-800/30 to-purple-900/20 pointer-events-none"></div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="flex-1 order-2 lg:order-1">
            <!-- Unit Information -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h4 class="font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="fas fa-info-circle"></i> Informasi Unit</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-3">
                            <div class="text-xs font-bold text-gray-400 mb-1">NAMA UNIT</div>
                            <div class="text-lg text-indigo-700 font-semibold">{{ $structure->unit_name }}</div>
                        </div>
                        @if($structure->parent)
                            <div class="mb-3">
                                <div class="text-xs font-bold text-gray-400 mb-1">UNIT INDUK</div>
                                <div>
                                    <a href="{{ route('organization-structure.show', $structure->parent->id) }}" class="text-indigo-600 hover:underline">{{ $structure->parent->unit_name }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div>
                        @if($structure->position_title)
                            <div class="mb-3">
                                <div class="text-xs font-bold text-gray-400 mb-1">JABATAN</div>
                                <div class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold text-sm">{{ $structure->position_title }}</div>
                            </div>
                        @endif
                        @if($structure->person_name)
                            <div class="mb-3">
                                <div class="text-xs font-bold text-gray-400 mb-1">PEJABAT</div>
                                <div class="font-semibold">{{ $structure->person_name }}</div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-6">
                    <div class="text-xs font-bold text-gray-400 mb-1">HIERARKI LENGKAP</div>
                    <div class="bg-gray-50 p-3 rounded text-gray-700 text-sm">{{ $structure->getFullPath() }}</div>
                </div>
            </div>
            <!-- Sub Units -->
            @if($structure->children->count() > 0)
                <div class="bg-white rounded-xl shadow p-6">
                    <h4 class="font-bold text-blue-700 mb-4 flex items-center gap-2"><i class="fas fa-sitemap"></i> Unit di Bawahnya ({{ $structure->children->count() }})</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($structure->children as $child)
                            <div class="bg-gray-50 rounded-lg shadow-sm p-4 flex gap-4 items-center">
                                @if($child->image_path)
                                    <img src="{{ asset('storage/' . $child->image_path) }}" alt="{{ $child->unit_name }}" class="w-16 h-16 rounded border-2 border-indigo-200 object-cover">
                                @else
                                    <div class="w-16 h-16 rounded bg-indigo-200 flex items-center justify-center">
                                        <i class="fas fa-building text-white text-2xl"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <a href="{{ route('organization-structure.show', $child->id) }}" class="font-bold text-indigo-700 hover:underline text-base">{{ $child->unit_name }}</a>
                                    @if($child->position_title && $child->person_name)
                                        <div class="mt-1 text-xs bg-indigo-100 text-indigo-700 inline-block px-2 py-0.5 rounded">{{ $child->position_title }}</div>
                                        <div class="text-xs text-gray-500">{{ $child->person_name }}</div>
                                    @endif
                                    @if($child->children->count() > 0)
                                        <div class="text-xs text-blue-500 mt-1 flex items-center gap-1"><i class="fas fa-sitemap"></i> {{ $child->children->count() }} sub-unit</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-80 flex-shrink-0 order-1 lg:order-2 space-y-6">
            <!-- Navigation -->
            <div class="bg-white rounded-xl shadow p-6">
                <h5 class="font-bold text-gray-700 mb-4 flex items-center gap-2"><i class="fas fa-compass"></i> Navigasi</h5>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('organization-structure.index') }}" class="btn btn-outline-primary text-indigo-700 border border-indigo-300 rounded-lg px-4 py-2 flex items-center gap-2 hover:bg-indigo-50 transition"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>
                    @if($structure->parent)
                        <a href="{{ route('organization-structure.show', $structure->parent->id) }}" class="btn btn-outline-success text-green-700 border border-green-300 rounded-lg px-4 py-2 flex items-center gap-2 hover:bg-green-50 transition"><i class="fas fa-arrow-up"></i> Unit Induk</a>
                    @endif
                    @if($structure->children->count() > 0)
                        <hr class="my-2">
                        <div class="text-xs font-bold text-gray-400 mb-1">UNIT DI BAWAHNYA:</div>
                        <div class="flex flex-col gap-1">
                            @foreach($structure->children as $child)
                                <a href="{{ route('organization-structure.show', $child->id) }}" class="btn btn-outline-info text-blue-700 border border-blue-300 rounded px-3 py-1 text-xs hover:bg-blue-50 transition">{{ $child->unit_name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow p-6">
                <h5 class="font-bold text-yellow-700 mb-4 flex items-center gap-2"><i class="fas fa-chart-bar"></i> Statistik</h5>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-indigo-700">{{ $structure->children->count() }}</div>
                        <div class="text-xs text-gray-500">Unit Langsung</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-700">{{ $structure->getAllDescendants()->count() }}</div>
                        <div class="text-xs text-gray-500">Total Keturunan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    z-index: 1;
}
.hero-overlay {
    pointer-events: none;
}
.card {
    transition: transform 0.3s cubic-bezier(.4,2,.3,1), box-shadow 0.3s cubic-bezier(.4,2,.3,1);
}
.card:hover {
    transform: translateY(-2px) scale(1.01);
    box-shadow: 0 8px 25px rgba(0,0,0,0.13);
}
.organization-card {
    transition: transform 0.3s cubic-bezier(.4,2,.3,1), box-shadow 0.3s cubic-bezier(.4,2,.3,1);
}
.organization-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 25px rgba(0,0,0,0.10);
}
.breadcrumb-dark .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}
@media (max-width: 991.98px) {
    .hero-section { padding: 2rem 0; }
    .card-body, .card-header { padding: 1.25rem !important; }
}
@media (max-width: 767.98px) {
    .hero-section { padding: 1.5rem 0; }
    .card { margin-bottom: 1rem; }
    .organization-card { min-width: 100%; }
}
</style>
@endpush
@endsection
