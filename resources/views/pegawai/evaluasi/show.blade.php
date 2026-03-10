<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Evaluasi
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
            <div class="bg-white p-6 rounded shadow-md max-w-4xl">

                <h3 class="text-lg font-semibold mb-4">
                    {{ $evaluasi->kegiatan->nama_kegiatan ?? '-' }}
                </h3>

                <p><strong>Bidang:</strong>
                    {{ $evaluasi->kegiatan->bidang->nama_bidang ?? '-' }}
                </p>

                <p><strong>Status Pencapaian:</strong>
                    <span class="px-2 py-1 rounded text-white
                        {{ $evaluasi->status_pencapaian == 'Tercapai' ? 'bg-green-600' : 'bg-red-600' }}">
                        {{ $evaluasi->status_pencapaian }}
                    </span>
                </p>

                <div class="mt-4">
                    <strong>Catatan Evaluasi:</strong>
                    <div class="border p-3 rounded mt-2 bg-gray-50">
                        {{ $evaluasi->catatan }}
                    </div>
                </div>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('pegawai.evaluasi.pdf', $evaluasi) }}"
                    class="px-4 py-2 bg-red-600 text-white rounded">
                        Cetak PDF
                    </a>

                    <a href="{{ route('pegawai.evaluasi.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded">
                        Kembali
                    </a>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>