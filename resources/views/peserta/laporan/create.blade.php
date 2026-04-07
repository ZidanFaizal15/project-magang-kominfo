<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Pelaporan Kegiatan
            </h2>
            <p class="text-sm text-gray-500">
                Kelola dan lihat laporan kegiatan Anda
            </p>
        </div>
    </x-slot>
    <main class="flex-1 p-6 bg-gray-100">

        <h2 class="text-2xl font-bold mb-4">Buat Laporan</h2>

        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('peserta.laporan.store') }}"
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

                <a href="{{ route('peserta.laporan.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded">
                    Kembali
                </a>

            </form>

        </div>

    </main>
</div>
</x-app-layout>
