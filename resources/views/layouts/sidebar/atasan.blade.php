<aside class="w-64 bg-gray-900 text-gray-100 min-h-screen flex flex-col">

    {{-- TOP --}}
    <div>
        <!-- LOGO -->
        <div class="p-4 text-lg font-bold border-b border-gray-700">
            Monitoring App
        </div>

        <!-- MENU -->
        <ul class="p-4 space-y-2 text-sm">
            <li>
                <a href="{{ route('atasan.dashboard') }}"
                   class="block p-2 rounded {{ request()->routeIs('atasan.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('atasan.kegiatan.index') }}"
                   class="block p-2 rounded {{ request()->routeIs('atasan.kegiatan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    Program / Kegiatan
                </a>
            </li>

            <li>
                <a href="{{ route('atasan.laporan.index') }}"
                   class="block p-2 rounded {{ request()->routeIs('atasan.laporan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    Laporan Kegiatan
                </a>
            </li>

            <li>
                <a href="{{ route('atasan.evaluasi.index') }}"
                   class="block p-2 rounded {{ request()->routeIs('atasan.evaluasi.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
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