<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
            <input id="name" name="name" type="text" 
                   class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input id="email" name="email" type="email" 
                   class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800">
                        Email Anda belum diverifikasi.

                        <button form="send-verification" class="underline text-sm text-yellow-600 hover:text-yellow-900 ml-1">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Link verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input id="phone" name="phone" type="tel" 
                       class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                       value="{{ old('phone', $user->phone) }}" placeholder="Contoh: +62 812 3456 7890">
                @error('phone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                <input id="birth_date" name="birth_date" type="date" 
                       class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                       value="{{ old('birth_date', $user->birth_date) }}">
                @error('birth_date')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
            <select id="gender" name="gender" 
                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
            <textarea id="bio" name="bio" rows="4" 
                      class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                      placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="fakultas" class="block text-sm font-medium text-gray-700 mb-2">Fakultas</label>
                <input id="fakultas" name="fakultas" type="text" 
                       class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                       value="{{ old('fakultas', $user->fakultas) }}" placeholder="Contoh: Fakultas Teknik">
                @error('fakultas')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                <input id="jurusan" name="jurusan" type="text" 
                       class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                       value="{{ old('jurusan', $user->jurusan) }}" placeholder="Contoh: Teknik Informatika">
                @error('jurusan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="nim_nip" class="block text-sm font-medium text-gray-700 mb-2">
                {{ $user->isLecturer() ? 'NIP' : 'NIM' }}
            </label>
            <input id="nim_nip" name="nim_nip" type="text" 
                   class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                   value="{{ old('nim_nip', $user->nim_nip) }}" 
                   placeholder="{{ $user->isLecturer() ? 'Contoh: 198501012010011001' : 'Contoh: 2021110001' }}">
            @error('nim_nip')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
            <textarea id="address" name="address" rows="3" 
                      class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                      placeholder="Alamat lengkap Anda...">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900">Media Sosial & Website</h3>
            
            <div>
                <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                <input id="website" name="website" type="url" 
                       class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                       value="{{ old('website', $user->website) }}" placeholder="https://example.com">
                @error('website')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                    <input id="linkedin" name="linkedin" type="url" 
                           class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                           value="{{ old('linkedin', $user->linkedin) }}" placeholder="https://linkedin.com/in/username">
                    @error('linkedin')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                    <input id="instagram" name="instagram" type="url" 
                           class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                           value="{{ old('instagram', $user->instagram) }}" placeholder="https://instagram.com/username">
                    @error('instagram')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-primary/90 flex items-center gap-2">
                <i class="ri-save-line"></i>
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600 flex items-center gap-2">
                    <i class="ri-check-line"></i>
                    Profil berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
