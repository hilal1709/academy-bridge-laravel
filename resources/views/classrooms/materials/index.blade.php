@extends('layouts.app')

@section('title', 'Materi Kelas - ' . $classroom->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Kelas -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-16 w-16 rounded-lg overflow-hidden bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                    @if($classroom->cover_image)
                        <img src="{{ Storage::url($classroom->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                    @endif
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $classroom->name }}</h1>
                    <p class="text-gray-600">{{ $classroom->subject }} - {{ $classroom->program }}</p>
                    <p class="text-sm text-gray-500">Kode: {{ $classroom->code }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('classrooms.show', $classroom) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Kelas
                </a>
                @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                    <a href="{{ route('classrooms.materials.create', $classroom) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-plus mr-2"></i>Tambah Materi
                    </a>
                @endif
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
                <div>
                    <label for="week_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter Minggu:</label>
                    <select id="week_filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Minggu</option>
                        @for($i = 1; $i <= 16; $i++)
                            <option value="{{ $i }}">Minggu {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="type_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter Tipe:</label>
                    <select id="type_filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Tipe</option>
                        <option value="document">Dokumen</option>
                        <option value="video">Video</option>
                        <option value="link">Link</option>
                        <option value="presentation">Presentasi</option>
                    </select>
                </div>
            </div>
            <div class="flex space-x-2">
                @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                    <span class="text-sm text-gray-600">
                        Total: {{ $materials->total() }} materi
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Daftar Materi -->
    @if($materials->count() > 0)
        <div class="space-y-4">
            @foreach($materials as $material)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4 flex-1">
                                <!-- Icon berdasarkan tipe file -->
                                <div class="flex-shrink-0">
                                    <i class="{{ $material->file_icon }} text-3xl"></i>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $material->title }}</h3>
                                        @if(!$material->is_published)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Draft
                                            </span>
                                        @endif
                                        @if($material->week)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Minggu {{ $material->week }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if($material->description)
                                        <p class="text-gray-600 text-sm mb-3">{{ $material->description }}</p>
                                    @endif
                                    
                                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                                        <span>
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $material->publish_date ? $material->publish_date->format('d M Y') : 'Belum dijadwalkan' }}
                                        </span>
                                        @if($material->file_size)
                                            <span>
                                                <i class="fas fa-file mr-1"></i>
                                                {{ $material->formatted_file_size }}
                                            </span>
                                        @endif
                                        <span>
                                            <i class="fas fa-download mr-1"></i>
                                            {{ $material->download_count }} download
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center space-x-2 ml-4">
                                @if($material->file_path || $material->external_link)
                                    @if($material->file_path)
                                        <a href="{{ route('classrooms.materials.download', [$classroom, $material]) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                                            <i class="fas fa-download mr-1"></i>Download
                                        </a>
                                    @else
                                        <a href="{{ $material->external_link }}" target="_blank"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                                            <i class="fas fa-external-link-alt mr-1"></i>Buka
                                        </a>
                                    @endif
                                @endif
                                
                                <a href="{{ route('classrooms.materials.show', [$classroom, $material]) }}" 
                                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                                
                                @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" 
                                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border">
                                            <div class="py-1">
                                                <a href="{{ route('classrooms.materials.edit', [$classroom, $material]) }}" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                </a>
                                                <form action="{{ route('classrooms.materials.toggle-publish', [$classroom, $material]) }}" method="POST" class="block">
                                                    @csrf
                                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                        @if($material->is_published)
                                                            <i class="fas fa-eye-slash mr-2"></i>Sembunyikan
                                                        @else
                                                            <i class="fas fa-eye mr-2"></i>Publikasikan
                                                        @endif
                                                    </button>
                                                </form>
                                                <form action="{{ route('classrooms.materials.destroy', [$classroom, $material]) }}" method="POST" 
                                                      onsubmit="return confirm('Yakin ingin menghapus materi ini?')" class="block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                        <i class="fas fa-trash mr-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $materials->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Materi</h3>
            <p class="text-gray-600 mb-6">
                @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                    Mulai dengan menambahkan materi pertama untuk kelas ini
                @else
                    Dosen belum menambahkan materi untuk kelas ini
                @endif
            </p>
            @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                <a href="{{ route('classrooms.materials.create', $classroom) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Tambah Materi Pertama
                </a>
            @endif
        </div>
    @endif
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
// Filter functionality
document.getElementById('week_filter').addEventListener('change', function() {
    filterMaterials();
});

document.getElementById('type_filter').addEventListener('change', function() {
    filterMaterials();
});

function filterMaterials() {
    const weekFilter = document.getElementById('week_filter').value;
    const typeFilter = document.getElementById('type_filter').value;
    
    // Implementasi filter akan ditambahkan dengan AJAX atau reload halaman
    const url = new URL(window.location);
    
    if (weekFilter) {
        url.searchParams.set('week', weekFilter);
    } else {
        url.searchParams.delete('week');
    }
    
    if (typeFilter) {
        url.searchParams.set('type', typeFilter);
    } else {
        url.searchParams.delete('type');
    }
    
    window.location.href = url.toString();
}
</script>
@endsection