<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forum Diskusi - Academy Bridge</title>
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
<a href="{{ route('discussions.my') }}" class="font-medium text-gray-900 border-b-2 border-primary pb-1">Forum</a>
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
<h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('app.my_discussions') }}</h1>
<p class="text-gray-600">Kelola dan lihat riwayat diskusi Anda tentang materi pembelajaran</p>
</div>
<div>
<button class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-add-line ri-lg"></i>
Mulai Diskusi Baru
</button>
</div>
</div>
</div>
</section>

<!-- Search & Filter Section -->
<section class="py-8 bg-white">
<div class="container mx-auto px-4">
<div class="bg-white rounded-xl shadow-md p-6">
<form method="GET" action="{{ route('discussions.my') }}">
<div class="relative mb-6">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<i class="ri-search-line ri-lg text-gray-500"></i>
</div>
<input type="search" name="search" value="{{ request('search') }}" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="Cari diskusi berdasarkan topik atau materi...">
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
<option value="teknik-informatika" {{ request('jurusan') == 'teknik-informatika' ? 'selected' : '' }}>Teknik Informatika</option>
<option value="sistem-informasi" {{ request('jurusan') == 'sistem-informasi' ? 'selected' : '' }}>Sistem Informasi</option>
<option value="teknik-elektro" {{ request('jurusan') == 'teknik-elektro' ? 'selected' : '' }}>Teknik Elektro</option>
<option value="teknik-sipil" {{ request('jurusan') == 'teknik-sipil' ? 'selected' : '' }}>Teknik Sipil</option>
<option value="manajemen" {{ request('jurusan') == 'manajemen' ? 'selected' : '' }}>Manajemen</option>
<option value="akuntansi" {{ request('jurusan') == 'akuntansi' ? 'selected' : '' }}>Akuntansi</option>
<option value="ekonomi-pembangunan" {{ request('jurusan') == 'ekonomi-pembangunan' ? 'selected' : '' }}>Ekonomi Pembangunan</option>
<option value="kedokteran-umum" {{ request('jurusan') == 'kedokteran-umum' ? 'selected' : '' }}>Kedokteran Umum</option>
<option value="kedokteran-gigi" {{ request('jurusan') == 'kedokteran-gigi' ? 'selected' : '' }}>Kedokteran Gigi</option>
<option value="hukum" {{ request('jurusan') == 'hukum' ? 'selected' : '' }}>Ilmu Hukum</option>
<option value="matematika" {{ request('jurusan') == 'matematika' ? 'selected' : '' }}>Matematika</option>
<option value="fisika" {{ request('jurusan') == 'fisika' ? 'selected' : '' }}>Fisika</option>
<option value="kimia" {{ request('jurusan') == 'kimia' ? 'selected' : '' }}>Kimia</option>
<option value="biologi" {{ request('jurusan') == 'biologi' ? 'selected' : '' }}>Biologi</option>
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
<option value="algoritma-struktur-data" {{ request('mata_kuliah') == 'algoritma-struktur-data' ? 'selected' : '' }}>Algoritma dan Struktur Data</option>
<option value="basis-data" {{ request('mata_kuliah') == 'basis-data' ? 'selected' : '' }}>Basis Data</option>
<option value="pemrograman-web" {{ request('mata_kuliah') == 'pemrograman-web' ? 'selected' : '' }}>Pemrograman Web</option>
<option value="jaringan-komputer" {{ request('mata_kuliah') == 'jaringan-komputer' ? 'selected' : '' }}>Jaringan Komputer</option>
<option value="sistem-operasi" {{ request('mata_kuliah') == 'sistem-operasi' ? 'selected' : '' }}>Sistem Operasi</option>
<option value="rekayasa-perangkat-lunak" {{ request('mata_kuliah') == 'rekayasa-perangkat-lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
<option value="kecerdasan-buatan" {{ request('mata_kuliah') == 'kecerdasan-buatan' ? 'selected' : '' }}>Kecerdasan Buatan</option>
<option value="matematika-diskrit" {{ request('mata_kuliah') == 'matematika-diskrit' ? 'selected' : '' }}>Matematika Diskrit</option>
<option value="statistika" {{ request('mata_kuliah') == 'statistika' ? 'selected' : '' }}>Statistika</option>
<option value="kalkulus" {{ request('mata_kuliah') == 'kalkulus' ? 'selected' : '' }}>Kalkulus</option>
<option value="fisika-dasar" {{ request('mata_kuliah') == 'fisika-dasar' ? 'selected' : '' }}>Fisika Dasar</option>
<option value="kimia-dasar" {{ request('mata_kuliah') == 'kimia-dasar' ? 'selected' : '' }}>Kimia Dasar</option>
<option value="ekonomi-mikro" {{ request('mata_kuliah') == 'ekonomi-mikro' ? 'selected' : '' }}>Ekonomi Mikro</option>
<option value="ekonomi-makro" {{ request('mata_kuliah') == 'ekonomi-makro' ? 'selected' : '' }}>Ekonomi Makro</option>
<option value="manajemen-keuangan" {{ request('mata_kuliah') == 'manajemen-keuangan' ? 'selected' : '' }}>Manajemen Keuangan</option>
<option value="akuntansi-dasar" {{ request('mata_kuliah') == 'akuntansi-dasar' ? 'selected' : '' }}>Akuntansi Dasar</option>
<option value="anatomi" {{ request('mata_kuliah') == 'anatomi' ? 'selected' : '' }}>Anatomi</option>
<option value="fisiologi" {{ request('mata_kuliah') == 'fisiologi' ? 'selected' : '' }}>Fisiologi</option>
<option value="farmakologi" {{ request('mata_kuliah') == 'farmakologi' ? 'selected' : '' }}>Farmakologi</option>
<option value="hukum-perdata" {{ request('mata_kuliah') == 'hukum-perdata' ? 'selected' : '' }}>Hukum Perdata</option>
<option value="hukum-pidana" {{ request('mata_kuliah') == 'hukum-pidana' ? 'selected' : '' }}>Hukum Pidana</option>
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
<span class="ml-2 text-sm text-gray-700">Hanya diskusi materi terverifikasi</span>
</label>
</div>
<button type="submit" class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-search-line ri-lg"></i>
Cari Diskusi
</button>
</div>
</form>
</div>
</div>
</section>

<!-- Discussions List -->
<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-gray-900">Diskusi Saya</h2>
<div class="flex items-center gap-4">
<span class="text-sm text-gray-600">{{ $discussions->total() }} diskusi ditemukan</span>
<div class="flex items-center gap-2">
<button class="p-2 rounded-lg bg-white border border-gray-200 hover:bg-gray-50">
<i class="ri-list-check text-gray-600"></i>
</button>
<button class="p-2 rounded-lg bg-white border border-gray-200 hover:bg-gray-50">
<i class="ri-grid-line text-gray-600"></i>
</button>
</div>
</div>
</div>

<div class="space-y-6">
@forelse($discussions as $discussion)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="p-6">
<div class="flex items-start justify-between mb-4">
<div class="flex-1">
<div class="flex items-center gap-2 mb-2">
<div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
<i class="ri-discuss-line"></i>
</div>
<span class="text-sm font-medium text-gray-900">Diskusi Materi</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span class="text-sm text-gray-500">{{ $discussion->created_at->diffForHumans() }}</span>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">
<a href="{{ route('materials.show', $discussion->material) }}" class="text-primary hover:text-primary/80">
{{ $discussion->material->title }}
</a>
</h3>
<div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
<span>{{ $discussion->material->course->name }}</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Oleh {{ $discussion->material->user->name }}</span>
</div>
</div>
<div class="flex items-center gap-2">
<div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
<i class="ri-chat-3-line mr-1"></i>
Aktif
</div>
</div>
</div>

<div class="mb-4">
<p class="text-gray-700 leading-relaxed">{{ $discussion->content }}</p>
</div>

<div class="flex items-center justify-between pt-4 border-t border-gray-100">
<div class="flex items-center gap-4">
<div class="flex items-center gap-2">
<x-user-avatar :user="auth()->user()" size="sm" />
<span class="text-sm text-gray-900">{{ auth()->user()->name }}</span>
</div>
<div class="flex items-center gap-3 text-xs text-gray-500">
<div class="flex items-center gap-1">
<i class="ri-message-3-line"></i>
<span>5 balasan</span>
</div>
<div class="flex items-center gap-1">
<i class="ri-eye-line"></i>
<span>24 dilihat</span>
</div>
</div>
</div>
<div class="flex items-center gap-2">
<a href="{{ route('materials.show', $discussion->material) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
Lihat Detail
</a>
<form action="{{ route('discussions.destroy', $discussion) }}" method="POST" class="inline">
@csrf
@method('DELETE')
<button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full bg-red-100 hover:bg-red-200 text-red-600" onclick="return confirm('Yakin ingin menghapus diskusi ini?')">
<i class="ri-delete-bin-line"></i>
</button>
</form>
</div>
</div>
</div>
</div>
@empty
<div class="text-center py-12">
<div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full">
<i class="ri-discuss-line ri-2x text-gray-400"></i>
</div>
<h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada diskusi</h3>
<p class="text-gray-500 mb-6">{{ __('app.no_discussions') }}</p>
<button class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90 mx-auto">
<i class="ri-add-line ri-lg"></i>
Mulai Diskusi Pertama
</button>
</div>
@endforelse
</div>

<!-- Pagination -->
@if($discussions->hasPages())
<div class="mt-8 flex justify-center">
{{ $discussions->links() }}
</div>
@endif
</div>
</section>

<!-- Popular Topics Section -->
<section class="py-12 bg-white">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-gray-900">Topik Populer</h2>
<a href="#" class="text-primary font-medium flex items-center gap-1 hover:underline">
Lihat Semua
<i class="ri-arrow-right-line"></i>
</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Popular Topic 1 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
<div class="flex items-center gap-3 mb-4">
<div class="w-12 h-12 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
<i class="ri-code-s-slash-line ri-lg"></i>
</div>
<div>
<h3 class="font-semibold text-gray-900">Algoritma Sorting</h3>
<p class="text-sm text-gray-500">Teknik Informatika</p>
</div>
</div>
<p class="text-gray-600 text-sm mb-4">Diskusi tentang berbagai algoritma sorting dan implementasinya dalam pemrograman.</p>
<div class="flex items-center justify-between">
<div class="flex items-center gap-3 text-xs text-gray-500">
<span>24 diskusi</span>
<span>156 balasan</span>
</div>
<span class="text-xs text-gray-500">2 jam lalu</span>
</div>
</div>

<!-- Popular Topic 2 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
<div class="flex items-center gap-3 mb-4">
<div class="w-12 h-12 flex items-center justify-center bg-green-100 text-green-600 rounded-full">
<i class="ri-database-2-line ri-lg"></i>
</div>
<div>
<h3 class="font-semibold text-gray-900">Database Design</h3>
<p class="text-sm text-gray-500">Sistem Informasi</p>
</div>
</div>
<p class="text-gray-600 text-sm mb-4">Pembahasan tentang perancangan database yang efisien dan normalisasi.</p>
<div class="flex items-center justify-between">
<div class="flex items-center gap-3 text-xs text-gray-500">
<span>18 diskusi</span>
<span>89 balasan</span>
</div>
<span class="text-xs text-gray-500">5 jam lalu</span>
</div>
</div>

<!-- Popular Topic 3 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
<div class="flex items-center gap-3 mb-4">
<div class="w-12 h-12 flex items-center justify-center bg-purple-100 text-purple-600 rounded-full">
<i class="ri-global-line ri-lg"></i>
</div>
<div>
<h3 class="font-semibold text-gray-900">Web Development</h3>
<p class="text-sm text-gray-500">Teknik Informatika</p>
</div>
</div>
<p class="text-gray-600 text-sm mb-4">Tips dan trik dalam pengembangan aplikasi web modern menggunakan framework terbaru.</p>
<div class="flex items-center justify-between">
<div class="flex items-center gap-3 text-xs text-gray-500">
<span>31 diskusi</span>
<span>203 balasan</span>
</div>
<span class="text-xs text-gray-500">1 hari lalu</span>
</div>
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
<li><a href="#" class="text-gray-400 hover:text-white">Diskusi Aktif</a></li>
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
});
</script>
</body>
</html>