# Partials Directory

This directory contains reusable Blade template partials organized by sections for better maintainability.

## Homepage Sections

### `/homepage` subdirectory contains:

- **`image-slider.blade.php`** - Homepage image slider/banner section
  - Displays rotating banners with navigation controls
  - Requires `$banners` variable from controller
  
- **`academic-programs.blade.php`** - Academic programs showcase section  
  - Displays program cards with images and descriptions
  - Includes hover effects and styling
  - Requires `$jurusans` variable from controller

## Usage

To include these partials in your views:

```blade
{{-- Include Image Slider Section --}}
@include('partials.homepage.image-slider')

{{-- Include Academic Programs Section --}}
@include('partials.homepage.academic-programs')
```

## Benefits

- **Better maintainability**: Each section is in its own file
- **Reusability**: Sections can be included in multiple views
- **Organization**: Clean separation of concerns
- **Easier debugging**: Isolated components are easier to troubleshoot
