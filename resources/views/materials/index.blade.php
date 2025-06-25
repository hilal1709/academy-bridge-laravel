<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Materi - Academy Bridge</title>
<meta name="cache-timestamp" content="{{ $cacheTimestamp ?? time() }}">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
<style>
:where([class^="ri-"])::before { content: "\\f3c2"; }
body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
input[type="search"]::-webkit-search-decoration,
input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-results-button,
input[type="search"]::-webkit-search-results-decoration { display: none; }
</style>
</head>
<body>
<!-- Header & Navigation -->
<header class="bg-white shadow-sm sticky top-0 z-50">
<div class="container mx-auto px-4 py-3 flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-10 h-10 flex items-center justify-center bg-primary rounded-lg text-white">
<i class="ri-book-open-line ri-lg"></i>
</div>
<a href="{{ route('dashboard') }}" class="text-2xl font-['Pacifico'] text-primary">Academy Bridge</a>
</div>
<nav class="hidden md:flex items-center space-x-6">
<a href="{{ route('dashboard') }}" class="font-medium text-gray-600 hover:text-gray-900">Beranda</a>
<a href="{{ route('materials.index') }}" class="font-medium text-gray-900 border-b-2 border-primary pb-1">Materi</a>
<a href="{{ route('discussions.my') }}" class="font-medium text-gray-600 hover:text-gray-900">Forum</a>
<a href="{{ route('notifications.index') }}" class="font-medium text-gray-600 hover:text-gray-900">Notifikasi</a>
<a href="{{ route('analytics.index') }}" class="font-medium text-gray-600 hover:text-gray-900">Analitik</a>
<a href="{{ route('profile.edit') }}" class="font-medium text-gray-600 hover:text-gray-900">Profil</a>
</nav>
<div class="flex items-center gap-3">
<button class="hidden md:flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200">
<i class="ri-notification-3-line ri-lg text-gray-700"></i>
</button>
@include('components.profile-dropdown')
</div>
</div>
</header>

<main>
<!-- Page Header -->
<section class="py-8 bg-white border-b border-gray-100">
<div class="container mx-auto px-4">
<div class="flex justify-between items-center">
<div>
<h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('materials.search_materials') }}</h1>
<p class="text-gray-600">{{ __('materials.search_description') }}</p>
</div>
@auth
<div>
<a href="{{ route('materials.create') }}" 
   class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-upload-line ri-lg"></i>
Unggah Materi
</a>
</div>
@endauth
</div>
</div>
</section>

