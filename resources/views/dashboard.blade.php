<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Academy Bridge - Platform Berbagi Materi Kuliah</title>
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
<style>
:where([class^="ri-"])::before { content: "\\f3c2"; }
body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
input[type="search"]::-webkit-search-decoration,
input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-results-button,
input[type="search"]::-webkit-search-results-decoration { display: none; }
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
.custom-checkbox { position: relative; display: inline-block; width: 20px; height: 20px; background: white; border: 2px solid #e2e8f0; border-radius: 4px; cursor: pointer; transition: all 0.2s; }
.custom-checkbox.checked { background: #4F46E5; border-color: #4F46E5; }
.custom-checkbox.checked:after { content: ''; position: absolute; top: 4px; left: 7px; width: 5px; height: 10px; border: solid white; border-width: 0 2px 2px 0; transform: rotate(45deg); }
.custom-switch { position: relative; display: inline-block; width: 44px; height: 24px; background: #e2e8f0; border-radius: 12px; cursor: pointer; transition: all 0.3s; }
.custom-switch.active { background: #4F46E5; }
.custom-switch:after { content: ''; position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background: white; border-radius: 10px; transition: all 0.3s; }
.custom-switch.active:after { left: 22px; }
.custom-range { -webkit-appearance: none; width: 100%; height: 6px; background: #e2e8f0; border-radius: 3px; outline: none; }
.custom-range::-webkit-slider-thumb { -webkit-appearance: none; width: 18px; height: 18px; background: #4F46E5; border-radius: 50%; cursor: pointer; }
.custom-radio { position: relative; display: inline-block; width: 20px; height: 20px; background: white; border: 2px solid #e2e8f0; border-radius: 50%; cursor: pointer; transition: all 0.2s; }
.custom-radio.checked { border-color: #4F46E5; }
.custom-radio.checked:after { content: ''; position: absolute; top: 4px; left: 4px; width: 8px; height: 8px; background: #4F46E5; border-radius: 50%; }
.hero-section { background-image: linear-gradient(to right, rgba(255, 255, 255, 0.95) 50%, rgba(255, 255, 255, 0.7) 70%, rgba(255, 255, 255, 0.4) 85%, rgba(255, 255, 255, 0) 100%), url('https://readdy.ai/api/search-image?query=A%20calming%20and%20modern%20university%20study%20space%20with%20students%20collaborating.%20The%20scene%20features%20soft%20natural%20lighting%20with%20teal%20and%20sage%20green%20accents%2C%20creating%20a%20serene%20and%20focused%20atmosphere.%20Modern%20ergonomic%20furniture%20and%20plants%20are%20visible%2C%20with%20clean%20architectural%20lines%20and%20large%20windows.%20Natural%20light%20creates%20a%20peaceful%20environment%20perfect%20for%20extended%20study%20sessions%2C%20with%20a%20color%20palette%20designed%20for%20eye%20comfort.&width=1600&height=800&seq=1&orientation=landscape'); background-size: cover; background-position: center right; }
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
<a href="#" class="text-2xl font-['Pacifico'] text-primary">Academy Bridge</a>
</div>
<nav class="hidden md:flex items-center space-x-6">
<a href="{{ route('dashboard') }}" class="font-medium text-gray-900 border-b-2 border-primary pb-1">Beranda</a>
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
<!-- Hero Section -->
<section class="hero-section py-16 md:py-24">
<div class="container mx-auto px-4 w-full">
<div class="max-w-2xl">
<h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Berbagi Pengetahuan, Membangun Masa Depan</h1>
<p class="text-lg text-gray-700 mb-8">Platform berbagi materi kuliah yang memudahkan mahasiswa dan dosen untuk mengakses, berbagi, dan berkolaborasi dalam pembelajaran akademik.</p>
<div class="flex flex-col sm:flex-row gap-4 mb-10">
<button class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center justify-center gap-2 whitespace-nowrap hover:bg-primary/90">
<i class="ri-user-add-line ri-lg"></i>
Daftar Sekarang
</button>
<button class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-button font-medium flex items-center justify-center gap-2 whitespace-nowrap hover:bg-gray-50">
<i class="ri-information-line ri-lg"></i>
Pelajari Lebih Lanjut
</button>
</div>
<div class="flex items-center gap-2 text-sm text-gray-600">
<div class="flex items-center justify-center w-5 h-5">
<i class="ri-check-line ri-lg text-primary"></i>
</div>
<span>Terverifikasi oleh dosen</span>
<div class="mx-2 w-1 h-1 bg-gray-400 rounded-full"></div>
<div class="flex items-center justify-center w-5 h-5">
<i class="ri-check-line ri-lg text-primary"></i>
</div>
<span>Akses offline</span>
<div class="mx-2 w-1 h-1 bg-gray-400 rounded-full"></div>
<div class="flex items-center justify-center w-5 h-5">
<i class="ri-check-line ri-lg text-primary"></i>
</div>
<span>Integrasi dengan LMS</span>
</div>
</div>
</div>
</section>
<!-- Search Section -->
<section class="py-8 bg-white">
<div class="container mx-auto px-4">
<div class="bg-white rounded-xl shadow-md p-6">
<div class="relative mb-6">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<i class="ri-search-line ri-lg text-gray-500"></i>
</div>
<input type="search" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="Cari materi kuliah, modul, atau topik...">
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
<div class="relative">
<select id="fakultas-select" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Fakultas</option>
<option value="teknik">Fakultas Teknik</option>
<option value="ekonomi">Fakultas Ekonomi</option>
<option value="kedokteran">Fakultas Kedokteran</option>
<option value="hukum">Fakultas Hukum</option>
<option value="ilmu-komputer">Fakultas Ilmu Komputer</option>
<option value="mipa">Fakultas MIPA</option>
<option value="other">Lainnya</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
<input type="text" id="fakultas-other" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary hidden" placeholder="Masukkan nama fakultas...">
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
<div class="relative">
<select id="jurusan-select" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Jurusan</option>
<option value="teknik-informatika">Teknik Informatika</option>
<option value="sistem-informasi">Sistem Informasi</option>
<option value="teknik-elektro">Teknik Elektro</option>
<option value="teknik-sipil">Teknik Sipil</option>
<option value="manajemen">Manajemen</option>
<option value="akuntansi">Akuntansi</option>
<option value="ekonomi-pembangunan">Ekonomi Pembangunan</option>
<option value="kedokteran-umum">Kedokteran Umum</option>
<option value="kedokteran-gigi">Kedokteran Gigi</option>
<option value="hukum">Ilmu Hukum</option>
<option value="matematika">Matematika</option>
<option value="fisika">Fisika</option>
<option value="kimia">Kimia</option>
<option value="biologi">Biologi</option>
<option value="other">Lainnya</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
<input type="text" id="jurusan-other" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary hidden" placeholder="Masukkan nama jurusan...">
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
<div class="relative">
<select class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Semester</option>
<option value="1">Semester 1</option>
<option value="2">Semester 2</option>
<option value="3">Semester 3</option>
<option value="4">Semester 4</option>
<option value="5">Semester 5</option>
<option value="6">Semester 6</option>
<option value="7">Semester 7</option>
<option value="8">Semester 8</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
<div class="relative">
<select id="matkul-select" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Mata Kuliah</option>
<option value="algoritma-struktur-data">Algoritma dan Struktur Data</option>
<option value="basis-data">Basis Data</option>
<option value="pemrograman-web">Pemrograman Web</option>
<option value="jaringan-komputer">Jaringan Komputer</option>
<option value="sistem-operasi">Sistem Operasi</option>
<option value="rekayasa-perangkat-lunak">Rekayasa Perangkat Lunak</option>
<option value="kecerdasan-buatan">Kecerdasan Buatan</option>
<option value="matematika-diskrit">Matematika Diskrit</option>
<option value="statistika">Statistika</option>
<option value="kalkulus">Kalkulus</option>
<option value="fisika-dasar">Fisika Dasar</option>
<option value="kimia-dasar">Kimia Dasar</option>
<option value="ekonomi-mikro">Ekonomi Mikro</option>
<option value="ekonomi-makro">Ekonomi Makro</option>
<option value="manajemen-keuangan">Manajemen Keuangan</option>
<option value="akuntansi-dasar">Akuntansi Dasar</option>
<option value="anatomi">Anatomi</option>
<option value="fisiologi">Fisiologi</option>
<option value="farmakologi">Farmakologi</option>
<option value="hukum-perdata">Hukum Perdata</option>
<option value="hukum-pidana">Hukum Pidana</option>
<option value="other">Lainnya</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
<i class="ri-arrow-down-s-line text-gray-500"></i>
</div>
</div>
<input type="text" id="matkul-other" class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary hidden" placeholder="Masukkan nama mata kuliah...">
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-4">
<label class="inline-flex items-center">
<input type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
<span class="ml-2 text-sm text-gray-700">Hanya materi terverifikasi dosen</span>
</label>
</div>
<button class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-search-line ri-lg"></i>
Cari Materi
</button>
</div>
</div>
</div>
</section>
<!-- Featured Materials Section -->
<section class="py-12 bg-white">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-gray-900">Materi Populer</h2>
<a href="{{ route('materials.index') }}" class="text-primary font-medium flex items-center gap-1 hover:underline">
Lihat Semua
<i class="ri-arrow-right-line"></i>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Material Card 1 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="h-40 bg-gradient-to-br from-blue-50 to-indigo-100 relative flex items-center justify-center">
<div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center">
<i class="ri-code-s-slash-line ri-2x text-white"></i>
</div>
<div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
</div>
<div class="p-5">
<div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
<span>Teknik Informatika</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Semester 3</span>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Algoritma dan Struktur Data</h3>
<p class="text-gray-600 text-sm mb-4">Kumpulan materi lengkap tentang algoritma sorting, searching, dan implementasi struktur data.</p>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=4&orientation=squarish" alt="Dr. Siti Rahayu" class="w-full h-full object-cover">
</div>
<div>
<p class="text-xs text-gray-900 font-medium">Dr. Siti Rahayu</p>
<p class="text-xs text-gray-500">Dosen</p>
</div>
</div>
<div class="flex items-center gap-3">
<div class="flex items-center text-amber-500">
<i class="ri-star-fill"></i>
<span class="text-xs font-medium ml-1">4.8</span>
</div>
<span class="text-xs text-gray-500">1.2k unduhan</span>
</div>
</div>
</div>
</div>

<!-- Material Card 2 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="h-40 bg-gradient-to-br from-green-50 to-emerald-100 relative flex items-center justify-center">
<div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
<i class="ri-building-line ri-2x text-white"></i>
</div>
<div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
</div>
<div class="p-5">
<div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
<span>Ekonomi</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Semester 2</span>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Ekonomi Mikro</h3>
<p class="text-gray-600 text-sm mb-4">Materi kuliah lengkap tentang teori permintaan dan penawaran, elastisitas, serta struktur pasar.</p>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=6&orientation=squarish" alt="Anita Wijaya" class="w-full h-full object-cover">
</div>
<div>
<p class="text-xs text-gray-900 font-medium">Anita Wijaya</p>
<p class="text-xs text-gray-500">Mahasiswa</p>
</div>
</div>
<div class="flex items-center gap-3">
<div class="flex items-center text-amber-500">
<i class="ri-star-fill"></i>
<span class="text-xs font-medium ml-1">4.6</span>
</div>
<span class="text-xs text-gray-500">987 unduhan</span>
</div>
</div>
</div>
</div>

<!-- Material Card 3 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="h-40 bg-gradient-to-br from-red-50 to-pink-100 relative flex items-center justify-center">
<div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center">
<i class="ri-heart-pulse-line ri-2x text-white"></i>
</div>
</div>
<div class="p-5">
<div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
<span>Kedokteran</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Semester 1</span>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Anatomi Manusia</h3>
<p class="text-gray-600 text-sm mb-4">Rangkuman materi anatomi tubuh manusia dengan ilustrasi detail sistem organ dan jaringan.</p>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=8&orientation=squarish" alt="Reza Pratama" class="w-full h-full object-cover">
</div>
<div>
<p class="text-xs text-gray-900 font-medium">Reza Pratama</p>
<p class="text-xs text-gray-500">Mahasiswa</p>
</div>
</div>
<div class="flex items-center gap-3">
<div class="flex items-center text-amber-500">
<i class="ri-star-fill"></i>
<span class="text-xs font-medium ml-1">4.7</span>
</div>
<span class="text-xs text-gray-500">756 unduhan</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- Categories Section -->
<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">
<div class="text-center mb-10">
<h2 class="text-2xl font-bold text-gray-900 mb-3">Jelajahi Berdasarkan Fakultas</h2>
<p class="text-gray-600 max-w-2xl mx-auto">Temukan materi kuliah yang terorganisir berdasarkan fakultas dan jurusan untuk memudahkan pencarian Anda</p>
</div>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
<!-- Category 1 -->
<div class="bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-md transition-shadow flex flex-col items-center">
<div class="w-16 h-16 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full mb-4">
<i class="ri-code-s-slash-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Ilmu Komputer</h3>
<p class="text-sm text-gray-500">142 materi</p>
</div>

<!-- Category 2 -->
<div class="bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-md transition-shadow flex flex-col items-center">
<div class="w-16 h-16 flex items-center justify-center bg-green-100 text-green-600 rounded-full mb-4">
<i class="ri-building-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Ekonomi</h3>
<p class="text-sm text-gray-500">98 materi</p>
</div>

<!-- Category 3 -->
<div class="bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-md transition-shadow flex flex-col items-center">
<div class="w-16 h-16 flex items-center justify-center bg-red-100 text-red-600 rounded-full mb-4">
<i class="ri-heart-pulse-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Kedokteran</h3>
<p class="text-sm text-gray-500">76 materi</p>
</div>

<!-- Category 4 -->
<div class="bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-md transition-shadow flex flex-col items-center">
<div class="w-16 h-16 flex items-center justify-center bg-purple-100 text-purple-600 rounded-full mb-4">
<i class="ri-scales-3-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Hukum</h3>
<p class="text-sm text-gray-500">63 materi</p>
</div>

<!-- Category 5 -->
<div class="bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-md transition-shadow flex flex-col items-center">
<div class="w-16 h-16 flex items-center justify-center bg-amber-100 text-amber-600 rounded-full mb-4">
<i class="ri-hammer-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Teknik</h3>
<p class="text-sm text-gray-500">114 materi</p>
</div>

<!-- Category 6 -->
<div class="bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-md transition-shadow flex flex-col items-center">
<div class="w-16 h-16 flex items-center justify-center bg-teal-100 text-teal-600 rounded-full mb-4">
<i class="ri-microscope-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">MIPA</h3>
<p class="text-sm text-gray-500">87 materi</p>
</div>
</div>
</div>
</section>

<!-- Verified Materials Section -->
<section class="py-12 bg-white">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<div>
<h2 class="text-2xl font-bold text-gray-900 mb-1">Materi Terverifikasi</h2>
<p class="text-gray-600">Materi yang telah diverifikasi oleh dosen dan institusi pendidikan</p>
</div>
<a href="{{ route('materials.index', ['verified' => 1]) }}" class="text-primary font-medium flex items-center gap-1 hover:underline">
Lihat Semua
<i class="ri-arrow-right-line"></i>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
<!-- Verified Material 1 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="p-5">
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-2">
<div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
<i class="ri-file-text-line"></i>
</div>
<span class="text-sm font-medium text-gray-900">PDF</span>
</div>
<div class="bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
</div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Pengantar Kecerdasan Buatan</h3>
<div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
<span>Teknik Informatika</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Semester 5</span>
</div>
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-1 text-amber-500 text-sm">
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-half-fill"></i>
</div>
<span class="text-xs text-gray-500">532 unduhan</span>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=9&orientation=squarish" alt="Prof. Dr. Hadi Wibowo" class="w-full h-full object-cover">
</div>
<p class="text-xs text-gray-900">Prof. Dr. Hadi Wibowo</p>
</div>
<button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
<i class="ri-download-line text-gray-700"></i>
</button>
</div>
</div>
</div>

<!-- Verified Material 2 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="p-5">
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-2">
<div class="w-8 h-8 flex items-center justify-center bg-green-100 text-green-600 rounded-full">
<i class="ri-file-excel-2-line"></i>
</div>
<span class="text-sm font-medium text-gray-900">XLSX</span>
</div>
<div class="bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
</div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Data Statistik Ekonomi</h3>
<div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
<span>Ekonomi</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Semester 4</span>
</div>
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-1 text-amber-500 text-sm">
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-line"></i>
</div>
<span class="text-xs text-gray-500">421 unduhan</span>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=10&orientation=squarish" alt="Dr. Maya Kusuma" class="w-full h-full object-cover">
</div>
<p class="text-xs text-gray-900">Dr. Maya Kusuma</p>
</div>
<button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
<i class="ri-download-line text-gray-700"></i>
</button>
</div>
</div>
</div>

<!-- Verified Material 3 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="p-5">
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-2">
<div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
<i class="ri-file-word-line"></i>
</div>
<span class="text-sm font-medium text-gray-900">DOCX</span>
</div>
<div class="bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
</div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Hukum Perdata Indonesia</h3>
<div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
<span>Hukum</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Semester 3</span>
</div>
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-1 text-amber-500 text-sm">
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
</div>
<span class="text-xs text-gray-500">389 unduhan</span>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=11&orientation=squarish" alt="Dr. Budi Santoso" class="w-full h-full object-cover">
</div>
<p class="text-xs text-gray-900">Dr. Budi Santoso</p>
</div>
<button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
<i class="ri-download-line text-gray-700"></i>
</button>
</div>
</div>
</div>

<!-- Verified Material 4 -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
<div class="p-5">
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-2">
<div class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-600 rounded-full">
<i class="ri-file-pdf-line"></i>
</div>
<span class="text-sm font-medium text-gray-900">PDF</span>
</div>
<div class="bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
</div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Farmakologi Dasar</h3>
<div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
<span>Kedokteran</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>Semester 2</span>
</div>
<div class="flex items-center justify-between mb-3">
<div class="flex items-center gap-1 text-amber-500 text-sm">
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-fill"></i>
<i class="ri-star-half-fill"></i>
</div>
<span class="text-xs text-gray-500">476 unduhan</span>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=12&orientation=squarish" alt="Prof. Dr. Ratna Dewi" class="w-full h-full object-cover">
</div>
<p class="text-xs text-gray-900">Prof. Dr. Ratna Dewi</p>
</div>
<button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
<i class="ri-download-line text-gray-700"></i>
</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Recent Activity Section -->
<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<div>
<h2 class="text-2xl font-bold text-gray-900 mb-1">Aktivitas Terkini</h2>
<p class="text-gray-600">Materi dan diskusi terbaru dari pengguna yang Anda ikuti</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Recent Materials Column -->
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between mb-5">
<h3 class="font-semibold text-gray-900">Materi Terbaru</h3>
<a href="#" class="text-primary text-sm hover:underline">Lihat Semua</a>
</div>
<div class="space-y-4">
<!-- Recent Material Items -->
<div class="flex gap-3 pb-4 border-b border-gray-100">
<div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-purple-100 text-purple-600 rounded-lg">
<i class="ri-file-text-line"></i>
</div>
<div class="flex-grow min-w-0">
<h4 class="text-sm font-medium text-gray-900 truncate">Teori Komunikasi Massa</h4>
<div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
<span>Ilmu Komunikasi</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>15 menit yang lalu</span>
</div>
</div>
</div>
</div>
</div>

<!-- Recent Discussions Column -->
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between mb-5">
<h3 class="font-semibold text-gray-900">Diskusi Terbaru</h3>
<a href="#" class="text-primary text-sm hover:underline">Lihat Semua</a>
</div>
<div class="space-y-4">
<!-- Discussion Items -->
<div class="pb-4 border-b border-gray-100">
<div class="flex items-center gap-2 mb-2">
<div class="w-6 h-6 rounded-full overflow-hidden">
<img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20avatar&width=100&height=100&seq=13&orientation=squarish" alt="User" class="w-full h-full object-cover">
</div>
<span class="text-sm font-medium text-gray-900">Dian Permata</span>
<span class="text-xs text-gray-500">20 menit yang lalu</span>
</div>
<h4 class="text-sm font-medium text-gray-900 mb-1">Algoritma Dijkstra untuk Shortest Path</h4>
<p class="text-xs text-gray-600 mb-2">Bagaimana implementasi algoritma Dijkstra untuk mencari jalur terpendek dalam graf berbobot?</p>
<div class="flex items-center gap-3 text-xs">
<div class="flex items-center gap-1 text-gray-500">
<i class="ri-message-3-line"></i>
<span>8 balasan</span>
</div>
<div class="flex items-center gap-1 text-gray-500">
<i class="ri-eye-line"></i>
<span>42 dilihat</span>
</div>
</div>
</div>
</div>
</div>

<!-- Learning Analytics Column -->
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between mb-5">
<h3 class="font-semibold text-gray-900">Analitik Pembelajaran</h3>
<a href="{{ route('analytics.index') }}" class="text-primary text-sm hover:underline">Detail</a>
</div>
<div class="mb-6">
<div class="flex items-center justify-between mb-2">
<h4 class="text-sm font-medium text-gray-900">Aktivitas Mingguan</h4>
<span class="text-xs text-green-600 font-medium">+12% dari minggu lalu</span>
</div>
<div id="weeklyActivityChart" class="h-48"></div>
</div>
</div>
</div>
</div>
</section>
<!-- Features Section -->
<section class="py-12 bg-white">
<div class="container mx-auto px-4">
<div class="text-center mb-10">
<h2 class="text-2xl font-bold text-gray-900 mb-3">Fitur Unggulan Academy Bridge</h2>
<p class="text-gray-600 max-w-2xl mx-auto">Platform berbagi materi kuliah dengan berbagai fitur inovatif untuk mendukung pembelajaran akademik</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Feature 1 -->
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
<div class="w-12 h-12 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-lg mb-4">
<i class="ri-verified-badge-line ri-lg"></i>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Materi Terverifikasi</h3>
<p class="text-gray-600">Akses materi kuliah yang telah diverifikasi oleh dosen dan institusi pendidikan untuk menjamin kualitas dan keakuratan konten.</p>
</div>

<!-- Feature 2 -->
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
<div class="w-12 h-12 flex items-center justify-center bg-green-100 text-green-600 rounded-lg mb-4">
<i class="ri-discuss-line ri-lg"></i>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Forum Diskusi</h3>
<p class="text-gray-600">Berpartisipasi dalam forum diskusi untuk berbagi pemahaman, mengajukan pertanyaan, dan berkolaborasi dengan sesama mahasiswa.</p>
</div>

<!-- Feature 3 -->
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
<div class="w-12 h-12 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg mb-4">
<i class="ri-wifi-off-line ri-lg"></i>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Akses Offline</h3>
<p class="text-gray-600">Unduh materi kuliah untuk diakses tanpa koneksi internet, mendukung pembelajaran di mana saja dan kapan saja.</p>
</div>

<!-- Feature 4 -->
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
<div class="w-12 h-12 flex items-center justify-center bg-purple-100 text-purple-600 rounded-lg mb-4">
<i class="ri-search-eye-line ri-lg"></i>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Pencarian Cerdas</h3>
<p class="text-gray-600">Temukan materi yang Anda butuhkan dengan cepat menggunakan fitur pencarian cerdas berbasis AI dengan filter komprehensif.</p>
</div>

<!-- Feature 5 -->
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
<div class="w-12 h-12 flex items-center justify-center bg-amber-100 text-amber-600 rounded-lg mb-4">
<i class="ri-line-chart-line ri-lg"></i>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Analitik Pembelajaran</h3>
<p class="text-gray-600">Dapatkan wawasan tentang pola belajar, kemajuan pemahaman materi, dan rekomendasi konten berdasarkan aktivitas Anda.</p>
</div>

<!-- Feature 6 -->
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
<div class="w-12 h-12 flex items-center justify-center bg-teal-100 text-teal-600 rounded-lg mb-4">
<i class="ri-cloud-line ri-lg"></i>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Integrasi dengan LMS</h3>
<p class="text-gray-600">Hubungkan dengan Learning Management System seperti Google Classroom dan Moodle untuk sinkronisasi materi perkuliahan.</p>
</div>
</div>
</div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-br from-teal-50 via-blue-50 to-emerald-50">
<div class="container mx-auto px-4">
<div class="max-w-3xl mx-auto text-center">
<h2 class="text-3xl font-bold text-gray-900 mb-4">Bergabunglah dengan Komunitas Akademik Kami</h2>
<p class="text-lg text-gray-600 mb-8">Akses ribuan materi kuliah, berkolaborasi dengan mahasiswa dan dosen dari berbagai institusi, dan tingkatkan pengalaman belajar Anda.</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<a href="{{ route('materials.index') }}" class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center justify-center gap-2 whitespace-nowrap hover:bg-primary/90">
<i class="ri-search-line ri-lg"></i>
Jelajahi Materi
</a>
<a href="{{ route('materials.create') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-button font-medium flex items-center justify-center gap-2 whitespace-nowrap hover:bg-gray-50">
<i class="ri-upload-line ri-lg"></i>
Upload Materi
</a>
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
<div class="flex gap-4">
<a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 hover:bg-gray-700">
<i class="ri-facebook-fill text-white"></i>
</a>
<a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 hover:bg-gray-700">
<i class="ri-twitter-x-fill text-white"></i>
</a>
<a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 hover:bg-gray-700">
<i class="ri-instagram-line text-white"></i>
</a>
<a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 hover:bg-gray-700">
<i class="ri-linkedin-fill text-white"></i>
</a>
</div>
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
<li class="flex items-center gap-2">
<i class="ri-map-pin-line text-gray-400"></i>
<span class="text-gray-400">Jl. Pendidikan No. 123, Jakarta, Indonesia</span>
</li>
</ul>
</div>
</div>

<div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
<p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; 2025 Academy Bridge. Hak Cipta Dilindungi.</p>
<div class="flex gap-4">
<a href="#" class="text-gray-400 hover:text-white text-sm">Syarat & Ketentuan</a>
<a href="#" class="text-gray-400 hover:text-white text-sm">Kebijakan Privasi</a>
<a href="#" class="text-gray-400 hover:text-white text-sm">FAQ</a>
</div>
</div>
</div>
</footer>
<script>
document.addEventListener('DOMContentLoaded', function() {
// Weekly Activity Chart with error handling
try {
const chartElement = document.getElementById('weeklyActivityChart');
if (chartElement && typeof echarts !== 'undefined') {
const weeklyActivityChart = echarts.init(chartElement);
const weeklyActivityOption = {
animation: false,
grid: { top: 10, right: 10, bottom: 20, left: 40 },
color: ['#4F9DA6'],
xAxis: { 
type: 'category', 
data: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'], 
axisLine: { lineStyle: { color: '#d1d5db' } }, 
axisLabel: { color: '#1f2937' } 
},
yAxis: { 
type: 'value', 
axisLine: { show: false }, 
axisLabel: { color: '#1f2937' }, 
splitLine: { lineStyle: { color: '#e5e7eb' } } 
},
tooltip: { 
trigger: 'axis', 
backgroundColor: 'rgba(255, 255, 255, 0.8)', 
borderColor: '#e5e7eb', 
textStyle: { color: '#1f2937' } 
},
series: [{ 
data: [5, 8, 12, 6, 10, 4, 7], 
type: 'line', 
smooth: true, 
symbol: 'none', 
lineStyle: { color: 'rgba(79, 157, 166, 1)' }, 
areaStyle: { 
color: { 
type: 'linear', 
x: 0, y: 0, x2: 0, y2: 1, 
colorStops: [
{ offset: 0, color: 'rgba(79, 157, 166, 0.2)' }, 
{ offset: 1, color: 'rgba(79, 157, 166, 0.05)' }
] 
} 
} 
}]
};
weeklyActivityChart.setOption(weeklyActivityOption);

// Handle window resize for charts
window.addEventListener('resize', function() {
if (weeklyActivityChart) {
weeklyActivityChart.resize();
}
});
}
} catch (error) {
console.warn('Chart initialization failed:', error);
}

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

// Custom checkboxes with error handling
try {
const customCheckboxes = document.querySelectorAll('.custom-checkbox');
customCheckboxes.forEach(checkbox => {
checkbox.addEventListener('click', function() {
this.classList.toggle('checked');
const input = this.previousElementSibling;
if (input && input.type === 'checkbox') {
input.checked = !input.checked;
}
});
});
} catch (error) {
console.warn('Error setting up custom checkboxes:', error);
}

// Custom switches with error handling
try {
const customSwitches = document.querySelectorAll('.custom-switch');
customSwitches.forEach(switchEl => {
switchEl.addEventListener('click', function() {
this.classList.toggle('active');
const input = this.previousElementSibling;
if (input && input.type === 'checkbox') {
input.checked = !input.checked;
}
});
});
} catch (error) {
console.warn('Error setting up custom switches:', error);
}

// Custom radios with error handling
try {
const customRadios = document.querySelectorAll('.custom-radio');
customRadios.forEach(radio => {
radio.addEventListener('click', function() {
const name = this.dataset.name;
if (name) {
document.querySelectorAll(`.custom-radio[data-name="${name}"]`).forEach(r => {
r.classList.remove('checked');
});
}
this.classList.add('checked');
const input = this.previousElementSibling;
if (input && input.type === 'radio') {
input.checked = true;
}
});
});
} catch (error) {
console.warn('Error setting up custom radios:', error);
}
});
</script>
</body>
</html>
