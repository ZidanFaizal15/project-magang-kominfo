<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Pelaporan Kegiatan
        </h2>
    </x-slot>
    <div class="flex">
            <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen text-white">
            <div class="p-4 font-bold text-lg border-b border-gray-700">
                Panel Pegawai
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
        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-2xl font-bold mb-4">
                Detail Laporan
            </h2>

            <div class="mb-3">
                <strong>Kegiatan:</strong><br>
                {{ $laporan->kegiatan->nama_kegiatan ?? '-' }}
            </div>

            <div class="mb-3">
                <strong>Pelapor:</strong><br>
                {{ $laporan->user->name ?? '-' }}
            </div>

            <div class="mb-3">
                <strong>Tanggal:</strong><br>
                {{ $laporan->created_at->format('d-m-Y H:i') }}
            </div>

            <div class="mb-3">
                <strong>Isi Laporan:</strong><br>
                <div class="border p-3 bg-gray-50 rounded">
                    {{ $laporan->isi_laporan }}
                </div>
            </div>

            @if($laporan->dokumentasi)
            <div class="mb-3">
                <strong>Dokumentasi:</strong><br>
                <img src="{{ asset('storage/'.$laporan->dokumentasi) }}"
                     class="w-64 mt-2 rounded shadow">
            </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('pegawai.laporan.index') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded">
                   Kembali
                </a>
            </div>

        </div>

    </main>
</div>
</x-app-layout>
