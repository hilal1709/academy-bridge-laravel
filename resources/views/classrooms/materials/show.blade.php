@extends('layouts.app')

@section('title', $material->title . ' - ' . $classroom->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <i class="{{ $material->file_icon }} text-4xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $material->title }}</h1>
                        <p class="text-gray-600">{{ $classroom->name }} - {{ $classroom->subject }}</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                            @if($material->week)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                    Minggu {{ $material->week }}
                                </span>
                            @endif
                            @if(!$material->is_published)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">
                                    Draft
                                </span>
                            @endif
                            <span>
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $material->publish_date ? $material->publish_date->format('d M Y') : 'Tidak dijadwalkan' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('classrooms.materials.index', $classroom) }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                        <a href="{{ route('classrooms.materials.edit', [$classroom, $material]) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            <i class="fas fa-edit mr-2"></i>Edit
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

        <!-- Content -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            @if($material->description)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $material->description }}</p>
                </div>
            @endif

            <!-- File Content -->
            @if($material->type === 'document' || $material->type === 'video')
                @if($material->file_path)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">File</h3>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <i class="{{ $material->file_icon }} text-2xl"></i>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $material->file_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $material->formatted_file_size }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($material->type === 'video' && in_array($material->file_type, ['mp4', 'webm', 'ogg']))
                                        <button onclick="playVideo()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                                            <i class="fas fa-play mr-2"></i>Putar
                                        </button>
                                    @endif
                                    <a href="{{ route('classrooms.materials.download', [$classroom, $material]) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                                        <i class="fas fa-download mr-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Video Player -->
                        @if($material->type === 'video' && in_array($material->file_type, ['mp4', 'webm', 'ogg']))
                            <div id="video-player" class="hidden mt-4">
                                <video controls class="w-full rounded-lg">
                                    <source src="{{ Storage::url($material->file_path) }}" type="video/{{ $material->file_type }}">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                            </div>
                        @endif
                    </div>
                @endif
            @endif

            <!-- Link Content -->
            @if($material->type === 'link' && $material->external_link)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Link</h3>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-external-link-alt text-2xl text-blue-500"></i>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $material->external_link }}</p>
                                    <p class="text-sm text-gray-500">Link eksternal</p>
                                </div>
                            </div>
                            <a href="{{ $material->external_link }}" target="_blank"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                                <i class="fas fa-external-link-alt mr-2"></i>Buka Link
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Text Content -->
            @if($material->type === 'text' && $material->content)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Konten</h3>
                    <div class="prose max-w-none">
                        <div class="bg-gray-50 rounded-lg p-6">
                            {!! nl2br(e($material->content)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Statistics -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-download text-blue-500 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-600">Total Download</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $material->download_count }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-green-500 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-600">Dibuat</p>
                                <p class="text-lg font-semibold text-green-600">{{ $material->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-edit text-purple-500 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-600">Terakhir Diupdate</p>
                                <p class="text-lg font-semibold text-purple-600">{{ $material->updated_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions for Lecturer -->
        @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Dosen</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('classrooms.materials.edit', [$classroom, $material]) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit Materi
                    </a>
                    
                    <form action="{{ route('classrooms.materials.toggle-publish', [$classroom, $material]) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            @if($material->is_published)
                                <i class="fas fa-eye-slash mr-2"></i>Sembunyikan
                            @else
                                <i class="fas fa-eye mr-2"></i>Publikasikan
                            @endif
                        </button>
                    </form>
                    
                    <form action="{{ route('classrooms.materials.destroy', [$classroom, $material]) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus materi ini? Tindakan ini tidak dapat dibatalkan.')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            <i class="fas fa-trash mr-2"></i>Hapus Materi
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function playVideo() {
    const videoPlayer = document.getElementById('video-player');
    videoPlayer.classList.remove('hidden');
    videoPlayer.scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection