<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Kegiatan
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen text-white">
            <div class="p-4 font-bold text-lg border-b border-gray-700">
                Panel Karyawan
            </div>
            <ul class="p-4 space-y-2">
                <li>
                    <a href="{{ route('pegawai.dashboard') }}"
                       class="block p-2 rounded {{ request()->routeIs('pegawai.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('pegawai.kegiatan.index') }}"
                       class="block p-2 rounded {{ request()->routeIs('pegawai.kegiatan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Program / Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('pegawai.laporan.index') }}"
                    class="block p-2 rounded {{ request()->routeIs('pegawai.laporan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Laporan Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('pegawai.evaluasi.index') }}"
                       class="block p-2 rounded {{ request()->routeIs('pegawai.evaluasi.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Evaluasi Kegiatan
                    </a>
                </li>
            </ul>
        </aside>

        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow space-y-4">

                <p><strong>ID:</strong> {{ $kegiatan->id }}</p>
                <p><strong>Nama:</strong> {{ $kegiatan->nama_kegiatan }}</p>
                <p><strong>Bidang:</strong> {{ $kegiatan->bidang->nama_bidang }}</p>
                <p><strong>Jenis:</strong> {{ $kegiatan->jenis_kegiatan }}</p>
                <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal_kegiatan }}</p>
                <p><strong>Status:</strong> {{ $kegiatan->status }}</p>
                <p><strong>Deskripsi:</strong> {{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </main>
    </div>
</x-app-layout>
