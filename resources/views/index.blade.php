@extends('layouts.app') <!-- Menggunakan layout app -->

@section('title', 'Home Page') <!-- Menentukan judul halaman -->

@section('content')

    {{-- Include Image Slider Section --}}
    @include('partials.homepage.image-slider')

    {{-- Include Academic Programs Section --}}
    @include('partials.homepage.academic-programs')


    @include('partials.homepage.register-mahasiswa')

    @include('partials.homepage.anouncment')

    @include('partials.homepage.news')

    @include('partials.homepage.fasilitas')








     <script>
        class ImageSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = document.querySelectorAll('#slider > div').length;
                this.isPlaying = true;
                this.intervalId = null;
                this.autoSlideDelay = 4000; // 4 seconds
                
                this.slider = document.getElementById('slider');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                this.dots = document.querySelectorAll('.dot');
                
                this.init();
            }
            
            init() {
                // Set initial active dot
                this.updateDots();
                
                // Start auto slide
                this.startAutoSlide();
                
                // Event listeners
                if(this.prevBtn) this.prevBtn.addEventListener('click', () => this.prevSlide());
                if(this.nextBtn) this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                if(this.slider && this.slider.parentElement) {
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
                }
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                if(this.slider) {
                    this.slider.style.transform = `translateX(${translateX}%)`;
                }
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
                        dot.classList.remove('bg-white');
                    } else {
                        dot.classList.remove('opacity-100', 'bg-blue-500');
                        dot.classList.add('opacity-60', 'bg-white');
                    }
                });
            }
            
            startAutoSlide() {
                if(this.totalSlides > 1) {
                    this.intervalId = setInterval(() => {
                        this.nextSlide();
                    }, this.autoSlideDelay);
                }
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
                
                if(this.slider && this.slider.parentElement) {
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
        }

        // Program Studi Slider Class
        class ProdiSlider {
            constructor() {
                const prodiSlider = document.getElementById('prodiSlider');
                if(!prodiSlider) return;
                
                this.currentSlide = 0;
                this.totalSlides = document.querySelectorAll('#prodiSlider > div').length;
                this.intervalId = null;
                this.autoSlideDelay = 6000; // 6 seconds
                
                this.slider = prodiSlider;
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
                if(this.prevBtn) this.prevBtn.addEventListener('click', () => this.prevSlide());
                if(this.nextBtn) this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Pause on hover
                if(this.slider && this.slider.parentElement) {
                    this.slider.parentElement.addEventListener('mouseenter', () => {
                        this.pauseAutoSlide();
                    });
                    
                    this.slider.parentElement.addEventListener('mouseleave', () => {
                        this.startAutoSlide();
                    });
                }
                
                // Touch/swipe support for mobile
                this.addTouchSupport();
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                const translateX = -slideIndex * 100;
                if(this.slider) {
                    this.slider.style.transform = `translateX(${translateX}%)`;
                }
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
                if(this.totalSlides > 1) {
                    this.intervalId = setInterval(() => {
                        this.nextSlide();
                    }, this.autoSlideDelay);
                }
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
                
                if(this.slider && this.slider.parentElement) {
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
        }
        
        // Initialize slider when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ImageSlider();
            new ProdiSlider();
        });
    </script>

@endsection