<!-- Image Slider Section -->
<div class="relative w-full h-[500px] md:h-[600px] overflow-hidden rounded-lg shadow-lg">
    <!-- Slider Container -->
    <div id="slider" class="flex transition-transform duration-500 ease-in-out h-full">
        @foreach($banners as $banner)
        <div class="min-w-full h-full relative">
            <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-center text-white">
                    <h2 class="text-4xl font-bold mb-4">{{ $banner->title }}</h2>
                    <p class="text-xl">{{ $banner->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Previous Button -->
    <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
        <i class="fas fa-chevron-left text-lg"></i>
    </button>

    <!-- Next Button -->
    <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
        <i class="fas fa-chevron-right text-lg"></i>
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3">
        @foreach($banners as $index => $banner)
            <button class="dot w-3 h-3 rounded-full bg-white opacity-60 hover:opacity-100 transition-opacity duration-300" data-slide="{{ $index }}"></button>
        @endforeach
    </div>
</div>
