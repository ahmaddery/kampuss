@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Homepage Banners</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBannerModal">
            <i class="fas fa-plus"></i> Create New Banner
        </button>
    </div>

    <!-- Banner Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="bannersTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td>{{ Str::limit($banner->title, 30) }}</td>
                                <td>{{ Str::limit($banner->description, 40) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" 
                                                class="btn btn-sm btn-info" 
                                                onclick="viewBanner({{ $banner->id }})"
                                                title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-warning" 
                                                onclick="editBanner({{ $banner->id }})"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="deleteBanner({{ $banner->id }}, '{{ $banner->title }}')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-image fa-3x mb-3"></i>
                                        <p>No banners found. Create your first banner to get started!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Banner Modal -->
<div class="modal fade" id="createBannerModal" tabindex="-1" aria-labelledby="createBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createBannerModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Create New Banner
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createBannerForm" action="{{ route('admin.homepage_banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="create_title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="create_title" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="create_description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="create_description" rows="4" required></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="create_image" class="form-label">Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="image" id="create_image" accept="image/*" required>
                                <div class="form-text">Max file size: 2MB. Allowed formats: JPG, JPEG, PNG, GIF, SVG</div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Image Preview</label>
                                <div id="createImagePreview" class="border rounded p-3 text-center" style="min-height: 200px; display: flex; align-items: center; justify-content: center;">
                                    <div class="text-muted">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p>No image selected</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Create Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Banner Modal -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editBannerModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Banner
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="edit_title" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="edit_description" rows="4" required></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="edit_image" accept="image/*">
                                <div class="form-text">Leave blank to keep current image. Max file size: 2MB.</div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Image Preview</label>
                                <div id="editImagePreview" class="border rounded p-3 text-center" style="min-height: 200px;">
                                    <!-- Current image will be loaded here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>Update Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Banner Modal -->
<div class="modal fade" id="viewBannerModal" tabindex="-1" aria-labelledby="viewBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewBannerModalLabel">
                    <i class="fas fa-eye me-2"></i>Banner Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><strong>Title:</strong></h6>
                        <p id="view_title" class="mb-3"></p>
                        
                        <h6><strong>Description:</strong></h6>
                        <p id="view_description" class="mb-3"></p>
                        
                        <h6><strong>Created:</strong></h6>
                        <p id="view_created" class="mb-3"></p>
                        
                        <h6><strong>Last Updated:</strong></h6>
                        <p id="view_updated" class="mb-3"></p>
                    </div>
                    <div class="col-md-6">
                        <h6><strong>Image:</strong></h6>
                        <div id="viewImageContainer" class="text-center">
                            <!-- Image will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toast configuration
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 8000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Show session messages
    @if(session('toast_success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('toast_success') }}'
        });
    @endif

    @if(session('toast_error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('toast_error') }}'
        });
    @endif

    @if($errors->any())
        let errorMessages = [];
        @foreach($errors->all() as $error)
            errorMessages.push('{{ $error }}');
        @endforeach
        
        Toast.fire({
            icon: 'error',
            title: 'Validation Error',
            html: errorMessages.join('<br>')
        });
    @endif

    // Image preview for create modal
    document.getElementById('create_image').addEventListener('change', function(e) {
        handleImagePreview(e, 'createImagePreview', 'create');
    });

    // Image preview for edit modal
    document.getElementById('edit_image').addEventListener('change', function(e) {
        handleImagePreview(e, 'editImagePreview', 'edit');
    });

    // Handle image preview
    function handleImagePreview(event, previewId, formType) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById(previewId);
        
        if (file) {
            // Validate file size (2MB)
            if (file.size > 2048 * 1024) {
                Toast.fire({
                    icon: 'error',
                    title: 'File size too large! Maximum 2MB allowed.'
                });
                event.target.value = '';
                resetImagePreview(previewId, formType);
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
            if (!allowedTypes.includes(file.type)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid file type! Only JPEG, PNG, JPG, GIF, SVG allowed.'
                });
                event.target.value = '';
                resetImagePreview(previewId, formType);
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Preview" 
                         class="img-fluid rounded" 
                         style="max-height: 200px; object-fit: contain;">
                    <p class="mt-2 text-success">
                        <i class="fas fa-check-circle"></i> Image selected: ${file.name}
                    </p>
                `;
            };
            reader.readAsDataURL(file);

            Toast.fire({
                icon: 'success',
                title: 'Image selected successfully!'
            });
        } else {
            resetImagePreview(previewId, formType);
        }
    }

    function resetImagePreview(previewId, formType) {
        const previewContainer = document.getElementById(previewId);
        if (formType === 'create') {
            previewContainer.innerHTML = `
                <div class="text-muted">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p>No image selected</p>
                </div>
            `;
        }
    }

    // Create banner form submission
    document.getElementById('createBannerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Create Banner?',
            text: "Are you sure you want to create this banner?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, create it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Creating Banner...',
                    text: 'Please wait while we save your banner.',
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

    // Edit banner form submission
    document.getElementById('editBannerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Update Banner?',
            text: "Are you sure you want to update this banner?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Updating Banner...',
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

    // Reset form when create modal is hidden
    document.getElementById('createBannerModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('createBannerForm').reset();
        resetImagePreview('createImagePreview', 'create');
        clearValidationErrors('createBannerForm');
    });

    // Reset form when edit modal is hidden
    document.getElementById('editBannerModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('editBannerForm').reset();
        clearValidationErrors('editBannerForm');
    });

    function clearValidationErrors(formId) {
        const form = document.getElementById(formId);
        const invalidInputs = form.querySelectorAll('.is-invalid');
        const invalidFeedbacks = form.querySelectorAll('.invalid-feedback');
        
        invalidInputs.forEach(input => input.classList.remove('is-invalid'));
        invalidFeedbacks.forEach(feedback => feedback.textContent = '');
    }
});

// View banner function
function viewBanner(id) {
    const banners = @json($banners);
    const banner = banners.find(b => b.id === id);
    
    if (banner) {
        document.getElementById('view_title').textContent = banner.title;
        document.getElementById('view_description').textContent = banner.description;
        document.getElementById('view_created').textContent = new Date(banner.created_at).toLocaleDateString();
        document.getElementById('view_updated').textContent = new Date(banner.updated_at).toLocaleDateString();
        
        document.getElementById('viewImageContainer').innerHTML = `
            <img src="${banner.image_url || '{{ Storage::url('') }}' + banner.image_path}" 
                 alt="${banner.title}" 
                 class="img-fluid rounded shadow" 
                 style="max-height: 300px; object-fit: contain;">
        `;
        
        new bootstrap.Modal(document.getElementById('viewBannerModal')).show();
    }
}

// Edit banner function
function editBanner(id) {
    const banners = @json($banners);
    const banner = banners.find(b => b.id === id);
    
    if (banner) {
        // Set form action
        document.getElementById('editBannerForm').action = `{{ route('admin.homepage_banners.update', '') }}/${id}`;
        
        // Populate form fields
        document.getElementById('edit_title').value = banner.title;
        document.getElementById('edit_description').value = banner.description;
        
        // Show current image
        document.getElementById('editImagePreview').innerHTML = `
            <img src="${banner.image_url || '{{ Storage::url('') }}' + banner.image_path}" 
                 alt="${banner.title}" 
                 class="img-fluid rounded" 
                 style="max-height: 200px; object-fit: contain;">
            <p class="mt-2 text-info">
                <i class="fas fa-info-circle"></i> Current image
            </p>
        `;
        
        new bootstrap.Modal(document.getElementById('editBannerModal')).show();
    }
}

// Delete banner function
function deleteBanner(id, title) {
    Swal.fire({
        title: 'Delete Banner?',
        html: `Are you sure you want to delete "<strong>${title}</strong>"?<br><small class="text-muted">This action cannot be undone.</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Deleting Banner...',
                text: 'Please wait while we remove the banner.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Create and submit delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ route('admin.homepage_banners.destroy', '') }}/${id}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endpush

@endsection