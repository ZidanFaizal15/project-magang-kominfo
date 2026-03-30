<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Pelaporan Kegiatan
        </h2>
        <p class="text-sm text-gray-500">
            Lihat laporan kegiatan yang masuk
        </p>
    </x-slot>


    <main class="flex-1 p-6 bg-gray-100">
        <div class="bg-white p-4 mt-4 rounded shadow">
            <table class="w-full border">
                <thead>
                <tr class="bg-gray-100 text-center">
                <th class="border p-2">ID</th>
                <th class="border p-2">Kegiatan</th>
                <th class="border p-2">Pelapor</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($laporans as $laporan)
                    <tr class="text-center">
                        <td class="border p-2">{{ $laporan->id }}</td>
                        <td class="border p-2">
                            {{ $laporan->kegiatan->nama_kegiatan ?? '-' }}
                        </td>
                        <td class="border p-2">
                            {{ $laporan->user->name ?? '-' }}
                        </td>
                        <td class="border p-2">
                            {{ $laporan->created_at->format('d-m-Y') }}
                        </td>
                        <td class="border p-2 space-x-2">
                            <a href="{{ route('atasan.laporan.show',$laporan) }}"
                            class="px-2 py-1 bg-indigo-600 text-white rounded">
                            Detail
                            </a>
                            <a href="{{ route('atasan.laporan.cetak',$laporan) }}"
                            class="px-2 py-1 bg-green-600 text-white rounded">
                            Cetak
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
</x-app-layout>
