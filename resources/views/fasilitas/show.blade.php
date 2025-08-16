@extends('layouts.app')

@section('title', $fasilitas->seo_title ?? ($fasilitas->nama_fasilitas . ' - Fasilitas'))
@section('meta_description', $fasilitas->seo_description ?? ($fasilitas->deskripsi ?? ('Detail fasilitas ' . $fasilitas->nama_fasilitas)))

@section('content')
<div class="min-h-screen bg-gray-50">

    {{-- Breadcrumb --}}
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center gap-2 text-sm py-4">
                <li>
                    <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                        <i class="fas fa-home mr-1"></i> Beranda
                    </a>
                </li>
                <li class="text-gray-400">
                    <i class="fas fa-chevron-right"></i>
                </li>
                <li>
                    <a href="{{ route('fasilitas.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                        Fasilitas
                    </a>
                </li>
                <li class="text-gray-400">
                    <i class="fas fa-chevron-right"></i>
                </li>
                <li class="text-gray-900 font-medium">
                    {{ $fasilitas->nama_fasilitas }}
                </li>
            </ol>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 text-white py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">
                {{-- Content --}}
                <div class="space-y-6">
                    {{-- Badges --}}
                    <div class="flex flex-wrap items-center gap-3">
                        @if($fasilitas->jurusan)
                            <span class="bg-blue-500 text-white px-4 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-graduation-cap mr-2"></i>{{ $fasilitas->jurusan->jurusan }}
                            </span>
                        @endif
                        <span class="bg-green-500 text-white px-4 py-1.5 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle mr-2"></i>Aktif
                        </span>
                        @if($fasilitas->lokasi)
                            <span class="bg-purple-500 text-white px-4 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-map-marker-alt mr-2"></i>{{ $fasilitas->lokasi }}
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">
                        {{ $fasilitas->nama_fasilitas }}
                    </h1>

                    @if($fasilitas->deskripsi)
                        <p class="text-lg md:text-xl text-blue-100 leading-relaxed">
                            {{ $fasilitas->deskripsi }}
                        </p>
                    @endif

                    {{-- Quick Info --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        @if($fasilitas->jam_operasional)
                            <div class="flex items-center text-blue-100">
                                <i class="fas fa-clock text-green-400 mr-3 text-lg"></i>
                                <div>
                                    <div class="text-xs uppercase tracking-wide text-blue-200">Jam Operasional</div>
                                    <div class="font-semibold">{{ $fasilitas->jam_operasional }}</div>
                                </div>
                            </div>
                        @endif
                        @if($fasilitas->kontak)
                            <div class="flex items-center text-blue-100">
                                <i class="fas fa-phone text-yellow-400 mr-3 text-lg"></i>
                                <div>
                                    <div class="text-xs uppercase tracking-wide text-blue-200">Kontak</div>
                                    <div class="font-semibold">{{ $fasilitas->kontak }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="order-first lg:order-last">
                    @if($fasilitas->gambar && count($fasilitas->gambar) > 0)
                        <div class="relative group">
                            <img
                                id="mainImage"
                                src="{{ asset('storage/' . $fasilitas->gambar[0]) }}"
                                alt="{{ $fasilitas->nama_fasilitas }}"
                                class="w-full h-72 md:h-96 object-cover rounded-2xl shadow-2xl cursor-pointer"
                                onclick="openLightbox(this.src)"
                            />
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            @if(count($fasilitas->gambar) > 1)
                                <div class="absolute bottom-3 right-3 bg-black/70 text-white px-3 py-1 rounded-full text-xs md:text-sm">
                                    <i class="fas fa-images mr-1"></i>{{ count($fasilitas->gambar) }} Foto
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="w-full h-72 md:h-96 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl shadow-2xl flex items-center justify-center">
                            <i class="fas fa-building text-7xl md:text-8xl text-blue-400"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">
            {{-- Left / Content --}}
            <div class="lg:col-span-2 space-y-10">
                {{-- Gallery --}}
                @if($fasilitas->gambar && count($fasilitas->gambar) > 0)
                    <div class="space-y-4">
                        <div class="w-full">
                            <img
                                id="contentMainImage"
                                src="{{ asset('storage/' . $fasilitas->gambar[0]) }}"
                                alt="{{ $fasilitas->nama_fasilitas }}"
                                class="w-full h-64 md:h-[420px] object-cover rounded-xl shadow cursor-pointer"
                                onclick="openLightbox(this.src)"
                            />
                        </div>

                        @if(count($fasilitas->gambar) > 1)
                            <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
                                @foreach($fasilitas->gambar as $index => $gambar)
                                    <button
                                        type="button"
                                        class="group relative rounded-lg overflow-hidden border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        onclick="setMainImage('{{ asset('storage/' . $gambar) }}', this)"
                                        aria-label="Thumbnail {{ $index + 1 }}"
                                    >
                                        <img
                                            src="{{ asset('storage/' . $gambar) }}"
                                            alt="Thumbnail {{ $index + 1 }}"
                                            class="h-20 w-full object-cover group-hover:opacity-90 transition"
                                        />
                                        <span class="absolute inset-0 ring-2 ring-transparent group-[.active]/thumb:ring-blue-500"></span>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Deskripsi Lengkap --}}
                @if($fasilitas->deskripsi_lengkap)
                    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                        <h2 class="text-xl md:text-2xl font-bold mb-4">Tentang Fasilitas</h2>
                        <div class="prose max-w-none prose-p:leading-relaxed prose-headings:scroll-mt-20">
                            {!! nl2br(e($fasilitas->deskripsi_lengkap)) !!}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right / Sidebar --}}
            <aside class="space-y-6 lg:space-y-8">
                {{-- Info Card --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-blue-600 text-white px-6 py-4 font-semibold">
                        <i class="fas fa-info-circle mr-2"></i> Informasi Fasilitas
                    </div>
                    <div class="p-6 space-y-5">
                        @if($fasilitas->lokasi)
                            <div class="flex items-start gap-3">
                                <i class="fas fa-map-marker-alt text-blue-600 mt-1.5"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Lokasi</div>
                                    <div class="font-medium text-gray-900">{{ $fasilitas->lokasi }}</div>
                                </div>
                            </div>
                        @endif

                        @if($fasilitas->jam_operasional)
                            <div class="flex items-start gap-3">
                                <i class="fas fa-clock text-blue-600 mt-1.5"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Jam Operasional</div>
                                    <div class="font-medium text-gray-900">{{ $fasilitas->jam_operasional }}</div>
                                </div>
                            </div>
                        @endif

                        @if($fasilitas->kontak)
                            <div class="flex items-start gap-3">
                                <i class="fas fa-phone text-blue-600 mt-1.5"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Kontak</div>
                                    <div class="font-medium text-gray-900">
                                        @if(str_contains($fasilitas->kontak, '@'))
                                            <a href="mailto:{{ $fasilitas->kontak }}" class="text-blue-600 hover:underline">
                                                {{ $fasilitas->kontak }}
                                            </a>
                                        @elseif(str_starts_with($fasilitas->kontak, '08') || str_starts_with($fasilitas->kontak, '+62'))
                                            <a href="https://wa.me/{{ str_starts_with($fasilitas->kontak, '08') ? '62' . substr($fasilitas->kontak, 1) : str_replace('+', '', $fasilitas->kontak) }}"
                                               target="_blank" class="text-blue-600 hover:underline">
                                                {{ $fasilitas->kontak }}
                                            </a>
                                        @else
                                            {{ $fasilitas->kontak }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($fasilitas->jurusan)
                            <div class="flex items-start gap-3">
                                <i class="fas fa-graduation-cap text-blue-600 mt-1.5"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Jurusan</div>
                                    <a href="{{ route('jurusan.show', $fasilitas->jurusan->slug) }}"
                                       class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-sm font-medium hover:bg-blue-100">
                                        {{ $fasilitas->jurusan->jurusan }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="bg-white rounded-xl shadow-sm p-6 space-y-3">
                    @if($fasilitas->kontak)
                        @if(str_contains($fasilitas->kontak, '@'))
                            <a href="mailto:{{ $fasilitas->kontak }}"
                               class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">
                                <i class="fas fa-envelope"></i> Kirim Email
                            </a>
                        @elseif(str_starts_with($fasilitas->kontak, '08') || str_starts_with($fasilitas->kontak, '+62'))
                            <a href="https://wa.me/{{ str_starts_with($fasilitas->kontak, '08') ? '62' . substr($fasilitas->kontak, 1) : str_replace('+', '', $fasilitas->kontak) }}"
                               target="_blank"
                               class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700">
                                <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                            </a>
                        @endif
                    @endif

                    <button type="button" onclick="shareOnSocial()"
                            class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 rounded-lg border border-blue-600 text-blue-700 font-semibold hover:bg-blue-50">
                        <i class="fas fa-share-alt"></i> Bagikan Fasilitas
                    </button>
                </div>
            </aside>
        </div>
    </section>

    {{-- Fasilitas Terkait --}}
    @if($fasilitasTerkait->count() > 0)
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl md:text-3xl font-bold text-center mb-8">Fasilitas Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($fasilitasTerkait as $item)
                        <article class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                            @if($item->gambar_utama_url)
                                <a href="{{ route('fasilitas.show', $item->slug) }}" class="block">
                                    <img src="{{ $item->gambar_utama_url }}" alt="{{ $item->nama_fasilitas }}"
                                         class="w-full h-44 object-cover">
                                </a>
                            @else
                                <div class="w-full h-44 bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-building fa-lg text-gray-400"></i>
                                </div>
                            @endif

                            <div class="p-5 space-y-2">
                                <h3 class="font-semibold text-gray-900 line-clamp-1">
                                    <a href="{{ route('fasilitas.show', $item->slug) }}" class="hover:underline">
                                        {{ $item->nama_fasilitas }}
                                    </a>
                                </h3>

                                @if($item->lokasi)
                                    <p class="text-gray-500 text-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i>{{ $item->lokasi }}
                                    </p>
                                @endif

                                @if($item->deskripsi)
                                    <p class="text-gray-600 text-sm line-clamp-2">
                                        {{ Str::limit($item->deskripsi, 90) }}
                                    </p>
                                @endif

                                <div class="pt-2">
                                    <a href="{{ route('fasilitas.show', $item->slug) }}"
                                       class="inline-flex items-center gap-2 text-blue-700 font-semibold hover:underline">
                                        Lihat Detail <i class="fas fa-arrow-right text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Lightbox (Tailwind, no Bootstrap) --}}
    <div id="lightbox" class="fixed inset-0 bg-black/80 hidden z-50 items-center justify-center p-4" onclick="closeLightbox()">
        <img id="lightboxImage" src="" alt="Preview" class="max-h-[85vh] max-w-[90vw] rounded-lg shadow-2xl" />
        <button type="button" class="absolute top-4 right-4 text-white text-2xl" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function setMainImage(src, btn) {
        const main = document.getElementById('contentMainImage');
        if (main) main.src = src;

        // tandai thumbnail aktif
        document.querySelectorAll('[onclick^="setMainImage"]').forEach(el => {
            el.classList.remove('ring-2','ring-blue-500');
        });
        btn.classList.add('ring-2','ring-blue-500');
    }

    function openLightbox(src) {
        const box = document.getElementById('lightbox');
        const img = document.getElementById('lightboxImage');
        if (box && img) {
            img.src = src;
            box.classList.remove('hidden');
            box.classList.add('flex');
        }
    }

    function closeLightbox() {
        const box = document.getElementById('lightbox');
        if (box) {
            box.classList.add('hidden');
            box.classList.remove('flex');
        }
    }

    function shareOnSocial() {
        const url = window.location.href;
        const title = '{{ $fasilitas->nama_fasilitas }} - {{ config("app.name") }}';

        if (navigator.share) {
            navigator.share({ title, url });
        } else {
            const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }
    }
</script>
@endpush
