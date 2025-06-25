<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifikasi - Academy Bridge</title>
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
<style>
:where([class^="ri-"])::before { content: "\\f3c2"; }
body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
.notification-item:hover { background-color: #f8fafc; }
.notification-unread { background-color: #f0f9ff; border-left: 4px solid #4F9DA6; }
.notification-read { opacity: 0.8; }
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
<a href="{{ route('notifications.index') }}" class="font-medium text-gray-900 border-b-2 border-primary pb-1">Notifikasi</a>
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

<main class="container mx-auto px-4 py-8">
<!-- Page Header -->
<div class="flex items-center justify-between mb-8">
<div>
<h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-3">
<i class="ri-notification-3-line text-primary"></i>
Notifikasi
</h1>
<p class="text-gray-600">Pantau aktivitas terbaru dan update penting dari Academy Bridge</p>
</div>
<div class="flex items-center gap-3">
<button onclick="markAllAsRead()" class="bg-primary text-white px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-primary/90">
<i class="ri-check-double-line"></i>
Tandai Semua Dibaca
</button>
<button onclick="toggleFilter()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-button font-medium flex items-center gap-2 hover:bg-gray-50">
<i class="ri-filter-line"></i>
Filter
</button>
</div>
</div>

<!-- Filter Section (Hidden by default) -->
<div id="filterSection" class="bg-white rounded-xl shadow-sm p-6 mb-6 hidden">
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
<div>
<label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
<select class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Status</option>
<option value="unread">Belum Dibaca</option>
<option value="read">Sudah Dibaca</option>
</select>
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
<select class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Jenis</option>
<option value="material">Materi</option>
<option value="discussion">Diskusi</option>
<option value="system">Sistem</option>
<option value="verification">Verifikasi</option>
</select>
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-2">Waktu</label>
<select class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
<option value="">Semua Waktu</option>
<option value="today">Hari Ini</option>
<option value="week">Minggu Ini</option>
<option value="month">Bulan Ini</option>
</select>
</div>
<div class="flex items-end">
<button class="w-full bg-primary text-white px-4 py-2 rounded-button font-medium hover:bg-primary/90">
Terapkan Filter
</button>
</div>
</div>
</div>

<!-- Notification Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-600">Total Notifikasi</p>
<p class="text-2xl font-bold text-gray-900">24</p>
</div>
<div class="w-12 h-12 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg">
<i class="ri-notification-3-line ri-xl"></i>
</div>
</div>
</div>
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-600">Belum Dibaca</p>
<p class="text-2xl font-bold text-red-600">8</p>
</div>
<div class="w-12 h-12 flex items-center justify-center bg-red-100 text-red-600 rounded-lg">
<i class="ri-notification-badge-line ri-xl"></i>
</div>
</div>
</div>
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-600">Hari Ini</p>
<p class="text-2xl font-bold text-green-600">12</p>
</div>
<div class="w-12 h-12 flex items-center justify-center bg-green-100 text-green-600 rounded-lg">
<i class="ri-calendar-check-line ri-xl"></i>
</div>
</div>
</div>
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-600">Minggu Ini</p>
<p class="text-2xl font-bold text-purple-600">18</p>
</div>
<div class="w-12 h-12 flex items-center justify-center bg-purple-100 text-purple-600 rounded-lg">
<i class="ri-calendar-2-line ri-xl"></i>
</div>
</div>
</div>
</div>

<!-- Notifications List -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
<div class="p-6 border-b border-gray-100">
<h2 class="text-lg font-semibold text-gray-900">Notifikasi Terbaru</h2>
</div>

<div class="divide-y divide-gray-100">
<!-- Unread Notification -->
<div class="notification-item notification-unread p-6 cursor-pointer" onclick="markAsRead(this)">
<div class="flex items-start gap-4">
<div class="w-12 h-12 flex items-center justify-center bg-primary/10 text-primary rounded-full flex-shrink-0">
<i class="ri-file-download-line ri-xl"></i>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-start justify-between">
<div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Materi Berhasil Diunduh</h3>
<p class="text-gray-700 mb-2">Materi "Algoritma dan Struktur Data" telah berhasil diunduh. Anda dapat mengaksesnya secara offline.</p>
<div class="flex items-center gap-4 text-sm text-gray-500">
<span class="flex items-center gap-1">
<i class="ri-time-line"></i>
2 menit yang lalu
</span>
<span class="flex items-center gap-1">
<i class="ri-folder-line"></i>
Materi
</span>
</div>
</div>
<div class="flex items-center gap-2">
<span class="bg-primary text-white text-xs font-medium px-2 py-1 rounded-full">Baru</span>
<button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
<i class="ri-more-2-line text-gray-500"></i>
</button>
</div>
</div>
</div>
</div>

<!-- Unread Notification -->
<div class="notification-item notification-unread p-6 cursor-pointer" onclick="markAsRead(this)">
<div class="flex items-start gap-4">
<div class="w-12 h-12 flex items-center justify-center bg-green-100 text-green-600 rounded-full flex-shrink-0">
<i class="ri-verified-badge-line ri-xl"></i>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-start justify-between">
<div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Materi Terverifikasi</h3>
<p class="text-gray-700 mb-2">Materi "Ekonomi Mikro" Anda telah diverifikasi oleh Dr. Maya Kusuma dan sekarang tersedia untuk publik.</p>
<div class="flex items-center gap-4 text-sm text-gray-500">
<span class="flex items-center gap-1">
<i class="ri-time-line"></i>
15 menit yang lalu
</span>
<span class="flex items-center gap-1">
<i class="ri-shield-check-line"></i>
Verifikasi
</span>
</div>
</div>
<div class="flex items-center gap-2">
<span class="bg-primary text-white text-xs font-medium px-2 py-1 rounded-full">Baru</span>
<button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
<i class="ri-more-2-line text-gray-500"></i>
</button>
</div>
</div>
</div>
</div>

<!-- Unread Notification -->
<div class="notification-item notification-unread p-6 cursor-pointer" onclick="markAsRead(this)">
<div class="flex items-start gap-4">
<div class="w-12 h-12 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full flex-shrink-0">
<i class="ri-discuss-line ri-xl"></i>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-start justify-between">
<div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Balasan Diskusi Baru</h3>
<p class="text-gray-700 mb-2">Dian Permata membalas diskusi Anda tentang "Algoritma Dijkstra untuk Shortest Path".</p>
<div class="flex items-center gap-4 text-sm text-gray-500">
<span class="flex items-center gap-1">
<i class="ri-time-line"></i>
30 menit yang lalu
</span>
<span class="flex items-center gap-1">
<i class="ri-message-3-line"></i>
Diskusi
</span>
</div>
</div>
<div class="flex items-center gap-2">
<span class="bg-primary text-white text-xs font-medium px-2 py-1 rounded-full">Baru</span>
<button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
<i class="ri-more-2-line text-gray-500"></i>
</button>
</div>
</div>
</div>
</div>

<!-- Read Notification -->
<div class="notification-item notification-read p-6 cursor-pointer">
<div class="flex items-start gap-4">
<div class="w-12 h-12 flex items-center justify-center bg-amber-100 text-amber-600 rounded-full flex-shrink-0">
<i class="ri-star-line ri-xl"></i>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-start justify-between">
<div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Rating Materi Baru</h3>
<p class="text-gray-700 mb-2">Materi "Farmakologi Dasar" Anda mendapat rating 5 bintang dari Reza Pratama.</p>
<div class="flex items-center gap-4 text-sm text-gray-500">
<span class="flex items-center gap-1">
<i class="ri-time-line"></i>
1 jam yang lalu
</span>
<span class="flex items-center gap-1">
<i class="ri-star-line"></i>
Rating
</span>
</div>
</div>
<div class="flex items-center gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
<i class="ri-more-2-line text-gray-500"></i>
</button>
</div>
</div>
</div>
</div>

<!-- Read Notification -->
<div class="notification-item notification-read p-6 cursor-pointer">
<div class="flex items-start gap-4">
<div class="w-12 h-12 flex items-center justify-center bg-purple-100 text-purple-600 rounded-full flex-shrink-0">
<i class="ri-upload-line ri-xl"></i>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-start justify-between">
<div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Materi Berhasil Diunggah</h3>
<p class="text-gray-700 mb-2">Materi "Teori Komunikasi Massa" berhasil diunggah dan sedang menunggu verifikasi.</p>
<div class="flex items-center gap-4 text-sm text-gray-500">
<span class="flex items-center gap-1">
<i class="ri-time-line"></i>
2 jam yang lalu
</span>
<span class="flex items-center gap-1">
<i class="ri-upload-line"></i>
Upload
</span>
</div>
</div>
<div class="flex items-center gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
<i class="ri-more-2-line text-gray-500"></i>
</button>
</div>
</div>
</div>
</div>

<!-- Read Notification -->
<div class="notification-item notification-read p-6 cursor-pointer">
<div class="flex items-start gap-4">
<div class="w-12 h-12 flex items-center justify-center bg-teal-100 text-teal-600 rounded-full flex-shrink-0">
<i class="ri-user-add-line ri-xl"></i>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-start justify-between">
<div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Pengikut Baru</h3>
<p class="text-gray-700 mb-2">Anita Wijaya mulai mengikuti aktivitas Anda di Academy Bridge.</p>
<div class="flex items-center gap-4 text-sm text-gray-500">
<span class="flex items-center gap-1">
<i class="ri-time-line"></i>
3 jam yang lalu
</span>
<span class="flex items-center gap-1">
<i class="ri-user-line"></i>
Sosial
</span>
</div>
</div>
<div class="flex items-center gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
<i class="ri-more-2-line text-gray-500"></i>
</button>
</div>
</div>
</div>
</div>

<!-- System Notification -->
<div class="notification-item notification-read p-6 cursor-pointer">
<div class="flex items-start gap-4">
<div class="w-12 h-12 flex items-center justify-center bg-gray-100 text-gray-600 rounded-full flex-shrink-0">
<i class="ri-settings-line ri-xl"></i>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-start justify-between">
<div>
<h3 class="text-base font-semibold text-gray-900 mb-1">Pembaruan Sistem</h3>
<p class="text-gray-700 mb-2">Academy Bridge telah diperbarui dengan fitur pencarian yang lebih cerdas dan antarmuka yang ditingkatkan.</p>
<div class="flex items-center gap-4 text-sm text-gray-500">
<span class="flex items-center gap-1">
<i class="ri-time-line"></i>
1 hari yang lalu
</span>
<span class="flex items-center gap-1">
<i class="ri-information-line"></i>
Sistem
</span>
</div>
</div>
<div class="flex items-center gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
<i class="ri-more-2-line text-gray-500"></i>
</button>
</div>
</div>
</div>
</div>
</div>

<!-- Load More Button -->
<div class="p-6 text-center border-t border-gray-100">
<button class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-button font-medium hover:bg-gray-50 flex items-center gap-2 mx-auto">
<i class="ri-refresh-line"></i>
Muat Lebih Banyak
</button>
</div>
</div>

<!-- Empty State (Hidden by default) -->
<div id="emptyState" class="bg-white rounded-xl shadow-sm p-12 text-center hidden">
<div class="w-20 h-20 flex items-center justify-center bg-gray-100 text-gray-400 rounded-full mx-auto mb-4">
<i class="ri-notification-off-line ri-3x"></i>
</div>
<h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Notifikasi</h3>
<p class="text-gray-600 mb-6">Anda belum memiliki notifikasi. Aktivitas dan update akan muncul di sini.</p>
<a href="{{ route('materials.index') }}" class="bg-primary text-white px-6 py-3 rounded-button font-medium inline-flex items-center gap-2 hover:bg-primary/90">
<i class="ri-search-line"></i>
Jelajahi Materi
</a>
</div>
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12 mt-16">
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
<li><a href="{{ route('notifications.index') }}" class="text-gray-400 hover:text-white">Notifikasi</a></li>
<li><a href="{{ route('analytics.index') }}" class="text-gray-400 hover:text-white">Analitik</a></li>
<li><a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-white">Profil</a></li>
</ul>
</div>

<div>
<h3 class="text-lg font-semibold mb-4">Fitur</h3>
<ul class="space-y-2">
<li><a href="{{ route('materials.saved') }}" class="text-gray-400 hover:text-white">Materi Tersimpan</a></li>
<li><a href="{{ route('materials.create') }}" class="text-gray-400 hover:text-white">Upload Materi</a></li>
<li><a href="{{ route('notifications.index') }}" class="text-gray-400 hover:text-white">Notifikasi</a></li>
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
function toggleFilter() {
const filterSection = document.getElementById('filterSection');
filterSection.classList.toggle('hidden');
}

function markAsRead(element) {
element.classList.remove('notification-unread');
element.classList.add('notification-read');
const badge = element.querySelector('.bg-primary');
if (badge) {
badge.remove();
}
}

function markAllAsRead() {
const unreadNotifications = document.querySelectorAll('.notification-unread');
unreadNotifications.forEach(notification => {
notification.classList.remove('notification-unread');
notification.classList.add('notification-read');
const badge = notification.querySelector('.bg-primary');
if (badge) {
badge.remove();
}
});
// Update stats
document.querySelector('.text-red-600').textContent = '0';
}

// Auto-refresh notifications every 30 seconds
setInterval(() => {
// In a real application, this would fetch new notifications from the server
console.log('Checking for new notifications...');
}, 30000);
</script>
</body>
</html>