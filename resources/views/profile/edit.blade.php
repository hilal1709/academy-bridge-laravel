<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil - Academy Bridge</title>
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
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
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
<a href="{{ route('profile.edit') }}" class="font-medium text-gray-900 border-b-2 border-primary pb-1">Profil</a>
</nav>
<div class="flex items-center gap-3">
<button class="hidden md:flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200">
<i class="ri-notification-3-line ri-lg text-gray-700"></i>
</button>
<div class="relative">
<button class="flex items-center gap-2">
<x-user-avatar :user="Auth::user()" size="md" />
<span class="hidden md:block font-medium">{{ Auth::user()->name }}</span>
<i class="ri-arrow-down-s-line ri-lg text-gray-600"></i>
</button>
</div>
</div>
</div>
</header>

<main>
<!-- Profile Header -->
<section class="py-8 bg-white border-b border-gray-100">
<div class="container mx-auto px-4">
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
<div class="flex items-center gap-4">
<x-user-avatar :user="Auth::user()" size="xl" />
<div>
<h1 class="text-3xl font-bold text-gray-900 mb-2">{{ Auth::user()->name }}</h1>
<p class="text-gray-600 mb-1">{{ Auth::user()->email }}</p>
<div class="flex items-center gap-2">
<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
@if(Auth::user()->isLecturer())
<i class="ri-user-star-line mr-1"></i>
Dosen
@else
<i class="ri-graduation-cap-line mr-1"></i>
Mahasiswa
@endif
</span>
<span class="text-sm text-gray-500">Bergabung {{ Auth::user()->created_at->format('M Y') }}</span>
</div>
</div>
</div>
<div class="flex gap-3">
<button onclick="scrollToEditForm()" class="bg-primary text-white px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-edit-line"></i>
Edit Profil
</button>
<button onclick="toggleSettingsModal()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-gray-50">
<i class="ri-settings-line"></i>
Pengaturan
</button>
</div>
</div>
</div>
</section>

<!-- Profile Content -->
<section class="py-8 bg-gray-50">
<div class="container mx-auto px-4">
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Main Content -->
<div class="lg:col-span-2 space-y-6">
<!-- Profile Statistics -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
<h2 class="text-xl font-bold text-gray-900 mb-6">Statistik Aktivitas</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="text-center">
<div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
<i class="ri-file-text-line ri-2x"></i>
</div>
<div class="text-2xl font-bold text-gray-900">{{ Auth::user()->materials()->count() }}</div>
<div class="text-sm text-gray-600">Materi Dibagikan</div>
</div>
<div class="text-center">
<div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
<i class="ri-bookmark-line ri-2x"></i>
</div>
<div class="text-2xl font-bold text-gray-900">{{ $savedMaterials->total() }}</div>
<div class="text-sm text-gray-600">Materi Tersimpan</div>
</div>
<div class="text-center">
<div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
<i class="ri-discuss-line ri-2x"></i>
</div>
<div class="text-2xl font-bold text-gray-900">{{ Auth::user()->discussions()->count() }}</div>
<div class="text-sm text-gray-600">Diskusi Dibuat</div>
</div>
</div>
</div>

<!-- Avatar Update Form -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
<div class="p-6">
<h2 class="text-xl font-bold text-gray-900 mb-6">Foto Profil</h2>
@include('profile.partials.update-avatar-form')
</div>
</div>

<!-- Profile Information Form -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
<div class="p-6">
<h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Profil</h2>
@include('profile.partials.update-profile-information-form')
</div>
</div>

<!-- Password Update Form -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
<div class="p-6">
<h2 class="text-xl font-bold text-gray-900 mb-6">Ubah Password</h2>
@include('profile.partials.update-password-form')
</div>
</div>

<!-- Account Deletion Form -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
<div class="p-6">
<h2 class="text-xl font-bold text-gray-900 mb-6">Hapus Akun</h2>
@include('profile.partials.delete-user-form')
</div>
</div>
</div>

