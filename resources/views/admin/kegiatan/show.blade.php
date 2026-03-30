<x-app-layout>
    <x-slot name="header">
            <h2 class="text-2xl font-bold text-gray-800">
                Program / Kegiatan
            </h2>
            <p class="text-sm text-gray-500">
                Kelola dan lihat program/kegiatan yang ada di sistem
            </p>
    </x-slot>

     <div class="flex">

        <main class="flex-1 p-6 bg-gray-100">
            <div class="bg-white p-6 rounded shadow space-y-4">

                <p><strong>ID:</strong> {{ $kegiatan->id }}</p>
                <p><strong>Nama:</strong> {{ $kegiatan->nama_kegiatan }}</p>
                <p><strong>Bidang:</strong> {{ $kegiatan->bidang->nama_bidang }}</p>
                <p><strong>Jenis:</strong> {{ $kegiatan->jenis_kegiatan }}</p>
                <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal_kegiatan }}</p>
                <p><strong>Status:</strong> {{ $kegiatan->status }}</p>
                <p><strong>Deskripsi:</strong> {{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                <div class="bg-white p-4 rounded shadow mb-4">

                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'atasan')

                        @if($statusTarget == 'Tercapai')

                            @if(!$kegiatan->evaluasi)
                                <a href="{{ route('admin.evaluasi.create', $kegiatan->id) }}"
                                class="bg-green-600 text-white px-4 py-2 rounded">
                                    Beri Evaluasi
                                </a>
                            @else
                                <a href="{{ route('admin.evaluasi.show', $kegiatan->evaluasi->id) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded">
                                    Lihat Evaluasi
                                </a>
                            @endif

                        @else
                            <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">
                                Target Belum Tercapai
                            </button>
                        @endif

                    @endif

                    <h3 class="font-bold text-lg mb-2 mt-4">Monitoring Target Laporan</h3>

                    <p><strong>Target Laporan:</strong> {{ $target ?? 0 }} User</p>
                    <p><strong>Jumlah User Sudah Melapor:</strong> {{ $jumlahUserMelapor }} User</p>

                    <p>
                        <strong>Status:</strong>
                        @if($statusTarget == 'Tercapai')
                            <span class="text-green-600 font-bold">Tercapai</span>
                        @else
                            <span class="text-red-600 font-bold">Belum Tercapai</span>
                        @endif
                    </p>

                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
                       class="px-3 py-2 bg-yellow-500 text-white rounded">
                        Edit
                    </a>

                    <form action="{{ route('admin.kegiatan.destroy', $kegiatan) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-2 bg-red-600 text-white rounded"
                                onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>

                    <a href="{{ route('admin.kegiatan.cetak', $kegiatan) }}"
                       class="px-3 py-2 bg-indigo-600 text-white rounded">
                        Cetak PDF
                    </a>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
