<section class="space-y-6">
    <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-start gap-3">
            <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-red-100 text-red-600 rounded-full mt-0.5">
                <i class="ri-error-warning-line text-sm"></i>
            </div>
            <div>
                <h3 class="text-sm font-medium text-red-800 mb-1">Hapus Akun</h3>
                <p class="text-sm text-red-700">
                    Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. 
                    Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.
                </p>
            </div>
        </div>
    </div>

    <button type="button" 
            onclick="document.getElementById('deleteModal').classList.remove('hidden')"
            class="bg-red-600 text-white px-6 py-3 rounded-button font-medium hover:bg-red-700 flex items-center gap-2">
        <i class="ri-delete-bin-line"></i>
        Hapus Akun
    </button>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 flex items-center justify-center bg-red-100 text-red-600 rounded-full">
                        <i class="ri-error-warning-line"></i>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        Konfirmasi Hapus Akun
                    </h2>
                </div>

                <p class="text-sm text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus akun Anda? Setelah akun dihapus, semua sumber daya dan data akan dihapus secara permanen. 
                    Masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.
                </p>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" 
                           class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500" 
                           placeholder="Masukkan password Anda">
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" 
                            onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-button font-medium hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-red-600 text-white px-4 py-2 rounded-button font-medium hover:bg-red-700">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($errors->userDeletion->isNotEmpty())
        <script>
            document.getElementById('deleteModal').classList.remove('hidden');
        </script>
    @endif
</section>
