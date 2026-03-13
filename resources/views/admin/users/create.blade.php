<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800">
Tambah User
</h2>
</x-slot>

<div class="flex">

<!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen text-white">
            <div class="p-4 font-bold text-lg border-b border-gray-700">
                Admin Panel
            </div>
            <ul class="p-4 space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block p-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="block p-2 rounded {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Manajemen User
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kegiatan.index') }}"
                       class="block p-2 rounded {{ request()->routeIs('admin.kegiatan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Program / Kegiatan
                    </a>
                </li>
                                <li>
                    <a href="{{ route('admin.laporan.index') }}"
                    class="block p-2 rounded {{ request()->routeIs('admin.laporan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Laporkan Kegiatan
                    </a>
                </li>
            </ul>
        </aside>

<!-- Content -->
<main class="flex-1 p-6 bg-gray-100">

<div class="bg-white p-6 rounded shadow max-w-xl">

<form method="POST" action="{{ route('admin.users.store') }}">
@csrf

<div class="mb-4">
<label class="block mb-1">Nama</label>
<input type="text" name="name"
class="w-full border rounded p-2">
</div>

<div class="mb-4">
<label class="block mb-1">Email</label>
<input type="email" name="email"
class="w-full border rounded p-2">
</div>

<div class="mb-4">
<label class="block mb-1">Password</label>
<input type="password" name="password"
class="w-full border rounded p-2">
</div>

<div class="mb-4">
<label class="block mb-1">Role</label>
<select name="role" class="w-full border rounded p-2">
<option value="pegawai">Pegawai</option>
<option value="atasan">Atasan</option>
<option value="admin">Admin</option>
</select>
</div>

<div class="mb-4">
<label class="block mb-1">Bidang</label>
<select name="bidang_id" class="w-full border rounded p-2">
<option value="">-- Pilih Bidang --</option>

@foreach($bidangs as $bidang)

<option value="{{ $bidang->id }}">
{{ $bidang->nama_bidang }}
</option>

@endforeach

</select>
</div>

<button
class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
Simpan
</button>

</form>

</div>

</main>
</div>

</x-app-layout>