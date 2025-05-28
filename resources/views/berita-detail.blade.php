@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .article-content {
            font-family: 'Crimson Text', serif;
            line-height: 1.8;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.8) 100%);
        }
        
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            z-index: 1000;
            transition: width 0.3s ease;
        }
        
        .floating-nav {
            position: fixed;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            z-index: 100;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .floating-nav.visible {
            opacity: 1;
        }
        
        .social-share-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .social-share-btn:hover {
            transform: translateY(-2px) scale(1.05);
        }
        
        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 0.75rem;
            border: 1px solid rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }
        
        .article-meta-item:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.2);
            transform: translateY(-1px);
        }
        
        .related-card {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
        }
        
        .back-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .back-button:hover {
            transform: translateX(-4px);
            box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.4);
        }
        
        .print-button {
            position: relative;
            overflow: hidden;
        }
        
        .print-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .print-button:hover::before {
            left: 100%;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
        }
        
        .content-section {
            scroll-margin-top: 2rem;
        }
        
        .image-zoom {
            cursor: zoom-in;
            transition: transform 0.3s ease;
        }
        
        .image-zoom:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">
    <!-- Reading Progress Bar -->
    <div class="reading-progress"></div>
    
    <!-- Floating Navigation -->
    <div class="floating-nav no-print">
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-xl border border-gray-200/50">
            <div class="flex flex-col space-y-3">
                <button onclick="scrollToTop()" class="p-3 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300" title="Ke Atas">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <button onclick="window.print()" class="p-3 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-xl transition-all duration-300" title="Print">
                    <i class="fas fa-print"></i>
                </button>
                <button onclick="shareArticle()" class="p-3 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-xl transition-all duration-300" title="Share">
                    <i class="fas fa-share-alt"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-8 no-print">
            <a href="{{ route('berita.index') }}" class="back-button inline-flex items-center text-white px-6 py-3 rounded-xl font-semibold shadow-lg">
                <i class="fas fa-arrow-left mr-3"></i>
                <span>Kembali ke Berita</span>
            </a>
        </div>

        <!-- Main Article Container -->
        <article class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50">
            <!-- Hero Image Section -->
           
            <div class="relative h-96 lg:h-[500px] overflow-hidden">
                
                <img src="{{ asset('storage/' . $berita->image_path) }}" 
                     alt="Wisuda Semester Ganjil 2024" 
                     class="w-full h-full object-cover image-zoom">
                <div class="hero-gradient absolute inset-0"></div>
                
                <!-- Article Title Overlay -->
                <div class="absolute bottom-0 left-0 right-0 p-8 lg:p-12">
                    <div class="max-w-4xl">
                        <div class="mb-4">
                            <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                Akademik
                            </span>
                        </div>
                        <h1 class="text-3xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                           {{ $berita->title }}
                        </h1>
                    </div>
                </div>
            </div>
            <!-- Article Meta Information -->
            <div class="p-8 lg:p-12 border-b border-gray-100">
                <div class="flex flex-wrap gap-4 items-center justify-between">
                    <div class="flex flex-wrap gap-4">
                        
                        <div class="article-meta-item">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                            <span class="font-medium text-gray-700">
                                {{ \Carbon\Carbon::parse($berita->publish_date)->format('d') }} 
                                {{ \Carbon\Carbon::parse($berita->publish_date)->format('M') }} 
                                {{ \Carbon\Carbon::parse($berita->publish_date)->format('Y') }}
                            </span>
                        </div>

                        <div class="article-meta-item">
                            <i class="fas fa-user-edit text-green-600"></i>
                            <span class="font-medium text-gray-700">{{ $berita->author }}</span>
                        </div>
                        <div class="article-meta-item">
                            <i class="fas fa-eye text-purple-600"></i>
                            <span class="font-medium text-gray-700">2,547 views</span>
                        </div>
                        <div class="article-meta-item">
                            <i class="fas fa-clock text-orange-600"></i>
                            <span class="font-medium text-gray-700">5 min read</span>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Article Content -->
            <div class="p-8 lg:p-12">
                <div class="max-w-4xl mx-auto">
                    <div class="article-content text-gray-800 text-lg leading-relaxed space-y-6 content-section">

                        <p>
                            {!! $berita->description !!}
                        </p>
                        <!-- Call to Action
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8 rounded-2xl text-center my-8 no-print">
                            <h4 class="text-2xl font-bold mb-4">
                                <i class="fas fa-graduation-cap mr-3"></i>
                                Tertarik Bergabung?
                            </h4>
                            <p class="mb-6 text-blue-100">
                                Daftarkan diri Anda untuk menjadi bagian dari keluarga besar universitas kami
                            </p>
                            <a href="#" class="bg-white text-blue-600 px-8 py-3 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300 inline-flex items-center shadow-lg">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Info Pendaftaran
                            </a>
                        </div>

                         -->
                    </div>
                </div>
            </div>
        </article>


        <!-- Related Articles -->
        <section class="mt-16 no-print">
            <div class="max-w-4xl mx-auto">
                <h3 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                    <i class="fas fa-newspaper text-blue-600 mr-3"></i>
                    Berita Terkait
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Related Article 1 -->
                    <article class="related-card rounded-2xl overflow-hidden">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                 alt="Penelitian Mahasiswa" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    Penelitian
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2">
                                Mahasiswa Teknik Raih Juara 1 Kompetisi Inovasi Smart City
                            </h4>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Tim mahasiswa Fakultas Teknik berhasil meraih juara 1 dalam kompetisi inovasi smart city tingkat nasional...
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">25 Mei 2024</span>
                                <a href="#" class="text-blue-600 font-semibold text-sm hover:text-blue-700 transition-colors duration-300">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Related Article 2 -->
                    <article class="related-card rounded-2xl overflow-hidden">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                 alt="Seminar Internasional" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    Internasional
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2">
                                Seminar Internasional "Future of Digital Education"
                            </h4>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Universitas mengadakan seminar internasional dengan menghadirkan pembicara dari berbagai negara...
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">22 Mei 2024</span>
                                <a href="#" class="text-blue-600 font-semibold text-sm hover:text-blue-700 transition-colors duration-300">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Newsletter Subscription -->
        <section class="mt-16 no-print">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 md:p-12 text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
                    <div class="relative z-10">
                        <h3 class="text-3xl font-bold text-white mb-4">
                            <i class="fas fa-envelope mr-3"></i>
                            Jangan Lewatkan Berita Terbaru
                        </h3>
                        <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                            Berlangganan newsletter kami dan dapatkan update berita kampus langsung di email Anda
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                            <input type="email" 
                                   placeholder="Masukkan email Anda" 
                                   class="flex-1 px-6 py-4 rounded-xl border-0 text-gray-900 placeholder-gray-500 shadow-lg focus:ring-4 focus:ring-white/25 focus:outline-none">
                            <button class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Berlangganan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Reading Progress Bar
        window.addEventListener('scroll', () => {
            const article = document.querySelector('article');
            const scrolled = window.pageYOffset;
            const rate = scrolled / (article.offsetHeight - window.innerHeight);
            const progress = Math.min(rate * 100, 100);
            document.querySelector('.reading-progress').style.width = progress + '%';
            
            // Show/hide floating nav
            const floatingNav = document.querySelector('.floating-nav');
            if (scrolled > 300) {
                floatingNav.classList.add('visible');
            } else {
                floatingNav.classList.remove('visible');
            }
        });

        // Smooth scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Share article function
        function shareArticle() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                });
            } else {
                // Fallback - copy to clipboard
                navigator.clipboard.writeText(window.location.href);
                alert('Link artikel telah disalin ke clipboard!');
            }
        }

        // Print optimization
        window.addEventListener('beforeprint', () => {
            document.querySelectorAll('.no-print').forEach(el => {
                el.style.display = 'none';
            });
        });

        window.addEventListener('afterprint', () => {
            document.querySelectorAll('.no-print').forEach(el => {
                el.style.display = '';
            });
        });
    </script>
</body>
</html>
@endsection
