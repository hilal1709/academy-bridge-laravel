<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Materi Terverifikasi - Academy Bridge</title>
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
<h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-2">
<i class="ri-verified-badge-line text-green-500"></i>
Materi Terverifikasi
</h1>
<p class="text-gray-600">Koleksi materi yang telah diverifikasi dan disetujui oleh dosen</p>
</div>
<div class="flex items-center gap-3">
@if(Auth::user()->isLecturer())
<a href="{{ route('materials.pending-verification') }}" 
   class="bg-yellow-500 text-white px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-yellow-600">
<i class="ri-time-line"></i>
Menunggu Verifikasi
</a>
@endif
<a href="{{ route('materials.index') }}" 
   class="bg-gray-500 text-white px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-gray-600">
<i class="ri-arrow-left-line"></i>
Semua Materi
</a>
</div>
</div>
</div>
</section>

<!-- Verified Materials Grid -->
<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-gray-900">Materi Berkualitas Terverifikasi</h2>
<span class="text-sm text-gray-600">{{ $materials->total() }} materi terverifikasi</span>
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
<div class="bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
<i class="ri-verified-badge-line"></i>
Terverifikasi
</div>
</div>

<h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $material->title }}</h3>
<p class="text-gray-600 text-sm mb-4">{{ Str::limit($material->description, 100) }}</p>

<div class="space-y-2 mb-4 text-xs text-gray-600">
<div class="flex items-center justify-between">
<span>Fakultas:</span>
<span class="font-medium">{{ Str::limit($material->fakultas, 20) }}</span>
</div>
<div class="flex items-center justify-between">
<span>Jurusan:</span>
<span class="font-medium">{{ Str::limit($material->jurusan, 20) }}</span>
</div>
<div class="flex items-center justify-between">
<span>Semester:</span>
<span class="font-medium">{{ $material->semester }}</span>
</div>
<div class="flex items-center justify-between">
<span>Mata Kuliah:</span>
<span class="font-medium">{{ Str::limit($material->mata_kuliah, 20) }}</span>
</div>
</div>

@if($material->verifications->isNotEmpty())
<div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
<div class="flex items-center gap-2 mb-1">
<i class="ri-user-line text-green-600 text-sm"></i>
<span class="text-sm font-medium text-green-800">
Diverifikasi oleh: {{ $material->verifications->first()->verifier->name }}
</span>
</div>
<span class="text-xs text-green-600">
{{ $material->verifications->first()->created_at->format('d M Y, H:i') }}
</span>
@if($material->verifications->first()->comments)
<p class="text-sm text-green-700 mt-2">
"{{ $material->verifications->first()->comments }}"
</p>
@endif
</div>
@endif

<div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
<span>{{ $material->course->name ?? 'Unknown Course' }}</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span>{{ $material->downloads_count ?? 0 }} unduhan</span>
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
<i class="ri-bookmark-line text-gray-700"></i>
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
<i class="ri-verified-badge-line ri-2x text-gray-400"></i>
</div>
<h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada materi terverifikasi</h3>
<p class="text-gray-500">Materi yang telah diverifikasi oleh dosen akan muncul di sini.</p>
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
<li><a href="{{ route('materials.verified') }}" class="text-gray-400 hover:text-white">Materi Terverifikasi</a></li>
<li><a href="{{ route('materials.create') }}" class="text-gray-400 hover:text-white">Upload Materi</a></li>
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
</body>
</html>