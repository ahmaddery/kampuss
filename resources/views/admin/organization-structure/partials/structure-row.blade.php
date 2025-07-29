<tr class="structure-row">
    <td class="structure-level-{{ $level }}">
        <div class="d-flex align-items-center">
            @if($level > 0)
                <span class="text-muted me-2">
                    @for($i = 0; $i < $level; $i++)
                        <i class="fas fa-angle-right"></i>
                    @endfor
                </span>
            @endif
            <div>
                <div class="unit-name">{{ $structure->unit_name }}</div>
                @if($structure->parent)
                    <small class="text-muted">{{ $structure->parent->unit_name }}</small>
                @endif
            </div>
        </div>
    </td>
    <td>
        @if($structure->position_title)
            <span class="badge bg-primary position-badge">{{ $structure->position_title }}</span>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
    <td>
        @if($structure->person_name)
            <span class="fw-medium">{{ $structure->person_name }}</span>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
    <td>
        @if($structure->image_path)
            <img src="{{ asset('storage/' . $structure->image_path) }}" alt="Logo" class="unit-image">
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
    <td class="text-center">
        <span class="badge bg-secondary">{{ $structure->order_position }}</span>
    </td>
    <td class="text-center">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.organization-structure.show', $structure->id) }}" 
               class="btn btn-sm btn-outline-info" title="Lihat Detail">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('admin.organization-structure.edit', $structure->id) }}" 
               class="btn btn-sm btn-outline-warning" title="Edit">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('admin.organization-structure.destroy', $structure->id) }}" 
                  method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" 
                        data-unit-name="{{ $structure->unit_name }}" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>

{{-- Render children --}}
@if($structure->children->count() > 0)
    @foreach($structure->children as $child)
        @include('admin.organization-structure.partials.structure-row', ['structure' => $child, 'level' => $level + 1])
    @endforeach
@endif
