<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Pelaporan Kegiatan
        </h2>
    </x-slot>

    <main class="flex-1 p-6 bg-gray-100">
        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-2xl font-bold mb-4">
                Detail Laporan
            </h2>

            <div class="mb-3">
                <strong>Kegiatan:</strong><br>
                {{ $laporan->kegiatan->nama_kegiatan ?? '-' }}
            </div>

            <div class="mb-3">
                <strong>Pelapor:</strong><br>
                {{ $laporan->user->name ?? '-' }}
            </div>

            <div class="mb-3">
                <strong>Tanggal:</strong><br>
                {{ $laporan->created_at->format('d-m-Y H:i') }}
            </div>

            <div class="mb-3">
                <strong>Isi Laporan:</strong><br>
                <div class="border p-3 bg-gray-50 rounded">
                    {{ $laporan->isi_laporan }}
                </div>
            </div>

            @if($laporan->dokumentasi)
            <div class="mb-3">
                <strong>Dokumentasi:</strong><br>
                <img src="{{ asset('storage/'.$laporan->dokumentasi) }}"
                     class="w-64 mt-2 rounded shadow">
            </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('atasan.laporan.index') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded">
                   Kembali
                </a>
            </div>

        </div>

    </main>
</div>
</x-app-layout>
