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

        <h2 class="text-2xl font-bold mb-4">Buat Laporan</h2>

        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('pegawai.laporan.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- Pilih Kegiatan --}}
                <div class="mb-4">
                    <label class="block font-medium">Pilih Kegiatan</label>

                    <select name="kegiatan_id"
                            class="w-full border p-2 rounded">
                        <option value="">-- Pilih Kegiatan --</option>

                        @foreach($kegiatans as $kegiatan)
                            <option value="{{ $kegiatan->id }}">
                                {{ $kegiatan->nama_kegiatan }}
                            </option>
                        @endforeach
                    </select>

                    @error('kegiatan_id')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Isi Laporan --}}
                <div class="mb-4">
                    <label class="block font-medium">Isi Laporan</label>

                    <textarea name="isi_laporan"
                              rows="5"
                              class="w-full border p-2 rounded"></textarea>

                    @error('isi_laporan')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Upload Dokumentasi --}}
                <div class="mb-4">
                    <label class="block font-medium">
                        Dokumentasi (Opsional)
                    </label>

                    <input type="file"
                           name="dokumentasi"
                           class="w-full border p-2 rounded">
                </div>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                    Simpan Laporan
                </button>

            </form>

        </div>

    </main>
</div>
</x-app-layout>
