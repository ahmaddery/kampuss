@extends('layouts.app')

@section('content')
    <style>
        .rector-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .rector-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2c3e50, #e74c3c);
        }
        
        .rector-image {
            width: 300px;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            border: 3px solid #ffffff;
        }
        
        .rector-image:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        
        .image-container {
            position: relative;
        }
        
        .image-container::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
            border-radius: 2px;
        }
        
        .section-title {
            color: #2c3e50;
            font-weight: 700;
            font-size: 2.8rem;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #3498db, #e74c3c);
            border-radius: 2px;
        }
        
        .rector-subtitle {
            color: #34495e;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 30px;
            line-height: 1.6;
            font-style: italic;
            padding-left: 20px;
            border-left: 4px solid #3498db;
            background: rgba(52, 152, 219, 0.05);
            padding: 15px 20px;
            border-radius: 5px;
        }
        
        .rector-content {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.9;
            text-align: justify;
            margin-bottom: 30px;
        }
        
        .rector-content p {
            margin-bottom: 20px;
            text-indent: 30px;
            position: relative;
        }
        
        .rector-content p:first-child::first-letter {
            font-size: 3.5rem;
            font-weight: bold;
            float: left;
            line-height: 1;
            margin: 0 8px 0 0;
            color: #3498db;
            font-family: 'Times New Roman', serif;
        }
        
        .rector-signature {
            margin-top: 50px;
            color: #2c3e50;
            font-weight: 600;
            text-align: right;
            position: relative;
            padding: 25px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            border-left: 5px solid #3498db;
        }
        
        .signature-line {
            width: 200px;
            height: 1px;
            background: #3498db;
            margin: 15px 0 10px auto;
        }
        
        .rector-info {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: 1px solid rgba(52, 152, 219, 0.1);
        }
        
        .content-wrapper {
            position: relative;
            z-index: 2;
        }
        
        .decorative-element {
            position: absolute;
            top: 20%;
            right: -100px;
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, rgba(52, 152, 219, 0.1), rgba(231, 76, 60, 0.1));
            border-radius: 50%;
            z-index: 1;
        }
        
        .quote-mark {
            font-size: 4rem;
            color: rgba(52, 152, 219, 0.2);
            position: absolute;
            top: -20px;
            left: -20px;
            font-family: 'Times New Roman', serif;
            line-height: 1;
        }
        
        .content-section {
            position: relative;
            padding: 30px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        
        .loading-placeholder {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7f8c8d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #bdc3c7;
        }
        
        @media (max-width: 768px) {
            .rector-section {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2.2rem;
                text-align: center;
            }
            
            .section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .rector-image {
                width: 100%;
                max-width: 280px;
                height: 350px;
                margin: 0 auto 40px;
                display: block;
            }
            
            .rector-subtitle {
                text-align: center;
                margin-left: 0;
                margin-right: 0;
            }
            
            .rector-signature {
                text-align: center;
            }
            
            .decorative-element {
                display: none;
            }
            
            .content-section {
                margin: 0 -15px;
                border-radius: 0;
            }
        }
        
        @media (max-width: 576px) {
            .rector-section {
                padding: 40px 0;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .rector-content {
                font-size: 1rem;
            }
            
            .rector-content p:first-child::first-letter {
                font-size: 2.5rem;
            }
        }
    </style>

    <section class="rector-section">
        <div class="decorative-element"></div>
        <div class="container">
            <div class="content-wrapper">
                @if(isset($data) && count($data) > 0)
                    <div class="row align-items-start">
                        <div class="col-lg-4 col-md-5 mb-4 mb-md-0">
                            <div class="text-center">
                                <div class="image-container">
                                    @if(isset($data[0]->foto) && !empty($data[0]->foto))
                                        <img src="{{ asset('storage/' . $data[0]->foto) }}" 
                                             alt="Foto {{ $data[0]->nama ?? 'Rektor' }}" 
                                             class="rector-image"
                                             loading="lazy"
                                             onerror="this.src='https://via.placeholder.com/300x400/f8f9fa/6c757d?text=Foto+Tidak+Tersedia'">
                                    @else
                                        <img src="https://via.placeholder.com/300x400/f8f9fa/6c757d?text=Foto+Rektor" 
                                             alt="Foto Rektor" 
                                             class="rector-image loading-placeholder">
                                    @endif
                                </div>
                                
                                @if(isset($data[0]->nama) || isset($data[0]->jabatan) || isset($data[0]->gelar))
                                    <div class="rector-info mt-4">
                                        @if(isset($data[0]->nama))
                                            <h5 class="mb-1 text-primary">{{ $data[0]->nama }}</h5>
                                        @endif
                                        @if(isset($data[0]->jabatan))
                                            <p class="mb-1 text-muted">{{ $data[0]->jabatan }}</p>
                                        @endif
                                        @if(isset($data[0]->gelar))
                                            <small class="text-muted">{{ $data[0]->gelar }}</small>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-8 col-md-7">
    @foreach($data as $index => $sambutan)
        <div class="content-section">
            <div class="quote-mark">"</div>
            
            <!-- Judul Sambutan -->
            <h2 class="section-title">
                @if(isset($sambutan->judul) && !empty($sambutan->judul))
                    {{ $sambutan->judul }}
                @else
                    Sambutan Rektor
                @endif
            </h2>
            
            <!-- Salam Pembuka -->
            @if(isset($sambutan->salam) && !empty($sambutan->salam))
                <div class="rector-subtitle">
                    {{ $sambutan->salam }}
                </div>
            @else
            @endif

            <!-- Deskripsi Sambutan -->
            @if(isset($sambutan->deskripsi) && !empty($sambutan->deskripsi))
                <div class="rector-content">
                    {!! $sambutan->deskripsi !!}
                </div>
            @else
                <div class="rector-content">
                    <p>Konten sambutan akan segera tersedia.</p>
                </div>
            @endif
        </div>

        <!-- Pisah antar sambutan jika bukan yang terakhir -->
        @if(!$loop->last)
            <hr class="my-5" style="border-color: #3498db; opacity: 0.3;">
        @endif
    @endforeach
</div>

                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-info-circle"></i>
                        <h4>Sambutan Rektor</h4>
                        <p>Informasi sambutan rektor akan segera tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Smooth scroll animation for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading animation
            const images = document.querySelectorAll('.rector-image');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.classList.remove('loading-placeholder');
                });
            });
            
            // Add fade-in animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });
            
            document.querySelectorAll('.content-section').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease';
                observer.observe(el);
            });
        });
    </script>
    @endpush

@endsection