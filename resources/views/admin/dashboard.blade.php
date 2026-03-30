<x-app-layout>
<x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Admin
            </h2>
        </div>
</x-slot>

<div class="flex">



<!-- Content -->
<main class="flex-1 p-6 bg-gray-100 space-y-6">

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

<div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
<h3 class="text-gray-500 text-sm">Total User</h3>
<p class="text-3xl font-bold">{{ $totalUser }}</p>
</div>

<div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
<h3 class="text-gray-500 text-sm">Total Kegiatan</h3>
<p class="text-3xl font-bold">{{ $totalKegiatan }}</p>
</div>

<div class="bg-white p-6 rounded shadow border-l-4 border-yellow-500">
<h3 class="text-gray-500 text-sm">Total Laporan</h3>
<p class="text-3xl font-bold">{{ $totalLaporan }}</p>
</div>

<div class="bg-white p-6 rounded shadow border-l-4 border-purple-500">
<h3 class="text-gray-500 text-sm">Total Evaluasi</h3>
<p class="text-3xl font-bold">{{ $totalEvaluasi }}</p>
</div>

</div>


<!-- Quick Action -->
<div class="bg-white p-6 rounded shadow">

<h3 class="text-lg font-semibold mb-4">
Aksi Cepat
</h3>

<div class="flex gap-4">

<a href="{{ route('admin.users.create') }}"
class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
+ Tambah User
</a>

<a href="{{ route('admin.kegiatan.create') }}"
class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
+ Tambah Kegiatan
</a>

<a href="{{ route('admin.laporan.index') }}"
class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
Lihat Laporan
</a>

<a href="{{ route('admin.evaluasi.index') }}"
class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
Lihat Evaluasi
</a>

</div>

</div>


<!-- Aktivitas Terbaru -->
<div class="grid md:grid-cols-3 gap-6">

<!-- Kegiatan -->
<div class="bg-white p-4 rounded shadow">

<h3 class="font-semibold mb-3">Kegiatan Terbaru</h3>

<ul class="space-y-2">

@foreach($kegiatanTerbaru as $item)

<li class="border-b pb-1">
{{ $item->nama_kegiatan }}
</li>

@endforeach

</ul>

</div>


<!-- Laporan -->
<div class="bg-white p-4 rounded shadow">

<h3 class="font-semibold mb-3">Laporan Terbaru</h3>

<ul class="space-y-2">

@foreach($laporanTerbaru as $item)

<li class="border-b pb-1">
{{ $item->user->name ?? '-' }}
</li>

@endforeach

</ul>

</div>


<!-- Evaluasi -->
<div class="bg-white p-4 rounded shadow">

<h3 class="font-semibold mb-3">Evaluasi Terbaru</h3>

<ul class="space-y-2">

@foreach($evaluasiTerbaru as $item)

<li class="border-b pb-1">
{{ $item->kegiatan->nama_kegiatan ?? '-' }}
</li>

@endforeach

</ul>

</div>

</div>

</main>

</div>

</x-app-layout>