<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Google OAuth - Academy Bridge</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4F9DA6',secondary:'#F5B041'}}}}</script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-4xl w-full">
            <div class="text-center mb-8">
                <div class="w-16 h-16 flex items-center justify-center bg-primary rounded-lg text-white mx-auto mb-4">
                    <i class="ri-google-line ri-2x"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Setup Google OAuth</h1>
                <p class="text-gray-600">Ikuti langkah-langkah berikut untuk mengaktifkan login dengan Google</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="space-y-8">
                    <!-- Step 1 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">1</div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Buat Project di Google Cloud Console</h3>
                            <p class="text-gray-600 mb-3">Buka <a href="https://console.cloud.google.com/" target="_blank" class="text-primary hover:underline">Google Cloud Console</a> dan buat project baru atau pilih project yang sudah ada.</p>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <p class="text-sm text-blue-800">💡 <strong>Tips:</strong> Gunakan nama project yang mudah diingat seperti "Academy Bridge OAuth"</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">2</div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Aktifkan Google+ API</h3>
                            <p class="text-gray-600 mb-3">Di Google Cloud Console, pergi ke <strong>APIs & Services</strong> > <strong>Library</strong> dan aktifkan:</p>
                            <ul class="list-disc list-inside text-gray-600 space-y-1">
                                <li>Google+ API</li>
                                <li>Google OAuth2 API</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">3</div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Konfigurasi OAuth Consent Screen</h3>
                            <p class="text-gray-600 mb-3">Pergi ke <strong>APIs & Services</strong> > <strong>OAuth consent screen</strong>:</p>
                            <ul class="list-disc list-inside text-gray-600 space-y-1">
                                <li>Pilih <strong>External</strong> untuk user type</li>
                                <li>App name: <code class="bg-gray-100 px-2 py-1 rounded">Academy Bridge</code></li>
                                <li>User support email: email Anda</li>
                                <li>Developer contact information: email Anda</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">4</div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Buat OAuth 2.0 Client ID</h3>
                            <p class="text-gray-600 mb-3">Pergi ke <strong>APIs & Services</strong> > <strong>Credentials</strong> > <strong>Create Credentials</strong> > <strong>OAuth client ID</strong>:</p>
                            <ul class="list-disc list-inside text-gray-600 space-y-1">
                                <li>Application type: <strong>Web application</strong></li>
                                <li>Name: <code class="bg-gray-100 px-2 py-1 rounded">Academy Bridge Web Client</code></li>
                            </ul>
                            
                            <div class="mt-4 space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Authorized JavaScript origins:</label>
                                    <div class="bg-gray-50 border rounded-lg p-3">
                                        <code class="text-sm">{{ config('app.url') }}</code>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Authorized redirect URIs:</label>
                                    <div class="bg-gray-50 border rounded-lg p-3">
                                        <code class="text-sm">{{ config('app.url') }}/auth/google/callback</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">5</div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Update File .env</h3>
                            <p class="text-gray-600 mb-3">Setelah membuat OAuth client, copy Client ID dan Client Secret ke file <code class="bg-gray-100 px-2 py-1 rounded">.env</code>:</p>
                            
                            <div class="bg-gray-900 text-green-400 rounded-lg p-4 font-mono text-sm">
                                <div class="mb-2"># Google OAuth Configuration</div>
                                <div>GOOGLE_CLIENT_ID=your_google_client_id_here</div>
                                <div>GOOGLE_CLIENT_SECRET=your_google_client_secret_here</div>
                                <div>GOOGLE_REDIRECT_URI={{ config('app.url') }}/auth/google/callback</div>
                            </div>
                            
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-4">
                                <p class="text-sm text-yellow-800">⚠️ <strong>Penting:</strong> Jangan commit file .env ke repository Git!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">6</div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Test Login Google</h3>
                            <p class="text-gray-600 mb-3">Setelah konfigurasi selesai, test login Google di halaman login.</p>
                            
                            <div class="flex gap-3">
                                <a href="{{ route('login') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-medium hover:bg-primary/90 flex items-center gap-2">
                                    <i class="ri-login-box-line"></i>
                                    Test Login
                                </a>
                                <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-600 flex items-center gap-2">
                                    <i class="ri-arrow-left-line"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Troubleshooting</h3>
                    
                    <div class="space-y-4">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <h4 class="font-medium text-red-800 mb-2">Error: "redirect_uri_mismatch"</h4>
                            <p class="text-sm text-red-700">Pastikan redirect URI di Google Console sama persis dengan: <code>{{ config('app.url') }}/auth/google/callback</code></p>
                        </div>
                        
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <h4 class="font-medium text-red-800 mb-2">Error: "invalid_client"</h4>
                            <p class="text-sm text-red-700">Periksa GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET di file .env</p>
                        </div>
                        
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <h4 class="font-medium text-red-800 mb-2">Error: "access_denied"</h4>
                            <p class="text-sm text-red-700">User menolak memberikan izin. Pastikan OAuth consent screen sudah dikonfigurasi dengan benar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>