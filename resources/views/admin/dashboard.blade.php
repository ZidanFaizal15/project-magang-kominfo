<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Admin
        </h2>
    </x-slot>

        <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen text-white">
            <div class="p-4 font-bold text-lg border-b border-gray-700">
                Admin Panel
            </div>
            <ul class="p-4 space-y-2">
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
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6 bg-gray-100">
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                        <!-- Total User -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-gray-500 text-sm">Total User</h3>
                            <p class="text-3xl font-bold">{{ $totalUser }}</p>
                        </div>

                        <!-- Total Kegiatan -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-gray-500 text-sm">Total Kegiatan</h3>
                            <p class="text-3xl font-bold">{{ $totalKegiatan }}</p>
                        </div>

                        <!-- Total Laporan -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-gray-500 text-sm">Total Laporan</h3>
                            <p class="text-3xl font-bold">{{ $totalLaporan }}</p>
                        </div>

                        <!-- Total Evaluasi -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-gray-500 text-sm">Total Evaluasi</h3>
                            <p class="text-3xl font-bold">{{ $totalEvaluasi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
