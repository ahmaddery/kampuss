<div class="card organization-card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-2 text-center">
                @if($structure->image_path)
                    <img src="{{ asset('storage/' . $structure->image_path) }}" 
                         alt="{{ $structure->unit_name }}" 
                         class="img-fluid rounded" style="max-height: 80px;">
                @else
                    <div class="bg-primary rounded d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-building fa-2x text-white"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title fw-bold text-primary mb-2">{{ $structure->unit_name }}</h4>
                        @if($structure->position_title && $structure->person_name)
                            <div class="mb-2">
                                <span class="badge bg-success me-2">{{ $structure->position_title }}</span>
                                <span class="fw-semibold">{{ $structure->person_name }}</span>
                            </div>
                        @endif
                        @if($structure->parent)
                            <p class="text-muted small mb-0">
                                <i class="fas fa-arrow-up me-1"></i> {{ $structure->parent->unit_name }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-4 text-end">
                        @if($structure->children->count() > 0)
                            <span class="badge bg-info">{{ $structure->children->count() }} Unit</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Children Units --}}
        @if($structure->children->count() > 0)
            <hr class="my-4">
            <div class="row">
                @foreach($structure->children as $child)
                    <div class="col-lg-6 mb-3">
                        <div class="card border bg-light">
                            <div class="card-body p-3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        @if($child->image_path)
                                            <img src="{{ asset('storage/' . $child->image_path) }}" 
                                                 alt="{{ $child->unit_name }}" 
                                                 class="img-fluid rounded" style="max-height: 50px;">
                                        @else
                                            <div class="bg-secondary rounded d-inline-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-building text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <h6 class="fw-bold mb-1">{{ $child->unit_name }}</h6>
                                        @if($child->position_title && $child->person_name)
                                            <div class="small">
                                                <span class="badge bg-primary badge-sm">{{ $child->position_title }}</span>
                                            </div>
                                            <div class="small text-muted">{{ $child->person_name }}</div>
                                        @endif
                                        @if($child->children->count() > 0)
                                            <small class="text-info">
                                                <i class="fas fa-sitemap me-1"></i>{{ $child->children->count() }} sub-unit
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
