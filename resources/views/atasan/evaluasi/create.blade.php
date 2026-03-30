<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Evaluasi Kegiatan
        </h2>
        <p class="text-sm text-gray-500">
            Lakukan Evaluasi terhadap kegiatan yang telah dilaporkan
        </p>
    </x-slot>

    <div class="flex">

        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow space-y-4">

                <h3 class="text-lg font-bold">
                    {{ $kegiatan->nama_kegiatan }}
                </h3>

                <p><strong>Bidang:</strong> {{ $kegiatan->bidang->nama_bidang }}</p>
                <p><strong>Target:</strong> {{ $kegiatan->target_laporan }} User</p>
                <p><strong>Sudah Melapor:</strong> {{ $jumlahUserMelapor }} User</p>

                <form method="POST" action="{{ route('atasan.evaluasi.store') }}">
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

                        <a href="{{ route('atasan.kegiatan.show', $kegiatan) }}"
                           class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </main>
    </div>
</x-app-layout>