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
<main class="flex-1 p-6 bg-gray-100">

<div class="bg-white p-6 rounded-xl shadow max-w-xl">
<form method="POST" action="{{ route('admin.users.store') }}">
@csrf

<!-- NAMA -->
<div class="mb-4">
    <label class="block mb-1 font-medium">Nama</label>
    <input type="text" name="name"
        value="{{ old('name') }}"
        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200
        @error('name') border-red-500 @enderror">

    @error('name')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- EMAIL -->
<div class="mb-4">
    <label class="block mb-1 font-medium">Email</label>
    <input type="email" name="email"
        value="{{ old('email') }}"
        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200
        @error('email') border-red-500 @enderror">

    @error('email')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- PASSWORD -->
<div class="mb-4">
    <label class="block mb-1 font-medium">Password</label>
    <input type="password" name="password"
        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200
        @error('password') border-red-500 @enderror">

    @error('password')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- ROLE -->
<div class="mb-4">
    <label class="block mb-1 font-medium">Role</label>
    <select name="role" id="role"
        onchange="toggleBidang(this.value)"
        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200
        @error('role') border-red-500 @enderror">

        <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
        <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>

    @error('role')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- BIDANG -->
<div class="mb-4">
    <label class="block mb-1 font-medium">Bidang</label>
    <select name="bidang_id" id="bidang_id"
        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200
        @error('bidang_id') border-red-500 @enderror">

        <option value="">-- Pilih Bidang --</option>

        @foreach($bidangs as $bidang)
            <option value="{{ $bidang->id }}"
                {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                {{ $bidang->nama_bidang }}
            </option>
        @endforeach

    </select>

    @error('bidang_id')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- BUTTON -->
<div class="flex gap-2">
    <button
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        Simpan
    </button>

    <a href="{{ route('admin.users.index') }}"
        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
        Kembali
    </a>
</div>

</form>

</div>
</main>
</div>

<!-- SCRIPT -->
<script>
function toggleBidang(role) {
    const bidang = document.getElementById('bidang_id');

    if (role === 'admin') {
        bidang.value = '';
        bidang.disabled = true;
    } else {
        bidang.disabled = false;
    }
}

// AUTO LOAD (biar tetap sesuai saat error)
document.addEventListener('DOMContentLoaded', function () {
    toggleBidang(document.getElementById('role').value);
});
</script>

</x-app-layout>