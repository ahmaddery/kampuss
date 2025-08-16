@extends('layouts.app')

@section('title', 'Fasilitas - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 text-white py-20">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fadeInUp">
                    Fasilitas Kampus
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto animate-fadeInUp animate-delay-100">
                    Fasilitas lengkap dan modern untuk mendukung proses pembelajaran dan aktivitas mahasiswa
                </p>
                <div class="mt-8 animate-fadeInUp animate-delay-200">
                    <div class="flex justify-center items-center space-x-8 text-sm text-blue-200">
                        <div class="flex items-center">
                            <i class="fas fa-building mr-2"></i>
                            <span>{{ $fasilitas->total() }}+ Fasilitas</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Berbagai Lokasi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>Akses 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section (auto-hide on scroll) -->
    <section id="filterBar"
             class="bg-white/95 backdrop-blur border-b border-gray-200 sticky top-20 z-40 shadow-sm transition-transform duration-300"
             style="will-change: transform;"
             role="region" aria-label="Filter fasilitas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div class="space-y-2">
                    <label for="search" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-search mr-2 text-blue-600"></i>Cari Fasilitas
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="search" name="search"
                            value="{{ request('search') }}"
                            placeholder="Nama fasilitas, lokasi..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        >
                        <button type="submit"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Jurusan -->
                <div class="space-y-2">
                    <label for="jurusan" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-graduation-cap mr-2 text-blue-600"></i>Filter Jurusan
                    </label>
                    <select id="jurusan" name="jurusan"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            onchange="this.form.submit()">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusan as $item)
                            <option value="{{ $item->id }}" {{ request('jurusan') == $item->id ? 'selected' : '' }}>
                                {{ $item->jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex items-end gap-3">
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-all hover:scale-105 focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    @if(request('search') || request('jurusan'))
                        <a href="{{ route('fasilitas.index') }}"
                           class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-all text-center">
                            <i class="fas fa-times mr-2"></i>Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- List Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($fasilitas->count() > 0)
                <!-- Summary -->
                <div class="mb-8 text-center">
                    <p class="text-gray-600">
                        Menampilkan <span class="font-semibold text-blue-600">{{ $fasilitas->count() }}</span>
                        dari <span class="font-semibold text-blue-600">{{ $fasilitas->total() }}</span> fasilitas
                        @if(request('search'))
                            untuk pencarian "<span class="font-semibold text-blue-600">{{ request('search') }}</span>"
                        @endif
                        @if(request('jurusan'))
                            @php $selectedJurusan = $jurusan->find(request('jurusan')); @endphp
                            @if($selectedJurusan)
                                di jurusan "<span class="font-semibold text-blue-600">{{ $selectedJurusan->jurusan }}</span>"
                            @endif
                        @endif
                    </p>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($fasilitas as $item)
                        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                            <!-- Image -->
                            <div class="relative overflow-hidden">
                                @if($item->gambar_utama_url)
                                    <img src="{{ $item->gambar_utama_url }}"
                                         alt="{{ $item->nama_fasilitas }}"
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                        <i class="fas fa-building text-6xl text-blue-400"></i>
                                    </div>
                                @endif

                                @if($item->jurusan)
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                            {{ $item->jurusan->jurusan }}
                                        </span>
                                    </div>
                                @endif

                                <div class="absolute top-4 left-4">
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">
                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                    </span>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                                    {{ $item->nama_fasilitas }}
                                </h3>

                                <div class="space-y-2 mb-4">
                                    @if($item->lokasi)
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-map-marker-alt text-blue-500 mr-3 w-4"></i>
                                            <span class="text-sm">{{ $item->lokasi }}</span>
                                        </div>
                                    @endif
                                    @if($item->jam_operasional)
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-clock text-green-500 mr-3 w-4"></i>
                                            <span class="text-sm">{{ $item->jam_operasional }}</span>
                                        </div>
                                    @endif
                                </div>

                                @if($item->deskripsi)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {{ Str::limit($item->deskripsi, 120) }}
                                    </p>
                                @endif

                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="{{ route('fasilitas.show', $item->slug) }}"
                                       class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center font-medium transition-all hover:scale-105 focus:ring-2 focus:ring-blue-500">
                                        <i class="fas fa-info-circle mr-2"></i>Lihat Detail
                                    </a>

                                    @if($item->kontak)
                                        <button type="button"
                                                class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-all hover:scale-105 focus:ring-2 focus:ring-green-500"
                                                onclick="showContact('{{ $item->kontak }}', '{{ $item->nama_fasilitas }}')">
                                            <i class="fas fa-phone mr-2"></i>Kontak
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                        {{ $fasilitas->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <!-- Empty -->
                <div class="text-center py-16">
                    <div class="mx-auto w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-search text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Fasilitas tidak ditemukan</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        @if(request('search') || request('jurusan'))
                            Tidak ada fasilitas yang sesuai dengan filter yang dipilih. Coba ubah kata kunci pencarian atau filter yang digunakan.
                        @else
                            Belum ada fasilitas yang tersedia saat ini. Silakan periksa kembali nanti.
                        @endif
                    </p>
                    @if(request('search') || request('jurusan'))
                        <div class="space-x-4">
                            <a href="{{ route('fasilitas.index') }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-all hover:scale-105 focus:ring-2 focus:ring-blue-500 inline-block">
                                <i class="fas fa-refresh mr-2"></i>Lihat Semua Fasilitas
                            </a>
                            <button type="button" onclick="history.back()"
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-medium transition-all hover:scale-105 focus:ring-2 focus:ring-gray-500 inline-block">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
</div>

<!-- Modal Kontak -->
<div id="contactModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full max-h-96 overflow-y-auto transform transition-all">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 rounded-t-xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-phone-alt mr-3 text-blue-200"></i>
                    <h3 class="text-xl font-bold">Kontak Fasilitas</h3>
                </div>
                <button type="button" onclick="closeContactModal()" class="text-blue-200 hover:text-white transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <!-- Body -->
        <div class="p-6">
            <div id="contactInfo" class="text-center"></div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* line clamp utility (jika plugin tidak aktif) */
.line-clamp-3 {
  display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}

/* smooth transform helper */
.transform { transition: transform .2s ease-in-out; }

/* modal scrollbar */
.max-h-96::-webkit-scrollbar { width: 6px; }
.max-h-96::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
.max-h-96::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 10px; }
.max-h-96::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }

/* loading skeleton (opsional) */
@keyframes shimmer { 0%{background-position:-468px 0} 100%{background-position:468px 0} }
.skeleton { animation: shimmer 1.2s ease-in-out infinite; background: linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%); background-size:1000px 100%; }

/* simple fadeInUp animation for hero */
@keyframes fadeInUp { from { opacity: 0; transform: translate3d(0, 10px, 0) } to { opacity: 1; transform: translate3d(0, 0, 0) } }
.animate-fadeInUp { animation: fadeInUp .6s ease both; }
.animate-delay-100 { animation-delay: .1s; }
.animate-delay-200 { animation-delay: .2s; }
</style>
@endpush

@push('scripts')
<script>
// ===== Auto-hide filter bar on scroll (hide down, show up)
(function () {
  const bar = document.getElementById('filterBar');
  if (!bar) return;

  let lastY = window.scrollY || 0;
  let hidden = false;
  const threshold = 8;      // cegah jitter
  const revealAtTop = 80;   // selalu tampil dekat top

  function updateBar() {
    const y = window.scrollY || 0;

    if (y < revealAtTop) {
      if (hidden) { bar.classList.remove('-translate-y-full'); hidden = false; }
    } else {
      if (y > lastY + threshold) {
        if (!hidden) { bar.classList.add('-translate-y-full'); hidden = true; }
      } else if (y < lastY - threshold) {
        if (hidden) { bar.classList.remove('-translate-y-full'); hidden = false; }
      }
    }

    // accentuate shadow after passing hero
    if (y > 120) { bar.classList.add('shadow-md'); }
    else { bar.classList.remove('shadow-md'); }

    lastY = y;
  }

  let rafId = null;
  window.addEventListener('scroll', () => {
    if (rafId) cancelAnimationFrame(rafId);
    rafId = requestAnimationFrame(updateBar);
  }, { passive: true });
})();

// ===== Modal Kontak
function showContact(contact, facilityName) {
  const modal = document.getElementById('contactModal');
  const contactInfo = document.getElementById('contactInfo');

  const isWhatsApp = contact.startsWith('08') || contact.startsWith('+62');
  const isEmail = contact.includes('@');

  let html = `
    <div class="mb-6">
      <h4 class="text-lg font-semibold text-gray-900 mb-2">${facilityName}</h4>
      <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
    </div>
  `;

  if (isWhatsApp) {
    const wa = contact.startsWith('08') ? '62' + contact.substring(1) : contact.replace('+','');
    html += `
      <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
        <div class="flex items-center justify-center mb-3">
          <i class="fab fa-whatsapp text-2xl text-green-600 mr-2"></i>
          <span class="font-semibold text-green-800">WhatsApp</span>
        </div>
        <p class="text-green-700 mb-4 font-medium">${contact}</p>
        <a href="https://wa.me/${wa}" target="_blank"
           class="block w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-medium transition-all hover:scale-105 focus:ring-2 focus:ring-green-500">
          <i class="fab fa-whatsapp mr-2"></i> Buka WhatsApp
        </a>
      </div>`;
  } else if (isEmail) {
    html += `
      <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
        <div class="flex items-center justify-center mb-3">
          <i class="fas fa-envelope text-2xl text-blue-600 mr-2"></i>
          <span class="font-semibold text-blue-800">Email</span>
        </div>
        <p class="text-blue-700 mb-4 font-medium break-all">${contact}</p>
        <a href="mailto:${contact}"
           class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-all hover:scale-105 focus:ring-2 focus:ring-blue-500">
          <i class="fas fa-envelope mr-2"></i> Kirim Email
        </a>
      </div>`;
  } else {
    html += `
      <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
        <div class="flex items-center justify-center mb-3">
          <i class="fas fa-phone text-2xl text-gray-600 mr-2"></i>
          <span class="font-semibold text-gray-800">Kontak</span>
        </div>
        <p class="text-gray-700 font-medium">${contact}</p>
      </div>`;
  }

  contactInfo.innerHTML = html;
  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeContactModal() {
  const modal = document.getElementById('contactModal');
  modal.classList.add('hidden');
  document.body.style.overflow = 'auto';
}

document.getElementById('contactModal')?.addEventListener('click', function(e){
  if (e.target === this) closeContactModal();
});

document.addEventListener('keydown', function(e){
  if (e.key === 'Escape') closeContactModal();
});

// ===== Optional: Lazy load for images that use data-src
if ('IntersectionObserver' in window) {
  const obs = new IntersectionObserver((entries, o) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        if (img.dataset.src) {
          img.src = img.dataset.src;
          img.classList.remove('skeleton');
          o.unobserve(img);
        }
      }
    });
  });
  document.querySelectorAll('img[data-src]').forEach(img => obs.observe(img));
}
</script>
@endpush
