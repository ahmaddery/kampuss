@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-10">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Struktur Organisasi</h1>
                <p class="text-lg md:text-xl opacity-90">Mengenal struktur kepemimpinan dan organisasi universitas</p>
            </div>
            <div class="flex justify-center md:justify-end items-center">
                <i class="fas fa-sitemap text-white/70 text-7xl md:text-8xl"></i>
            </div>
        </div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-800/30 to-purple-900/20 pointer-events-none"></div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Navigation Tabs -->
    <div class="mb-6 overflow-x-auto">
        <div class="flex gap-2 md:gap-4 bg-white rounded-xl shadow p-2 md:p-3 w-max md:w-full min-w-[320px]">
            <button class="tab-link px-4 py-2 rounded-lg font-semibold flex items-center gap-2 focus:outline-none transition-all text-indigo-700 bg-indigo-100" id="hierarchy-tab" data-tab="hierarchy">
                <i class="fas fa-sitemap"></i> Hierarki
            </button>
            <button class="tab-link px-4 py-2 rounded-lg font-semibold flex items-center gap-2 focus:outline-none transition-all text-gray-700 hover:bg-indigo-50" id="tree-tab" data-tab="tree">
                <i class="fas fa-project-diagram"></i> Bagan Organisasi
            </button>
            <button class="tab-link px-4 py-2 rounded-lg font-semibold flex items-center gap-2 focus:outline-none transition-all text-gray-700 hover:bg-indigo-50" id="leadership-tab" data-tab="leadership">
                <i class="fas fa-users"></i> Kepemimpinan
            </button>
        </div>
    </div>

    <div>
        <!-- Hierarchy View -->
        <div class="tab-pane" id="hierarchy-pane">
            @if($structures->count() > 0)
                <div class="grid grid-cols-1 gap-6">
                    @foreach($structures as $structure)
                        <div>
                            @include('partials.organization-card', ['structure' => $structure])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center py-10">
                    <i class="fas fa-sitemap text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-400">Struktur Organisasi Belum Tersedia</h3>
                    <p class="text-gray-400">Informasi struktur organisasi sedang dalam proses pembaruan.</p>
                </div>
            @endif
        </div>

        <!-- Tree View -->
        <div class="tab-pane hidden" id="tree-pane">
            <div class="bg-white rounded-xl shadow p-6">
                <div id="organizationTree" class="flex flex-col items-center min-h-[300px]">
                    <div class="animate-spin text-indigo-500 text-3xl"><i class="fas fa-spinner"></i></div>
                    <p class="mt-3 text-gray-400">Memuat bagan organisasi...</p>
                </div>
            </div>
        </div>

        <!-- Leadership View -->
        <div class="tab-pane hidden" id="leadership-pane">
            <div class="leadership-grid">
                @foreach($structures as $structure)
                    @if($structure->position_title && $structure->person_name)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition-all p-6 flex flex-col items-center">
                            @if($structure->image_path)
                                <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->unit_name }}" class="w-24 h-24 rounded-full object-cover border-4 border-indigo-200 mb-3">
                            @else
                                <div class="w-24 h-24 rounded-full bg-indigo-200 flex items-center justify-center mb-3">
                                    <i class="fas fa-user text-3xl text-white"></i>
                                </div>
                            @endif
                            <h5 class="font-bold text-lg text-center">{{ $structure->person_name }}</h5>
                            <p class="text-indigo-700 font-semibold mb-1 text-center">{{ $structure->position_title }}</p>
                            <p class="text-gray-500 text-sm text-center">{{ $structure->unit_name }}</p>
                        </div>
                    @endif
                    @foreach($structure->children as $child)
                        @if($child->position_title && $child->person_name)
                            <div class="bg-white rounded-xl shadow hover:shadow-lg transition-all p-6 flex flex-col items-center">
                                @if($child->image_path)
                                    <img src="{{ asset('storage/' . $child->image_path) }}" alt="{{ $child->unit_name }}" class="w-24 h-24 rounded-full object-cover border-4 border-indigo-200 mb-3">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-indigo-200 flex items-center justify-center mb-3">
                                        <i class="fas fa-user text-3xl text-white"></i>
                                    </div>
                                @endif
                                <h5 class="font-bold text-lg text-center">{{ $child->person_name }}</h5>
                                <p class="text-indigo-700 font-semibold mb-1 text-center">{{ $child->position_title }}</p>
                                <p class="text-gray-500 text-sm text-center">{{ $child->unit_name }}</p>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.tab-link.active,
