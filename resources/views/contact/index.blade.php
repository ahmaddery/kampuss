@extends('layouts.app')

@section('title', 'Kontak Kami - Universitas Mercu Buana Yogyakarta')

@section('meta')
<meta name="description" content="Hubungi Universitas Mercu Buana Yogyakarta. Temukan informasi kontak, alamat, telepon, email, dan jam operasional kampus.">
<meta name="keywords" content="kontak kampus, telepon, email, universitas mercu buana yogyakarta">
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    
    body {
        font-family: 'Inter', sans-serif;
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .animate-fade-in {
        animation: fadeIn 0.8s ease-in-out forwards;
        opacity: 0;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .contact-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        transition: all 0.3s ease;
    }
    
    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(102, 126, 234, 0.25);
    }
    
    .info-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
    }
    
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }
    
    .icon-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    
    .map-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 pt-20 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Hubungi <span class="text-yellow-400">Kami</span>
                </h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Kami siap membantu Anda dengan informasi lengkap mengenai program studi, 
                    pendaftaran, dan layanan akademik lainnya
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-full px-6 py-3 flex items-center space-x-2">
                        <i class="fas fa-phone text-yellow-400"></i>
                        <span class="text-white font-medium">Layanan 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Phone Card -->
            <div class="info-card animate-fade-in" style="animation-delay: 0.1s;">
                <div class="icon-container">
                    <i class="fas fa-phone-alt text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Telepon</h3>
                <p class="text-gray-600">{{ $contactData['phone']}}</p>
            </div>

            <!-- Email Card -->
            <div class="info-card animate-fade-in" style="animation-delay: 0.2s;">
                <div class="icon-container">
                    <i class="fas fa-envelope text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Email</h3>
                <p class="text-gray-600">{{ $contactData['email']}}</p>
            </div>

            <!-- Address Card -->
            <div class="info-card animate-fade-in" style="animation-delay: 0.3s;">
                <div class="icon-container">
                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Alamat</h3>
                <p class="text-gray-600">{{ $contactData['address']}}</p>
            </div>

            <!-- Office Hours Card -->
            <div class="info-card animate-fade-in" style="animation-delay: 0.4s;">
                <div class="icon-container">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Jam Operasional</h3>
                <p class="text-gray-600">{{ $contactData['operasional']}}</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Contact Form -->
            <div class="animate-fade-in" style="animation-delay: 0.5s;">
                <div class="contact-card">
                    <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm" class="space-y-6">
                        @csrf
                        
                        <!-- Honeypot Field (Hidden) -->
                        <input type="text" name="website" style="display: none !important;" tabindex="-1" autocomplete="off">
                        
                        <!-- Time-based Protection -->
                        <input type="hidden" name="form_start_time" id="formStartTime">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 text-white placeholder-white placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 text-white placeholder-white placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="your@email.com" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Nomor Telepon</label>
                            <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 text-white placeholder-white placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Subjek</label>
                            <select name="subjek" class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
                                <option value="" {{ old('subjek') == '' ? 'selected' : '' }}>Pilih Subjek</option>
                                <option value="Informasi Umum" {{ old('subjek') == 'Informasi Umum' ? 'selected' : '' }}>Informasi Umum</option>
                                <option value="Pendaftaran" {{ old('subjek') == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                <option value="Akademik" {{ old('subjek') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="Keuangan" {{ old('subjek') == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Pesan</label>
                            <textarea name="pesan" id="pesan" rows="5" class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 text-white placeholder-white placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Tulis pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                            <div id="charCount" class="text-sm text-white text-opacity-70 mt-1">0 / 1000 karakter</div>
                        </div>
                        
                        <!-- Spam Protection Notice -->
                        <div class="bg-blue-600 bg-opacity-30 border border-blue-400 border-opacity-50 rounded-lg p-3">
                            <p class="text-sm text-white">
                                <i class="fas fa-shield-alt mr-2 text-yellow-400"></i>
                                Form ini dilindungi sistem anti-spam. Pastikan mengisi dengan informasi yang valid.
                            </p>
                        </div>
                        
                        <button type="submit" id="submitBtn" class="w-full bg-yellow-400 text-blue-900 font-semibold py-3 px-6 rounded-lg hover:bg-yellow-300 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Map and Additional Info -->
            <div class="space-y-8">
                <!-- Map -->
                <div class="animate-fade-in" style="animation-delay: 0.6s;">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Lokasi Kampus</h2>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0!2d110.3695!3d-7.7956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDcnNDQuMiJTIDExMMKwMjInMTAuMiJF!5e0!3m2!1sen!2sid!4v1234567890"
                            width="100%" 
                            height="300" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Quick Contact Info -->
                <div class="animate-fade-in" style="animation-delay: 0.7s;">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Kontak Darurat</h3>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center text-red-700">
                            <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                            <div>
                                <p class="font-medium">Hotline Darurat</p>
                                <p class="text-sm">{{ $contactData['emergency_phone'] ?? '0274-911' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="animate-fade-in" style="animation-delay: 0.8s;">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="{{ $contactData['facebook'] ?? '#' }}" class="w-12 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ $contactData['instagram'] ?? '#' }}" class="w-12 h-12 bg-pink-600 text-white rounded-lg flex items-center justify-center hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $contactData['youtube'] ?? '#' }}" class="w-12 h-12 bg-red-600 text-white rounded-lg flex items-center justify-center hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="{{ $contactData['linkedin'] ?? '#' }}" class="w-12 h-12 bg-blue-800 text-white rounded-lg flex items-center justify-center hover:bg-blue-900 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="animate-fade-in mb-16" style="animation-delay: 0.9s;">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Pertanyaan yang Sering Diajukan</h2>
            <div class="max-w-4xl mx-auto space-y-4">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Bagaimana cara mendaftar sebagai mahasiswa baru?</h3>
                        <p class="text-gray-600">Anda dapat mendaftar melalui website resmi kami atau datang langsung ke kampus. Informasi lengkap mengenai persyaratan dan prosedur pendaftaran tersedia di bagian admisi.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Apa saja program studi yang tersedia?</h3>
                        <p class="text-gray-600">Kami menyediakan berbagai program studi mulai dari D3, S1, hingga S2. Informasi lengkap mengenai program studi dapat dilihat di halaman jurusan.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Bagaimana dengan fasilitas kampus?</h3>
                        <p class="text-gray-600">Kampus kami dilengkapi dengan fasilitas modern termasuk laboratorium, perpustakaan digital, auditorium, dan fasilitas olahraga yang lengkap.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Add smooth animation on scroll and spam protection
document.addEventListener('DOMContentLoaded', function() {
    const animateElements = document.querySelectorAll('.animate-fade-in');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    animateElements.forEach(element => {
        observer.observe(element);
    });

    // Spam Protection JavaScript
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const pesanField = document.getElementById('pesan');
    const charCount = document.getElementById('charCount');
    
    if (form && submitBtn && pesanField && charCount) {
        // Set form start time for time-based protection
        document.getElementById('formStartTime').value = Math.floor(Date.now() / 1000);
        
        let formInteractionStarted = false;
        
        // Track form interaction
        form.addEventListener('input', function() {
            if (!formInteractionStarted) {
                formInteractionStarted = true;
                document.getElementById('formStartTime').value = Math.floor(Date.now() / 1000);
            }
        });
        
        // Character count for message
        pesanField.addEventListener('input', function() {
            const length = this.value.length;
            charCount.innerHTML = `${length} / 1000 karakter`;
            
            if (length > 950) {
                charCount.className = 'text-sm text-red-400 mt-1';
            } else if (length > 800) {
                charCount.className = 'text-sm text-yellow-400 mt-1';
            } else {
                charCount.className = 'text-sm text-white text-opacity-70 mt-1';
            }
        });
        
        // Basic spam detection (client-side)
        const spamPatterns = [
            /https?:\/\/[^\s]+.*https?:\/\/[^\s]+.*https?:\/\/[^\s]+/, // Multiple URLs
            /(.)\1{5,}/, // Repeated characters
            /[A-Z]{10,}/ // Excessive caps
        ];
        
        function checkSpam(text) {
            return spamPatterns.some(pattern => pattern.test(text));
        }
        
        pesanField.addEventListener('blur', function() {
            if (checkSpam(this.value)) {
                this.style.borderColor = '#f56565';
                if (!document.getElementById('spamWarning')) {
                    const warning = document.createElement('div');
                    warning.id = 'spamWarning';
                    warning.className = 'text-sm text-red-400 mt-1';
                    warning.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i>Pesan terdeteksi mencurigakan. Mohon gunakan bahasa yang lebih formal.';
                    this.parentNode.appendChild(warning);
                }
            } else {
                this.style.borderColor = '';
                const warning = document.getElementById('spamWarning');
                if (warning) {
                    warning.remove();
                }
            }
        });
        
        // Prevent too fast submission
        form.addEventListener('submit', function(e) {
            const startTime = document.getElementById('formStartTime').value;
            const currentTime = Math.floor(Date.now() / 1000);
            
            // Minimum 3 seconds interaction time
            if (currentTime - startTime < 3) {
                e.preventDefault();
                alert('Mohon luangkan waktu untuk mengisi form dengan teliti.');
                return false;
            }
            
            // Check for spam content one more time
            if (checkSpam(pesanField.value)) {
                e.preventDefault();
                alert('Pesan mengandung konten yang tidak diperbolehkan.');
                return false;
            }
            
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
        });
    }
});
</script>
@endpush

@endsection
