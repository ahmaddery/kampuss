@if ($paginator->hasPages())
    <nav aria-label="pagination">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            {{-- Previous Page Link --}}
            <div class="pagination-prev">
                @if ($paginator->onFirstPage())
                    <span class="btn btn-sm btn-outline-secondary disabled">
                        <i class="fas fa-chevron-left me-1"></i>
                        Sebelumnya
                    </span>
                @else
                    <a class="btn btn-sm btn-outline-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left me-1"></i>
                        Sebelumnya
                    </a>
                @endif
            </div>

            {{-- Current Page Info --}}
            <div class="pagination-info">
                <span class="badge bg-primary fs-6 px-3 py-2">
                    {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
                </span>
            </div>

            {{-- Next Page Link --}}
            <div class="pagination-next">
                @if ($paginator->hasMorePages())
                    <a class="btn btn-sm btn-outline-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Selanjutnya
                        <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                @else
                    <span class="btn btn-sm btn-outline-secondary disabled">
                        Selanjutnya
                        <i class="fas fa-chevron-right ms-1"></i>
                    </span>
                @endif
            </div>
        </div>
    </nav>

    {{-- Quick Jump (for many pages) --}}
    @if($paginator->lastPage() > 10)
    <div class="pagination-jump mt-2 text-center">
        <div class="d-inline-flex align-items-center">
            <span class="text-muted small me-2">Lompat ke halaman:</span>
            <input type="number" 
                   class="form-control form-control-sm" 
                   id="pageJump" 
                   min="1" 
                   max="{{ $paginator->lastPage() }}" 
                   value="{{ $paginator->currentPage() }}" 
                   style="width: 80px;"
                   onchange="jumpToPage(this.value)">
        </div>
    </div>

    <script>
    function jumpToPage(page) {
        if (page >= 1 && page <= {{ $paginator->lastPage() }}) {
            const url = new URL(window.location);
            url.searchParams.set('page', page);
            window.location.href = url.toString();
        }
    }
    </script>
    @endif
@endif
