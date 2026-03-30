<x-app-layout>
    <x-slot name="header">
             <h2 class="text-2xl font-bold text-gray-800">
                Pelaporan Kegiatan
            </h2>
            <p class="text-sm text-gray-500">
                Kelola dan lihat laporan kegiatan yang ada di sistem
            </p>
    </x-slot>
    <div class="flex">
        <main class="flex-1 p-6 bg-gray-100">

            <h2 class="text-2xl font-bold mb-4">Edit Laporan</h2>

            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('admin.laporan.update', $laporan->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Pilih Kegiatan --}}
                    <div class="mb-4">
                        <label class="block font-medium">Pilih Kegiatan</label>

                        <select name="kegiatan_id"
                                class="w-full border p-2 rounded">
                            <option value="">-- Pilih Kegiatan --</option>

                            @foreach($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->id }}"
                                    {{ $laporan->kegiatan_id == $kegiatan->id ? 'selected' : '' }}>
                                    {{ $kegiatan->nama_kegiatan }}
                                </option>
                            @endforeach
                        </select>

                        @error('kegiatan_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Isi Laporan --}}
                    <div class="mb-4">
                        <label class="block font-medium">Isi Laporan</label>

                        <textarea name="isi_laporan"
                                  rows="5"
                                  class="w-full border p-2 rounded">{{ old('isi_laporan', $laporan->isi_laporan) }}</textarea>

                        @error('isi_laporan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Dokumentasi Lama --}}
                    @if($laporan->dokumentasi)
                        <div class="mb-4">
                            <label class="block font-medium">Dokumentasi Saat Ini</label>
                            <img src="{{ asset('storage/'.$laporan->dokumentasi) }}"
                                 class="w-64 mt-2 rounded shadow">
                        </div>
                    @endif

                    {{-- Upload Baru --}}
                    <div class="mb-4">
                        <label class="block font-medium">
                            Ganti Dokumentasi (Opsional)
                        </label>

                        <input type="file"
                               name="dokumentasi"
                               class="w-full border p-2 rounded">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-between mt-6">

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            Update Laporan
                        </button>

                        <a href="{{ route('admin.laporan.index') }}"
                           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">
                           Kembali
                        </a>

                    </div>

                </form>

            </div>

        </main>
    </div>
</x-app-layout>