<aside class="w-64 bg-gray-900 text-gray-100 min-h-screen flex flex-col">

    <!-- OVERLAY -->
    <div id="overlay"
        onclick="toggleProfilePanel()"
        class="fixed inset-0 bg-black/50 hidden z-40">
    </div>

    <!-- PROFILE PANEL -->
    <div id="profilePanel"
        class="fixed top-0 right-0 w-80 h-full bg-white shadow-xl transform translate-x-full transition duration-300 z-50">

        <div class="p-6">

            <!-- CLOSE -->
            <button onclick="toggleProfilePanel()"
                class="mb-4 text-gray-400 hover:text-gray-700 transition">
                ✕
            </button>

            <!-- FOTO -->
            <div class="flex justify-center mb-4">
                <img 
                    src="{{ auth()->user()->photo ? asset('storage/'.auth()->user()->photo) : 'https://via.placeholder.com/150' }}"
                    class="w-24 h-24 rounded-full object-cover shadow">
            </div>

            <!-- INFO -->
            <div class="text-center mb-6">
                <h3 class="font-semibold text-lg text-gray-800">
                    {{ auth()->user()->name }}
                </h3>
                <p class="text-sm text-gray-500">
                    {{ auth()->user()->email }}
                </p>
                <span class="inline-block mt-2 text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>

            <!-- ACTION -->
            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}"
                    class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- TOP -->
    <div>

        <!-- LOGO -->
        <div class="p-4 text-lg font-bold border-b border-gray-700 tracking-wide">
            Monitoring App
        </div>

        <!-- MENU -->
        <ul class="p-4 space-y-2 text-sm">

            <li>
                <a href="{{ route('peserta.dashboard') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg transition
                    {{ request()->routeIs('peserta.dashboard') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-800' }}">
                    
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('peserta.kegiatan.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg transition
                    {{ request()->routeIs('peserta.kegiatan.*') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-800' }}">
                    
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    Program / Kegiatan
                </a>
            </li>

            <li>
                <a href="{{ route('peserta.laporan.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg transition
                    {{ request()->routeIs('peserta.laporan.*') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-800' }}">
                    
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Laporan Kegiatan
                </a>
            </li>

            <li>
                <a href="{{ route('peserta.evaluasi.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg transition
                    {{ request()->routeIs('peserta.evaluasi.*') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-800' }}">
                    
                    <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                    Evaluasi Kegiatan
                </a>
            </li>

        </ul>
    </div>

    <!-- BOTTOM -->
    <div class="mt-auto p-4 border-t border-gray-700">

        <div onclick="toggleProfilePanel()"
            class="flex items-center gap-3 cursor-pointer hover:bg-gray-800 p-2 rounded-lg transition">

            <!-- FOTO -->
            <img 
                src="{{ auth()->user()->photo ? asset('storage/'.auth()->user()->photo) : 'https://via.placeholder.com/40' }}"
                class="w-10 h-10 rounded-full object-cover">

            <div>
                <p class="font-medium text-sm">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-400">
                    {{ ucfirst(auth()->user()->role) }}
                </p>
            </div>
        </div>

    </div>

</aside>

<script>
    lucide.createIcons();

    function toggleProfilePanel() {
        const panel = document.getElementById('profilePanel');
        const overlay = document.getElementById('overlay');

        panel.classList.toggle('translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>