<aside class="w-64 bg-gray-800 min-h-screen text-white">
    <div class="p-4 font-bold text-lg border-b border-gray-700">
        Admin Panel
    </div>

    <ul class="p-4 space-y-2">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="block p-2 rounded hover:bg-gray-700">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.users.index') }}"
               class="block p-2 rounded hover:bg-gray-700">
                Manajemen User
            </a>
        </li>

        <li>
            <a href="{{ route('admin.kegiatan.index') }}"
               class="block p-2 rounded hover:bg-gray-700">
                Program / Kegiatan
            </a>
        </li>
    </ul>
</aside>
