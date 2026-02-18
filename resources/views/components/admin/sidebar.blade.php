<aside class="w-64 bg-gray-800 text-white min-h-screen">
    <div class="p-4 font-bold text-lg border-b border-gray-700">
        Admin Panel
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="block px-3 py-2 rounded 
           {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.kegiatan.index') }}"
           class="block px-3 py-2 rounded 
           {{ request()->routeIs('admin.kegiatan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            Kegiatan
        </a>

        <a href="{{ route('admin.users.index') }}"
           class="block px-3 py-2 rounded 
           {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            User
        </a>
    </nav>
</aside>
