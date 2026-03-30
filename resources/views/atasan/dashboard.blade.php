<x-app-layout>
<x-slot name="header">
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Atasan
            </h2>
</x-slot>

<div class="flex">
<!-- Content -->
<main class="flex-1 p-6 bg-gray-100">

<div class="max-w-7xl mx-auto space-y-6">

    <!-- 🔥 WELCOME USER -->
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-800">
            Selamat datang, {{ auth()->user()->name }} 👋
        </h3>
        <p class="text-gray-500 text-sm mt-1">
            Berikut adalah ringkasan kegiatan dan laporan kegiatan yang bisa anda kelola.
        </p>
    </div>


    <!-- 📊 STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
            <h3 class="text-gray-500 text-sm">Total Kegiatan</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalKegiatan }}
            </p>
        </div>

        <div class="bg-white shadow rounded-xl p-6 border-l-4 border-green-500">
            <h3 class="text-gray-500 text-sm">Total Laporan Masuk</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalLaporan }}
            </p>
        </div>

        <div class="bg-white shadow rounded-xl p-6 border-l-4 border-purple-500">
            <h3 class="text-gray-500 text-sm">Kegiatan Mencapai Target</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $kegiatanTercapai }}
            </p>
        </div>

    </div>



    <!-- 📋 KEGIATAN TERBARU -->
    <div class="bg-white shadow rounded-xl p-6">

        <h3 class="text-lg font-semibold text-gray-700 mb-4">
            Kegiatan Terbaru
        </h3>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Nama Kegiatan</th>
                    <th class="border p-2 text-center">Tanggal</th>
                    <th class="border p-2 text-center">Progress</th>
                    <th class="border p-2 text-center">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kegiatan->take(5) as $item)
                <tr>
                    <td class="border p-2">
                        {{ $item->nama_kegiatan }}
                    </td>

                    <td class="border p-2 text-center">
                        {{ $item->tanggal_kegiatan }}
                    </td>

                    <td class="border p-2 text-center">
                        {{ $item->laporans()->count() }} / {{ $item->target_laporan }}
                    </td>

                    <td class="border p-2 text-center">
                        @if($item->laporans()->count() >= $item->target_laporan)
                            <span class="px-2 py-1 bg-green-600 text-white rounded text-sm">
                                Selesai
                            </span>
                        @else
                            <span class="px-2 py-1 bg-yellow-500 text-white rounded text-sm">
                                Proses
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-500">
                        Belum ada kegiatan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

</main>

</div>

</x-app-layout>