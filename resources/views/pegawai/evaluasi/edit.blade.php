<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Evaluasi
        </h2>
    </x-slot>

   

        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow-md max-w-4xl">

                <h3 class="text-lg font-semibold mb-4">
                    {{ $evaluasi->kegiatan->nama_kegiatan ?? '-' }}
                </h3>

                <p class="mb-4">
                    <strong>Bidang:</strong>
                    {{ $evaluasi->kegiatan->bidang->nama_bidang ?? '-' }}
                </p>

                <form method="POST" action="{{ route('atasan.evaluasi.update', $evaluasi) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Status Pencapaian
                        </label>

                        <select name="status_pencapaian"
                            class="w-full border rounded px-3 py-2">

                            <option value="Tercapai"
                                {{ $evaluasi->status_pencapaian == 'Tercapai' ? 'selected' : '' }}>
                                Tercapai
                            </option>

                            <option value="Tidak Tercapai"
                                {{ $evaluasi->status_pencapaian == 'Tidak Tercapai' ? 'selected' : '' }}>
                                Tidak Tercapai
                            </option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Catatan Evaluasi
                        </label>

                        <textarea name="catatan"
                            rows="5"
                            class="w-full border rounded px-3 py-2">{{ $evaluasi->catatan }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>

                        <a href="{{ route('atasan.evaluasi.index') }}"
                            class="px-4 py-2 bg-gray-600 text-white rounded">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </main>
    </div>
</x-app-layout>