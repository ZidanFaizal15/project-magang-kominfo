<x-app-layout>
    <x-slot name="header">
             <h2 class="text-2xl font-bold text-gray-800">
                Evaluasi Kegiatan
            </h2>
            <p class="text-sm text-gray-500">
                Kelola dan lihat evaluasi yang ada di sistem
            </p>
    </x-slot>

<div class="flex">

    


    <!-- Content -->
    <div class="flex-1 p-6">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

                {{-- 🔥 KEGIATAN SIAP DIEVALUASI --}}
        @if($kegiatanSiap->count())
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-3">
                Kegiatan Siap Dievaluasi
            </h3>

            <div class="flex flex-wrap gap-2">
                @foreach($kegiatanSiap as $item)
                    <a href="{{ route('admin.evaluasi.create', $item->id) }}"
                       class="px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        {{ $item->nama_kegiatan }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">
                    Daftar Evaluasi
                </h3>
            </div>
            <div class="overflow-x-auto">

                <table class="w-full border border-gray-200">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Nama Kegiatan</th>
                            <th class="px-4 py-2 border">Bidang</th>
                            <th class="px-4 py-2 border">Target</th>
                            <th class="px-4 py-2 border">Jumlah Laporan</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($evaluasis as $index => $evaluasi)

                        <tr>

                            <td class="px-4 py-2 border text-center">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-4 py-2 border">
                                {{ $evaluasi->kegiatan->nama_kegiatan }}
                            </td>

                            <td class="px-4 py-2 border">
                                {{ $evaluasi->bidang->nama_bidang }}
                            </td>

                            <td class="px-4 py-2 border text-center">
                                {{ $evaluasi->kegiatan->target_laporan }}
                            </td>

                            <td class="px-4 py-2 border text-center">
                                {{ $evaluasi->kegiatan->laporans()->count() }}
                            </td>

                            <td class="px-4 py-2 border text-center">

                                @if($evaluasi->status_pencapaian == 'Tercapai')

                                    <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-sm">
                                        Tercapai
                                    </span>

                                @else

                                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded text-sm">
                                        Belum Tercapai
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-2 border text-center space-x-2">

                                <a href="{{ route('admin.evaluasi.show', $evaluasi->id) }}"
                                   class="px-3 py-1 bg-blue-500 text-white rounded text-sm">
                                   Detail
                                </a>

                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'mentor')

                                <a href="{{ route('admin.evaluasi.edit', $evaluasi->id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                                   Edit
                                </a>

                                @endif

                                <a href="{{ route('admin.evaluasi.pdf', $evaluasi->id) }}"
                                   class="px-3 py-1 bg-gray-700 text-white rounded text-sm">
                                   PDF
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Belum ada data evaluasi.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</x-app-layout>