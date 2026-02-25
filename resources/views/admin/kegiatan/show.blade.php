<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Kegiatan
        </h2>
    </x-slot>

    <div class="flex">
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
                       class="block p-2 rounded bg-gray-700">
                        Program / Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan.index') }}"
                    class="block p-2 rounded {{ request()->routeIs('admin.laporan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Laporkan Kegiatan
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

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
                       class="px-3 py-2 bg-yellow-500 text-white rounded">
                        Edit
                    </a>

                    <form action="{{ route('admin.kegiatan.destroy', $kegiatan) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-2 bg-red-600 text-white rounded"
                                onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>

                    <a href="{{ route('admin.kegiatan.cetak', $kegiatan) }}"
                       class="px-3 py-2 bg-indigo-600 text-white rounded">
                        Cetak PDF
                    </a>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
