<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Pegawai
        </h2>
    </x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Welcome -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                Selamat datang, <b>{{ auth()->user()->name }}</b> 👋  
                <br>
                Berikut adalah ringkasan kegiatan Anda di bidang <b>{{ auth()->user()->bidang->nama_bidang }}</b>.  
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Jumlah Kegiatan -->
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">
                    Jumlah Kegiatan Bidang
                </h3>

                <p class="text-3xl font-bold">
                    {{ $jumlahKegiatan }}
                </p>

                <p class="text-sm mt-2">
                    Total kegiatan pada bidang Anda
                </p>
            </div>

            <!-- Laporan Saya -->
            <div class="bg-green-500 text-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">
                    Laporan Saya
                </h3>

                <p class="text-3xl font-bold">
                    {{ $jumlahLaporanSaya }}
                </p>

                <p class="text-sm mt-2">
                    Total laporan yang sudah Anda kirim
                </p>
            </div>

        </div>

        <!-- Shortcut Menu -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

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

    </div>
</div>
</x-app-layout>