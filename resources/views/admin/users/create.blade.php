<x-app-layout>
<x-slot name="header">
             <h2 class="text-2xl font-bold text-gray-800">
                Daftar User
            </h2>
            <p class="text-sm text-gray-500">
                Kelola user yang memiliki akses ke sistem
            </p>
</x-slot>

<div class="flex">



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
<option value="peserta">Peserta</option>
<option value="mentor">Mentor</option>
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

                        <a href="{{ route('admin.users.index') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded">
                            Kembali
                        </a>

</form>

</div>

</main>
</div>

</x-app-layout>