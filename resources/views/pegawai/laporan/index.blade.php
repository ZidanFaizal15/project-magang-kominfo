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
        <a href="{{ route('pegawai.laporan.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded">
            + Buat Laporan
        </a>
        <div class="bg-white p-4 mt-4 rounded shadow">
            <table class="w-full border">
                <thead>
                <tr class="bg-gray-100 text-center">
                <th class="border p-2">ID</th>
                <th class="border p-2">Kegiatan</th>
                <th class="border p-2">Pelapor</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($laporans as $laporan)
                    <tr class="text-center">
                        <td class="border p-2">{{ $laporan->id }}</td>
                        <td class="border p-2">
                            {{ $laporan->kegiatan->nama_kegiatan ?? '-' }}
                        </td>
                        <td class="border p-2">
                            {{ $laporan->user->name ?? '-' }}
                        </td>
                        <td class="border p-2">
                            {{ $laporan->created_at->format('d-m-Y') }}
                        </td>
                        <td class="border p-2 space-x-2">
                            <a href="{{ route('pegawai.laporan.show',$laporan) }}"
                            class="px-2 py-1 bg-indigo-600 text-white rounded">
                            Detail
                            </a>
                            <a href="{{ route('pegawai.laporan.cetak',$laporan) }}"
                            class="px-2 py-1 bg-green-600 text-white rounded">
                            Cetak
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
</x-app-layout>
