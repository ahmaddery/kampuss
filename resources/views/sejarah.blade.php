@extends('layouts.app')

@section('content')
    <style>
        .history-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .history-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2c3e50, #e74c3c);
        }
        
        .history-image {
            width: 300px;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(139, 69, 19, 0.2);
            transition: all 0.3s ease;
            border: 3px solid #ffffff;
            filter: sepia(20%);
        }
        
        .history-image:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(139, 69, 19, 0.3);
            filter: sepia(0%);
        }
        
        .section-title {
            color: #8b4513;
            font-weight: 700;
            font-size: 2.8rem;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
            font-family: 'Times New Roman', serif;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, #8b4513, #cd853f);
            border-radius: 2px;
        }
        
        .history-subtitle {
            color: #a0522d;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 30px;
            line-height: 1.6;
            font-style: italic;
            padding-left: 20px;
            border-left: 4px solid #d2691e;
            background: rgba(210, 105, 30, 0.05);
            padding: 15px 20px;
            border-radius: 5px;
            font-family: 'Times New Roman', serif;
        }
        
        .history-content {
            color: #5d4037;
            font-size: 1.1rem;
            line-height: 1.9;
            text-align: justify;
            margin-bottom: 30px;
            font-family: 'Georgia', serif;
        }
        
        .history-content p {
            margin-bottom: 20px;
            text-indent: 30px;
        }
        
        .timeline-marker {
            position: absolute;
            left: -40px;
            top: 10px;
            width: 12px;
            height: 12px;
            background: #d2691e;
            border-radius: 50%;
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 3px #d2691e;
        }
        
        .timeline-line {
            position: absolute;
            left: -34px;
            top: 25px;
            width: 2px;
            height: calc(100% - 25px);
            background: linear-gradient(to bottom, #d2691e, transparent);
        }
        
        .content-wrapper {
            position: relative;
            z-index: 2;
        }

        .content-section {
            position: relative;
            padding: 40px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.1);
            border: 1px solid rgba(210, 105, 30, 0.1);
        }

        .year-badge {
            position: absolute;
            top: -15px;
            left: 30px;
            background: linear-gradient(135deg, #8b4513, #d2691e);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        }

        @media (max-width: 768px) {
            .history-section {
                padding: 60px 0;
            }

            .section-title {
                font-size: 2.2rem;
                text-align: center;
            }

            .history-image {
                width: 100%;
                max-width: 280px;
                height: 350px;
                margin: 0 auto 40px;
                display: block;
            }

            .history-subtitle {
                text-align: center;
            }

            .history-meta {
                text-align: center;
            }

            .decorative-element {
                display: none;
            }

            .content-section {
                margin: 0 -15px;
                border-radius: 0;
                padding: 30px 20px;
            }
        }

        @media (max-width: 576px) {
            .history-section {
                padding: 40px 0;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .history-content {
                font-size: 1rem;
            }

            .year-badge {
                position: static;
                display: inline-block;
                margin-bottom: 20px;
            }
        }
    </style>

    <section class="history-section">
        <div class="container">
            <div class="content-wrapper">
                <div class="row align-items-start">
                    <div class="col-lg-4 col-md-5 mb-4 mb-md-0">
                        <div class="text-center">
                            <div class="image-container">
                                @if(isset($sejarahData[0]->foto) && !empty($sejarahData[0]->foto))
                                    <img src="{{ asset('storage/' . $sejarahData[0]->foto) }}" 
                                         alt="Foto Sejarah {{ $sejarahData[0]->periode ?? '' }}" 
                                         class="history-image"
                                         loading="lazy"
                                         onerror="this.src='https://via.placeholder.com/300x400/8b4513/ffffff?text=Foto+Sejarah'">
                                @else
                                    <img src="https://via.placeholder.com/300x400/8b4513/ffffff?text=Sejarah+Universitas" 
                                         alt="Sejarah Universitas" 
                                         class="history-image">
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-8 col-md-7">
                        @foreach($sejarahData as $index => $sejarah)
                            <div class="content-section">
                                @if(isset($sejarah->tahun) && !empty($sejarah->tahun))
                                    <div class="year-badge">{{ $sejarah->tahun }}</div>
                                @endif

                                <div class="vintage-quote">❝</div>
                                <div class="timeline-marker"></div>
                                <div class="timeline-line"></div>

                                @if(isset($sejarah->judul) && !empty($sejarah->judul))
                                    <h2 class="section-title">{{ $sejarah->judul }}</h2>
                                @endif

                                @if(isset($sejarah->deskripsi) && !empty($sejarah->deskripsi))
                                    <div class="history-content">
                                        {!! $sejarah->deskripsi !!}
                                    </div>
                                @endif
                            </div>

                            @if(!$loop->last)
                                <div class="chapter-divider">
                                    <div class="chapter-icon">📖</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.history-image');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.classList.remove('loading-placeholder');
                    this.style.opacity = '0';
                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        this.style.transition = 'all 0.6s ease';
                        this.style.opacity = '1';
                        this.style.transform = 'scale(1)';
                    }, 100);
                });
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.content-section').forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateX(30px)';
                el.style.transition = `all 0.8s ease ${index * 0.2}s`;
                observer.observe(el);
            });

            const timelineElements = document.querySelectorAll('.timeline-marker');
            timelineElements.forEach((marker, index) => {
                setTimeout(() => {
                    marker.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        marker.style.transform = 'scale(1)';
                    }, 200);
                }, index * 300);
            });

            const firstParagraphs = document.querySelectorAll('.history-content p:first-child');
            firstParagraphs.forEach(paragraph => {
                const text = paragraph.textContent;
                paragraph.textContent = '';
                let i = 0;
                const typeWriter = () => {
                    if (i < text.length) {
                        paragraph.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 30);
                    }
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(typeWriter, 1000);
                            observer.unobserve(entry.target);
                        }
                    });
                });

                observer.observe(paragraph);
            });
        });
    </script>
    @endpush
@endsection
