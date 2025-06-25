<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google OAuth Debug - Academy Bridge</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'}}}}</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Google OAuth Debug</h1>
                <p class="text-gray-600">Informasi konfigurasi Google OAuth untuk debugging</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
                <div class="border-b pb-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Konfigurasi Saat Ini</h2>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Client ID</label>
                            <code class="text-sm text-gray-900 break-all">{{ config('services.google.client_id') ?: 'TIDAK DIKONFIGURASI' }}</code>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Client Secret</label>
                            <code class="text-sm text-gray-900">{{ config('services.google.client_secret') ? str_repeat('*', strlen(config('services.google.client_secret'))) : 'TIDAK DIKONFIGURASI' }}</code>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Redirect URI</label>
                            <code class="text-sm text-gray-900 break-all">{{ config('services.google.redirect') ?: 'TIDAK DIKONFIGURASI' }}</code>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Current URL</label>
                            <code class="text-sm text-gray-900 break-all">{{ request()->getSchemeAndHttpHost() }}</code>
                        </div>
                    </div>
                </div>

                <div class="border-b pb-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Status Konfigurasi</h2>
                    
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            @if(config('services.google.client_id'))
                                <i class="ri-check-line text-green-600"></i>
                                <span class="text-green-600">Client ID dikonfigurasi</span>
                            @else
                                <i class="ri-close-line text-red-600"></i>
                                <span class="text-red-600">Client ID belum dikonfigurasi</span>
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-3">
                            @if(config('services.google.client_secret'))
                                <i class="ri-check-line text-green-600"></i>
                                <span class="text-green-600">Client Secret dikonfigurasi</span>
                            @else
                                <i class="ri-close-line text-red-600"></i>
                                <span class="text-red-600">Client Secret belum dikonfigurasi</span>
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-3">
                            @if(config('services.google.redirect'))
                                <i class="ri-check-line text-green-600"></i>
                                <span class="text-green-600">Redirect URI dikonfigurasi</span>
                            @else
                                <i class="ri-close-line text-red-600"></i>
                                <span class="text-red-600">Redirect URI belum dikonfigurasi</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="border-b pb-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Langkah Perbaikan</h2>
                    
                    <div class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="font-medium text-blue-900 mb-2">1. Periksa Google Cloud Console</h3>
                            <p class="text-sm text-blue-800 mb-3">Pastikan aplikasi sudah dikonfigurasi di Google Cloud Console:</p>
                            <ul class="text-sm text-blue-800 space-y-1 ml-4">
                                <li>• Buka <a href="https://console.cloud.google.com/" target="_blank" class="underline">Google Cloud Console</a></li>
                                <li>• Pilih project atau buat project baru</li>
                                <li>• Aktifkan Google+ API</li>
                                <li>• Buat OAuth 2.0 credentials</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h3 class="font-medium text-yellow-900 mb-2">2. Konfigurasi Authorized Redirect URIs</h3>
                            <p class="text-sm text-yellow-800 mb-3">Tambahkan URI berikut di Google Cloud Console:</p>
                            <div class="bg-white border rounded p-2">
                                <code class="text-sm">{{ request()->getSchemeAndHttpHost() }}/auth/google/callback</code>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <h3 class="font-medium text-green-900 mb-2">3. Update File .env</h3>
                            <p class="text-sm text-green-800 mb-3">Pastikan variabel berikut ada di file .env:</p>
                            <div class="bg-white border rounded p-2 space-y-1">
                                <div><code class="text-sm">GOOGLE_CLIENT_ID=your_client_id</code></div>
                                <div><code class="text-sm">GOOGLE_CLIENT_SECRET=your_client_secret</code></div>
                                <div><code class="text-sm">GOOGLE_REDIRECT_URI={{ request()->getSchemeAndHttpHost() }}/auth/google/callback</code></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg text-center hover:bg-gray-700">
                        Kembali ke Login
                    </a>
                    
                    @if(config('services.google.client_id') && config('services.google.client_secret'))
                        <a href="{{ route('auth.google') }}" class="flex-1 bg-primary text-white py-2 px-4 rounded-lg text-center hover:bg-primary/90">
                            Test Google Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>