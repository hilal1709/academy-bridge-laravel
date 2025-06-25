<div class="relative">
    <button onclick="toggleProfileDropdown()" class="flex items-center gap-2">
        <x-user-avatar :user="auth()->user()" size="md" />
        <span class="hidden md:block font-medium">{{ auth()->user()->name }}</span>
        <i class="ri-arrow-down-s-line ri-lg text-gray-600"></i>
    </button>
    
    <!-- Profile Dropdown -->
    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
        <div class="py-2">
            <div class="px-4 py-2 border-b border-gray-100">
                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
            </div>
            
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-50">
                <i class="ri-user-line"></i>
                <span>Profil</span>
            </a>
            
            <a href="{{ route('analytics.index') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-50">
                <i class="ri-line-chart-line"></i>
                <span>Analitik</span>
            </a>
            
            <a href="{{ route('materials.saved') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-50">
                <i class="ri-bookmark-line"></i>
                <span>Materi Tersimpan</span>
            </a>
            
            <a href="{{ route('notifications.index') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-50">
                <i class="ri-notification-3-line"></i>
                <span>Notifikasi</span>
            </a>
            
            <hr class="my-2">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 text-left">
                    <i class="ri-logout-box-line"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Profile dropdown functionality
function toggleProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profileDropdown');
    const button = event.target.closest('button[onclick="toggleProfileDropdown()"]');
    if (!button && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>