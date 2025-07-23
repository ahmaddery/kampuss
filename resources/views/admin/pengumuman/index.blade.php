@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manage Pengumuman</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengumumanModal" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Create New Pengumuman
            </button>
        </div>

        <!-- Pengumuman Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="pengumumanTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publish Date</th>
                                <th>Tags</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengumuman as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->author ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->publish_date)->format('d M Y') }}</td>
                                <td>
                                    @if($item->tags)
                                        @foreach(explode(',', $item->tags) as $tag)
                                            <span class="badge bg-secondary me-1">{{ trim($tag) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No tags</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="Image" width="50" height="50" class="rounded">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning me-1" 
                                            onclick="openEditModal({{ $item->id }})" 
                                            data-bs-toggle="modal" data-bs-target="#pengumumanModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    
                                    <!-- Hidden form for delete -->
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengumuman Modal -->
    <div class="modal fade" id="pengumumanModal" tabindex="-1" aria-labelledby="pengumumanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengumumanModalLabel">Create New Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="pengumumanForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="method" name="_method" value="">
                        <input type="hidden" id="pengumuman_id" name="pengumuman_id" value="">
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="editor" class="form-control" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="image_path" class="form-label">Image</label>
                                <input type="file" name="image_path" id="image_path" class="form-control" accept="image/*">
                                <small class="text-muted">Max size: 2MB (JPEG, PNG, JPG, GIF)</small>
                                
                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-2" style="display: none;">
                                    <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                                
                                <!-- Current Image (for edit mode) -->
                                <div id="currentImage" class="mt-2" style="display: none;">
                                    <label class="form-label">Current Image:</label><br>
                                    <img id="currentImg" src="" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="publish_date" class="form-label">Publish Date <span class="text-danger">*</span></label>
                                <input type="date" name="publish_date" id="publish_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" name="author" id="author" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" name="tags" id="tags" class="form-control" placeholder="e.g., technology, news, updates">
                                <small class="text-muted">Separate tags with commas</small>
                            </div>
                        </div>

                        <!-- Checkbox for Random Slug -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="random_slug" id="random_slug" class="form-check-input">
                                    <label for="random_slug" class="form-check-label">Generate Random Slug?</label>
                                </div>
                            </div>
                        </div>

                        <!-- Manual Slug Input -->
                        <div class="row" id="slug_field">
                            <div class="col-md-12 mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control">
                                <small class="text-muted">Leave empty to auto-generate from title</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" onclick="submitForm()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
let editor;
let isEditMode = false;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(ck => {
            editor = ck;
        })
        .catch(error => {
            console.error(error);
        });

    // Initialize SweetAlert Toast
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
    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif

    // Show error toast
    @if(session('error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
        });
    @endif

    // Show validation error toast
    @if($errors->any())
        let errorMessages = '';
        @foreach($errors->all() as $error)
            errorMessages += '{{ $error }}\n';
        @endforeach
        
        Toast.fire({
            icon: 'error',
            title: 'Validation Error',
            html: errorMessages.replace(/\n/g, '<br>')
        });
    @endif

    // Toggle Slug input visibility based on checkbox
    const randomSlugCheckbox = document.getElementById('random_slug');
    const slugField = document.getElementById('slug_field');

    randomSlugCheckbox.addEventListener('change', function() {
        if (this.checked) {
            slugField.style.display = 'none';
        } else {
            slugField.style.display = 'block';
        }
    });

    // Image preview functionality
    document.getElementById('image_path').addEventListener('change', function(e) {
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

    // Reset modal when closed
    document.getElementById('pengumumanModal').addEventListener('hidden.bs.modal', function () {
        resetForm();
    });
});

// Open Create Modal
function openCreateModal() {
    isEditMode = false;
    document.getElementById('pengumumanModalLabel').textContent = 'Create New Pengumuman';
    document.getElementById('saveBtn').textContent = 'Save';
    document.getElementById('method').value = '';
    document.getElementById('pengumuman_id').value = '';
    resetForm();
}

// Open Edit Modal
function openEditModal(id) {
    isEditMode = true;
    document.getElementById('pengumumanModalLabel').textContent = 'Edit Pengumuman';
    document.getElementById('saveBtn').textContent = 'Update';
    document.getElementById('method').value = 'PUT';
    document.getElementById('pengumuman_id').value = id;

    // Show loading
    Swal.fire({
        title: 'Loading...',
        text: 'Please wait while we fetch the data.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Fetch pengumuman data
    fetch(`/admin/pengumuman/${id}/edit`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        Swal.close();
        
        if (data.success) {
            const pengumuman = data.pengumuman;
            
            // Fill form with data
            document.getElementById('title').value = pengumuman.title || '';
            document.getElementById('author').value = pengumuman.author || '';
            document.getElementById('publish_date').value = pengumuman.publish_date || '';
            document.getElementById('tags').value = pengumuman.tags || '';
            document.getElementById('slug').value = pengumuman.slug || '';
            
            // Set CKEditor content
            if (editor) {
                editor.setData(pengumuman.description || '');
            }

            // Handle slug checkbox
            const randomSlugCheckbox = document.getElementById('random_slug');
            const slugField = document.getElementById('slug_field');
            
            if (pengumuman.slug) {
                randomSlugCheckbox.checked = false;
                slugField.style.display = 'block';
            } else {
                randomSlugCheckbox.checked = true;
                slugField.style.display = 'none';
            }

            // Show current image if exists
            const currentImageDiv = document.getElementById('currentImage');
            const currentImg = document.getElementById('currentImg');
            
            if (pengumuman.image_path) {
                currentImg.src = `/storage/${pengumuman.image_path}`;
                currentImageDiv.style.display = 'block';
            } else {
                currentImageDiv.style.display = 'none';
            }

            // Hide image preview
            document.getElementById('imagePreview').style.display = 'none';
        } else {
            throw new Error(data.message || 'Failed to fetch data');
        }
    })
    .catch(error => {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to load pengumuman data: ' + error.message
        });
    });
}

// Reset Form
function resetForm() {
    document.getElementById('pengumumanForm').reset();
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('currentImage').style.display = 'none';
    document.getElementById('slug_field').style.display = 'block';
    
    if (editor) {
        editor.setData('');
    }
}

// Submit Form
function submitForm() {
    const form = document.getElementById('pengumumanForm');
    const formData = new FormData(form);
    
    // Add CKEditor content
    if (editor) {
        formData.set('description', editor.getData());
    }

    // Show loading
    Swal.fire({
        title: isEditMode ? 'Updating...' : 'Saving...',
        text: 'Please wait while we process your request.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Determine URL and method
    let url = isEditMode ? `/admin/pengumuman/${document.getElementById('pengumuman_id').value}` : '/admin/pengumuman';
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        Swal.close();
        
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                // Close modal and reload page
                bootstrap.Modal.getInstance(document.getElementById('pengumumanModal')).hide();
                location.reload();
            });
        } else {
            // Handle validation errors
            let errorMessage = 'Please check your input and try again.';
            if (data.errors) {
                errorMessage = Object.values(data.errors).flat().join('\n');
            } else if (data.message) {
                errorMessage = data.message;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                html: errorMessage.replace(/\n/g, '<br>')
            });
        }
    })
    .catch(error => {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while processing your request: ' + error.message
        });
    });
}

// Confirm Delete
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we delete the item.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit delete form
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush