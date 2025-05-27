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
    </script>
@endsection
