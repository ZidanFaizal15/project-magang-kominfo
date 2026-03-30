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

            @if($errors->any())
                <div class="mb-4 text-red-600">
                    {{ implode(', ', $errors->all()) }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow max-w-xl">

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium">Nama</label>
                        <input type="text" name="name"
                               value="{{ old('name', $user->name) }}"
                               class="border p-2 rounded w-full">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               class="border p-2 rounded w-full">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Role</label>
                        <select name="role" class="border p-2 rounded w-full">
                            <option value="admin" @selected($user->role=='admin')>Admin</option>
                            <option value="pegawai" @selected($user->role=='pegawai')>Pegawai</option>
                            <option value="atasan" @selected($user->role=='atasan')>Atasan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Bidang
                        </label>

                        <select name="bidang_id"
                                class="mt-1 block w-full border-gray-300 rounded-md">

                            <option value="">-- Pilih Bidang --</option>

                            @foreach($bidangs as $bidang)
                                <option value="{{ $bidang->id }}"
                                    {{ $user->bidang_id == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama_bidang }}
                                </option>
                            @endforeach
                        </select>

                        @error('bidang_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Password Baru (Opsional)</label>
                        <input type="password" name="password"
                               class="border p-2 rounded w-full">
                    </div>

                    <button class="px-4 py-2 bg-blue-600 text-white rounded">
                        Update User
                    </button>
                </form>

                <!-- ACTION AREA -->
                <div class="mt-8 pt-6 border-t">

                    <h3 class="text-lg font-semibold mb-4 text-gray-700">
                        Aksi Tambahan
                    </h3>

                    <div class="flex gap-3">

                        <!-- Toggle Status -->
                        <form method="POST"
                            action="{{ route('admin.users.toggle', $user) }}">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                class="px-4 py-2 rounded text-white 
                                {{ $user->is_active 
                                    ? 'bg-yellow-600 hover:bg-yellow-700' 
                                    : 'bg-green-600 hover:bg-green-700' }}">
                                {{ $user->is_active ? 'Blacklist User' : 'Aktifkan User' }}
                            </button>
                        </form>

                        <!-- Delete User -->
                        @if($user->id !== auth()->id())
                        <form method="POST"
                            action="{{ route('admin.users.destroy', $user) }}"
                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                                Hapus User
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('admin.users.index') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded">
                            Kembali
                        </a>
                        
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
