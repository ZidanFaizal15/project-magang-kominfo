<aside class="w-64 bg-gray-900 text-gray-100 min-h-screen flex flex-col">
    <!-- OVERLAY -->
    <div id="overlay" onclick="toggleProfilePanel()"
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

    <!-- PROFILE PANEL -->
    <div id="profilePanel"
        class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg transform translate-x-full transition duration-300 z-50">

        <div class="p-6">

            <!-- CLOSE -->
            <button onclick="toggleProfilePanel()" class="mb-4 text-gray-500">
                ✕
            </button>

            <!-- FOTO BESAR -->
            <div class="flex justify-center mb-4">
                <img 
                    src="{{ auth()->user()->photo ? asset('storage/'.auth()->user()->photo) : 'https://via.placeholder.com/150' }}"
                    class="w-24 h-24 rounded-full object-cover"
                >
            </div>

            <!-- INFO -->
            <div class="text-center mb-6">
                <div class="font-bold text-lg">
                    {{ auth()->user()->name }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ auth()->user()->email }}
                </div>
                <div class="text-xs text-gray-400 mt-1">
                    {{ auth()->user()->role }}
                </div>
            </div>

            <!-- BUTTON EDIT -->
            <a href="{{ route('profile.edit') }}"
            class="block w-full text-center mb-3 bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">
                Edit Profile
            </a>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded">
                    Logout
                </button>
            </form>

        </div>
    </div>

    {{-- TOP --}}
    <div>
        <!-- LOGO -->
        <div class="p-4 text-lg font-bold border-b border-gray-700">
            Monitoring App
        </div>

        <!-- MENU -->
        <ul class="p-4 space-y-2 text-sm">

                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block p-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="block p-2 rounded {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Manajemen User
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kegiatan.index') }}"
                       class="block p-2 rounded {{ request()->routeIs('admin.kegiatan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Program / Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan.index') }}"
                    class="block p-2 rounded {{ request()->routeIs('admin.laporan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Laporkan Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.evaluasi.index') }}"
                       class="block p-2 rounded {{ request()->routeIs('admin.evaluasi.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Evaluasi Kegiatan
                    </a>
                </li>

        </ul>
    </div>

    {{-- BOTTOM (AUTO NEMPEL BAWAH) --}}
    <div class="mt-auto p-4 border-t border-gray-700">

        <!-- PROFILE INFO -->
        <div onclick="toggleProfilePanel()" 
            class="mb-3 flex items-center space-x-3 cursor-pointer hover:bg-gray-800 p-2 rounded transition">

            <!-- FOTO -->
            <img 
                src="{{ auth()->user()->photo ? asset('storage/'.auth()->user()->photo) : 'https://via.placeholder.com/40' }}"
                class="w-10 h-10 rounded-full object-cover"
            >

            <div>
                <div class="font-semibold text-sm">
                    {{ auth()->user()->name }}
                </div>
                <div class="text-xs text-gray-400">
                    {{ auth()->user()->role }}
                </div>
            </div>
        </div>

    </div>

</aside>

<script>
function toggleProfilePanel() {
    const panel = document.getElementById('profilePanel');
    const overlay = document.getElementById('overlay');

    panel.classList.toggle('translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>