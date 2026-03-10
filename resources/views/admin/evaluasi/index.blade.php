<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Evaluasi
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

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Kegiatan</th>
                                <th class="px-4 py-2 border">Bidang</th>
                                <th class="px-4 py-2 border">Target</th>
                                <th class="px-4 py-2 border">Jumlah Laporan</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($evaluasis as $index => $evaluasi)
                                <tr>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-2 border">
                                        {{ $evaluasi->kegiatan->nama_kegiatan }}
                                    </td>

                                    <td class="px-4 py-2 border">
                                        {{ $evaluasi->bidang->nama_bidang }}
                                    </td>

                                    <td class="px-4 py-2 border text-center">
                                        {{ $evaluasi->kegiatan->target_laporan }}
                                    </td>

                                    <td class="px-4 py-2 border text-center">
                                        {{ $evaluasi->kegiatan->laporans()->count() }}
                                    </td>

                                    <td class="px-4 py-2 border text-center">
                                        @if($evaluasi->status_pencapaian == 'Tercapai')
                                            <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-sm">
                                                Tercapai
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-200 text-red-800 rounded text-sm">
                                                Belum Tercapai
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-2 border text-center space-x-2">

                                        <a href="{{ route('admin.evaluasi.show', $evaluasi->id) }}"
                                           class="px-3 py-1 bg-blue-500 text-white rounded text-sm">
                                            Detail
                                        </a>

                                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'atasan')
                                            <a href="{{ route('admin.evaluasi.edit', $evaluasi->id) }}"
                                               class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                                                Edit
                                            </a>
                                        @endif

                                        <a href="{{ route('admin.evaluasi.pdf', $evaluasi->id) }}"
                                           class="px-3 py-1 bg-gray-700 text-white rounded text-sm">
                                            PDF
                                        </a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        Belum ada data evaluasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>