.tab-link[aria-selected="true"] {
    @apply bg-indigo-100 text-indigo-700;
}
.tab-pane { display: none; }
.tab-pane.active { display: block; }

.organization-tree {
    max-width: 100%;
    overflow-x: auto;
    padding: 20px 0;
}

.tree-node {
    position: relative;
    transition: all 0.3s ease;
}

/* Tree connecting lines */
.tree-node:not(:first-child):before {
    content: '';
    position: absolute;
    left: -15px;
    top: -20px;
    width: 15px;
    height: 30px;
    border-left: 2px solid #e5e7eb;
    border-bottom: 2px solid #e5e7eb;
    border-bottom-left-radius: 8px;
}

.tree-node:not(:last-child):after {
    content: '';
    position: absolute;
    left: -15px;
    top: 50%;
    bottom: -20px;
    width: 2px;
    background: #e5e7eb;
}

/* Hide connectors for root level */
.tree-node[style*="margin-left: 0px"]:before,
.tree-node[style*="margin-left: 0px"]:after {
    display: none;
}

/* Enhance tree node appearance */
.tree-node:hover .border-indigo-200 {
    border-color: #6366f1;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Leadership cards grid improvements */
.leadership-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .tree-node {
        margin-left: 0 !important;
    }
    
    .tree-node:before,
    .tree-node:after {
        display: none;
    }
    
    .organization-tree {
        padding: 10px 0;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing tabs...');
    
    const tabs = document.querySelectorAll('.tab-link');
    const hierarchyPane = document.getElementById('hierarchy-pane');
    const treePane = document.getElementById('tree-pane');
    const leadershipPane = document.getElementById('leadership-pane');
    
    console.log('Found tabs:', tabs.length);
    console.log('Found panes:', hierarchyPane ? 'hierarchy-pane' : 'missing', treePane ? 'tree-pane' : 'missing', leadershipPane ? 'leadership-pane' : 'missing');
    
    function showTab(targetTab) {
        console.log('Switching to tab:', targetTab.id);
        
        // Remove active class from all tabs
        tabs.forEach(t => {
            t.classList.remove('bg-indigo-100', 'text-indigo-700');
            t.classList.add('text-gray-700', 'hover:bg-indigo-50');
        });
        
        // Add active class to current tab
        targetTab.classList.add('bg-indigo-100', 'text-indigo-700');
        targetTab.classList.remove('text-gray-700', 'hover:bg-indigo-50');
        
        // Hide all panes
        if (hierarchyPane) {
            hierarchyPane.classList.add('hidden');
            hierarchyPane.classList.remove('active');
        }
        if (treePane) {
            treePane.classList.add('hidden');
            treePane.classList.remove('active');
        }
        if (leadershipPane) {
            leadershipPane.classList.add('hidden');
            leadershipPane.classList.remove('active');
        }
        
        // Show target pane based on tab data-tab attribute
        const targetPaneKey = targetTab.getAttribute('data-tab');
        console.log('Target pane key:', targetPaneKey);
        
        if (targetPaneKey === 'hierarchy' && hierarchyPane) {
            hierarchyPane.classList.remove('hidden');
            hierarchyPane.classList.add('active');
        } else if (targetPaneKey === 'tree' && treePane) {
            treePane.classList.remove('hidden');
            treePane.classList.add('active');
            loadOrganizationTree();
        } else if (targetPaneKey === 'leadership' && leadershipPane) {
            leadershipPane.classList.remove('hidden');
            leadershipPane.classList.add('active');
        }
    }
    
    // Add click event listeners to tabs
    tabs.forEach((tab, index) => {
        console.log('Adding listener to tab:', tab.id, tab.getAttribute('data-tab'));
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Tab clicked:', this.id);
            showTab(this);
        });
    });
    
    // Function to load organization tree
    function loadOrganizationTree() {
        console.log('Loading organization tree...');
        const treeContainer = document.getElementById('organizationTree');
        if (!treeContainer) {
            console.error('organizationTree container not found');
            return;
        }
        
        // Show loading state
        treeContainer.innerHTML = `
            <div class="flex flex-col items-center justify-center py-8">
                <div class="animate-spin text-indigo-500 text-3xl mb-3">
                    <i class="fas fa-spinner"></i>
                </div>
                <p class="text-gray-400">Memuat bagan organisasi...</p>
            </div>
        `;
        
        // Fetch tree data
        fetch('/struktur-organisasi/tree/data')
            .then(response => {
                console.log('Fetch response:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Tree data received:', data);
                renderOrganizationTree(data, treeContainer);
            })
            .catch(error => {
                console.error('Error loading organization tree:', error);
                treeContainer.innerHTML = `
                    <div class="flex flex-col items-center justify-center py-8">
                        <i class="fas fa-exclamation-triangle text-red-500 text-3xl mb-3"></i>
                        <p class="text-red-500">Gagal memuat bagan organisasi</p>
                        <p class="text-sm text-gray-500">${error.message}</p>
                    </div>
                `;
            });
    }
    
    // Function to render organization tree
    function renderOrganizationTree(data, container) {
        console.log('Rendering tree with data:', data);
        if (!data || data.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-8">
                    <i class="fas fa-sitemap text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-400">Bagan Organisasi Belum Tersedia</h3>
                    <p class="text-gray-400">Data struktur organisasi sedang dalam proses pembaruan.</p>
                </div>
            `;
            return;
        }
        
        // Simple tree rendering
        let html = '<div class="organization-tree">';
        data.forEach(node => {
            html += renderTreeNode(node, 0);
        });
        html += '</div>';
        
        container.innerHTML = html;
    }
    
    // Function to render a single tree node
    function renderTreeNode(node, level) {
        const indent = level * 30;
        let html = `
            <div class="tree-node mb-4" style="margin-left: ${indent}px;">
                <div class="bg-white border-2 border-indigo-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-all hover:border-indigo-300">
                    <div class="flex items-center gap-4">
                        ${node.image_path ? 
                            `<img src="/storage/${node.image_path}" alt="${node.text}" class="w-16 h-16 rounded-full object-cover border-3 border-indigo-300 shadow-sm">` :
                            `<div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center shadow-sm">
                                <i class="fas fa-building text-white text-xl"></i>
                            </div>`
                        }
                        <div class="flex-1">
                            <h4 class="font-bold text-lg text-indigo-700 mb-1">${node.text}</h4>
                            ${node.position_title && node.person_name ? 
                                `<div class="text-sm mb-2">
                                    <div class="inline-flex items-center gap-2 mb-1">
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">${node.position_title}</span>
                                    </div>
                                    <div class="text-gray-700 font-medium">${node.person_name}</div>
                                </div>` : ''
                            }
                            ${level > 0 ? `<div class="text-xs text-gray-400 flex items-center gap-1">
                                <i class="fas fa-level-up-alt"></i> Level ${level + 1}
                            </div>` : ''}
                        </div>
                        ${node.children && node.children.length > 0 ? 
                            `<div class="text-right">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    ${node.children.length} unit
                                </span>
                            </div>` : ''
                        }
                    </div>
                </div>
        `;
        
        if (node.children && node.children.length > 0) {
            html += '<div class="mt-3">';
            node.children.forEach(child => {
                html += renderTreeNode(child, level + 1);
            });
            html += '</div>';
        }
        
        html += '</div>';
        return html;
    }
    
    // Default: show hierarchy tab
    const hierarchyTab = document.getElementById('hierarchy-tab');
    if (hierarchyTab) {
        console.log('Setting default tab to hierarchy');
        showTab(hierarchyTab);
    }
});
</script>
@endpush
@endsection
