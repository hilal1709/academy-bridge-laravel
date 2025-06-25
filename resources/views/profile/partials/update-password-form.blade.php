<section>
    <p class="text-sm text-gray-600 mb-6">
        Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                   autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
            <input id="update_password_password" name="password" type="password" 
                   class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                   autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-primary/90 flex items-center gap-2">
                <i class="ri-lock-line"></i>
                Ubah Password
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600 flex items-center gap-2">
                    <i class="ri-check-line"></i>
                    Password berhasil diubah.
                </p>
            @endif
        </div>
    </form>
</section>
