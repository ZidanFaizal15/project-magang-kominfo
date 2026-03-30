<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Program Kegiatan
            </h2>
            <p class="text-sm text-gray-500">
                Lihat program dan kegiatan yang tersedia untuk anda
            </p>
        </div>
    </x-slot>

        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow space-y-4">

                <p><strong>ID:</strong> {{ $kegiatan->id }}</p>
                <p><strong>Nama:</strong> {{ $kegiatan->nama_kegiatan }}</p>
                <p><strong>Bidang:</strong> {{ $kegiatan->bidang->nama_bidang }}</p>
                <p><strong>Jenis:</strong> {{ $kegiatan->jenis_kegiatan }}</p>
                <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal_kegiatan }}</p>
                <p><strong>Status:</strong> {{ $kegiatan->status }}</p>
                <p><strong>Deskripsi:</strong> {{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <div class="pt-4 border-t">
                <a href="{{ route('pegawai.kegiatan.index') }}"
                class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>

        </main>
    </div>
</x-app-layout>
