<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unggah Materi - Academy Bridge</title>
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
<style>
:where([class^="ri-"])::before { content: "\\f3c2"; }
body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
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
<a href="{{ route('materials.index') }}" class="font-medium text-gray-600 hover:text-gray-900">Materi</a>
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
<section class="py-12 bg-white min-h-screen">
<div class="container mx-auto px-4">
<div class="max-w-2xl mx-auto">
<div class="bg-white rounded-xl shadow-md border border-gray-100 p-8">
<h1 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-2">
<i class="ri-upload-cloud-2-line text-primary"></i>
Unggah Materi
</h1>
<form method="POST" action="{{ route('materials.store') }}" enctype="multipart/form-data" class="space-y-6">
@csrf
<!-- Hidden Course Selection (set to default) -->
<input type="hidden" name="course_id" value="1">

<!-- Judul Materi -->
<div>
<label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
<input id="title" name="title" type="text" value="{{ old('title') }}" required autofocus class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4">
@if($errors->has('title'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('title') }}</p>
@endif
</div>

<!-- Deskripsi Materi -->
<div>
<label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Materi</label>
<textarea id="description" name="description" rows="4" required class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4">{{ old('description') }}</textarea>
@if($errors->has('description'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('description') }}</p>
@endif
</div>

<!-- Fakultas -->
<div>
<label for="fakultas" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
<div class="relative">
<select id="fakultas-select" name="fakultas" required class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4">
<option value="">Pilih Fakultas</option>
<option value="Fakultas Teknik" {{ old('fakultas') == 'Fakultas Teknik' ? 'selected' : '' }}>Fakultas Teknik</option>
<option value="Fakultas Ekonomi" {{ old('fakultas') == 'Fakultas Ekonomi' ? 'selected' : '' }}>Fakultas Ekonomi</option>
<option value="Fakultas Kedokteran" {{ old('fakultas') == 'Fakultas Kedokteran' ? 'selected' : '' }}>Fakultas Kedokteran</option>
<option value="Fakultas Hukum" {{ old('fakultas') == 'Fakultas Hukum' ? 'selected' : '' }}>Fakultas Hukum</option>
<option value="Fakultas Ilmu Komputer" {{ old('fakultas') == 'Fakultas Ilmu Komputer' ? 'selected' : '' }}>Fakultas Ilmu Komputer</option>
<option value="Fakultas MIPA" {{ old('fakultas') == 'Fakultas MIPA' ? 'selected' : '' }}>Fakultas MIPA</option>
<option value="other">Lainnya</option>
</select>
<input type="text" id="fakultas-other" name="fakultas_other" value="{{ old('fakultas_other') }}" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary {{ old('fakultas') == 'other' ? '' : 'hidden' }}" placeholder="Masukkan nama fakultas...">
</div>
@if($errors->has('fakultas'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('fakultas') }}</p>
@endif
</div>

