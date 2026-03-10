<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Buat Evaluasi
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
    </div>

        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow space-y-4">

                <h3 class="text-lg font-bold">
                    {{ $kegiatan->nama_kegiatan }}
                </h3>

                <p><strong>Bidang:</strong> {{ $kegiatan->bidang->nama_bidang }}</p>
                <p><strong>Target:</strong> {{ $kegiatan->target_laporan }} User</p>
                <p><strong>Sudah Melapor:</strong> {{ $jumlahUserMelapor }} User</p>

                <form method="POST" action="{{ route('admin.evaluasi.store') }}">
                    @csrf

                    <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">

                    <div>
                        <label class="block font-semibold mb-2">Catatan Evaluasi</label>
                        <textarea name="catatan"
                                  class="w-full border rounded p-3"
                                  rows="5"
                                  required></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded">
                            Simpan Evaluasi
                        </button>

                        <a href="{{ route('admin.kegiatan.show', $kegiatan) }}"
                           class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </main>
    </div>
</x-app-layout>