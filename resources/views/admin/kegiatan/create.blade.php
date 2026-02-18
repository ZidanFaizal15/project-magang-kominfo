<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Kegiatan
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

        <!-- Content -->
        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('admin.kegiatan.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-4">

                    @csrf

                    <div>
                        <label class="block font-medium">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan"
                               value="{{ old('nama_kegiatan') }}"
                               class="w-full border rounded p-2" required>
                    </div>

                    <div>
                        <label class="block font-medium">Jenis Kegiatan</label>
                        <input type="text" name="jenis_kegiatan"
                               value="{{ old('jenis_kegiatan') }}"
                               class="w-full border rounded p-2" required>
                    </div>

                    <div>
                        <label class="block font-medium">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan"
                               value="{{ old('tanggal_kegiatan') }}"
                               class="w-full border rounded p-2" required>
                    </div>

                    <div>
                        <label class="block font-medium">Status</label>
                        <select name="status" class="w-full border rounded p-2" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>

                        <a href="{{ route('admin.kegiatan.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </main>
    </div>
</x-app-layout>
