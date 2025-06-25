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
    <style>
        :where([class^="ri-"])::before { content: "\\f3c2"; }
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        .hero-section { 
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.95) 50%, rgba(255, 255, 255, 0.7) 70%, rgba(255, 255, 255, 0.4) 85%, rgba(255, 255, 255, 0) 100%), url('https://readdy.ai/api/search-image?query=A%20calming%20and%20modern%20university%20study%20space%20with%20students%20collaborating.%20The%20scene%20features%20soft%20natural%20lighting%20with%20teal%20and%20sage%20green%20accents%2C%20creating%20a%20serene%20and%20focused%20atmosphere.%20Modern%20ergonomic%20furniture%20and%20plants%20are%20visible%2C%20with%20clean%20architectural%20lines%20and%20large%20windows.%20Natural%20light%20creates%20a%20peaceful%20environment%20perfect%20for%20extended%20study%20sessions%2C%20with%20a%20color%20palette%20designed%20for%20eye%20comfort.&width=1600&height=800&seq=1&orientation=landscape'); 
            background-size: cover; 
            background-position: center right; 
        }
        .gradient-text {
            background: linear-gradient(135deg, #4F9DA6 0%, #26a69a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 flex items-center justify-center bg-primary rounded-lg text-white">
                    <i class="ri-book-open-line ri-lg"></i>
                </div>
                <a href="#" class="text-2xl font-['Pacifico'] text-primary">Academy Bridge</a>
            </div>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#features" class="font-medium text-gray-600 hover:text-gray-900">Fitur</a>
                <a href="#how-it-works" class="font-medium text-gray-600 hover:text-gray-900">Cara Kerja</a>
                <a href="#about" class="font-medium text-gray-600 hover:text-gray-900">Tentang</a>
            </nav>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-button font-medium hover:bg-primary/90 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-primary transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-button font-medium hover:bg-primary/90 transition">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section py-16 md:py-24">
        <div class="container mx-auto px-4 w-full">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Berbagi Pengetahuan, Membangun Masa Depan</h1>
                <p class="text-lg text-gray-700 mb-8">Platform berbagi materi kuliah yang memudahkan mahasiswa dan dosen untuk mengakses, berbagi, dan berkolaborasi dalam pembelajaran akademik.</p>
                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    @guest
                    <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center justify-center gap-2 whitespace-nowrap hover:bg-primary/90">
                        <i class="ri-user-add-line ri-lg"></i>
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-button font-medium flex items-center justify-center gap-2 whitespace-nowrap hover:bg-gray-50">
                        <i class="ri-information-line ri-lg"></i>
                        Masuk
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="bg-primary text-white px-6 py-3 rounded-button font-medium flex items-center justify-center gap-2 whitespace-nowrap hover:bg-primary/90">
                        <i class="ri-dashboard-line ri-lg"></i>
                        Buka Dashboard
                    </a>
                    @endguest
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

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan Academy Bridge</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Platform lengkap yang dirancang khusus untuk kebutuhan akademik mahasiswa dan dosen Indonesia</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group bg-gradient-to-br from-primary/5 to-primary/10 rounded-2xl p-8 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="ri-verified-badge-line ri-2x text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Materi Terverifikasi</h3>
                    <p class="text-gray-600 leading-relaxed">Semua materi telah diverifikasi oleh dosen dan institusi pendidikan untuk menjamin kualitas dan keakuratan.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group bg-gradient-to-br from-secondary/5 to-secondary/10 rounded-2xl p-8 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-secondary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="ri-discuss-line ri-2x text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Forum Diskusi Aktif</h3>
                    <p class="text-gray-600 leading-relaxed">Bergabung dalam diskusi, tanya jawab, dan berbagi pemahaman dengan komunitas akademik yang aktif.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="ri-download-cloud-line ri-2x text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Download & Akses Offline</h3>
                    <p class="text-gray-600 leading-relaxed">Unduh materi untuk diakses kapan saja tanpa koneksi internet. Belajar tanpa batas waktu dan tempat.</p>
                </div>

                <!-- Feature 4 -->
                <div class="group bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="ri-search-eye-line ri-2x text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pencarian Cerdas</h3>
                    <p class="text-gray-600 leading-relaxed">Temukan materi dengan mudah menggunakan filter berdasarkan fakultas, jurusan, mata kuliah, dan semester.</p>
                </div>

                <!-- Feature 5 -->
                <div class="group bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="ri-shield-check-line ri-2x text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-600 leading-relaxed">Data dan file Anda tersimpan aman dengan enkripsi tingkat enterprise dan backup otomatis.</p>
                </div>

                <!-- Feature 6 -->
                <div class="group bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="ri-team-line ri-2x text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kolaborasi Tim</h3>
                    <p class="text-gray-600 leading-relaxed">Bekerja sama dalam proyek kelompok, berbagi catatan, dan saling membantu dalam pembelajaran.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Cara Kerja Academy Bridge</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Tiga langkah mudah untuk memulai perjalanan akademik yang lebih baik</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="relative mb-8">
                        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="ri-user-add-line ri-3x text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-secondary rounded-full flex items-center justify-center text-white font-bold text-sm">1</div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Daftar Gratis</h3>
                    <p class="text-gray-600 leading-relaxed">Buat akun gratis dengan email atau login menggunakan Google. Proses pendaftaran hanya butuh 30 detik.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="relative mb-8">
                        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="ri-search-line ri-3x text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-secondary rounded-full flex items-center justify-center text-white font-bold text-sm">2</div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Jelajahi & Simpan</h3>
                    <p class="text-gray-600 leading-relaxed">Cari materi sesuai jurusan dan mata kuliah Anda. Simpan ke koleksi pribadi untuk akses mudah.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="relative mb-8">
                        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="ri-share-line ri-3x text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-secondary rounded-full flex items-center justify-center text-white font-bold text-sm">3</div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Bagikan & Diskusi</h3>
                    <p class="text-gray-600 leading-relaxed">Upload materi Anda sendiri dan bergabung dalam diskusi untuk saling membantu sesama mahasiswa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-primary to-primary/80">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h2 class="text-3xl lg:text-5xl font-bold mb-6">Siap Memulai Perjalanan Akademik yang Lebih Baik?</h2>
                <p class="text-xl mb-8 opacity-90">Bergabunglah dengan ribuan mahasiswa dan dosen yang sudah merasakan manfaat Academy Bridge</p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    @guest
                    <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-4 rounded-button font-bold text-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                        <i class="ri-rocket-line ri-lg"></i>
                        Mulai Sekarang - Gratis!
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-4 rounded-button font-bold text-lg flex items-center justify-center gap-2 hover:bg-white hover:text-primary transition-all">
                        <i class="ri-login-box-line ri-lg"></i>
                        Sudah Punya Akun?
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="bg-white text-primary px-8 py-4 rounded-button font-bold text-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                        <i class="ri-dashboard-line ri-lg"></i>
                        Buka Dashboard
                    </a>
                    @endguest
                </div>

                <p class="text-sm opacity-75">✓ Gratis selamanya ✓ Tanpa iklan ✓ Data aman terjamin</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 flex items-center justify-center bg-primary rounded-lg">
                            <i class="ri-book-open-line ri-lg text-white"></i>
                        </div>
                        <span class="text-2xl font-['Pacifico'] text-white">Academy Bridge</span>
                    </div>
                    <p class="text-gray-400 mb-4">Platform berbagi materi kuliah terpercaya untuk mahasiswa dan dosen Indonesia.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 hover:bg-primary transition">
                            <i class="ri-facebook-fill text-white"></i>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 hover:bg-primary transition">
                            <i class="ri-twitter-x-fill text-white"></i>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 hover:bg-primary transition">
                            <i class="ri-instagram-line text-white"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Platform</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Cara Kerja</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Harga</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Dukungan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kontak</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Status</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Komunitas</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Keamanan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Lisensi</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; 2025 Academy Bridge. Hak Cipta Dilindungi.</p>
                <p class="text-gray-400 text-sm">Dibuat dengan ❤️ untuk mahasiswa Indonesia</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>