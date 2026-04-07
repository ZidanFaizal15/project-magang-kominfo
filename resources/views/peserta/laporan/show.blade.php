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

        <div class="mt-6 flex items-center gap-2">
            <a href="{{ route('peserta.laporan.edit', $laporan->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">
                Edit
            </a>

            <form action="{{ route('peserta.laporan.destroy', $laporan->id) }}"
                method="POST">
                @csrf
                @method('DELETE')

                <button onclick="return confirm('Yakin hapus laporan?')"
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                    Hapus
                </button>
            </form>

            <a href="{{ route('peserta.laporan.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded">
                Kembali
            </a>
        </div>

        </div>

    </main>
</div>
</x-app-layout>
