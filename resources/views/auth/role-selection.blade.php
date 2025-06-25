<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pilih Peran - Academy Bridge</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        :where([class^="ri-"])::before { content: "\\f3c2"; }
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        .role-bg { 
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.95) 50%, rgba(255, 255, 255, 0.7) 70%, rgba(255, 255, 255, 0.4) 85%, rgba(255, 255, 255, 0) 100%), 
            url('https://readdy.ai/api/search-image?query=A%20calming%20and%20modern%20university%20study%20space%20with%20students%20collaborating.%20The%20scene%20features%20soft%20natural%20lighting%20with%20teal%20and%20sage%20green%20accents%2C%20creating%20a%20serene%20and%20focused%20atmosphere.%20Modern%20ergonomic%20furniture%20and%20plants%20are%20visible%2C%20with%20clean%20architectural%20lines%20and%20large%20windows.%20Natural%20light%20creates%20a%20peaceful%20environment%20perfect%20for%20extended%20study%20sessions%2C%20with%20a%20color%20palette%20designed%20for%20eye%20comfort.&width=1600&height=800&seq=3&orientation=landscape'); 
            background-size: cover; 
            background-position: center right; 
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 flex items-center justify-center bg-primary rounded-lg text-white">
                    <i class="ri-book-open-line ri-lg"></i>
                </div>
                <a href="{{ route('welcome') }}" class="text-2xl font-['Pacifico'] text-primary">Academy Bridge</a>
            </div>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('welcome') }}" class="font-medium text-gray-600 hover:text-gray-900">Beranda</a>
                <a href="{{ route('materials.index') }}" class="font-medium text-gray-600 hover:text-gray-900">Materi</a>
                <a href="#" class="font-medium text-gray-600 hover:text-gray-900">Tentang</a>
                <a href="#" class="font-medium text-gray-600 hover:text-gray-900">Kontak</a>
            </nav>
            <div class="flex items-center gap-3">
                <a href="{{ route('register') }}" class="hidden md:block font-medium text-gray-600 hover:text-gray-900">Daftar</a>
                <a href="{{ route('login') }}" class="bg-primary text-white px-4 py-2 rounded-button font-medium hover:bg-primary/90">Masuk</a>
            </div>
        </div>
    </header>

    <main class="min-h-screen role-bg flex items-center justify-center py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Role Selection Card -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <!-- Logo and Title -->
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 flex items-center justify-center bg-primary rounded-lg text-white mx-auto mb-4">
                            <i class="ri-user-settings-line ri-2x"></i>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pilih Peran Anda</h1>
                        <p class="text-gray-600">Silakan pilih peran yang sesuai untuk mengakses Academy Bridge</p>
                    </div>

                    <!-- Role Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Student Option -->
                        <div class="group">
                            <a href="{{ route('login', ['role' => 'student']) }}" 
                               class="block bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-8 text-center transition-all duration-300 hover:border-blue-400 hover:shadow-lg group-hover:scale-105">
                                <div class="w-20 h-20 flex items-center justify-center bg-blue-500 rounded-full mx-auto mb-4 group-hover:bg-blue-600 transition-colors">
                                    <i class="ri-graduation-cap-line ri-3x text-white"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Mahasiswa</h3>
                                <p class="text-gray-600 mb-4">Akses dan unduh materi kuliah, ikuti diskusi, dan simpan materi favorit</p>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-blue-500"></i>
                                        <span>Unduh materi kuliah</span>
                                    </div>
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-blue-500"></i>
                                        <span>Ikuti forum diskusi</span>
                                    </div>
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-blue-500"></i>
                                        <span>Simpan materi favorit</span>
                                    </div>
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-blue-500"></i>
                                        <span>Upload materi untuk berbagi</span>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <span class="bg-blue-500 text-white px-6 py-3 rounded-button font-medium inline-flex items-center gap-2 group-hover:bg-blue-600 transition-colors">
                                        <i class="ri-login-box-line"></i>
                                        Masuk sebagai Mahasiswa
                                    </span>
                                </div>
                            </a>
                        </div>

                        <!-- Lecturer Option -->
                        <div class="group">
                            <a href="{{ route('login', ['role' => 'lecturer']) }}" 
                               class="block bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-200 rounded-xl p-8 text-center transition-all duration-300 hover:border-green-400 hover:shadow-lg group-hover:scale-105">
                                <div class="w-20 h-20 flex items-center justify-center bg-green-500 rounded-full mx-auto mb-4 group-hover:bg-green-600 transition-colors">
                                    <i class="ri-user-star-line ri-3x text-white"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Dosen</h3>
                                <p class="text-gray-600 mb-4">Verifikasi materi, kelola konten, dan bimbing mahasiswa dalam pembelajaran</p>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-green-500"></i>
                                        <span>Verifikasi materi mahasiswa</span>
                                    </div>
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-green-500"></i>
                                        <span>Kelola konten pembelajaran</span>
                                    </div>
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-green-500"></i>
                                        <span>Monitor aktivitas mahasiswa</span>
                                    </div>
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="ri-check-line text-green-500"></i>
                                        <span>Berikan feedback dan komentar</span>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <span class="bg-green-500 text-white px-6 py-3 rounded-button font-medium inline-flex items-center gap-2 group-hover:bg-green-600 transition-colors">
                                        <i class="ri-shield-check-line"></i>
                                        Masuk sebagai Dosen
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center border-t border-gray-200 pt-6">
                        <p class="text-gray-600 mb-4">
                            Belum punya akun? 
                        </p>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-3 rounded-button font-medium inline-flex items-center gap-2 hover:bg-primary/90">
                            <i class="ri-user-add-line"></i>
                            Daftar Akun Baru
                        </a>
                    </div>
                </div>

                <!-- Features Comparison -->
                <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Fitur Platform</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="p-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-primary/10 text-primary rounded-full mx-auto mb-3">
                                <i class="ri-verified-badge-line ri-xl"></i>
                            </div>
                            <h4 class="font-medium text-gray-900 mb-2">Materi Terverifikasi</h4>
                            <p class="text-sm text-gray-600">Semua materi telah diverifikasi oleh dosen untuk memastikan kualitas</p>
                        </div>
                        <div class="p-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-primary/10 text-primary rounded-full mx-auto mb-3">
                                <i class="ri-discuss-line ri-xl"></i>
                            </div>
                            <h4 class="font-medium text-gray-900 mb-2">Forum Diskusi</h4>
                            <p class="text-sm text-gray-600">Berinteraksi dan berdiskusi dengan mahasiswa dan dosen lainnya</p>
                        </div>
                        <div class="p-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-primary/10 text-primary rounded-full mx-auto mb-3">
                                <i class="ri-cloud-line ri-xl"></i>
                            </div>
                            <h4 class="font-medium text-gray-900 mb-2">Akses Cloud</h4>
                            <p class="text-sm text-gray-600">Akses materi kapan saja dan dimana saja dengan penyimpanan cloud</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center gap-2 mb-4 md:mb-0">
                    <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg">
                        <i class="ri-book-open-line text-primary"></i>
                    </div>
                    <span class="text-lg font-['Pacifico'] text-white">Academy Bridge</span>
                </div>
                <div class="flex gap-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-white">Syarat & Ketentuan</a>
                    <a href="#" class="text-gray-400 hover:text-white">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-400 hover:text-white">Bantuan</a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-800 text-center">
                <p class="text-gray-400 text-sm">&copy; 2025 Academy Bridge. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>