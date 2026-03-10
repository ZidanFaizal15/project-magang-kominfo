<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Buat Program / Kegiatan
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

        <!-- Content -->
        <main class="flex-1 p-6 bg-gray-100 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Daftar Kegiatan</h3>

                <a href="{{ route('atasan.kegiatan.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Kegiatan
                </a>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100 text-center">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Bidang</th>
                            <th class="border p-2">Jenis</th>
                            <th class="border p-2">Tanggal</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatans as $kegiatan)
                            <tr class="text-center hover:bg-gray-50">
                                <td class="border p-2">{{ $kegiatan->id }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('atasan.kegiatan.show', $kegiatan) }}"
                                       class="text-blue-600 hover:underline">
                                        {{ $kegiatan->nama_kegiatan }}
                                    </a>
                                </td>
                                <td>{{ $kegiatan->bidang->nama_bidang ?? '-' }}</td>
                                <td class="border p-2">{{ $kegiatan->jenis_kegiatan }}</td>
                                <td class="border p-2">{{ $kegiatan->tanggal_kegiatan }}</td>
                                <td class="border p-2">
                                    <span class="px-2 py-1 rounded text-white
                                        {{ $kegiatan->status == 'Selesai' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                        {{ $kegiatan->status }}
                                    </span>
                                </td>
                                <td class="border p-2">
                                    <a href="{{ route('atasan.kegiatan.show', $kegiatan) }}"
                                       class="px-2 py-1 bg-indigo-600 text-white rounded">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border p-4 text-center text-gray-500">
                                    Belum ada data kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    <div class="py-6">
</x-app-layout>
