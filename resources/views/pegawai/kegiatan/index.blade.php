<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800">
Program / Kegiatan
</h2>
</x-slot>

<div class="flex">

<!-- Sidebar -->
<aside class="w-64 bg-gray-800 min-h-screen text-white">
<div class="p-4 font-bold text-lg border-b border-gray-700">
Panel Karyawan
</div>

<ul class="p-4 space-y-2">

<li>
<a href="{{ route('pegawai.dashboard') }}"
class="block p-2 rounded {{ request()->routeIs('pegawai.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
Dashboard
</a>
</li>

<li>
<a href="{{ route('pegawai.kegiatan.index') }}"
class="block p-2 rounded {{ request()->routeIs('pegawai.kegiatan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
Program / Kegiatan
</a>
</li>

<li>
<a href="{{ route('pegawai.laporan.index') }}"
class="block p-2 rounded {{ request()->routeIs('pegawai.laporan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
Laporan Kegiatan
</a>
</li>

<li>
<a href="{{ route('pegawai.evaluasi.index') }}"
class="block p-2 rounded {{ request()->routeIs('pegawai.evaluasi.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
Evaluasi Kegiatan
</a>
</li>

</ul>
</aside>


<!-- Content -->
<main class="flex-1 p-6 bg-gray-100 space-y-6">

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded">
{{ session('success') }}
</div>
@endif


<div class="flex justify-between items-center">
<h3 class="text-lg font-semibold">Daftar Kegiatan</h3>
</div>


<div class="bg-white p-4 rounded shadow">

<table class="w-full border">

<thead>
<tr class="bg-gray-100 text-center">
<th class="border p-2">ID</th>
<th class="border p-2">Nama</th>
<th class="border p-2">Bidang</th>
<th class="border p-2">Jenis</th>
<th class="border p-2">Tanggal</th>
<th class="border p-2">Status</th>
<th class="border p-2">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($kegiatans as $kegiatan)

<tr class="text-center hover:bg-gray-50">

<td class="border p-2">
{{ $kegiatan->id }}
</td>

<td class="border p-2">
<a href="{{ route('pegawai.kegiatan.show', $kegiatan) }}"
class="text-blue-600 hover:underline">
{{ $kegiatan->nama_kegiatan }}
</a>
</td>

<td class="border p-2">
{{ $kegiatan->bidang->nama_bidang ?? '-' }}
</td>

<td class="border p-2">
{{ $kegiatan->jenis_kegiatan }}
</td>

<td class="border p-2">
{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
</td>

<td class="border p-2">

<span class="px-2 py-1 rounded text-white
{{ strtolower($kegiatan->status) == 'selesai' ? 'bg-green-600' : 'bg-yellow-500' }}">

{{ ucfirst($kegiatan->status) }}

</span>

</td>

<td class="border p-2">

<a href="{{ route('pegawai.kegiatan.show', $kegiatan) }}"
class="px-2 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
Lihat
</a>

</td>

</tr>

@empty

<tr>
<td colspan="7" class="border p-4 text-center text-gray-500">
Belum ada data kegiatan.
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</main>

</div>

</x-app-layout>