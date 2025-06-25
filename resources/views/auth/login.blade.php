<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Academy Bridge</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        :where([class^="ri-"])::before { content: "\\f3c2"; }
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        .login-bg { 
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.95) 50%, rgba(255, 255, 255, 0.7) 70%, rgba(255, 255, 255, 0.4) 85%, rgba(255, 255, 255, 0) 100%), 
            url('https://readdy.ai/api/search-image?query=A%20calming%20and%20modern%20university%20study%20space%20with%20students%20collaborating.%20The%20scene%20features%20soft%20natural%20lighting%20with%20teal%20and%20sage%20green%20accents%2C%20creating%20a%20serene%20and%20focused%20atmosphere.%20Modern%20ergonomic%20furniture%20and%20plants%20are%20visible%2C%20with%20clean%20architectural%20lines%20and%20large%20windows.%20Natural%20light%20creates%20a%20peaceful%20environment%20perfect%20for%20extended%20study%20sessions%2C%20with%20a%20color%20palette%20designed%20for%20eye%20comfort.&width=1600&height=800&seq=1&orientation=landscape'); 
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

    <main class="min-h-screen login-bg flex items-center justify-center py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <!-- Login Card -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <!-- Logo and Title -->
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 flex items-center justify-center bg-primary rounded-lg text-white mx-auto mb-4">
                            <i class="ri-book-open-line ri-2x"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h1>
                        <p class="text-gray-600">Masuk ke akun Academy Bridge Anda</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="ri-check-line text-green-600 mr-2"></i>
                                <span class="text-green-700 text-sm">{{ session('status') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="ri-error-warning-line text-red-600 mr-2"></i>
                                <span class="text-red-700 text-sm">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="ri-mail-line mr-1"></i>
                                {{ __('auth.email') }}
                            </label>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('email') border-red-300 @enderror"
                                   placeholder="Masukkan email Anda">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="ri-lock-line mr-1"></i>
                                {{ __('auth.password') }}
                            </label>
                            <div class="relative">
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('password') border-red-300 @enderror"
                                       placeholder="Masukkan password Anda">
                                <button type="button" 
                                        onclick="togglePassword()" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i id="password-icon" class="ri-eye-off-line text-gray-400 hover:text-gray-600"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" 
                                       type="checkbox" 
                                       name="remember" 
                                       class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                                <span class="ml-2 text-sm text-gray-600">{{ __('auth.remember_me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                   class="text-sm text-primary hover:text-primary/80 font-medium">
                                    {{ __('auth.forgot_password') }}
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" 
                                class="w-full bg-primary text-white py-3 rounded-button font-medium flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
                            <i class="ri-login-box-line"></i>
                            {{ __('auth.login') }}
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="my-6 flex items-center">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="px-4 text-sm text-gray-500">atau</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <!-- Google Login Button -->
                    @if(config('services.google.client_id') && config('services.google.client_secret'))
                        <a href="{{ route('auth.google') }}" 
                           class="w-full bg-white border border-gray-300 text-gray-700 py-3 rounded-button font-medium flex items-center justify-center gap-2 hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Masuk dengan Google
                        </a>
                    @else
                        <div class="w-full bg-gray-100 border border-gray-300 text-gray-500 py-3 rounded-button font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#9CA3AF" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#9CA3AF" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#9CA3AF" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#9CA3AF" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/</svg>
                            Google OAuth Belum Dikonfigurasi
                        </div>
                        <div class="text-center mt-2 space-x-4">
                            <a href="{{ route('auth.google.setup') }}" class="text-primary hover:text-primary/80 text-sm font-medium">
                                Lihat Panduan Setup →
                            </a>
                            <a href="{{ route('auth.google.debug') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                                Debug OAuth
                            </a>
                        </div>
                    @endif

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-gray-600">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-primary hover:text-primary/80 font-medium">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Features -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div class="bg-white/80 backdrop-blur-sm rounded-lg p-4">
                        <div class="w-8 h-8 flex items-center justify-center bg-green-100 text-green-600 rounded-full mx-auto mb-2">
                            <i class="ri-verified-badge-line"></i>
                        </div>
                        <p class="text-sm text-gray-700 font-medium">Materi Terverifikasi</p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-lg p-4">
                        <div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full mx-auto mb-2">
                            <i class="ri-discuss-line"></i>
                        </div>
                        <p class="text-sm text-gray-700 font-medium">Forum Diskusi</p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-lg p-4">
                        <div class="w-8 h-8 flex items-center justify-center bg-purple-100 text-purple-600 rounded-full mx-auto mb-2">
                            <i class="ri-wifi-off-line"></i>
                        </div>
                        <p class="text-sm text-gray-700 font-medium">Akses Offline</p>
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

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'ri-eye-line text-gray-400 hover:text-gray-600';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'ri-eye-off-line text-gray-400 hover:text-gray-600';
            }
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>
