@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Berita</h1>

        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $berita->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <!-- Textarea for CKEditor -->
                <textarea name="description" id="editor" class="form-control">{{ $berita->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image_path">Image</label>
                <input type="file" name="image_path" class="form-control">
                @if ($berita->image_path)
                    <img src="{{ asset('storage/' . $berita->image_path) }}" alt="Image" class="mt-2" width="150">
                @endif
            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input type="date" name="publish_date" class="form-control" value="{{ $berita->publish_date }}" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="{{ $berita->author }}">
            </div>

            <!-- Tags Input -->
            <div class="form-group">
                <label for="tags">Tags (comma separated)</label>
                <input type="text" name="tags" class="form-control" value="{{ old('tags', $berita->tags) }}" placeholder="e.g., technology, news, updates">
            </div>

            <!-- Checkbox for Random Slug -->
            <div class="form-group">
                <label for="random_slug">Generate Random Slug?</label>
                <input type="checkbox" name="random_slug" id="random_slug" class="form-check-input" {{ old('random_slug', $berita->slug ? true : false) ? 'checked' : '' }}>
            </div>

            <!-- Manual Slug Input -->
            <div class="form-group" id="slug_field">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $berita->slug) }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>

    <!-- CKEditor Script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        // Toggle Slug input visibility based on checkbox
        const randomSlugCheckbox = document.getElementById('random_slug');
        const slugField = document.getElementById('slug_field');

        randomSlugCheckbox.addEventListener('change', function() {
            if (this.checked) {
                slugField.style.display = 'none'; // Hide slug input field
            } else {
                slugField.style.display = 'block'; // Show slug input field
            }
        });

        // Initially hide or show the slug field based on checkbox status
        if (randomSlugCheckbox.checked) {
            slugField.style.display = 'none';
        } else {
            slugField.style.display = 'block';
        }
    </script>
@endsection
