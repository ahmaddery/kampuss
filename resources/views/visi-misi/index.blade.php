@extends('layouts.app')

@section('title', ($intro && $intro->title ? $intro->title : 'Visi Misi') . ' - Universitas Mercu Buana Yogyakarta')

@section('content')
<section class="relative bg-white text-gray-900 overflow-hidden">
    <div class="container mx-auto px-4 py-20 relative z-10">
        <div class="flex flex-col md:flex-row items-center min-h-[400px]">
            <div class="md:w-2/3 w-full md:pr-12 mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    {{ $intro && $intro->title ? $intro->title : 'Visi Misi' }}
                </h1>
                <p class="text-base md:text-lg leading-relaxed opacity-95 text-justify">
                    {{ $intro && $intro->description ? $intro->description : 'Para pendiri Universitas Mercu Buana Yogyakarta berkeyakinan bahwa kebahagiaan dan kesejahteraan adalah rahmat Allah SWT dan merupakan cita-cita semua umat manusia. Oleh karena itu Universitas Mercu Buana Yogyakarta berusaha ikut andil membantu masyarakat Indonesia umumnya untuk mewujudkan cita-cita tersebut melalui penyelenggaraan pendidikan, pengajaran, penelitian dan pengabdian pada masyarakat.' }}
                </p>
            </div>
            <div class="md:w-1/3 w-full flex justify-center">
                @if($intro && $intro->image_url)
                    <img src="{{ $intro->image_url }}" alt="{{ $intro->title ?? 'Student' }}" class="rounded-2xl shadow-xl object-cover w-72 h-72 md:w-80 md:h-80" />
                @else
                    <img src="{{ asset('images/profile.jpg') }}" alt="Student" class="rounded-2xl shadow-xl object-cover w-72 h-72 md:w-80 md:h-80" />
                @endif
            </div>
        </div>
    </div>
</section>

<section class="bg-white text-gray-900 py-16">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="mb-10">
            <h2 class="text-2xl md:text-2xl font-semibold text-blue-700 mb-2">
                {{ $vision && $vision->title ? $vision->title : 'Visi Universitas Mercu Buana Yogyakarta' }}
            </h2>
            @if($vision && $vision->description)
                <p class="italic text-lg text-gray-700 mb-2">“{{ $vision->description }}”</p>
            @endif
            @if($vision && $vision->year_target)
                <span class="inline-block bg-blue-100 text-blue-700 text-sm rounded px-3 py-1 mt-2">Target {{ $vision->year_target }}</span>
            @endif
        </div>
        <div>
            <h2 class="text-2xl md:text-2xl font-semibold text-blue-700 mb-4">
                Misi Universitas Mercu Buana Yogyakarta
            </h2>
            @if($missions && $missions->count())
                <ul class="space-y-4 pl-4">
                    @foreach($missions as $mission)
                        <li class="flex items-start"><span class="text-blue-500 text-xl mr-3 mt-1">•</span> <span>{{ $mission->description }}</span></li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Belum ada data misi.</p>
            @endif
        </div>
    </div>
</section>
@endsection