<!-- Sidebar -->
<div class="lg:col-span-1 space-y-6">
<!-- Saved Materials -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-8">
<div class="p-6">
<div class="flex items-center justify-between mb-6">
<h2 class="text-xl font-bold text-gray-900">Materi Tersimpan</h2>
<a href="{{ route('materials.saved') }}" class="text-primary text-sm hover:underline">Lihat Semua</a>
</div>
@if ($savedMaterials && $savedMaterials->count() > 0)
<div class="space-y-4">
@foreach ($savedMaterials->take(5) as $material)
<div class="flex items-start space-x-3 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
<div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg">
<i class="ri-file-text-line"></i>
</div>
<div class="flex-1 min-w-0">
<h3 class="text-sm font-semibold text-gray-900 truncate">{{ $material->title }}</h3>
<p class="text-xs text-gray-600 mt-1">{{ Str::limit($material->description, 50) }}</p>
<div class="flex items-center gap-2 mt-2">
<span class="text-xs text-gray-500">{{ $material->fakultas ?? 'Umum' }}</span>
<div class="w-1 h-1 bg-gray-400 rounded-full"></div>
<span class="text-xs text-gray-500">{{ $material->created_at->diffForHumans() }}</span>
</div>
<div class="flex items-center gap-3 mt-2">
<a href="{{ route('materials.show', $material) }}" class="text-primary hover:text-primary/80 text-xs font-medium">
Lihat Detail
</a>
<form action="{{ route('materials.toggle-save', $material) }}" method="POST" class="inline">
@csrf
<button type="submit" class="text-gray-500 hover:text-gray-700 text-xs">
<i class="ri-bookmark-fill"></i>
</button>
</form>
</div>
</div>
</div>
@endforeach
</div>
@if($savedMaterials->total() > 5)
<div class="mt-4 pt-4 border-t border-gray-100 text-center">
<a href="{{ route('materials.saved') }}" class="text-primary hover:text-primary/80 text-sm font-medium">
Lihat {{ $savedMaterials->total() - 5 }} materi lainnya
</a>
</div>
@endif
@else
<div class="text-center py-8">
<div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
<i class="ri-bookmark-line text-gray-400 text-xl"></i>
</div>
<p class="text-gray-500 text-sm mb-3">Belum ada materi tersimpan</p>
<a href="{{ route('materials.index') }}" class="inline-block text-primary hover:text-primary/80 text-sm font-medium">
Jelajahi Materi
</a>
</div>
@endif
</div>
</div>

<!-- Recent Activity -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
<div class="p-6">
<h2 class="text-xl font-bold text-gray-900 mb-6">Aktivitas Terkini</h2>
<div class="space-y-4">
@if(Auth::user()->materials()->latest()->take(3)->count() > 0)
@foreach(Auth::user()->materials()->latest()->take(3)->get() as $material)
<div class="flex items-start space-x-3 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
<div class="w-8 h-8 flex-shrink-0 flex items-center justify-center bg-green-100 text-green-600 rounded-full">
<i class="ri-upload-line text-sm"></i>
</div>
<div class="flex-1 min-w-0">
<p class="text-sm text-gray-900">Membagikan materi <span class="font-medium">{{ $material->title }}</span></p>
<p class="text-xs text-gray-500 mt-1">{{ $material->created_at->diffForHumans() }}</p>
</div>
</div>
@endforeach
@else
<div class="text-center py-6">
<div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
<i class="ri-time-line text-gray-400"></i>
</div>
<p class="text-gray-500 text-sm">Belum ada aktivitas</p>
</div>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>

<!-- Settings Modal -->
<div id="settingsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
<div class="flex items-center justify-center min-h-screen p-4">
<div class="bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
<div class="p-6">
<div class="flex items-center justify-between mb-6">
<h2 class="text-xl font-bold text-gray-900">Pengaturan Akun</h2>
<button onclick="toggleSettingsModal()" class="text-gray-400 hover:text-gray-600">
<i class="ri-close-line ri-xl"></i>
</button>
</div>

<div class="space-y-4">
<!-- Pengaturan Privasi -->
<div class="border-b border-gray-100 pb-4">
<h3 class="font-semibold text-gray-900 mb-3">Privasi</h3>
<div class="space-y-3">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-700">Profil Publik</p>
<p class="text-xs text-gray-500">Izinkan orang lain melihat profil Anda</p>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input type="checkbox" class="sr-only peer" checked>
<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-700">Tampilkan Email</p>
<p class="text-xs text-gray-500">Email terlihat di profil publik</p>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input type="checkbox" class="sr-only peer">
<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
</div>
</div>

