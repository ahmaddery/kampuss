@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Banner</h1>

        <form action="{{ route('admin.homepage_banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $banner->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" required>{{ old('description', $banner->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image (Leave blank to keep current image)</label>
                <input type="file" class="form-control" name="image" id="image">
                @if($banner->image_path)
                    <div class="mt-2">
                        <img src="{{ Storage::url($banner->image_path) }}" alt="Current image" width="100">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Banner</button>
        </form>
    </div>
@endsection