@extends('layouts.app')

@section('title', 'Visi Misi - Universitas Mercu Buana Yogyakarta')

@section('content')
{{-- Hero Section with Blue Background --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-7">
                @if($intro)
                    @if($intro->title)
                        <h1 class="hero-title mb-4">{{ $intro->title }}</h1>
                    @endif
                    <p class="hero-description">{{ $intro->description }}</p>
                @else
                    <h1 class="hero-title mb-4">Visi Misi</h1>
                    <p class="hero-description">Para pendiri Universitas Mercu Buana Yogyakarta berkeyakinan bahwa kebahagiaan dan kesejahteraan adalah rahmat Allah SWT dan merupakan cita-cita semua umat manusia. Oleh karena itu Universitas Mercu Buana Yogyakarta berusaha ikut andil membantu masyarakat Indonesia umumnya untuk mewujudkan cita-cita tersebut melalui penyelenggaraan pendidikan, pengajaran, penelitian dan pengabdian pada masyarakat.</p>
                @endif
            </div>
            <div class="col-lg-5">
                <div class="hero-image-container">
                    @if($intro && $intro->image_path)
                        <img src="{{ $intro->image_url }}" alt="{{ $intro->title }}" class="hero-image">
                    @else
                        <img src="{{ asset('images/graduation-student.jpg') }}" alt="Student" class="hero-image">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Vision Mission Content Section --}}
<section class="content-section">
    <div class="container py-5">

{{-- Vision Mission Content Section --}}
<section class="content-section">
    <div class="container py-5">
        {{-- Vision Section --}}
        @if($vision)
        <div class="vision-section mb-5">
            <div class="row">
                <div class="col-12">
                    @if($vision->title)
                        <h2 class="section-title text-primary mb-3">{{ $vision->title }}</h2>
                    @endif
                    @if($vision->year_target)
                        <p class="target-year mb-3">"{{ $vision->description }}"</p>
                        <div class="text-end">
                            <span class="badge bg-primary px-3 py-2">Target {{ $vision->year_target }}</span>
                        </div>
                    @else
                        <p class="vision-text">"{{ $vision->description }}"</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- Mission Section --}}
        @if($missions->count() > 0)
        <div class="mission-section">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-primary mb-4">Misi Universitas Mercu Buana Yogyakarta</h2>
                    <div class="missions-list">
                        @foreach($missions as $mission)
                        <div class="mission-item d-flex align-items-start mb-4">
                            <span class="mission-bullet me-3">•</span>
                            <p class="mission-text mb-0">{{ $mission->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

    {{-- Call to Action Section --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-primary text-white border-0">
                <div class="card-body text-center py-5">
                    <h3 class="mb-3">Bergabunglah dengan Kami</h3>
                    <p class="mb-4">Mari bersama-sama mewujudkan visi dan misi Universitas Mercu Buana Yogyakarta untuk menciptakan masa depan yang gemilang.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="/sambutan-rektor" class="btn btn-light btn-lg">
                            <i class="fas fa-user-tie me-2"></i>Sambutan Rektor
                        </a>
                        <a href="/sejarah" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-history me-2"></i>Sejarah Universitas
                        </a>
                        <a href="/berita" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-newspaper me-2"></i>Berita Terbaru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section Styles */
.hero-section {
    background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #1e40af 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-section .container {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 2rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.hero-description {
    font-size: 1.1rem;
    line-height: 1.7;
    opacity: 0.95;
    text-align: justify;
    margin-bottom: 0;
}

.hero-image-container {
    position: relative;
    text-align: center;
}

.hero-image {
    max-width: 100%;
    height: auto;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    transform: perspective(1000px) rotateY(-5deg);
    transition: transform 0.3s ease;
}

.hero-image:hover {
    transform: perspective(1000px) rotateY(0deg);
}

/* Content Section Styles */
.content-section {
    background: #f8fafc;
    min-height: 60vh;
}

.section-title {
    font-size: 2.2rem;
    font-weight: 600;
    color: #1e40af !important;
    margin-bottom: 1.5rem;
}

.target-year {
    font-size: 1.1rem;
    font-style: italic;
    color: #374151;
    line-height: 1.6;
}

.vision-text {
    font-size: 1.1rem;
    font-style: italic;
    color: #374151;
    line-height: 1.6;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.mission-item {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border-left: 4px solid #3b82f6;
    margin-bottom: 1rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.mission-item:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.mission-bullet {
    color: #3b82f6;
    font-size: 1.5rem;
    font-weight: bold;
    line-height: 1;
}

.mission-text {
    color: #374151;
    font-size: 1rem;
    line-height: 1.6;
}

.icon-container {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.btn-lg {
    padding: 12px 24px;
    border-radius: 50px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-description {
        font-size: 1rem;
    }
    
    .hero-image {
        transform: none;
        border-radius: 15px;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .mission-item {
        padding: 1rem;
        margin-bottom: 0.75rem;
    }
    
    .mission-item:hover {
        transform: none;
    }
}

@media (max-width: 576px) {
    .hero-section {
        min-height: auto;
        padding: 3rem 0;
    }
    
    .hero-title {
        font-size: 2rem;
        text-align: center;
    }
    
    .hero-description {
        text-align: left;
    }
}
</style>
@endsection
