@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create New Berita</h1>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="editor" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="image_path">Image</label>
                <input type="file" name="image_path" class="form-control">
            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input type="date" name="publish_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control">
            </div>

            <!-- Checkbox for Random Slug -->
            <div class="form-group">
                <label for="random_slug">Generate Random Slug?</label>
                <input type="checkbox" name="random_slug" id="random_slug" class="form-check-input">
            </div>

            <!-- Manual Slug Input -->
            <div class="form-group" id="slug_field">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control">
            </div>

            <!-- Tag Input -->
            <div class="form-group">
                <label for="tags">Tags (comma separated)</label>
                <input type="text" name="tags" class="form-control" placeholder="e.g., technology, news, updates">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save</button>
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
