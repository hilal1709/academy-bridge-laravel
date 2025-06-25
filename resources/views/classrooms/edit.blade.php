@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg">
        <div class="p-8">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900">Edit Kelas</h1>
                <p class="text-gray-600 mt-2">Perbarui detail kelas Anda di bawah ini.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('classrooms.update', $classroom) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Kelas -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $classroom->name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Pemrograman Web Lanjutan" required>
                    </div>

                    <!-- Mata Pelajaran -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject', $classroom->subject) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Pemrograman Web" required>
                    </div>

                    <!-- Program Studi -->
                    <div>
                        <label for="program" class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                        <input type="text" id="program" name="program" value="{{ old('program', $classroom->program) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Sistem Informasi" required>
                    </div>

                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                        <input type="number" id="semester" name="semester" value="{{ old('semester', $classroom->semester) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               min="1" max="8" required>
                    </div>

                    <!-- Tahun Akademik -->
                    <div>
                        <label for="academic_year" class="block text-sm font-medium text-gray-700 mb-2">Tahun Akademik</label>
                        <input type="text" id="academic_year" name="academic_year" value="{{ old('academic_year', $classroom->academic_year) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: 2023/2024" required>
                    </div>

                    <!-- Maksimal Mahasiswa -->
                    <div>
                        <label for="max_students" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Mahasiswa</label>
                        <input type="number" id="max_students" name="max_students" value="{{ old('max_students', $classroom->max_students) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               min="1" max="100" required>
                    </div>

                    <!-- Status Kelas -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Kelas</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="active" {{ old('status', $classroom->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $classroom->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="archived" {{ old('status', $classroom->status) == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $classroom->description) }}</textarea>
                    </div>
                    
                    <!-- Ruangan -->
                    <div class="md:col-span-2">
                        <label for="room" class="block text-sm font-medium text-gray-700 mb-2">Ruangan (Opsional)</label>
                        <input type="text" id="room" name="room" value="{{ old('room', $classroom->room) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Lab Komputer 1">
                    </div>

                    <!-- Link RPS -->
                    <div class="md:col-span-2">
                        <label for="syllabus" class="block text-sm font-medium text-gray-700 mb-2">Link RPS (Opsional)</label>
                        <input type="url" id="syllabus" name="syllabus" value="{{ old('syllabus', $classroom->syllabus) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="https://contoh.com/rps.pdf">
                    </div>

                    <!-- Cover Image -->
                    <div class="md:col-span-2">
                        <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Ganti Gambar Sampul (Opsional)</label>
                        <input type="file" id="cover_image" name="cover_image"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @if($classroom->cover_image)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <img src="{{ Storage::url($classroom->cover_image) }}" alt="Cover Image" class="w-48 h-auto rounded-lg">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                    <a href="{{ route('classrooms.show', $classroom) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-6 rounded-lg font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-medium transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
