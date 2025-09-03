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

    @include('partials.homepage.fasilitas')






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