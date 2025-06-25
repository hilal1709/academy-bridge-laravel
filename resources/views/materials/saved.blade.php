<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Materi Tersimpan - Academy Bridge</title>
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
<!-- Page Header -->
<section class="py-8 bg-white border-b border-gray-100">
<div class="container mx-auto px-4">
<div class="flex justify-between items-center">
<div>
<h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('app.saved_materials') }}</h1>
<p class="text-gray-600">Koleksi materi kuliah yang telah Anda simpan untuk akses cepat</p>
</div>
<div>
<a href="{{ route('materials.index') }}" 
   class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-search-line ri-lg"></i>
Jelajahi Materi
</a>
</div>
</div>
</div>
</section>

<!-- Saved Materials Grid -->
<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-gray-900">Materi Tersimpan</h2>
<div class="flex items-center gap-4">
<span class="text-sm text-gray-600">{{ $materials->total() }} materi tersimpan</span>
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
@forelse($materials as $material)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
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

<div class="text-sm text-gray-500 mb-4">
<div class="flex items-center gap-2 mb-1">
<i class="ri-book-line text-gray-400"></i>
<span>{{ $material->course->name }}</span>
</div>
<div class="flex items-center gap-2 mb-1">
<i class="ri-user-line text-gray-400"></i>
<span>{{ $material->user->name }}</span>
</div>
<div class="flex items-center gap-2">
<i class="ri-download-line text-gray-400"></i>
<span>{{ $material->downloads_count }} unduhan</span>
</div>
</div>

<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<x-user-avatar :user="$material->user" size="sm" />
<p class="text-xs text-gray-900">{{ $material->user->name }}</p>
</div>
<div class="flex items-center gap-2">
<a href="{{ route('materials.show', $material) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
Lihat Detail
</a>
<form action="{{ route('materials.toggle-save', $material) }}" method="POST" class="inline">
@csrf
<button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200" title="Hapus dari tersimpan">
<i class="ri-bookmark-fill text-gray-700"></i>
</button>
</form>
</div>
</div>
</div>
</div>
@empty
<div class="col-span-3 text-center py-12">
<div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full">
<i class="ri-bookmark-line ri-2x text-gray-400"></i>
</div>
<h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada materi tersimpan</h3>
<p class="text-gray-500 mb-6">Mulai simpan materi kuliah yang menarik untuk akses cepat di kemudian hari</p>
<a href="{{ route('materials.index') }}" class="bg-primary text-white px-6 py-3 rounded-button font-medium inline-flex items-center gap-2 hover:bg-primary/90">
<i class="ri-search-line ri-lg"></i>
Jelajahi Materi
</a>
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
</body>
</html> 