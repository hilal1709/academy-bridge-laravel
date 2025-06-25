@extends('layouts.app')

@section('title', 'Buat Kelas Baru')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Buat Kelas Baru</h1>
            <p class="text-gray-600 mt-2">Buat kelas untuk mata kuliah yang Anda ampu</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('classrooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Dasar</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kelas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: Pemrograman Web A"
                               required>
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               value="{{ old('subject') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: Pemrograman Web"
                               required>
                    </div>

                    <div>
                        <label for="program" class="block text-sm font-medium text-gray-700 mb-2">
                            Program Studi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="program" 
                               name="program" 
                               value="{{ old('program') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: Sistem Informasi"
                               required>
                    </div>

                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                            Semester <span class="text-red-500">*</span>
                        </label>
                        <select id="semester" 
                                name="semester" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="">Pilih Semester</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="academic_year" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun Akademik <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="academic_year" 
                               name="academic_year" 
                               value="{{ old('academic_year', '2024/2025') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: 2024/2025"
                               required>
                    </div>

                    <div>
                        <label for="max_students" class="block text-sm font-medium text-gray-700 mb-2">
                            Maksimal Mahasiswa <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="max_students" 
                               name="max_students" 
                               value="{{ old('max_students', 40) }}"
                               min="1" 
                               max="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Kelas
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Deskripsi singkat tentang kelas ini...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Kelas</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="room" class="block text-sm font-medium text-gray-700 mb-2">
                            Ruang Kelas
                        </label>
                        <input type="text" 
                               id="room" 
                               name="room" 
                               value="{{ old('room') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: Lab Komputer 1">
                    </div>

                    <div>
                        <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Cover
                        </label>
                        <input type="file" 
                               id="cover_image" 
                               name="cover_image" 
                               accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jadwal Kelas
                    </label>
                    <div id="schedule-container">
                        <div class="schedule-item grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <select name="schedule[0][day]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih Hari</option>
                                    <option value="monday">Senin</option>
                                    <option value="tuesday">Selasa</option>
                                    <option value="wednesday">Rabu</option>
                                    <option value="thursday">Kamis</option>
                                    <option value="friday">Jumat</option>
                                    <option value="saturday">Sabtu</option>
                                    <option value="sunday">Minggu</option>
                                </select>
                            </div>
                            <div>
                                <input type="time" 
                                       name="schedule[0][start_time]" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Jam Mulai">
                            </div>
                            <div class="flex">
                                <input type="time" 
                                       name="schedule[0][end_time]" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Jam Selesai">
                                <button type="button" 
                                        onclick="removeSchedule(this)"
                                        class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-r-lg transition duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" 
                            onclick="addSchedule()"
                            class="text-blue-600 hover:text-blue-700 font-medium">
                        <i class="fas fa-plus mr-1"></i>Tambah Jadwal
                    </button>
                </div>

                <div class="mt-6">
                    <label for="syllabus" class="block text-sm font-medium text-gray-700 mb-2">
                        Silabus
                    </label>
                    <textarea id="syllabus" 
                              name="syllabus" 
                              rows="6"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Masukkan silabus mata kuliah...">{{ old('syllabus') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('classrooms.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                    <i class="fas fa-save mr-2"></i>Buat Kelas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let scheduleIndex = 1;

function addSchedule() {
    const container = document.getElementById('schedule-container');
    const scheduleItem = document.createElement('div');
    scheduleItem.className = 'schedule-item grid grid-cols-1 md:grid-cols-3 gap-4 mb-4';
    scheduleItem.innerHTML = `
        <div>
            <select name="schedule[${scheduleIndex}][day]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Pilih Hari</option>
                <option value="monday">Senin</option>
                <option value="tuesday">Selasa</option>
                <option value="wednesday">Rabu</option>
                <option value="thursday">Kamis</option>
                <option value="friday">Jumat</option>
                <option value="saturday">Sabtu</option>
                <option value="sunday">Minggu</option>
            </select>
        </div>
        <div>
            <input type="time" 
                   name="schedule[${scheduleIndex}][start_time]" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Jam Mulai">
        </div>
        <div class="flex">
            <input type="time" 
                   name="schedule[${scheduleIndex}][end_time]" 
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Jam Selesai">
            <button type="button" 
                    onclick="removeSchedule(this)"
                    class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-r-lg transition duration-200">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(scheduleItem);
    scheduleIndex++;
}

function removeSchedule(button) {
    const scheduleItems = document.querySelectorAll('.schedule-item');
    if (scheduleItems.length > 1) {
        button.closest('.schedule-item').remove();
    }
}
</script>
@endsection