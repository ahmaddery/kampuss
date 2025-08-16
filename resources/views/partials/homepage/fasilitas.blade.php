



<!-- Fasilitas Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">FASILITAS KAMPUS</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Fasilitas lengkap dan modern yang mendukung proses pembelajaran dan pengembangan mahasiswa
            </p>
        </div>

        @if($fasilitas && $fasilitas->count() > 0)
            <!-- Fasilitas Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($fasilitas as $item)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-xl transition-all duration-300">
                        <!-- Image -->
                        <div class="relative h-64 overflow-hidden">
                            @if($item->gambar_utama_url)
                                <img src="{{ $item->gambar_utama_url }}" 
                                     alt="{{ $item->nama_fasilitas }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center">
                                    <i class="fas fa-building text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            
                            <!-- Badge Jurusan -->
                            @if($item->jurusan)
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $item->jurusan->jurusan }}
                                    </span>
                                </div>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('fasilitas.show', $item->slug) }}" 
                                   class="bg-white text-gray-900 px-6 py-2 rounded-full font-medium hover:bg-gray-100 transition-colors">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->nama_fasilitas }}</h3>
                            
                            @if($item->lokasi)
                                <p class="text-gray-500 text-sm mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    {{ $item->lokasi }}
                                </p>
                            @endif

                            @if($item->jam_operasional)
                                <p class="text-gray-500 text-sm mb-3 flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    {{ $item->jam_operasional }}
                                </p>
                            @endif
                            
                            @if($item->deskripsi)
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ Str::limit($item->deskripsi, 120) }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <a href="{{ route('fasilitas.show', $item->slug) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                                
                                @if($item->kontak)
                                    <button onclick="showFacilityContact('{{ $item->kontak }}', '{{ $item->nama_fasilitas }}')"
                                            class="text-green-600 hover:text-green-800 transition-colors">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center">
                <a href="{{ route('fasilitas.index') }}" 
                   class="inline-flex items-center px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-th-large mr-2"></i>
                    Lihat Semua Fasilitas
                </a>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <i class="fas fa-building text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-500 mb-2">Belum ada fasilitas tersedia</h3>
                <p class="text-gray-400">Fasilitas akan segera hadir untuk mendukung aktivitas kampus</p>
            </div>
        @endif
    </div>
</section>

<!-- Contact Modal -->
<div id="facilityContactModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold" id="facilityName"></h3>
            <button onclick="closeFacilityContact()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="facilityContactInfo" class="text-center"></div>
        <div class="mt-4 text-center">
            <button onclick="closeFacilityContact()" 
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
function showFacilityContact(contact, facilityName) {
    const modal = document.getElementById('facilityContactModal');
    const nameElement = document.getElementById('facilityName');
    const infoElement = document.getElementById('facilityContactInfo');
    
    nameElement.textContent = facilityName;
    
    const isWhatsApp = contact.startsWith('08') || contact.startsWith('+62');
    const isEmail = contact.includes('@');
    
    let contactHtml = '';
    
    if (isWhatsApp) {
        const waNumber = contact.startsWith('08') ? '62' + contact.substring(1) : contact.replace('+', '');
        contactHtml = `
            <p class="mb-4"><strong>WhatsApp:</strong> ${contact}</p>
            <a href="https://wa.me/${waNumber}" target="_blank" 
               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                <i class="fab fa-whatsapp mr-2"></i>
                Buka WhatsApp
            </a>
        `;
    } else if (isEmail) {
        contactHtml = `
            <p class="mb-4"><strong>Email:</strong> ${contact}</p>
            <a href="mailto:${contact}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                <i class="fas fa-envelope mr-2"></i>
                Kirim Email
            </a>
        `;
    } else {
        contactHtml = `
            <p class="mb-4"><strong>Kontak:</strong> ${contact}</p>
        `;
    }
    
    infoElement.innerHTML = contactHtml;
    modal.classList.remove('hidden');
}

function closeFacilityContact() {
    const modal = document.getElementById('facilityContactModal');
    modal.classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('facilityContactModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFacilityContact();
    }
});
</script>