<!-- Jurusan -->
<div>
<label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
<div class="relative">
<select id="jurusan-select" name="jurusan" required class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4">
<option value="">Pilih Jurusan</option>
<option value="Teknik Informatika" {{ old('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
<option value="Sistem Informasi" {{ old('jurusan') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
<option value="Teknik Elektro" {{ old('jurusan') == 'Teknik Elektro' ? 'selected' : '' }}>Teknik Elektro</option>
<option value="Teknik Sipil" {{ old('jurusan') == 'Teknik Sipil' ? 'selected' : '' }}>Teknik Sipil</option>
<option value="Manajemen" {{ old('jurusan') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
<option value="Akuntansi" {{ old('jurusan') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
<option value="Ekonomi Pembangunan" {{ old('jurusan') == 'Ekonomi Pembangunan' ? 'selected' : '' }}>Ekonomi Pembangunan</option>
<option value="Kedokteran Umum" {{ old('jurusan') == 'Kedokteran Umum' ? 'selected' : '' }}>Kedokteran Umum</option>
<option value="Kedokteran Gigi" {{ old('jurusan') == 'Kedokteran Gigi' ? 'selected' : '' }}>Kedokteran Gigi</option>
<option value="Ilmu Hukum" {{ old('jurusan') == 'Ilmu Hukum' ? 'selected' : '' }}>Ilmu Hukum</option>
<option value="Matematika" {{ old('jurusan') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
<option value="Fisika" {{ old('jurusan') == 'Fisika' ? 'selected' : '' }}>Fisika</option>
<option value="Kimia" {{ old('jurusan') == 'Kimia' ? 'selected' : '' }}>Kimia</option>
<option value="Biologi" {{ old('jurusan') == 'Biologi' ? 'selected' : '' }}>Biologi</option>
<option value="other">Lainnya</option>
</select>
<input type="text" id="jurusan-other" name="jurusan_other" value="{{ old('jurusan_other') }}" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary {{ old('jurusan') == 'other' ? '' : 'hidden' }}" placeholder="Masukkan nama jurusan...">
</div>
@if($errors->has('jurusan'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('jurusan') }}</p>
@endif
</div>

<!-- Semester -->
<div>
<label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
<div class="relative">
<select id="semester" name="semester" required class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4">
<option value="">Pilih Semester</option>
<option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
<option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
<option value="3" {{ old('semester') == '3' ? 'selected' : '' }}>Semester 3</option>
<option value="4" {{ old('semester') == '4' ? 'selected' : '' }}>Semester 4</option>
<option value="5" {{ old('semester') == '5' ? 'selected' : '' }}>Semester 5</option>
<option value="6" {{ old('semester') == '6' ? 'selected' : '' }}>Semester 6</option>
<option value="7" {{ old('semester') == '7' ? 'selected' : '' }}>Semester 7</option>
<option value="8" {{ old('semester') == '8' ? 'selected' : '' }}>Semester 8</option>
</select>
</div>
@if($errors->has('semester'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('semester') }}</p>
@endif
</div>

<!-- Mata Kuliah -->
<div>
<label for="mata_kuliah" class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
<div class="relative">
<select id="matkul-select" name="mata_kuliah" required class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4">
<option value="">Pilih Mata Kuliah</option>
<option value="Algoritma dan Struktur Data" {{ old('mata_kuliah') == 'Algoritma dan Struktur Data' ? 'selected' : '' }}>Algoritma dan Struktur Data</option>
<option value="Basis Data" {{ old('mata_kuliah') == 'Basis Data' ? 'selected' : '' }}>Basis Data</option>
<option value="Pemrograman Web" {{ old('mata_kuliah') == 'Pemrograman Web' ? 'selected' : '' }}>Pemrograman Web</option>
<option value="Jaringan Komputer" {{ old('mata_kuliah') == 'Jaringan Komputer' ? 'selected' : '' }}>Jaringan Komputer</option>
<option value="Sistem Operasi" {{ old('mata_kuliah') == 'Sistem Operasi' ? 'selected' : '' }}>Sistem Operasi</option>
<option value="Rekayasa Perangkat Lunak" {{ old('mata_kuliah') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
<option value="Kecerdasan Buatan" {{ old('mata_kuliah') == 'Kecerdasan Buatan' ? 'selected' : '' }}>Kecerdasan Buatan</option>
<option value="Matematika Diskrit" {{ old('mata_kuliah') == 'Matematika Diskrit' ? 'selected' : '' }}>Matematika Diskrit</option>
<option value="Statistika" {{ old('mata_kuliah') == 'Statistika' ? 'selected' : '' }}>Statistika</option>
<option value="Kalkulus" {{ old('mata_kuliah') == 'Kalkulus' ? 'selected' : '' }}>Kalkulus</option>
<option value="Fisika Dasar" {{ old('mata_kuliah') == 'Fisika Dasar' ? 'selected' : '' }}>Fisika Dasar</option>
<option value="Kimia Dasar" {{ old('mata_kuliah') == 'Kimia Dasar' ? 'selected' : '' }}>Kimia Dasar</option>
<option value="Ekonomi Mikro" {{ old('mata_kuliah') == 'Ekonomi Mikro' ? 'selected' : '' }}>Ekonomi Mikro</option>
<option value="Ekonomi Makro" {{ old('mata_kuliah') == 'Ekonomi Makro' ? 'selected' : '' }}>Ekonomi Makro</option>
<option value="Manajemen Keuangan" {{ old('mata_kuliah') == 'Manajemen Keuangan' ? 'selected' : '' }}>Manajemen Keuangan</option>
<option value="Akuntansi Dasar" {{ old('mata_kuliah') == 'Akuntansi Dasar' ? 'selected' : '' }}>Akuntansi Dasar</option>
<option value="Anatomi" {{ old('mata_kuliah') == 'Anatomi' ? 'selected' : '' }}>Anatomi</option>
<option value="Fisiologi" {{ old('mata_kuliah') == 'Fisiologi' ? 'selected' : '' }}>Fisiologi</option>
<option value="Farmakologi" {{ old('mata_kuliah') == 'Farmakologi' ? 'selected' : '' }}>Farmakologi</option>
<option value="Hukum Perdata" {{ old('mata_kuliah') == 'Hukum Perdata' ? 'selected' : '' }}>Hukum Perdata</option>
<option value="Hukum Pidana" {{ old('mata_kuliah') == 'Hukum Pidana' ? 'selected' : '' }}>Hukum Pidana</option>
<option value="other">Lainnya</option>
</select>
<input type="text" id="matkul-other" name="mata_kuliah_other" value="{{ old('mata_kuliah_other') }}" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary {{ old('mata_kuliah') == 'other' ? '' : 'hidden' }}" placeholder="Masukkan nama mata kuliah...">
</div>
@if($errors->has('mata_kuliah'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('mata_kuliah') }}</p>
@endif
</div>

<!-- Kategori -->
<div>
<label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
<div class="relative">
<select id="kategori" name="kategori" required class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4">
<option value="">Pilih Kategori</option>
<option value="Materi Kuliah" {{ old('kategori') == 'Materi Kuliah' ? 'selected' : '' }}>Materi Kuliah</option>
<option value="Tugas" {{ old('kategori') == 'Tugas' ? 'selected' : '' }}>Tugas</option>
<option value="Ujian" {{ old('kategori') == 'Ujian' ? 'selected' : '' }}>Ujian</option>
<option value="Praktikum" {{ old('kategori') == 'Praktikum' ? 'selected' : '' }}>Praktikum</option>
<option value="Referensi" {{ old('kategori') == 'Referensi' ? 'selected' : '' }}>Referensi</option>
<option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
</select>
</div>
@if($errors->has('kategori'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('kategori') }}</p>
@endif
</div>

<!-- File Materi -->
<div>
<label for="file" class="block text-sm font-medium text-gray-700 mb-1">File Materi</label>
<div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-primary transition-colors duration-200">
<div class="space-y-1 text-center">
<i class="ri-file-upload-line text-4xl text-primary mx-auto mb-2"></i>
<div class="flex text-sm text-gray-600 justify-center">
<label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary" style="display: flex; align-items: center;">
<span>Pilih file</span>
<input id="file" name="file" type="file" class="absolute left-0 top-0 w-full h-full opacity-0 cursor-pointer" required accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt,.zip,.rar" onchange="updateFileName(this)" />
</label>
<p class="pl-1">atau drag and drop</p>
</div>
<p class="text-xs text-gray-500">PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, TXT, ZIP, RAR hingga 20MB</p>
<p id="selected-file" class="text-sm text-gray-700 font-medium hidden"></p>
</div>
</div>
@if($errors->has('file'))
<p class="text-red-500 text-xs mt-1">{{ $errors->first('file') }}</p>
@endif
</div>

<!-- Submit Button -->
<div class="flex items-center justify-end mt-4">
<button type="submit" id="submit-btn" class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90 disabled:opacity-60">
<span id="submit-text">Unggah Materi</span>
<span id="loading-text" class="hidden">
<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
</svg>
Mengunggah...
</span>
</button>
</div>
</form>
</div>
</div>
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
<a href="{{ route('dashboard') }}" class="text-2xl font-['Pacifico'] text-white">Academy Bridge</a>
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
<li><a href="{{ route('materials.index', ['verified' => 1]) }}" class="text-gray-400 hover:text-white">Materi Terverifikasi</a></li>
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
<a href="tel:+6281234567890" class="text-gray-400 hover:text-white">+62 812 3456 7890</a>
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
// File input functionality
function updateFileName(input) {
const fileDisplay = document.getElementById('selected-file');
if (input.files && input.files[0]) {
const fileName = input.files[0].name;
const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
fileDisplay.textContent = `File terpilih: ${fileName} (${fileSize} MB)`;
fileDisplay.classList.remove('hidden');
} else {
fileDisplay.classList.add('hidden');
}
}

// Make updateFileName globally accessible
window.updateFileName = updateFileName;

// Filter "Lainnya" functionality
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

// Drag and drop functionality
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('file');

if (dropZone && fileInput) {
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
e.preventDefault();
e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
dropZone.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
dropZone.classList.add('border-primary', 'bg-primary/10');
}

function unhighlight(e) {
dropZone.classList.remove('border-primary', 'bg-primary/10');
}

dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
const dt = e.dataTransfer;
const files = dt.files;
if (files.length > 0) {
fileInput.files = files;
updateFileName(fileInput);
}
}
}

// Form submission
const form = document.querySelector('form');
if (form) {
form.addEventListener('submit', function(e) {
const submitBtn = document.getElementById('submit-btn');
const submitText = document.getElementById('submit-text');
const loadingText = document.getElementById('loading-text');
const title = document.getElementById('title').value.trim();
const description = document.getElementById('description').value.trim();
const file = document.getElementById('file').files[0];
const fakultas = document.getElementById('fakultas-select').value;
const jurusan = document.getElementById('jurusan-select').value;
const semester = document.getElementById('semester').value;
const mataKuliah = document.getElementById('matkul-select').value;

if (!title || !description || !file || !fakultas || !jurusan || !semester || !mataKuliah) {
return; // Let browser validation handle this
}

if (submitBtn && submitText && loadingText) {
submitBtn.disabled = true;
submitText.classList.add('hidden');
loadingText.classList.remove('hidden');
}
});
}
});
</script>
</body>
</html>