<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Evaluasi
        </h2>
    </x-slot>


    <div class="flex">
        <!-- CONTENT -->
        <div class="flex-1 p-8 bg-gray-100">

            <div class="bg-white p-8 rounded-lg shadow w-full">

                <h3 class="text-2xl font-semibold mb-6">
                    {{ $evaluasi->kegiatan->nama_kegiatan ?? '-' }}
                </h3>

                <!-- GRID INFORMASI -->
                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-500 text-sm">Bidang</p>
                        <p class="font-semibold text-lg">
                            {{ $evaluasi->kegiatan->bidang->nama_bidang ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Status Pencapaian</p>

                        <span class="px-3 py-1 rounded text-white text-sm
                            {{ $evaluasi->status_pencapaian == 'Tercapai' ? 'bg-green-600' : 'bg-red-600' }}">
                            {{ $evaluasi->status_pencapaian }}
                        </span>
                    </div>

                </div>

                <!-- CATATAN -->
                <div class="mt-8">
                    <p class="text-gray-500 mb-2">Catatan Evaluasi</p>

                    <div class="border p-4 rounded bg-gray-50">
                        {{ $evaluasi->catatan }}
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-8 flex gap-3">

                    <a href="{{ route('peserta.evaluasi.pdf', $evaluasi) }}"
                       class="px-5 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Cetak PDF
                    </a>

                    <a href="{{ route('peserta.evaluasi.index') }}"
                       class="px-5 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>