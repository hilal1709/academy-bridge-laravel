@extends('layouts.app')

@section('title', 'Kelas Saya')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Kelas Saya</h1>
            <p class="text-gray-600 mt-2">
                @if(auth()->user()->role === 'lecturer')
                    Kelola kelas yang Anda ampu
                @else
                    Kelas yang Anda ikuti
                @endif
            </p>
        </div>
        
        <div class="flex space-x-4">
            @if(auth()->user()->role === 'student')
                <!-- Join Class Modal Button -->
                <button onclick="openJoinModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Gabung Kelas
                </button>
            @endif
            
            @if(auth()->user()->role === 'lecturer')
                <a href="{{ route('classrooms.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Buat Kelas Baru
                </a>
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

    @if($classrooms->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($classrooms as $classroom)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 overflow-hidden">
                    <!-- Cover Image -->
                    <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-600 relative">
                        @if($classroom->cover_image)
                            <img src="{{ Storage::url($classroom->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($classroom->status === 'active') bg-green-100 text-green-800
                                @elseif($classroom->status === 'inactive') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($classroom->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-2">
                                {{ $classroom->name }}
                            </h3>
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                {{ $classroom->code }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-book mr-2"></i>{{ $classroom->subject }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-graduation-cap mr-2"></i>{{ $classroom->program }} - Semester {{ $classroom->semester }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-calendar mr-2"></i>{{ $classroom->academic_year }}
                            </p>
                            @if(auth()->user()->role === 'student')
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-user-tie mr-2"></i>{{ $classroom->lecturer->name }}
                                </p>
                            @endif
                        </div>

                        <!-- Stats -->
                        <div class="flex justify-between text-sm text-gray-500 mb-4">
                            <span>
                                <i class="fas fa-users mr-1"></i>
                                {{ $classroom->enrolled_students_count }}/{{ $classroom->max_students }}
                            </span>
                            <span>
                                <i class="fas fa-file-alt mr-1"></i>
                                {{ $classroom->materials->count() }} Materi
                            </span>
                            <span>
                                <i class="fas fa-tasks mr-1"></i>
                                {{ $classroom->assignments->count() }} Tugas
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="{{ route('classrooms.show', $classroom) }}" 
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                                Masuk Kelas
                            </a>
                            
                            @if(auth()->user()->role === 'lecturer' && $classroom->lecturer_id === auth()->id())
                                <a href="{{ route('classrooms.edit', $classroom) }}" 
                                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-3 rounded-lg text-sm transition duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $classrooms->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="max-w-md mx-auto">
                <i class="fas fa-chalkboard-teacher text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    @if(auth()->user()->role === 'lecturer')
                        Belum Ada Kelas
                    @else
                        Belum Bergabung di Kelas Manapun
                    @endif
                </h3>
                <p class="text-gray-600 mb-6">
                    @if(auth()->user()->role === 'lecturer')
                        Mulai dengan membuat kelas pertama Anda
                    @else
                        Bergabunglah dengan kelas menggunakan kode kelas dari dosen
                    @endif
                </p>
                
                @if(auth()->user()->role === 'lecturer')
                    <a href="{{ route('classrooms.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-plus mr-2"></i>Buat Kelas Pertama
                    </a>
                @else
                    <button onclick="openJoinModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-plus mr-2"></i>Gabung Kelas
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>

@if(auth()->user()->role === 'student')
<!-- Join Class Modal -->
<div id="joinModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Gabung Kelas</h3>
                    <button onclick="closeJoinModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form action="{{ route('classrooms.join') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Kelas
                        </label>
                        <input type="text" 
                               id="code" 
                               name="code" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan kode kelas"
                               required>
                        <p class="text-sm text-gray-500 mt-1">
                            Dapatkan kode kelas dari dosen Anda
                        </p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button type="button" 
                                onclick="closeJoinModal()"
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-medium transition duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition duration-200">
                            Gabung
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<script>
function openJoinModal() {
    document.getElementById('joinModal').classList.remove('hidden');
}

function closeJoinModal() {
    document.getElementById('joinModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('joinModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeJoinModal();
    }
});
</script>
@endsection