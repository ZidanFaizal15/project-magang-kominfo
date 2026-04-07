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
<a href="{{ route('peserta.kegiatan.show', $kegiatan) }}"
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

<a href="{{ route('peserta.kegiatan.show', $kegiatan) }}"
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