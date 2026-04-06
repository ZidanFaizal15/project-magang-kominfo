<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Pegawai
            </h2>
        </div>
    </x-slot>

    <!-- Welcome -->
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-800">
            Selamat datang, {{ auth()->user()->name }} 👋
        </h3>
        <p class="text-gray-500 text-sm mt-1">
            Berikut adalah ringkasan kegiatan Anda pada bidang 
            <b>{{ auth()->user()->bidang->nama_bidang }}</b>.
        </p>
    </div>

    <div class="flex">

        <!-- Content -->
        <main class="flex-1 p-6 bg-gray-100 space-y-6">

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
                    <h3 class="text-gray-500 text-sm">Kegiatan Bidang</h3>
                    <p class="text-3xl font-bold">{{ $jumlahKegiatan }}</p>
                </div>

                <div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
                    <h3 class="text-gray-500 text-sm">Laporan Saya</h3>
                    <p class="text-3xl font-bold">{{ $jumlahLaporanSaya }}</p>
                </div>

            </div>

            <!-- Shortcut -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <a href="{{ route('pegawai.laporan.index') }}"
                   class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition">
                    <h3 class="font-semibold text-lg">
                        📄 Laporan Kegiatan
                    </h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Lihat dan kelola laporan kegiatan Anda
                    </p>
                </a>

                <a href="{{ route('pegawai.laporan.create') }}"
                   class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition">
                    <h3 class="font-semibold text-lg">
                        ➕ Buat Laporan
                    </h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Kirim laporan kegiatan baru
                    </p>
                </a>

            </div>

        </main>
    </div>
</x-app-layout>