<!-- Pengaturan Notifikasi -->
<div class="border-b border-gray-100 pb-4">
<h3 class="font-semibold text-gray-900 mb-3">Notifikasi</h3>
<div class="space-y-3">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-700">Email Notifikasi</p>
<p class="text-xs text-gray-500">Terima notifikasi via email</p>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input type="checkbox" class="sr-only peer" checked>
<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-700">Notifikasi Materi Baru</p>
<p class="text-xs text-gray-500">Notifikasi saat ada materi baru</p>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input type="checkbox" class="sr-only peer" checked>
<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
</div>
</div>

<!-- Pengaturan Keamanan -->
<div class="border-b border-gray-100 pb-4">
<h3 class="font-semibold text-gray-900 mb-3">Keamanan</h3>
<div class="space-y-3">
<button class="w-full text-left p-3 rounded-lg border border-gray-200 hover:bg-gray-50 flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-700">Ubah Password</p>
<p class="text-xs text-gray-500">Terakhir diubah 30 hari lalu</p>
</div>
<i class="ri-arrow-right-s-line text-gray-400"></i>
</button>
<button class="w-full text-left p-3 rounded-lg border border-gray-200 hover:bg-gray-50 flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-700">Aktivitas Login</p>
<p class="text-xs text-gray-500">Lihat riwayat login akun</p>
</div>
<i class="ri-arrow-right-s-line text-gray-400"></i>
</button>
</div>
</div>

<!-- Pengaturan Tampilan -->
<div class="pb-4">
<h3 class="font-semibold text-gray-900 mb-3">Tampilan</h3>
<div class="space-y-3">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-700">Mode Gelap</p>
<p class="text-xs text-gray-500">Gunakan tema gelap</p>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input type="checkbox" class="sr-only peer">
<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<div>
<p class="text-sm font-medium text-gray-700 mb-2">Bahasa</p>
<select class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="id">Bahasa Indonesia</option>
<option value="en">English</option>
</select>
</div>
</div>
</div>
</div>

<div class="flex gap-3 pt-4 border-t border-gray-100">
<button onclick="toggleSettingsModal()" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-button font-medium hover:bg-gray-200">
Batal
</button>
<button class="flex-1 bg-primary text-white py-2 px-4 rounded-button font-medium hover:bg-primary/90">
Simpan
</button>
</div>
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
    console.log('Profile page loaded');
    
    // Close modal when clicking outside
    document.getElementById('settingsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            toggleSettingsModal();
        }
    });
});

// Function to scroll to edit form
function scrollToEditForm() {
    const editSection = document.querySelector('.bg-white.rounded-xl.shadow-sm.border.border-gray-100');
    if (editSection) {
        editSection.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
        
        // Add highlight effect
        editSection.classList.add('ring-2', 'ring-primary', 'ring-opacity-50');
        setTimeout(() => {
            editSection.classList.remove('ring-2', 'ring-primary', 'ring-opacity-50');
        }, 2000);
        
        // Focus on first input
        const firstInput = editSection.querySelector('input');
        if (firstInput) {
            setTimeout(() => {
                firstInput.focus();
            }, 500);
        }
    }
}

// Function to toggle settings modal
function toggleSettingsModal() {
    const modal = document.getElementById('settingsModal');
    if (modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Add animation
        setTimeout(() => {
            modal.querySelector('.bg-white').classList.add('animate-pulse');
        }, 100);
    } else {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Handle escape key to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('settingsModal');
        if (!modal.classList.contains('hidden')) {
            toggleSettingsModal();
        }
    }
});

// Preview avatar before upload
document.addEventListener('change', function(e) {
    if (e.target && e.target.id === 'avatar') {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('.w-24.h-24.rounded-full img, .w-24.h-24.rounded-full > div');
                if (preview && preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else if (preview && preview.tagName === 'DIV') {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
                }
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
</body>
</html>