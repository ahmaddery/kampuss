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

    @push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Show success toast
    @if(session('toast_success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('toast_success') }}'
        });
    @endif

    // Show error toast
    @if(session('toast_error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('toast_error') }}'
        });
    @endif

    // Show validation error toast
    @if($errors->any())
        Toast.fire({
            icon: 'error',
            title: 'Please check your input and try again'
        });
    @endif

    // Preview image before upload
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (2MB = 2048KB)
            if (file.size > 2048 * 1024) {
                Toast.fire({
                    icon: 'error',
                    title: 'File size too large! Maximum 2MB allowed.'
                });
                this.value = '';
                document.getElementById('imagePreview').style.display = 'none';
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid file type! Only JPEG, PNG, JPG, GIF allowed.'
                });
                this.value = '';
                document.getElementById('imagePreview').style.display = 'none';
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);

            Toast.fire({
                icon: 'info',
                title: 'Image selected successfully!'
            });
        } else {
            document.getElementById('imagePreview').style.display = 'none';
        }
    });

    // Confirm before saving changes
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Save Changes?',
            text: "Are you sure you want to update your profile?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Updating Profile...',
                    text: 'Please wait while we save your changes.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.submit();
            }
        });
    });

    // Auto-hide validation errors after 5 seconds
    setTimeout(function() {
        const invalidFeedbacks = document.querySelectorAll('.invalid-feedback');
        invalidFeedbacks.forEach(function(feedback) {
            feedback.style.display = 'none';
        });
        
        const invalidInputs = document.querySelectorAll('.is-invalid');
        invalidInputs.forEach(function(input) {
            input.classList.remove('is-invalid');
        });
    }, 5000);
});
</script>
@endpush

@endsection