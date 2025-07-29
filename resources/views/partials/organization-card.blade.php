<div class="bg-white rounded-xl shadow p-6 mb-6">
    <div class="flex flex-col md:flex-row md:items-center gap-4">
        <div class="flex-shrink-0 flex justify-center md:justify-start">
            @if($structure->image_path)
                <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->unit_name }}" class="w-20 h-20 rounded-lg object-cover border-2 border-indigo-200">
            @else
                <div class="w-20 h-20 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-building text-indigo-400 text-3xl"></i>
                </div>
            @endif
        </div>
        <div class="flex-1">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <div>
                    <h4 class="text-xl font-bold text-indigo-700 mb-1">{{ $structure->unit_name }}</h4>
                    @if($structure->position_title && $structure->person_name)
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-semibold">{{ $structure->position_title }}</span>
                            <span class="font-medium text-gray-700 text-sm">{{ $structure->person_name }}</span>
                        </div>
                    @endif
                    @if($structure->parent)
                        <div class="text-xs text-gray-400 flex items-center gap-1"><i class="fas fa-arrow-up"></i> {{ $structure->parent->unit_name }}</div>
                    @endif
                </div>
                <div class="text-right">
                    @if($structure->children->count() > 0)
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $structure->children->count() }} Unit</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Children Units --}}
    @if($structure->children->count() > 0)
        <div class="mt-6 border-l-4 border-indigo-100 pl-4 space-y-4">
            @foreach($structure->children as $child)
                <div class="bg-gray-50 rounded-lg shadow-sm p-4 flex gap-4 items-center">
                    @if($child->image_path)
                        <img src="{{ asset('storage/' . $child->image_path) }}" alt="{{ $child->unit_name }}" class="w-12 h-12 rounded object-cover border border-indigo-100">
                    @else
                        <div class="w-12 h-12 rounded bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-building text-indigo-300 text-xl"></i>
                        </div>
                    @endif
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-1">
                            <div>
                                <div class="font-bold text-indigo-700">{{ $child->unit_name }}</div>
                                @if($child->position_title && $child->person_name)
                                    <div class="flex flex-wrap items-center gap-2 mt-1">
                                        <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded text-xs font-semibold">{{ $child->position_title }}</span>
                                        <span class="text-xs text-gray-600">{{ $child->person_name }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="text-right">
                                @if($child->children->count() > 0)
                                    <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded text-xs font-semibold flex items-center gap-1"><i class="fas fa-sitemap"></i> {{ $child->children->count() }} sub-unit</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
