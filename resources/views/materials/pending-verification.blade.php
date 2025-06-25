<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verifikasi Materi - Academy Bridge</title>
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
<i class="ri-shield-check-line text-primary"></i>
Verifikasi Materi
</h1>
<p class="text-gray-600">Kelola dan verifikasi materi yang diunggah mahasiswa</p>
</div>
<div class="flex items-center gap-3">
<a href="{{ route('materials.verified') }}" 
   class="bg-green-500 text-white px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-green-600">
<i class="ri-verified-badge-line"></i>
Materi Terverifikasi
</a>
<a href="{{ route('materials.index') }}" 
   class="bg-gray-500 text-white px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-gray-600">
<i class="ri-arrow-left-line"></i>
Kembali ke Materi
</a>
</div>
</div>
</div>
</section>

<!-- Success/Error Messages -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-4 mt-4">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-4 mt-4">
{{ session('error') }}
</div>
@endif

<!-- Materials Pending Verification -->
<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-gray-900">Materi Menunggu Verifikasi</h2>
<span class="text-sm text-gray-600">{{ $materials->total() }} materi menunggu verifikasi</span>
</div>

@forelse($materials as $material)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6 overflow-hidden">
<div class="p-6">
<div class="flex items-start justify-between mb-4">
<div class="flex-1">
<div class="flex items-center gap-3 mb-2">
<div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
@if(str_contains($material->file_path, '.pdf'))
<i class="ri-file-pdf-line"></i>
@elseif(str_contains($material->file_path, '.ppt') || str_contains($material->file_path, '.pptx'))
<i class="ri-file-ppt-line"></i>
@elseif(str_contains($material->file_path, '.doc') || str_contains($material->file_path, '.docx'))
<i class="ri-file-word-line"></i>
@else
<i class="ri-file-text-line"></i>
@endif
</div>
<div>
<h3 class="text-xl font-semibold text-gray-900">{{ $material->title }}</h3>
<p class="text-sm text-gray-600">Diunggah oleh: {{ $material->user->name }}</p>
</div>
</div>
<div class="flex items-center gap-2">
<span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">
<i class="ri-time-line"></i>
Menunggu Verifikasi
</span>
</div>
</div>

<p class="text-gray-700 mb-4">{{ Str::limit($material->description, 200) }}</p>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 text-sm">
<div>
<span class="font-medium text-gray-600">Fakultas:</span>
<p class="text-gray-900">{{ $material->fakultas }}</p>
</div>
<div>
<span class="font-medium text-gray-600">Jurusan:</span>
<p class="text-gray-900">{{ $material->jurusan }}</p>
</div>
<div>
<span class="font-medium text-gray-600">Semester:</span>
<p class="text-gray-900">{{ $material->semester }}</p>
</div>
<div>
<span class="font-medium text-gray-600">Mata Kuliah:</span>
<p class="text-gray-900">{{ $material->mata_kuliah }}</p>
</div>
</div>

<div class="flex items-center justify-between pt-4 border-t border-gray-100">
<div class="flex items-center gap-4 text-sm text-gray-600">
<span>{{ $material->created_at->format('d M Y, H:i') }}</span>
<span>{{ $material->downloads_count }} unduhan</span>
</div>
<div class="flex items-center gap-3">
<a href="{{ route('materials.show', $material) }}" 
   class="text-primary hover:text-primary/80 font-medium">
Lihat Detail
</a>
<a href="{{ route('materials.download', $material) }}" 
   class="text-blue-600 hover:text-blue-800 font-medium">
<i class="ri-download-line"></i>
Unduh
</a>
<button onclick="openVerificationModal({{ $material->id }}, '{{ $material->title }}')" 
        class="bg-primary text-white px-4 py-2 rounded-button font-medium hover:bg-primary/90">
<i class="ri-shield-check-line"></i>
Verifikasi
</button>
</div>
</div>
</div>
</div>
@empty
<div class="text-center py-12">
<div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full">
<i class="ri-shield-check-line ri-2x text-gray-400"></i>
</div>
<h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada materi yang menunggu verifikasi</h3>
<p class="text-gray-500">Semua materi telah diverifikasi atau belum ada materi yang diunggah.</p>
</div>
@endforelse

<!-- Pagination -->
@if($materials->hasPages())
<div class="mt-8 flex justify-center">
{{ $materials->links() }}
</div>
@endif
</div>
</section>
</main>

<!-- Verification Modal -->
<div id="verificationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
<div class="flex items-center justify-center min-h-screen p-4">
<div class="bg-white rounded-xl shadow-xl max-w-md w-full">
<div class="p-6">
<div class="flex items-center justify-between mb-4">
<h3 class="text-lg font-semibold text-gray-900">Verifikasi Materi</h3>
<button onclick="closeVerificationModal()" class="text-gray-400 hover:text-gray-600">
<i class="ri-close-line ri-lg"></i>
</button>
</div>
<p class="text-gray-600 mb-4">Materi: <span id="materialTitle" class="font-medium"></span></p>
<form id="verificationForm" method="POST">
@csrf
<div class="mb-4">
<label class="block text-sm font-medium text-gray-700 mb-2">Status Verifikasi</label>
<div class="space-y-2">
<label class="flex items-center">
<input type="radio" name="status" value="approved" class="text-primary focus:ring-primary" required>
<span class="ml-2 text-green-600 font-medium">
<i class="ri-check-line"></i>
Setujui Materi
</span>
</label>
<label class="flex items-center">
<input type="radio" name="status" value="rejected" class="text-primary focus:ring-primary" required>
<span class="ml-2 text-red-600 font-medium">
<i class="ri-close-line"></i>
Tolak Materi
</span>
</label>
</div>
</div>
<div class="mb-6">
<label for="comments" class="block text-sm font-medium text-gray-700 mb-1">Komentar (Opsional)</label>
<textarea id="comments" name="comments" rows="3" 
          class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-2.5 px-4"
          placeholder="Berikan komentar atau alasan verifikasi..."></textarea>
</div>
<div class="flex items-center justify-end gap-3">
<button type="button" onclick="closeVerificationModal()" 
        class="px-4 py-2 text-gray-600 hover:text-gray-800">
Batal
</button>
<button type="submit" 
        class="bg-primary text-white px-6 py-2 rounded-button font-medium hover:bg-primary/90">
Simpan Verifikasi
</button>
</div>
</form>
</div>
</div>
</div>
</div>

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
<h3 class="text-lg font-semibold mb-4">Fitur Dosen</h3>
<ul class="space-y-2">
<li><a href="{{ route('materials.pending-verification') }}" class="text-gray-400 hover:text-white">Verifikasi Materi</a></li>
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

<script>
function openVerificationModal(materialId, materialTitle) {
    document.getElementById('materialTitle').textContent = materialTitle;
    document.getElementById('verificationForm').action = `/materials/${materialId}/verify`;
    document.getElementById('verificationModal').classList.remove('hidden');
}

function closeVerificationModal() {
    document.getElementById('verificationModal').classList.add('hidden');
    document.getElementById('verificationForm').reset();
}

// Close modal when clicking outside
document.getElementById('verificationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVerificationModal();
    }
});
</script>
</body>
</html>