<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Atasan
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen text-white">
            <div class="p-4 font-bold text-lg border-b border-gray-700">
                Atasan Panel
            </div>
            <ul class="p-4 space-y-2">
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
        </aside>
    <div class="py-6">

    <!-- Content -->
    <main class="flex-1 p-6 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Total Kegiatan -->
                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
                    <h3 class="text-gray-500 text-sm">Total Kegiatan</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalKegiatan }}
                    </p>
                </div>

                <!-- Total Laporan -->
                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-green-500">
                    <h3 class="text-gray-500 text-sm">Total Laporan Masuk</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalLaporan }}
                    </p>
                </div>

                <!-- Kegiatan Tercapai -->
                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-purple-500">
                    <h3 class="text-gray-500 text-sm">Kegiatan Mencapai Target</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $kegiatanTercapai }}
                    </p>
                </div>
            </div>

            <!-- Informasi tambahan -->
            <div class="mt-8 bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Informasi Dashboard
                </h3>

                <p class="text-gray-600">
                        Dashboard ini menampilkan ringkasan kegiatan pada bidang yang Anda kelola.
                        Atasan dapat melihat jumlah kegiatan yang tersedia, total laporan yang telah
                        dikirim oleh pegawai, serta kegiatan yang telah mencapai target laporan
                        yang ditentukan.
                </p>
            </div>
        </div>
    </main>
</x-app-layout>