<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Program/Kegiatan
        </h2>
        <p class="text-sm text-gray-500">
            Lihat dan kelola program/kegiatan
        </p>
    </x-slot>

    <div class="flex">

        <!-- Content -->
        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('mentor.kegiatan.store') }}"
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

                    <div class="mb-4">
                        <label class="block font-medium">Bidang</label>

                        <select name="bidang_id" class="border p-2 rounded w-full">

                            @if(auth()->user()->role === 'admin')
                                <option value="">-- Pilih Bidang --</option>
                            @endif

                            @foreach($bidangs as $bidang)
                                <option value="{{ $bidang->id }}">
                                    {{ $bidang->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
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
                            <option value="Proses" selected>Proses</option>
                        </select>

                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Target Laporan
                        </label>

                    <input type="number"
                        name="target_laporan"
                        min="1"
                        value="{{ old('target_laporan', $kegiatan->target_laporan ?? 1) }}"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">
                            Deskripsi Kegiatan
                        </label>

                        <textarea name="deskripsi"
                                rows="4"
                                class="mt-1 block w-full border-black-300 rounded-md"
                                placeholder="Masukkan deskripsi kegiatan (opsional)">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>

                        <a href="{{ route('mentor.kegiatan.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </main>
    </div>
</x-app-layout>
