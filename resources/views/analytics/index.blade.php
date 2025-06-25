<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Analitik Pembelajaran - Academy Bridge</title>
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
<a href="{{ route('analytics.index') }}" class="font-medium text-gray-900 border-b-2 border-primary pb-1">Analitik</a>
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
<div class="mb-8">
<h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-3">
<i class="ri-line-chart-line text-primary"></i>
Analitik Pembelajaran
</h1>
<p class="text-gray-600">Pantau perkembangan dan aktivitas pembelajaran Anda</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-600">Materi Dipelajari</p>
<p class="text-2xl font-bold text-gray-900">34</p>
</div>
<div class="w-12 h-12 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
<i class="ri-book-2-line ri-xl"></i>
</div>
</div>
</div>
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-600">Jam Belajar Minggu Ini</p>
<p class="text-2xl font-bold text-green-600">12</p>
</div>
<div class="w-12 h-12 flex items-center justify-center bg-green-100 text-green-600 rounded-lg">
<i class="ri-time-line ri-xl"></i>
</div>
</div>
</div>
<div class="bg-white rounded-xl shadow-sm p-6">
<div class="flex items-center justify-between">
<div>
<p class="text-sm font-medium text-gray-600">Rata-rata Skor</p>
<p class="text-2xl font-bold text-amber-600">4.7</p>
</div>
<div class="w-12 h-12 flex items-center justify-center bg-amber-100 text-amber-600 rounded-lg">
<i class="ri-star-line ri-xl"></i>
</div>
</div>
</div>
</div>

<!-- Weekly Activity Chart -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-8">
<div class="flex items-center justify-between mb-6">
<h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
<i class="ri-bar-chart-grouped-line text-primary"></i>
Aktivitas Mingguan
</h2>
</div>
<div id="weeklyActivityChart" class="h-72 w-full"></div>
</div>

<!-- Charts and Achievements -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
<!-- Material Distribution Chart -->
<div class="bg-white rounded-xl shadow-sm p-6">
<h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
<i class="ri-pie-chart-2-line text-primary"></i>
Distribusi Materi Dipelajari
</h2>
<div id="materialDistributionChart" class="h-72 w-full"></div>
</div>

<!-- Achievements -->
<div class="bg-white rounded-xl shadow-sm p-6">
<h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
<i class="ri-trophy-line text-primary"></i>
Pencapaian
</h2>
<div class="space-y-4">
<div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
<div class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-600 rounded-full">
<i class="ri-check-double-line ri-lg"></i>
</div>
<div>
<p class="font-medium text-gray-900">Selesaikan 10 Materi</p>
<p class="text-sm text-gray-500">Sudah tercapai</p>
</div>
</div>
<div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
<div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
<i class="ri-discuss-line ri-lg"></i>
</div>
<div>
<p class="font-medium text-gray-900">Aktif di Forum Diskusi</p>
<p class="text-sm text-gray-500">3 diskusi minggu ini</p>
</div>
</div>
<div class="flex items-center gap-3 p-3 bg-amber-50 rounded-lg">
<div class="w-10 h-10 flex items-center justify-center bg-amber-100 text-amber-600 rounded-full">
<i class="ri-star-smile-line ri-lg"></i>
</div>
<div>
<p class="font-medium text-gray-900">Rata-rata Skor di Atas 4.5</p>
<p class="text-sm text-gray-500">Pertahankan performa baik!</p>
</div>
</div>
</div>
</div>
</div>

<!-- Learning Progress -->
<div class="bg-white rounded-xl shadow-sm p-6">
<h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
<i class="ri-progress-3-line text-primary"></i>
Progress Pembelajaran
</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="text-center">
<div class="w-16 h-16 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full mx-auto mb-3">
<i class="ri-code-s-slash-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Ilmu Komputer</h3>
<div class="w-full bg-gray-200 rounded-full h-2 mb-2">
<div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
</div>
<p class="text-sm text-gray-600">12 dari 16 materi</p>
</div>
<div class="text-center">
<div class="w-16 h-16 flex items-center justify-center bg-green-100 text-green-600 rounded-full mx-auto mb-3">
<i class="ri-building-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Ekonomi</h3>
<div class="w-full bg-gray-200 rounded-full h-2 mb-2">
<div class="bg-green-600 h-2 rounded-full" style="width: 60%"></div>
</div>
<p class="text-sm text-gray-600">8 dari 13 materi</p>
</div>
<div class="text-center">
<div class="w-16 h-16 flex items-center justify-center bg-red-100 text-red-600 rounded-full mx-auto mb-3">
<i class="ri-heart-pulse-line ri-2x"></i>
</div>
<h3 class="font-semibold text-gray-900 mb-1">Kedokteran</h3>
<div class="w-full bg-gray-200 rounded-full h-2 mb-2">
<div class="bg-red-600 h-2 rounded-full" style="width: 40%"></div>
</div>
<p class="text-sm text-gray-600">6 dari 15 materi</p>
</div>
</div>
</div>
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
// Weekly Activity Chart
try {
const chartElement = document.getElementById('weeklyActivityChart');
if (chartElement && typeof echarts !== 'undefined') {
const weeklyActivityChart = echarts.init(chartElement);
const weeklyActivityOption = {
animation: false,
grid: { top: 20, right: 10, bottom: 30, left: 40 },
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
data: [2, 3, 4, 2, 5, 1, 3],
type: 'bar',
barWidth: 32,
itemStyle: { 
borderRadius: [8, 8, 0, 0],
color: '#4F9DA6'
},
emphasis: { itemStyle: { color: '#F5B041' } }
}]
};
weeklyActivityChart.setOption(weeklyActivityOption);

// Handle window resize
window.addEventListener('resize', function() {
weeklyActivityChart.resize();
});
}
} catch (error) {
console.warn('Weekly activity chart initialization failed:', error);
}

// Material Distribution Chart
try {
const materialChartElement = document.getElementById('materialDistributionChart');
if (materialChartElement && typeof echarts !== 'undefined') {
const materialDistributionChart = echarts.init(materialChartElement);
const materialDistributionOption = {
animation: false,
tooltip: { trigger: 'item' },
legend: { 
top: 'bottom',
textStyle: { color: '#1f2937' }
},
color: ['#4F9DA6', '#F5B041', '#34D399', '#6366F1', '#F87171'],
series: [{
name: 'Materi',
type: 'pie',
radius: ['40%', '70%'],
avoidLabelOverlap: false,
itemStyle: { 
borderRadius: 10, 
borderColor: '#fff', 
borderWidth: 2 
},
label: { show: false, position: 'center' },
emphasis: { 
label: { 
show: true, 
fontSize: 18, 
fontWeight: 'bold',
color: '#1f2937'
} 
},
labelLine: { show: false },
data: [
{ value: 12, name: 'Ilmu Komputer' },
{ value: 8, name: 'Ekonomi' },
{ value: 6, name: 'Kedokteran' },
{ value: 5, name: 'Teknik' },
{ value: 3, name: 'Hukum' }
]
}]
};
materialDistributionChart.setOption(materialDistributionOption);

// Handle window resize
window.addEventListener('resize', function() {
materialDistributionChart.resize();
});
}
} catch (error) {
console.warn('Material distribution chart initialization failed:', error);
}
});
</script>
</body>
</html>