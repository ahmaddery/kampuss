  <!-- Menampilkan section jika is_active bernilai true -->
    @if($setting && $setting->is_active)
        <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-2/3 text-center md:text-left mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold">Pendaftaran Mahasiswa Baru 2025/2026</h2>
                        <p class="mt-4 text-blue-200 text-lg">Daftarkan diri Anda sekarang dan jadilah bagian dari keluarga besar Universitas Mercu Buana Yogyakarta!</p>
                    </div>
                    <div>
                        <a href="#" class="bg-white text-blue-800 hover:bg-blue-50 font-bold px-8 py-4 rounded-full inline-flex items-center text-lg transition-all shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- Menampilkan pesan jika section PMB tidak aktif -->
        <section class="py-20 bg-gray-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-2/3 text-center md:text-left mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold">Pendaftaran Mahasiswa Baru 2025/2026</h2>
                        <p class="mt-4 text-blue-200 text-lg">Saat ini, pendaftaran mahasiswa baru tidak tersedia.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif