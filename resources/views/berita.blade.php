<!-- resources/views/berita.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Berita</h1>

        <!-- Berita List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($berita as $item)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        <!-- Displaying Image -->
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $item->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{!! \Illuminate\Support\Str::limit($item->description, 100) !!}</p>
                        <a href="" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                            SELENGKAPNYA <i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2 mt-12">
            {{ $berita->links() }} <!-- Pagination links if paginated -->
        </div>
    </div>
@endsection
