@extends('layouts.app') <!-- Menggunakan layout app -->

@section('title', 'Home Page') <!-- Menentukan judul halaman -->

@section('content')

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Include Image Slider Section --}}
    @include('partials.homepage.image-slider')

    {{-- Include Academic Programs Section --}}
    @include('partials.homepage.academic-programs')


    @include('partials.homepage.register-mahasiswa')

    @include('partials.homepage.anouncment')

    @include('partials.homepage.news')




     <!-- Dosen & Staff Section -->
    <div class="py-20 bg-gradient-to-r from-purple-900 via-blue-900 to-purple-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-32 h-32 bg-green-400 rounded-full transform -translate-x-16 -translate-y-16"></div>
            <div class="absolute top-20 right-20 w-24 h-24 bg-yellow-400 rounded-full"></div>
            <div class="absolute bottom-20 left-20 w-28 h-28 bg-red-400 rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-36 h-36 bg-blue-400 rounded-full transform translate-x-18 translate-y-18"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">DOSEN & STAF</h2>
                <p class="text-xl text-gray-200">Dosen & Staf profesional</p>
            </div>

            <!-- Staff Slider Container -->
            <div class="relative">
                <!-- Slider Wrapper -->
                <div class="overflow-hidden">
                    <div id="staffSlider" class="flex transition-transform duration-500 ease-in-out">
                        <!-- Slide 1 -->
                        <div class="min-w-full">
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                                <!-- Staff Card 1 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1494790108755-2616c274b5e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Iswahyuni" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Iswahyuni, S.P....</h3>
                                        <p class="text-sm text-gray-600 mb-3">Wakil Ketua II</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 2 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Dr. Sudarsono" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Dr. Sudarsono,......</h3>
                                        <p class="text-sm text-gray-600 mb-3">Wakil Ketua III</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 3 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Hj. Kusjuniati" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Hj. Kusjuniati, S.E....</h3>
                                        <p class="text-sm text-gray-600 mb-3">Ka. Prodi ES</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 4 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Haris Nursyah" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Haris Nursyah...</h3>
                                        <p class="text-sm text-gray-600 mb-3">Ka. Prodi PAI</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Card 5 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Nur Wahyudi" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Nur Wahyudi, S....</h3>
                                        <p class="text-sm text-gray-600 mb-3">Ka. Prodi MPI</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="min-w-full">
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                                <!-- Additional Staff Cards for slide 2 -->
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Dr. Siti Aminah" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Dr. Siti Aminah...</h3>
                                        <p class="text-sm text-gray-600 mb-3">Dosen Senior</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Ahmad Fauzi" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Ahmad Fauzi, M.Pd</h3>
                                        <p class="text-sm text-gray-600 mb-3">Staf Akademik</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Rini Handayani" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Rini Handayani...</h3>
                                        <p class="text-sm text-gray-600 mb-3">Staf Keuangan</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Budi Santoso" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Budi Santoso, S.E</h3>
                                        <p class="text-sm text-gray-600 mb-3">Kepala TU</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="aspect-square">
                                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Maya Sari" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="font-bold text-gray-900 mb-1">Maya Sari, M.A</h3>
                                        <p class="text-sm text-gray-600 mb-3">Dosen Muda</p>
                                        <div class="flex justify-center space-x-2">
                                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-phone text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Navigation Buttons -->
                <button id="staffPrevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 w-12 h-12 rounded-full shadow-lg transition-all duration-300 hover:scale-110 z-10">
                    <i class="fas fa-chevron-left text-lg"></i>
                </button>
                
                <button id="staffNextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 w-12 h-12 rounded-full shadow-lg transition-all duration-300 hover:scale-110 z-10">
                    <i class="fas fa-chevron-right text-lg"></i>
                </button>
            </div>

            <!-- Dots Indicator -->
            <div class="flex justify-center mt-12 space-x-3">
                <button class="staff-dot w-3 h-3 rounded-full bg-white opacity-60 hover:opacity-100 transition-opacity duration-300" data-slide="0"></button>
                <button class="staff-dot w-3 h-3 rounded-full bg-white opacity-60 hover:opacity-100 transition-opacity duration-300" data-slide="1"></button>
            </div>
        </div>
    </div>

     <script>
        class ImageSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 3;
                this.isPlaying = true;
                this.intervalId = null;
                this.autoSlideDelay = 4000; // 4 seconds
                
                this.slider = document.getElementById('slider');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                this.playPauseBtn = null;
                this.playPauseIcon = null;
                this.dots = document.querySelectorAll('.dot');
                
                this.init();
            }
            
            init() {
                // Set initial active dot
                this.updateDots();
                
                // Start auto slide
                this.startAutoSlide();
                
                // Event listeners
                this.prevBtn.addEventListener('click', () => this.prevSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                this.slider.parentElement.addEventListener('mouseenter', () => {
                    if (this.isPlaying) {
                        this.pauseAutoSlide();
                    }
                });
                
                this.slider.parentElement.addEventListener('mouseleave', () => {
                    if (this.isPlaying) {
                        this.startAutoSlide();
                    }
                });
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                this.slider.style.transform = `translateX(${translateX}%)`;
                this.updateDots();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            updateDots() {
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.remove('opacity-60');
                        dot.classList.add('opacity-100', 'bg-blue-500');
                    } else {
                        dot.classList.remove('opacity-100', 'bg-blue-500');
                        dot.classList.add('opacity-60');
                    }
                });
            }
            
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, this.autoSlideDelay);
            }
            
            pauseAutoSlide() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                }
            }
            
            addTouchSupport() {
                let startX = 0;
                let endX = 0;
                
                this.slider.parentElement.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                
                this.slider.parentElement.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                });
                
                this.slider.parentElement.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;
                    
                    if (Math.abs(diff) > 50) { // Minimum swipe distance
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                });
            }
        }

        // Staff Slider Class
        class StaffSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 2;
                this.intervalId = null;
                this.autoSlideDelay = 8000; // 8 seconds - slower for staff profiles
                
                this.slider = document.getElementById('staffSlider');
                this.prevBtn = document.getElementById('staffPrevBtn');
                this.nextBtn = document.getElementById('staffNextBtn');
                this.dots = document.querySelectorAll('.staff-dot');
                
                this.init();
            }
            
            init() {
                // Set initial active dot
                this.updateDots();
                
                // Start auto slide
                this.startAutoSlide();
                
                // Event listeners
                this.prevBtn.addEventListener('click', () => this.prevSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                this.slider.parentElement.addEventListener('mouseenter', () => {
                    this.pauseAutoSlide();
                });
                
                this.slider.parentElement.addEventListener('mouseleave', () => {
                    this.startAutoSlide();
                });
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                this.slider.style.transform = `translateX(${translateX}%)`;
                this.updateDots();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            updateDots() {
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.remove('opacity-60');
                        dot.classList.add('opacity-100');
                    } else {
                        dot.classList.remove('opacity-100');
                        dot.classList.add('opacity-60');
                    }
                });
            }
            
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, this.autoSlideDelay);
            }
            
            pauseAutoSlide() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                }
            }
            
            addTouchSupport() {
                let startX = 0;
                let endX = 0;
                
                this.slider.parentElement.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                
                this.slider.parentElement.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                });
                
                this.slider.parentElement.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;
                    
                    if (Math.abs(diff) > 50) { // Minimum swipe distance
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                });
            }
        }
        
        // Initialize slider when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ImageSlider();
            new ProdiSlider();
            new StaffSlider();
        });

        // Program Studi Slider Class
        class ProdiSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 3;
                this.intervalId = null;
                this.autoSlideDelay = 6000; // 6 seconds
                
                this.slider = document.getElementById('prodiSlider');
                this.prevBtn = document.getElementById('prodiPrevBtn');
                this.nextBtn = document.getElementById('prodiNextBtn');
                this.dots = document.querySelectorAll('.prodi-dot');
                
                this.init();
            }
            
            init() {
                // Set initial active dot
                this.updateDots();
                
                // Start auto slide
                this.startAutoSlide();
                
                // Event listeners
                this.prevBtn.addEventListener('click', () => this.prevSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                this.slider.parentElement.addEventListener('mouseenter', () => {
                    this.pauseAutoSlide();
                });
                
                this.slider.parentElement.addEventListener('mouseleave', () => {
                    this.startAutoSlide();
                });
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                this.slider.style.transform = `translateX(${translateX}%)`;
                this.updateDots();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }
            
            updateDots() {
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.remove('bg-gray-400');
                        dot.classList.add('bg-blue-500');
                    } else {
                        dot.classList.remove('bg-blue-500');
                        dot.classList.add('bg-gray-400');
                    }
                });
            }
            
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, this.autoSlideDelay);
            }
            
            pauseAutoSlide() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                }
            }
            
            addTouchSupport() {
                let startX = 0;
                let endX = 0;
                
                this.slider.parentElement.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                
                this.slider.parentElement.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                });
                
                this.slider.parentElement.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;
                    
                    if (Math.abs(diff) > 50) { // Minimum swipe distance
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                });
            }
        }
    </script>

@endsection