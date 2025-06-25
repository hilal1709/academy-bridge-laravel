@extends('layouts.app')

@section('title', $classroom->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div class="flex items-center space-x-4">
            <div class="h-20 w-20 rounded-lg overflow-hidden bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                @if($classroom->cover_image)
                    <img src="{{ Storage::url($classroom->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-chalkboard-teacher text-white text-4xl"></i>
                @endif
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $classroom->name }}</h1>
                <div class="flex flex-wrap items-center text-gray-600 text-sm mt-1 space-x-2">
                    <span><i class="fas fa-book mr-1"></i>{{ $classroom->subject }}</span>
                    <span>|</span>
                    <span><i class="fas fa-graduation-cap mr-1"></i>{{ $classroom->program }} - Semester {{ $classroom->semester }}</span>
                    <span>|</span>
                    <span><i class="fas fa-calendar mr-1"></i>{{ $classroom->academic_year }}</span>
                </div>
                <div class="mt-1 text-xs text-gray-500">
                    Kode Kelas: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $classroom->code }}</span>
                </div>
            </div>
        </div>
        <div class="mt-4 md:mt-0 flex flex-col md:items-end space-y-2">
            <span class="px-3 py-1 text-xs font-semibold rounded-full
                @if($classroom->status === 'active') bg-green-100 text-green-800
                @elseif($classroom->status === 'inactive') bg-yellow-100 text-yellow-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ ucfirst($classroom->status) }}
            </span>
            @if($classroom->lecturer)
                <span class="text-sm text-gray-700 mt-1"><i class="fas fa-user-tie mr-1"></i>Dosen: {{ $classroom->lecturer->name }}</span>
            @endif
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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sidebar Info -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-3 text-gray-900">Info Kelas</h2>
                <ul class="text-sm text-gray-700 space-y-2">
                    <li><i class="fas fa-users mr-2"></i>Mahasiswa: <b>{{ $classroom->enrolled_students_count }}/{{ $classroom->max_students }}</b></li>
                    <li><i class="fas fa-file-alt mr-2"></i>Materi: <b>{{ $classroom->materials->count() }}</b></li>
                    <li><i class="fas fa-tasks mr-2"></i>Tugas: <b>{{ $classroom->assignments->count() }}</b></li>
                    @if($classroom->room)
                        <li><i class="fas fa-door-open mr-2"></i>Ruang: <b>{{ $classroom->room }}</b></li>
                    @endif
                    @if($classroom->syllabus)
                        <li><i class="fas fa-list-alt mr-2"></i>RPS: <a href="{{ $classroom->syllabus }}" class="text-blue-600 underline" target="_blank">Lihat RPS</a></li>
                    @endif
                </ul>
                @if($classroom->description)
                    <div class="mt-4 text-gray-600 text-sm">
                        <h3 class="font-semibold mb-1">Deskripsi:</h3>
                        <p>{{ $classroom->description }}</p>
                    </div>
                @endif
            </div>
            @if($classroom->schedule)
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-3 text-gray-900">Jadwal</h2>
                    <ul class="text-sm text-gray-700 space-y-2">
                        @foreach($classroom->schedule as $sch)
                            <li><i class="fas fa-clock mr-2"></i>{{ ucfirst($sch['day']) }}, {{ $sch['start_time'] }} - {{ $sch['end_time'] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                <a href="{{ route('classrooms.students', $classroom) }}" class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg font-medium transition duration-200 mb-2">
                    <i class="fas fa-users mr-2"></i>Lihat Daftar Mahasiswa
                </a>
                <a href="{{ route('classrooms.edit', $classroom) }}" class="block bg-gray-200 hover:bg-gray-300 text-gray-700 text-center py-2 px-4 rounded-lg font-medium transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit Kelas
                </a>
            @endif
        </div>

        <!-- Main Content -->
        <div class="md:col-span-2">
            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <a href="#" class="tab-link text-blue-600 border-b-2 border-blue-600 py-4 px-1 text-sm font-medium" onclick="showTab(event, 'stream')">Stream</a>
                    <a href="#" class="tab-link text-gray-500 hover:text-blue-600 hover:border-blue-600 border-b-2 border-transparent py-4 px-1 text-sm font-medium" onclick="showTab(event, 'materials')">Materi</a>
                    <a href="#" class="tab-link text-gray-500 hover:text-blue-600 hover:border-blue-600 border-b-2 border-transparent py-4 px-1 text-sm font-medium" onclick="showTab(event, 'assignments')">Tugas</a>
                    @if($classroom->syllabus)
                        <a href="{{ $classroom->syllabus }}" target="_blank" class="text-gray-500 hover:text-blue-600 hover:border-blue-600 border-b-2 border-transparent py-4 px-1 text-sm font-medium">RPS</a>
                    @endif
                </nav>
            </div>

            <!-- Stream Tab -->
            <div id="tab-stream" class="tab-content">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-3 text-gray-900">Pengumuman & Info Kelas</h2>
                    <p class="text-gray-700 text-sm">Belum ada pengumuman. Dosen dapat membagikan info penting di sini.</p>
                </div>
            </div>

            <!-- Materials Tab -->
            <div id="tab-materials" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Materi Kelas</h2>
                        <a href="{{ route('classrooms.materials.index', $classroom) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                            <i class="fas fa-list mr-2"></i>Lihat Semua Materi
                        </a>
                        @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                            <a href="{{ route('classrooms.materials.create', $classroom) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                                <i class="fas fa-plus mr-2"></i>Tambah Materi
                            </a>
                        @endif
                    </div>
                    @if($classroom->materials->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($classroom->materials as $material)
                                <li class="py-4 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class="{{ $material->file_icon }} text-2xl"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('classrooms.materials.show', [$classroom, $material]) }}" class="text-blue-700 font-semibold hover:underline">
                                            {{ $material->title }}
                                        </a>
                                        <div class="text-xs text-gray-500 mt-1">
                                            Diposting: {{ $material->publish_date ? $material->publish_date->format('d M Y') : '-' }}
                                            @if($material->week)
                                                | Minggu ke-{{ $material->week }}
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $material->description }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        @if($material->file_path)
                                            <a href="{{ route('classrooms.materials.download', [$classroom, $material]) }}" class="text-xs text-blue-600 hover:underline flex items-center"><i class="fas fa-download mr-1"></i>Download</a>
                                            <span class="text-xs text-gray-400 mt-1">{{ $material->formatted_file_size }}</span>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-gray-500 text-sm">Belum ada materi di kelas ini.</div>
                    @endif
                </div>
            </div>

            <!-- Assignments Tab -->
            <div id="tab-assignments" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Tugas Kelas</h2>
                        @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                                <i class="fas fa-plus mr-2"></i>Tambah Tugas
                            </a>
                        @endif
                    </div>
                    @if($classroom->assignments->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($classroom->assignments as $assignment)
                                <li class="py-4 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-tasks text-2xl text-blue-500"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="text-blue-700 font-semibold">{{ $assignment->title }}</span>
                                        <div class="text-xs text-gray-500 mt-1">
                                            Deadline: {{ $assignment->deadline ? $assignment->deadline->format('d M Y H:i') : '-' }}
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $assignment->description }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <a href="#" class="text-xs text-blue-600 hover:underline flex items-center"><i class="fas fa-eye mr-1"></i>Lihat</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-gray-500 text-sm">Belum ada tugas di kelas ini.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(event, tab) {
    event.preventDefault();
    document.querySelectorAll('.tab-link').forEach(el => {
        el.classList.remove('text-blue-600', 'border-blue-600');
        el.classList.add('text-gray-500', 'border-transparent');
    });
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById('tab-' + tab).classList.remove('hidden');
    event.target.classList.add('text-blue-600', 'border-blue-600');
    event.target.classList.remove('text-gray-500', 'border-transparent');
}
</script>
@endsection
