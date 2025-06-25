@extends('layouts.app')

@section('title', 'Tambah Materi - ' . $classroom->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tambah Materi Kelas</h1>
                    <p class="text-gray-600 mt-1">{{ $classroom->name }} - {{ $classroom->subject }}</p>
                </div>
                <a href="{{ route('classrooms.materials.index', $classroom) }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                <ul class="mt-2">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('classrooms.materials.store', $classroom) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul Materi -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Materi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Pengenalan HTML dan CSS" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Jelaskan tentang materi ini...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Tipe Materi -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipe Materi <span class="text-red-500">*</span>
                        </label>
                        <select id="type" name="type" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="toggleMaterialType()" required>
                            <option value="">Pilih Tipe Materi</option>
                            <option value="document" {{ old('type') == 'document' ? 'selected' : '' }}>Dokumen (PDF, DOC, PPT)</option>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>Link/URL</option>
                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Teks/Konten</option>
                        </select>
                    </div>

                    <!-- Minggu -->
                    <div>
                        <label for="week" class="block text-sm font-medium text-gray-700 mb-2">
                            Minggu Perkuliahan
                        </label>
                        <select id="week" name="week" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Minggu</option>
                            @for($i = 1; $i <= 16; $i++)
                                <option value="{{ $i }}" {{ old('week') == $i ? 'selected' : '' }}>Minggu {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Tanggal Publikasi -->
                    <div>
                        <label for="publish_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Publikasi
                        </label>
                        <input type="date" id="publish_date" name="publish_date" value="{{ old('publish_date', date('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Kosongkan untuk publikasi langsung</p>
                    </div>

                    <!-- Status Publikasi -->
                    <div>
                        <label for="is_published" class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select id="is_published" name="is_published" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1" {{ old('is_published', '1') == '1' ? 'selected' : '' }}>Publikasikan</option>
                            <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                        </select>
                    </div>
                </div>

                <!-- File Upload Section -->
                <div id="file-section" class="mt-6 hidden">
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload File <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition duration-200">
                        <input type="file" id="file" name="file" class="hidden" onchange="handleFileSelect(this)">
                        <div id="file-drop-area" onclick="document.getElementById('file').click()" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600">Klik untuk memilih file atau drag & drop</p>
                            <p class="text-sm text-gray-500 mt-1">Maksimal 50MB - PDF, DOC, DOCX, PPT, PPTX, MP4, AVI</p>
                        </div>
                        <div id="file-preview" class="hidden mt-4">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-file text-blue-500"></i>
                                <span id="file-name" class="text-sm text-gray-700"></span>
                                <button type="button" onclick="removeFile()" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Link Section -->
                <div id="link-section" class="mt-6 hidden">
                    <label for="external_link" class="block text-sm font-medium text-gray-700 mb-2">
                        URL/Link <span class="text-red-500">*</span>
                    </label>
                    <input type="url" id="external_link" name="external_link" value="{{ old('external_link') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="https://example.com">
                    <p class="text-sm text-gray-500 mt-1">Masukkan URL lengkap termasuk http:// atau https://</p>
                </div>

                <!-- Text Content Section -->
                <div id="content-section" class="mt-6 hidden">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Materi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="10"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Tulis konten materi di sini...">{{ old('content') }}</textarea>
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                    <a href="{{ route('classrooms.materials.index', $classroom) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-6 rounded-lg font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-save mr-2"></i>Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleMaterialType() {
    const type = document.getElementById('type').value;
    const fileSection = document.getElementById('file-section');
    const linkSection = document.getElementById('link-section');
    const contentSection = document.getElementById('content-section');
    
    // Hide all sections
    fileSection.classList.add('hidden');
    linkSection.classList.add('hidden');
    contentSection.classList.add('hidden');
    
    // Show relevant section
    if (type === 'document' || type === 'video') {
        fileSection.classList.remove('hidden');
    } else if (type === 'link') {
        linkSection.classList.remove('hidden');
    } else if (type === 'text') {
        contentSection.classList.remove('hidden');
    }
}

function handleFileSelect(input) {
    const file = input.files[0];
    if (file) {
        document.getElementById('file-drop-area').classList.add('hidden');
        document.getElementById('file-preview').classList.remove('hidden');
        document.getElementById('file-name').textContent = file.name;
    }
}

function removeFile() {
    document.getElementById('file').value = '';
    document.getElementById('file-drop-area').classList.remove('hidden');
    document.getElementById('file-preview').classList.add('hidden');
}

// Initialize form based on old input
document.addEventListener('DOMContentLoaded', function() {
    toggleMaterialType();
});
</script>
@endsection