<!-- Search Section -->
<section class="py-8 bg-white">
<div class="container mx-auto px-4">
<div class="bg-white rounded-xl shadow-md p-6">
<form method="GET" action="{{ route('materials.index') }}">
<div class="relative mb-6">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<i class="ri-search-line ri-lg text-gray-500"></i>
</div>
<input type="text" name="search" value="{{ request('search') }}" 
class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
placeholder="Cari materi kuliah, modul, atau topik...">
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
<div class="relative">
<select id="fakultas-select" name="fakultas" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Fakultas</option>
<option value="teknik" {{ request('fakultas') == 'teknik' ? 'selected' : '' }}>Fakultas Teknik</option>
<option value="ekonomi" {{ request('fakultas') == 'ekonomi' ? 'selected' : '' }}>Fakultas Ekonomi</option>
<option value="kedokteran" {{ request('fakultas') == 'kedokteran' ? 'selected' : '' }}>Fakultas Kedokteran</option>
<option value="hukum" {{ request('fakultas') == 'hukum' ? 'selected' : '' }}>Fakultas Hukum</option>
<option value="ilmu-komputer" {{ request('fakultas') == 'ilmu-komputer' ? 'selected' : '' }}>Fakultas Ilmu Komputer</option>
<option value="mipa" {{ request('fakultas') == 'mipa' ? 'selected' : '' }}>Fakultas MIPA</option>
<option value="other">Lainnya</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
<input type="text" id="fakultas-other" name="fakultas_other" value="{{ request('fakultas_other') }}" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary {{ request('fakultas') == 'other' ? '' : 'hidden' }}" placeholder="Masukkan nama fakultas...">
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
<div class="relative">
<select id="jurusan-select" name="jurusan" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Jurusan</option>
<option value="Teknik Informatika" {{ request('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
<option value="Sistem Informasi" {{ request('jurusan') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
<option value="Teknik Elektro" {{ request('jurusan') == 'Teknik Elektro' ? 'selected' : '' }}>Teknik Elektro</option>
<option value="Teknik Sipil" {{ request('jurusan') == 'Teknik Sipil' ? 'selected' : '' }}>Teknik Sipil</option>
<option value="Manajemen" {{ request('jurusan') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
<option value="Akuntansi" {{ request('jurusan') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
<option value="Ekonomi Pembangunan" {{ request('jurusan') == 'Ekonomi Pembangunan' ? 'selected' : '' }}>Ekonomi Pembangunan</option>
<option value="Kedokteran Umum" {{ request('jurusan') == 'Kedokteran Umum' ? 'selected' : '' }}>Kedokteran Umum</option>
<option value="Kedokteran Gigi" {{ request('jurusan') == 'Kedokteran Gigi' ? 'selected' : '' }}>Kedokteran Gigi</option>
<option value="Ilmu Hukum" {{ request('jurusan') == 'Ilmu Hukum' ? 'selected' : '' }}>Ilmu Hukum</option>
<option value="Matematika" {{ request('jurusan') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
<option value="Fisika" {{ request('jurusan') == 'Fisika' ? 'selected' : '' }}>Fisika</option>
<option value="Kimia" {{ request('jurusan') == 'Kimia' ? 'selected' : '' }}>Kimia</option>
<option value="Biologi" {{ request('jurusan') == 'Biologi' ? 'selected' : '' }}>Biologi</option>
<option value="other">Lainnya</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
<input type="text" id="jurusan-other" name="jurusan_other" value="{{ request('jurusan_other') }}" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary {{ request('jurusan') == 'other' ? '' : 'hidden' }}" placeholder="Masukkan nama jurusan...">
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
<div class="relative">
<select name="semester" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Semester</option>
<option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
<option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
<option value="3" {{ request('semester') == '3' ? 'selected' : '' }}>Semester 3</option>
<option value="4" {{ request('semester') == '4' ? 'selected' : '' }}>Semester 4</option>
<option value="5" {{ request('semester') == '5' ? 'selected' : '' }}>Semester 5</option>
<option value="6" {{ request('semester') == '6' ? 'selected' : '' }}>Semester 6</option>
<option value="7" {{ request('semester') == '7' ? 'selected' : '' }}>Semester 7</option>
<option value="8" {{ request('semester') == '8' ? 'selected' : '' }}>Semester 8</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
<div class="relative">
<select id="matkul-select" name="mata_kuliah" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Mata Kuliah</option>
<option value="Algoritma dan Struktur Data" {{ request('mata_kuliah') == 'Algoritma dan Struktur Data' ? 'selected' : '' }}>Algoritma dan Struktur Data</option>
<option value="Basis Data" {{ request('mata_kuliah') == 'Basis Data' ? 'selected' : '' }}>Basis Data</option>
<option value="Pemrograman Web" {{ request('mata_kuliah') == 'Pemrograman Web' ? 'selected' : '' }}>Pemrograman Web</option>
<option value="Jaringan Komputer" {{ request('mata_kuliah') == 'Jaringan Komputer' ? 'selected' : '' }}>Jaringan Komputer</option>
<option value="Sistem Operasi" {{ request('mata_kuliah') == 'Sistem Operasi' ? 'selected' : '' }}>Sistem Operasi</option>
<option value="Rekayasa Perangkat Lunak" {{ request('mata_kuliah') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
<option value="Kecerdasan Buatan" {{ request('mata_kuliah') == 'Kecerdasan Buatan' ? 'selected' : '' }}>Kecerdasan Buatan</option>
<option value="Matematika Diskrit" {{ request('mata_kuliah') == 'Matematika Diskrit' ? 'selected' : '' }}>Matematika Diskrit</option>
<option value="Statistika" {{ request('mata_kuliah') == 'Statistika' ? 'selected' : '' }}>Statistika</option>
<option value="Kalkulus" {{ request('mata_kuliah') == 'Kalkulus' ? 'selected' : '' }}>Kalkulus</option>
<option value="Fisika Dasar" {{ request('mata_kuliah') == 'Fisika Dasar' ? 'selected' : '' }}>Fisika Dasar</option>
<option value="Kimia Dasar" {{ request('mata_kuliah') == 'Kimia Dasar' ? 'selected' : '' }}>Kimia Dasar</option>
<option value="Ekonomi Mikro" {{ request('mata_kuliah') == 'Ekonomi Mikro' ? 'selected' : '' }}>Ekonomi Mikro</option>
<option value="Ekonomi Makro" {{ request('mata_kuliah') == 'Ekonomi Makro' ? 'selected' : '' }}>Ekonomi Makro</option>
<option value="Manajemen Keuangan" {{ request('mata_kuliah') == 'Manajemen Keuangan' ? 'selected' : '' }}>Manajemen Keuangan</option>
<option value="Akuntansi Dasar" {{ request('mata_kuliah') == 'Akuntansi Dasar' ? 'selected' : '' }}>Akuntansi Dasar</option>
<option value="Anatomi" {{ request('mata_kuliah') == 'Anatomi' ? 'selected' : '' }}>Anatomi</option>
<option value="Fisiologi" {{ request('mata_kuliah') == 'Fisiologi' ? 'selected' : '' }}>Fisiologi</option>
<option value="Farmakologi" {{ request('mata_kuliah') == 'Farmakologi' ? 'selected' : '' }}>Farmakologi</option>
<option value="Hukum Perdata" {{ request('mata_kuliah') == 'Hukum Perdata' ? 'selected' : '' }}>Hukum Perdata</option>
<option value="Hukum Pidana" {{ request('mata_kuliah') == 'Hukum Pidana' ? 'selected' : '' }}>Hukum Pidana</option>
<option value="other">Lainnya</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
<input type="text" id="matkul-other" name="mata_kuliah_other" value="{{ request('mata_kuliah_other') }}" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary {{ request('mata_kuliah') == 'other' ? '' : 'hidden' }}" placeholder="Masukkan nama mata kuliah...">
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-4">
<label class="inline-flex items-center">
<input type="checkbox" name="verified" value="1" {{ request('verified') ? 'checked' : '' }}
class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
<span class="ml-2 text-sm text-gray-700">Hanya materi terverifikasi dosen</span>
</label>
</div>
<button type="submit" class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-search-line ri-lg"></i>
Cari Materi
</button>
</div>
</form>
</div>
</div>
</section>

<!-- Materials Grid -->
<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-gray-900">Daftar Materi</h2>
<div class="flex items-center gap-4">
<span class="text-sm text-gray-600">{{ $materials->total() }} materi ditemukan</span>
<div class="flex items-center gap-2">
<button class="p-2 rounded-lg bg-white border border-gray-200 hover:bg-gray-50">
<i class="ri-grid-line text-gray-600"></i>
</button>
<button class="p-2 rounded-lg bg-white border border-gray-200 hover:bg-gray-50">
<i class="ri-list-check text-gray-600"></i>
</button>
</div>
</div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- Debug: Page loaded at {{ now() }} - Cache: {{ $cacheTimestamp ?? 'none' }} -->
<!-- Debug: Total materials in query: {{ $materials->total() }} -->
<!-- Debug: Current page materials: {{ $materials->count() }} -->
@forelse($materials as $material)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<!-- Debug: Material ID {{ $material->id }}, Updated: {{ $material->updated_at }} -->
<div class="p-6">
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-2">
<div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
@if(str_contains($material->file_path, '.pdf'))
<i class="ri-file-pdf-line"></i>
@elseif(str_contains($material->file_path, '.ppt') || str_contains($material->file_path, '.pptx'))
<i class="ri-file-ppt-line"></i>
@elseif(str_contains($material->file_path, '.doc') || str_contains($material->file_path, '.docx'))
<i class="ri-file-word-line"></i>
@elseif(str_contains($material->file_path, '.xls') || str_contains($material->file_path, '.xlsx'))
<i class="ri-file-excel-2-line"></i>
@else
<i class="ri-file-text-line"></i>
@endif
</div>
<span class="text-sm font-medium text-gray-900">
@if(str_contains($material->file_path, '.pdf'))
PDF
@elseif(str_contains($material->file_path, '.ppt') || str_contains($material->file_path, '.pptx'))
PPT
@elseif(str_contains($material->file_path, '.doc') || str_contains($material->file_path, '.docx'))
DOC
@elseif(str_contains($material->file_path, '.xls') || str_contains($material->file_path, '.xlsx'))
XLS
@else
FILE
@endif
</span>
</div>
@if($material->is_verified)
<div class="bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
@endif
</div>

<h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $material->title }}</h3>
<p class="text-gray-600 text-sm mb-4">{{ Str::limit($material->description, 100) }}</p>

<div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
<span>{{ $material->course->name ?? 'Unknown Course' }}</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>{{ $material->downloads_count }} unduhan</span>
</div>

<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs font-medium text-gray-600">
{{ strtoupper(substr($material->user->name ?? 'U', 0, 1)) }}
</div>
<p class="text-xs text-gray-900">{{ $material->user->name ?? 'Unknown User' }}</p>
</div>
<div class="flex items-center gap-2">
<a href="{{ route('materials.show', $material) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
Lihat Detail
</a>
@auth
<form action="{{ route('materials.toggle-save', $material) }}" method="POST" class="inline">
@csrf
<button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
<i class="ri-bookmark-{{ auth()->user()->savedMaterials->contains($material->id) ? 'fill' : 'line' }} text-gray-700"></i>
</button>
</form>
@endauth
</div>
</div>
</div>
</div>
@empty
<div class="col-span-3 text-center py-12">
<div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full">
<i class="ri-file-search-line ri-2x text-gray-400"></i>
</div>
<h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada materi ditemukan</h3>
<p class="text-gray-500">{{ __('materials.no_materials') }}</p>
</div>
@endforelse
</div>

<!-- Pagination -->
@if($materials->hasPages())
<div class="mt-8 flex justify-center">
{{ $materials->links() }}
</div>
@endif
</div>
</section>
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
<div class="container mx-auto px-4">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
<div>
<div class="flex items-center gap-2 mb-4">
<div class="w-10 h-10 flex items-center justify-center bg-white rounded-lg">
<i class="ri-book-open-line ri-lg text-primary"></i>
</div>
<a href="#" class="text-2xl font-['Pacifico'] text-white">Academy Bridge</a>
</div>
<p class="text-gray-400 mb-4">Platform berbagi materi kuliah yang memudahkan mahasiswa dan dosen untuk mengakses, berbagi, dan berkolaborasi dalam pembelajaran akademik.</p>
</div>
<div>
<h3 class="text-lg font-semibold mb-4">Navigasi</h3>
<ul class="space-y-2">
<li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
<li><a href="{{ route('materials.index') }}" class="text-gray-400 hover:text-white">Materi</a></li>
<li><a href="{{ route('discussions.my') }}" class="text-gray-400 hover:text-white">Forum</a></li>
<li><a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-white">Profil</a></li>
</ul>
</div>
<div>
<h3 class="text-lg font-semibold mb-4">Fitur</h3>
<ul class="space-y-2">
<li><a href="{{ route('materials.saved') }}" class="text-gray-400 hover:text-white">Materi Tersimpan</a></li>
<li><a href="{{ route('materials.create') }}" class="text-gray-400 hover:text-white">Upload Materi</a></li>
<li><a href="#" class="text-gray-400 hover:text-white">Verifikasi</a></li>
</ul>
</div>
<div>
<h3 class="text-lg font-semibold mb-4">Kontak</h3>
<ul class="space-y-2">
<li class="flex items-center gap-2">
<i class="ri-mail-line text-gray-400"></i>
<a href="mailto:info@academybridge.id" class="text-gray-400 hover:text-white">info@academybridge.id</a>
</li>
<li class="flex items-center gap-2">
<i class="ri-phone-line text-gray-400"></i>
<span class="text-gray-400">+62 812 3456 7890</span>
</li>
</ul>
</div>
</div>
<div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
<p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; 2025 Academy Bridge. Hak Cipta Dilindungi.</p>
<div class="flex gap-4">
<a href="#" class="text-gray-400 hover:text-white text-sm">Syarat & Ketentuan</a>
<a href="#" class="text-gray-400 hover:text-white text-sm">Kebijakan Privasi</a>
</div>
</div>
</div>
</footer>
<script>
document.addEventListener('DOMContentLoaded', function() {
// Force cache refresh
console.log('Materials page loaded at:', new Date().toISOString());
console.log('Cache timestamp:', '{{ $cacheTimestamp ?? "none" }}');

// Filter "Lainnya" functionality with error handling
function handleOtherOption(selectId, inputId) {
try {
const select = document.getElementById(selectId);
const input = document.getElementById(inputId);

if (select && input) {
select.addEventListener('change', function() {
if (this.value === 'other') {
input.classList.remove('hidden');
input.focus();
} else {
input.classList.add('hidden');
input.value = '';
}
});
}
} catch (error) {
console.warn(`Error setting up filter for ${selectId}:`, error);
}
}

// Initialize "Lainnya" handlers
handleOtherOption('fakultas-select', 'fakultas-other');
handleOtherOption('jurusan-select', 'jurusan-other');
handleOtherOption('matkul-select', 'matkul-other');

// Force page refresh if materials are not showing (emergency fallback)
setTimeout(function() {
const materialsGrid = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3');
const materialCards = materialsGrid ? materialsGrid.querySelectorAll('.bg-white.rounded-xl') : [];
console.log('Material cards found:', materialCards.length);
if (materialCards.length === 0) {
console.warn('No material cards found, this might be a cache issue');
}
}, 1000);
});
</script>
</body>
</html>
