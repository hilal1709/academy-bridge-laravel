<section>
    <div class="flex items-center space-x-6">
        <!-- Current Avatar -->
        <div class="flex-shrink-0">
            <x-user-avatar :user="$user" size="2xl" />
        </div>

        <!-- Upload Form -->
        <div class="flex-1">
            <form method="post" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Foto Profil Baru
                    </label>
                    <input id="avatar" name="avatar" type="file" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90">
                    <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF hingga 2MB</p>
                    @error('avatar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-button text-sm font-medium hover:bg-primary/90 flex items-center gap-2">
                        <i class="ri-upload-line"></i>
                        Upload Avatar
                    </button>

                    @if($user->avatar)
                        <form method="post" action="{{ route('profile.avatar.destroy') }}" class="inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center gap-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?')">
                                <i class="ri-delete-bin-line"></i>
                                Hapus Avatar
                            </button>
                        </form>
                    @endif
                </div>

                @if (session('status') === 'avatar-updated')
                    <p class="text-sm text-green-600 flex items-center gap-2">
                        <i class="ri-check-line"></i>
                        Avatar berhasil diperbarui.
                    </p>
                @endif

                @if (session('status') === 'avatar-deleted')
                    <p class="text-sm text-green-600 flex items-center gap-2">
                        <i class="ri-check-line"></i>
                        Avatar berhasil dihapus.
                    </p>
                @endif
            </form>
        </div>
    </div>
</section>